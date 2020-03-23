#!/bin/bash

echo "* This script must be executed with root privileges (sudo)."
echo "* Installing dependencies..."
composer require cloudflare/sdk

echo "* Unzipping..."
unzip addon.zip

echo "* Performing data migration..."
php artisan migrate --force

echo "* Fixing up .env file..."
cat <<EOT >> .env

CLOUDFLARE_EMAIL=youremailhere@hello.com
CLOUDFLARE_KEY=your-cf-api-key
CLOUDFLARE_ZONE=cf-zone-id
CLOUDFLARE_DOMAIN=your-domain.com
EOT

echo "* Fixing permissions..."
chown -R www-data:www-data *

echo "* Clearing cache..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "* Installation done !"


