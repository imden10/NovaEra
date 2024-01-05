#!/bin/bash

# Змініть налаштування за необхідності
REMOTE_DIR=/home/ka522929/sisidev.com.ua/www/
SSH_USER=ka522929

# Змініть назву секрету, який ви створили
SERVER_ALIAS=$DEPLOY_SERVER

# Змініть налаштування за необхідності
git pull origin master
rsync -avz --exclude='.git' --exclude='wp-config.php' ./ $SSH_USER@$SERVER_ALIAS:$REMOTE_DIR