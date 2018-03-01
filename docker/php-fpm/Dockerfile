FROM  php:7.1-fpm-alpine

MAINTAINER lujunwen "751836594@qq.com"

RUN apk update && apk upgrade && apk add  re2c git gcc make autoconf libc-dev bash

#安装phalcon扩展
RUN cd ~  \
	&& git clone --depth=1 "git://github.com/phalcon/cphalcon.git" \
	&& cd cphalcon/build \
	&& ./install \
	&& docker-php-ext-enable phalcon \
	&& rm -rf ~/cphalcon

#安装swoole扩展
RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS linux-headers \
	&& pecl install swoole \
	&& docker-php-ext-enable swoole

#删除无用的包
RUN apk del re2c git gcc make autoconf libc-dev


EXPOSE 9000
EXPOSE 9501

WORKDIR /var/www/src

#启动php-fpm

ENTRYPOINT ["php-fpm", "-F"]

