#!/usr/bin/env bash
cd docker/nginx \
&& docker build --rm -t alpine/nginx .  \
&& cd ../php-fpm \
&& docker build --rm -t alpine/php . \
&& cd ../ \
&& docker-compose up -d