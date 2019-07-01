#!/bin/bash
# Clean up and remove dev products since root directory is deployed
cp node_modules/dialog-polyfill/dist/dialog-polyfill.css dist/dialog-polyfill.css

echo "Moving files that should not be served to archive"
mkdir -p ~/nxs-archive
mv -f node_modules ~/nxs-archive
mv -f webpack.config.js ~/nxs-archive












# These aren't needed with github sites for now
#rm -rf node_modules package.json yarn.lock
#rm -rf scripts