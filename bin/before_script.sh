#!/usr/bin/env bash

bash bin/install-wp-tests.sh wordpress_test root '' localhost $WP_VERSION;

if [[ ${WP_VERSION} == '4.0' ]]; then
    composer require phpunit/phpunit=5.6;
elif [[ ${WP_VERSION} == '5.0' ]]; then
    composer require phpunit/phpunit=^6;
else
    composer require phpunit/phpunit:^7;
fi

composer require \
    squizlabs/php_codesniffer \
;

composer install \
    --no-ansi \
    --no-interaction \
    --no-progress \
    --optimize-autoloader \
    --classmap-authoritative \
;
