#!/usr/bin/env bash

bash bin/install-wp-tests.sh wordpress_test root '' localhost $WP_VERSION;

echo 'ENV VARIABLE WP_VERSION IS: ';
echo "$WP_VERSION";

if [[ ${WP_VERSION} == '4.0' ]]; then
    composer require "phpunit/phpunit=5.6.*";
else
   if [[ ${TRAVIS_PHP_VERSION:0:3} == "7.0" ]]; then
        composer require phpunit/phpunit;
    else
        composer require "phpunit/phpunit=5.6.*";
    fi
fi

composer install --no-ansi --no-interaction --no-progress --no-scripts --optimize-autoloader --classmap-authoritative;
