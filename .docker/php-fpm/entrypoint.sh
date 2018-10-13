#!/bin/bash

# xdebug config
if [ -f /usr/local/etc/php/conf.d/xdebug.ini ]
then
    # if XDEBUG_HOST is manually set
    HOST="$XDEBUG_HOST"

    # else if check if is Docker for Mac
    if [ -z "$HOST" ]; then
        HOST=`getent hosts docker.for.mac.localhost | awk '{ print $1 }'`
    fi

    # else get host ip
    if [ -z "$HOST" ]; then
        HOST=`/sbin/ip route|awk '/default/ { print $3 }'`
    fi

    sed -i "s/xdebug\.remote_host \=.*/xdebug\.remote_host\=$HOST/g" /usr/local/etc/php/conf.d/xdebug.ini
fi

if [ ! -d "/root/.composer" ]
then
  mkdir -p /root/.composer
fi
TOKEN="$GITHUB_TOKEN"
echo '{ "github-oauth" : { "github.com": "'"$TOKEN"'" } }' > /root/.composer/auth.json


if [ ! -d "/var/www/vendor" ]
then
  composer install --no-ansi --no-interaction --no-progress --no-scripts --no-suggest --optimize-autoloader
fi

if [ ! -d "/var/www/node_modules" ]
then
  npm install
fi

exec "$@"