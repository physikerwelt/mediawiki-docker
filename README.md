# mediawiki-docker

## Update everything
Run `git submodule update --recursive --remote` in the root folder.

## Local development
Create `docker-compose.overwrite.yml`
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
