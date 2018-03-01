FROM alpine

MAINTAINER Steven <751836594@qq.com>

RUN apk update \
	&& apk add nginx vim bash \
	&& mkdir -p /run/nginx \
	&& mv /etc/nginx/conf.d/default.conf  /etc/nginx/conf.d/default.conf.bak

COPY ./conf.d /etc/nginx/conf.d

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]