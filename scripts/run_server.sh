#!/usr/bin/env bash

set -e # exit on any failure (e.g. a crashing test)
set -o pipefail # propagate a failure through pipe

DIR_CURRENT=$(dirname "$0")
DIR_SERVICE="${DIR_CURRENT}/../app"

pushd app
	php -S 0.0.0.0:3000
popd
