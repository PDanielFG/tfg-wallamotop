#!/bin/bash

# shellcheck disable=SC1091

set -o errexit
set -o nounset
set -o pipefail
# set -o xtrace # Uncomment this line for debugging purposes

# Load libraries
. /opt/bitnami/scripts/libbitnami.sh
. /opt/bitnami/scripts/liblog.sh
. /opt/bitnami/scripts/libos.sh

# Load Laravel environment
. /opt/bitnami/scripts/laravel-env.sh

print_welcome_page

if [[ "$*" = *"/opt/bitnami/scripts/laravel/run.sh"* ]]; then
    info "** Running Laravel setup **"
    /opt/bitnami/scripts/php/setup.sh
    /opt/bitnami/scripts/laravel/setup.sh
    /post-init.sh

    php artisan migrate
    php artisan db:seed
    php artisan storage:link

    info "** Laravel setup finished! **"
fi

echo ""
exec "$@"
