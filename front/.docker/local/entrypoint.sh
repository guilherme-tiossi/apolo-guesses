#!/bin/sh

set -e

npm install

# Production build artifacts in .next break `next dev` (missing chunk modules).
if [ -f .next/BUILD_ID ]; then
  rm -rf .next
fi

exec npm run dev