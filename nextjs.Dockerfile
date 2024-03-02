# syntax=docker.io/docker/dockerfile-upstream:1.6.0

ARG NODE_VERSION=18

FROM node:${NODE_VERSION}-alpine as base
RUN --mount=type=cache,target=/var/cache/apk \
    apk add libc6-compat
WORKDIR /app
EXPOSE 3000

FROM base as builder
RUN --mount=type=cache,target=/var/cache/apk \
    apk add g++ make
COPY nextjs/package*.json .
RUN npm ci
COPY nextjs/ .
RUN npm run build

# Use this target for local development only.
FROM base as dev
ENV NODE_ENV=development
CMD npm run dev

FROM base as prd

ENV NODE_ENV=production

RUN addgroup -g 1001 -S nodejs
RUN adduser -S nextjs -u 1001
USER nextjs

COPY --from=builder --link --chown=nextjs:nodejs /app/.next .
COPY --from=builder --link /app/node_modules .
COPY --from=builder --link /app/package*.json .
COPY --from=builder --link /app/public .

CMD npm start
