DIR_CURRENT=$(dirname "$0")
DIR_FILES="${DIR_CURRENT}/files"
DIR_STYLE="${DIR_CURRENT}/../css"
DIR_JS="${DIR_CURRENT}/../js"

set -e # exit on any failure (e.g. a crashing test)
set -o pipefail # propagate a failure through pipe

BOOSTRAP_VERSION="5.3.2"

rm -rf "${DIR_FILES}"
mkdir -p "${DIR_FILES}" 

rm -rf "${DIR_STYLE}"
mkdir -p "${DIR_STYLE}"

rm -rf "${DIR_JS}"
mkdir -p "${DIR_JS}"

style_files="
    bootstrap.min.css"

js_files="
    bootstrap.min.js"

npm install --prefix "${DIR_FILES}" bootstrap@${BOOSTRAP_VERSION}
for file in ${style_files}; do
    cp "${DIR_FILES}/node_modules/bootstrap/dist/css/${file}" "${DIR_STYLE}/${file}" 
done

for file in ${js_files}; do
    cp "${DIR_FILES}/node_modules/bootstrap/dist/js/${file}" "${DIR_JS}/${file}" 
done

cp "${DIR_CURRENT}/../../service/target/debug/service" "${DIR_CURRENT}/../service"
