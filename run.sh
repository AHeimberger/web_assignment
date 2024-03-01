#/bin/bash

PROJECT_NAME="build_server"
DIR_DEPLOY="${HOME}/deploy/${PROJECT_NAME}"
mkdir -p "${DIR_DEPLOY}"

echo "PROJECT_NAME: ${PROJECT_NAME}"
echo "DIR_DEPLOY: ${DIR_DEPLOY}"

echo -e "\n\n -> build"
docker build \
    -t ${PROJECT_NAME} \
     .

echo -e "\n\n -> run"
docker run \
    --rm \
    -v .:/source/ \
    -p 127.0.0.1:3000:3000 \
    -it ${PROJECT_NAME} \
    start
