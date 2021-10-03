# mediawiki-docker

## Update everything
Run `git submodule update --recursive --remote` in the root folder.

## Local development
Create `docker-compose.override.yml`
```docker-compose
version: '3.4'
services:
  mediawiki:
    build:
      context: .
      dockerfile: Dockerfile-dev
    image: physikerwelt/mediawiki-dev
    environment:
      SERVER_NAME: localhost
    volumes:
      - local/path:/var/www/html/extensions/extension-name
```
## Transition to less custom method
```
docker-compose -f core/docker-compose.yml -f core/docker-compose.override.yml -f docker-compose-core.yml up -d
```