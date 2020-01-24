#!/usr/bin/env bash

# Get servers list:
set - f
# Variables from GitLab server:
# Note: They can't have spaces!!
string=$DEPLOY_SERVER
array=(${string//,/ })

for i in "${!array[@]}"; do
  echo "Deploy project on server ${array[i]}"
  sudo -i -u demo bash << EOF
    echo "Working On ${USER}"
    cd $PROJECT_PATH && bash distribute.sh
EOF
  echo "Done"
done