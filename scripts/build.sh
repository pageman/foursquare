#!/bin/bash

LOG_DIR=../fuel/app/logs/deploy/development
# LOG_DIR=/Users/tnk/Devel/crows-server/fuel/app/logs/deploy/development
LOG_NAME=deploy.log
LOG_FILE=$LOG_DIR/$LOG_NAME

GIT_PATH=/usr/local/bin/git

# to absolute path
LOG_FILE=$(cd $(dirname "$LOG_FILE") && pwd)/$(basename "$LOG_FILE")


echo "deploy started.">> $LOG_FILE
echo $(pwd)>> $LOG_FILE

# project root へ移動
cd .. >> $LOG_FILE 2>&1

# source update
echo "git pull">> $LOG_FILE
$GIT_PATH pull  >> $LOG_FILE 2>&1
if [ $? != 0 ]; then
  echo "git pull failed."  >> $LOG_FILE 2>&1
  exit 1
fi

# update the schema migrate
echo "migrate.">> $LOG_FILE
php oil refine migrate >> $LOG_FILE 2>&1

if [ $? != 0 ]; then
  echo "oil migration failed."  >> $LOG_FILE 2>&1
  exit 1
fi

# TODO task loading master data

# dummy data
echo "php oil refine loader:dummy">> $LOG_FILE
php oil refine loader:dummy

# end
echo "deploy complete.">> $LOG_FILE
