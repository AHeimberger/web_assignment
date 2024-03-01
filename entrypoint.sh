#!/bin/bash

echo -e "Executing: ${0}" # print filename
set -e # exit on any failure (e.g. a crashing test)
set -o pipefail # propagate a failure through pipe

# #############################################################################################################
# variables

DIR_CURRENT="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# #############################################################################################################
# run

if [ -z ${1} ] || [ ${1} == "start" ] ; then
	echo -e "-> Get Dependencies"
	${DIR_CURRENT}/scripts/get_files.sh
	
	echo -e "-> Build Executable"
	source $HOME/.cargo/env
	pushd service
	cargo build
	cargo run &
	popd

	echo -e "-> Run PHP"
	pushd app
	php -S 0.0.0.0:3000
	popd
else
	bash
fi

echo -e "Entrypoint Bye...\n"
