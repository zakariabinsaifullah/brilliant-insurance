/**
 * Star shape from the Figma design: a sharp 5-point star (corner radius 0,
 * inner/outer ratio 38.2%) in a 19.6 × 18.38 box.
 */
const STAR_POINTS = '9.8,0 12.11,7.02 19.6,7.02 13.54,11.36 15.86,18.38 9.8,14.04 3.74,18.38 6.06,11.36 0,7.02 7.49,7.02';

const Star = ({ className }) => (
    <svg className={className} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.6 18.38" aria-hidden="true" focusable="false">
        <polygon points={STAR_POINTS} />
    </svg>
);

/**
 * A row of `total` stars filled up to `rating`. A part-filled star shows the
 * filled star clipped to its share (e.g. 4.5 → the fifth star half filled)
 * over the empty one, so any decimal works without extra artwork.
 */
const StarRating = ({ total = 5, rating = 0 }) => {
    const stars = [];

    for (let i = 0; i < total; i++) {
        const fill = Math.round(Math.min(Math.max(rating - i, 0), 1) * 100);

        stars.push(
            <span key={i} className="bnti-rating__star">
                <Star className="bnti-rating__empty" />
                {fill > 0 && (
                    <span className="bnti-rating__fill" style={fill < 100 ? { width: `${fill}%` } : undefined}>
                        <Star />
                    </span>
                )}
            </span>
        );
    }

    return (
        <div className="bnti-rating" role="img" aria-label={`${rating} / ${total}`}>
            {stars}
        </div>
    );
};

export default StarRating;
