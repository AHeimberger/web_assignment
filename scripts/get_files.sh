#!/usr/bin/env bash

DIR_CURRENT=$(dirname "$0")
DIR_FILES="${DIR_CURRENT}/npm_files"
DIR_STYLE="${DIR_CURRENT}/../app/css"
DIR_JS="${DIR_CURRENT}/../app/js/ext"

set -e # exit on any failure (e.g. a crashing test)
set -o pipefail # propagate a failure through pipe

BOOSTRAP_VERSION="5.3.2"
JQUERY_VERSION="3.7.1"

rm -rf "${DIR_FILES}"
mkdir -p "${DIR_FILES}" 

rm -rf "${DIR_STYLE}"
mkdir -p "${DIR_STYLE}"

rm -rf "${DIR_JS}"
mkdir -p "${DIR_JS}"

style_files="
    bootstrap.min.css
    bootstrap.min.css.map"

js_files="
    bootstrap.min.js
    bootstrap.min.js.map"


npm install --prefix "${DIR_FILES}" bootstrap@${BOOSTRAP_VERSION}
for file in ${style_files}; do
    cp "${DIR_FILES}/node_modules/bootstrap/dist/css/${file}" "${DIR_STYLE}/${file}" 
done
for file in ${js_files}; do
    cp "${DIR_FILES}/node_modules/bootstrap/dist/js/${file}" "${DIR_JS}/${file}" 
done
cp "${DIR_CURRENT}/../service/target/debug/service" "${DIR_CURRENT}/../app/service"


npm install --prefix "${DIR_FILES}" jquery@${JQUERY_VERSION}
cp "${DIR_FILES}/node_modules/jquery/dist/jquery.min.js" "${DIR_JS}/jquery.min.js" 


npm install --prefix "${DIR_FILES}" bootstrap-icons
cp "${DIR_FILES}/node_modules/bootstrap-icons/font/bootstrap-icons.css" "${DIR_STYLE}/bootstrap-icons.css" 
cp -r "${DIR_FILES}/node_modules/bootstrap-icons/font/fonts" "${DIR_STYLE}/fonts" 