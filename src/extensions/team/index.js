/**
 * Team
 *
 * Editor side of the Team post type (inc/team.php):
 *
 * - "Team details" panel in the document sidebar of team members, one text
 *   field per `bnti_team_*` meta field (the list comes from PHP, `bntiTeam`).
 * - The "Team member" block bindings source (`bnti/team`), so bound blocks
 *   show the member's values in the editor too, including inside a Query
 *   Loop. The values mirror bnti_team_binding_value() in PHP.
 */
import { __, sprintf } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel, store as editorStore } from '@wordpress/editor';
import { TextControl, __experimentalVStack as VStack } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEntityProp, store as coreStore } from '@wordpress/core-data';
import { registerBlockBindingsSource } from '@wordpress/blocks';

const POST_TYPE = 'bnti_team';
const { fields = [], firmName = 'Brilliant Insurance' } = window.bntiTeam || {};

// -----------------------------------------------------------------------------
// Team details panel
// -----------------------------------------------------------------------------

const TeamDetailsPanel = () => {
    const postType = useSelect(select => select(editorStore).getCurrentPostType(), []);
    const [meta, setMeta] = useEntityProp('postType', POST_TYPE, 'meta');

    if (postType !== POST_TYPE || !meta) {
        return null;
    }

    return (
        <PluginDocumentSettingPanel name="bnti-team-details" title={__('Team details', 'brilliant-insurance')}>
            <VStack spacing={4}>
                {fields.map(({ key, label, description }) => (
                    <TextControl
                        key={key}
                        __next40pxDefaultSize
                        __nextHasNoMarginBottom
                        label={label}
                        help={description}
                        value={meta[key] || ''}
                        onChange={value => setMeta({ ...meta, [key]: value })}
                    />
                ))}
            </VStack>
        </PluginDocumentSettingPanel>
    );
};

registerPlugin('bnti-team-details', { render: TeamDetailsPanel });

// -----------------------------------------------------------------------------
// "Team member" binding source
// -----------------------------------------------------------------------------

const escapeHtml = text => String(text).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');

const stripTags = html => {
    const doc = document.implementation.createHTMLDocument('');
    doc.body.innerHTML = html || '';
    return doc.body.textContent || '';
};

/**
 * The full name with the highlighted part in the Highlight format.
 *
 * @param {string} name      Plain name.
 * @param {string} highlight Highlighted part (empty: the last word).
 * @return {string} HTML.
 */
const nameHtml = (name, highlight) => {
    let part = highlight.trim();
    if (!part) {
        const words = name.trim().split(/\s+/);
        part = words.length > 1 ? words[words.length - 1] : '';
    }

    const position = part ? name.lastIndexOf(part) : -1;
    if (position < 0) {
        return escapeHtml(name);
    }

    return (
        escapeHtml(name.slice(0, position)) +
        `<mark class="bnti-highlight">${escapeHtml(part)}</mark>` +
        escapeHtml(name.slice(position + part.length))
    );
};

/**
 * One binding value for a team member record.
 *
 * @param {Object} record Edited post record.
 * @param {string} key    Binding key.
 * @return {string|null} Value.
 */
const getValue = (record, key) => {
    const meta = record.meta || {};
    const field = name => (meta[`bnti_team_${name}`] || '').trim();
    const name = stripTags(typeof record.title === 'string' ? record.title : record.title?.raw || '');
    const shortName = field('short_name') || name.split(' ')[0];

    switch (key) {
        case 'name':
            return nameHtml(name, field('name_highlight'));
        case 'eyebrow':
            return escapeHtml([field('position'), field('office')].filter(Boolean).join(', '));
        case 'tagline':
            return escapeHtml(
                [field('position') ? `${field('position')}, ${firmName}.` : '', field('office') ? `${field('office')}.` : '']
                    .filter(Boolean)
                    .join(' ')
            );
        case 'bio_link':
            /* translators: %s: team member's short name, e.g. "James". */
            return escapeHtml(sprintf(__("Read %s's bio", 'brilliant-insurance'), shortName));
        case 'short_name':
            return escapeHtml(shortName);
    }

    if (fields.some(f => f.key === `bnti_team_${key}`)) {
        return escapeHtml(field(key));
    }

    return null;
};

const FIELDS_LIST = [
    { label: __('Name (highlighted)', 'brilliant-insurance'), args: { key: 'name' }, type: 'string' },
    { label: __('Position, Office', 'brilliant-insurance'), args: { key: 'eyebrow' }, type: 'string' },
    { label: __('Tagline', 'brilliant-insurance'), args: { key: 'tagline' }, type: 'string' },
    { label: __('"Read …\'s bio"', 'brilliant-insurance'), args: { key: 'bio_link' }, type: 'string' },
    ...fields
        .filter(f => f.key !== 'bnti_team_name_highlight')
        .map(f => ({ label: f.label, args: { key: f.key.replace('bnti_team_', '') }, type: 'string' }))
];

registerBlockBindingsSource({
    name: 'bnti/team',
    label: __('Team member', 'brilliant-insurance'),
    usesContext: ['postId', 'postType'],
    getValues({ select, context, bindings }) {
        const values = {};
        const record =
            context?.postType === POST_TYPE && context?.postId
                ? select(coreStore).getEditedEntityRecord('postType', POST_TYPE, context.postId)
                : null;

        for (const [attribute, { args }] of Object.entries(bindings)) {
            const value = record ? getValue(record, args?.key) : null;
            // Without a team member (e.g. in a template), show the field name.
            values[attribute] = value ?? FIELDS_LIST.find(f => f.args.key === args?.key)?.label ?? args?.key;
        }

        return values;
    },
    canUserEditValue: () => false,
    getFieldsList({ context }) {
        return context?.postType === POST_TYPE ? FIELDS_LIST : [];
    }
});
