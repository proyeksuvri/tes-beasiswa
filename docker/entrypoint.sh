#!/bin/sh
set -eu

: "${PORT:=10000}"
: "${APP_ENV:=production}"
: "${APP_DEBUG:=false}"

if [ -z "${APP_KEY:-}" ]; then
  echo "ERROR: APP_KEY must be set in the hosting environment." >&2
  exit 1
fi

if [ -z "${DB_URL:-}" ] && { [ -z "${DB_HOST:-}" ] || [ -z "${DB_DATABASE:-}" ] || [ -z "${DB_USERNAME:-}" ]; }; then
  echo "ERROR: Configure DB_URL or DB_HOST, DB_DATABASE, and DB_USERNAME." >&2
  exit 1
fi

php artisan config:clear
php artisan migrate --force
php artisan db:seed --force

exec apache2-foreground
