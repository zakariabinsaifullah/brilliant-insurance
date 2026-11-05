#!/usr/bin/env bash
# Checks a prepared theme folder before it is deployed or zipped: the files
# WordPress needs are there, and nothing from development slipped through
# (sources, packages, configs, docs, AI instructions, source maps).
# Usage: verify-dist.sh <folder>
set -euo pipefail

dir="${1:?usage: verify-dist.sh <folder>}"
fail=0

for required in style.css theme.json functions.php build/blocks-manifest.php; do
    if [ ! -e "$dir/$required" ]; then
        echo "::error::Missing $required in the deploy files"
        fail=1
    fi
done

forbidden=$(cd "$dir" && find . \
    \( -path './src' -o -path './node_modules' -o -path './.git' -o -path './.github' \
       -o -path './.claude' -o -path './.vscode' -o -path './.idea' \) -prune -print -o \
    -type f \( -name 'package.json' -o -name 'package-lock.json' -o -name 'composer.*' \
       -o -name '*.md' -o -name '*.map' -o -name '*.config.js' -o -name '.distignore' \
       -o -name '.gitignore' -o -name '.env*' -o -name '.DS_Store' -o -name '*.log' \) -print)

if [ -n "$forbidden" ]; then
    echo "::error::Development files found in the deploy files:"
    echo "$forbidden"
    fail=1
fi

if [ "$fail" -ne 0 ]; then
    exit 1
fi

echo "Deploy files are clean:"
(cd "$dir" && find . -mindepth 1 -maxdepth 1 | sort | sed 's#^\./#  #')
