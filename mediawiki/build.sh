MEDIAWIKI_VERSION=1.43.11
IMAGE=registry.iiasa.ac.at/ece-wiki/mediawiki

docker build --pull -t $IMAGE:$MEDIAWIKI_VERSION -t $IMAGE:latest .
