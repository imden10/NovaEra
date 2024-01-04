#!/bin/bash

REMOTE_DIR=/home/ka522929/sisidev.com.ua/www/
SSH_USER=ka522929

git pull origin master
rsync -avz --exclude='.git' --exclude='wp-config.php' ./ $SSH_USER@sisidev_server:$REMOTE_DIR