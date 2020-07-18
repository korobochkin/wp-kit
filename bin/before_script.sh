#!/usr/bin/env bash

bash bin/install-wp-tests.sh wordpress_test root '' localhost $WP_VERSION;

composer require \
    phpunit/phpunit:^6 \
    squizlabs/php_codesniffer \
;

composer install \
    --no-ansi \
    --no-interaction \
    --no-progress \
    --optimize-autoloader \
    --classmap-authoritative \
;
