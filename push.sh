#!/bin/bash

hugo --gc --minify -b /w/v1
echo "=== do rsync ==="
# CONF_PATH=$(cat config.secret)
source ../config.secret

echo "path: $CONF_PATH"
# rsync -avztP --delete -e "ssh" public/ $CONF_PATH/schaltstern/

# via https://robot.unipv.it/toolleeo/2021/09/using-rsync-to-update-a-remote-hugo-website/

rsync -r --delete --checksum public/ upload/
rsync -avztP  -e "ssh" upload/ $CONF_PATH/w/v1/

