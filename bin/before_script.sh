#!/usr/bin/env bash

bash bin/install-wp-tests.sh wordpress_test root '' localhost $WP_VERSION;

export PATH="$HOME/.composer/vendor/bin:$PATH";

if [[ ${TRAVIS_PHP_VERSION:0:3} == "7.0" ]]; then
    composer global require "phpunit/phpunit=5.6.*";
else
    composer global require "phpunit/phpunit=4.8.*";
fi

composer install --no-ansi --no-interaction --no-progress --no-scripts --optimize-autoloader --classmap-authoritative;
