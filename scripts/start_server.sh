DIR_CURRENT=$(dirname "$0")

php -S 127.0.0.1:3000 -t "${DIR_CURRENT}/../app"
