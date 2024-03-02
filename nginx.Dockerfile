# syntax=docker.io/docker/dockerfile-upstream:1.6.0

ARG NGINX_VERSION=1.25

FROM nginx:${NGINX_VERSION} as dev

FROM dev as prd
COPY --link nginx.conf /etc/nginx/nginx.conf:ro
COPY --link src /var/www/html
