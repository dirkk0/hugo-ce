#!/bin/bash

# baseURL comes from config.yaml (absolute https://curious-electric.com/w/v1/)
# so canonical/OpenGraph tags are absolute. No -b override.

# hugo --gc --minify
hugo --gc --minify --cleanDestinationDir

echo "=== do rsync ==="
# CONF_PATH=$(cat config.secret)
source ../config.secret

echo "path: $CONF_PATH"
# rsync -avztP --delete -e "ssh" public/ $CONF_PATH/schaltstern/

# via https://robot.unipv.it/toolleeo/2021/09/using-rsync-to-update-a-remote-hugo-website/

rsync -r --delete --checksum public/ upload/

echo
echo "=== backup analytics log ==="
# hits.log exists only on the server. Pull it before uploading, so a failed
# deploy still leaves you with the data. Not under upload/ (the staging rsync
# above runs --delete) and not under static/ (that would publish it).
mkdir -p backups
STAMP="$(date +%Y%m%d-%H%M%S)"
if err="$(rsync -az -e ssh "$CONF_PATH/w/v1/_private/hits.log" "backups/hits-$STAMP.log" 2>&1)"; then
  cp "backups/hits-$STAMP.log" backups/hits-latest.log
  echo "saved backups/hits-$STAMP.log ($(wc -l < backups/hits-latest.log | tr -d ' ') lines)"
else
  echo "skipped, could not fetch hits.log:"
  echo "$err" | sed 's/^/  /'
fi

rsync -avztP  -e "ssh" upload/ $CONF_PATH/w/v1/

