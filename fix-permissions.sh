#!/bin/bash

echo "📝 Checking for .env file..."
if [ ! -f .env ]; then
    echo "📋 Copying .env.example to .env"
    cp .env.example .env
fi

echo "📦 Checking for Composer dependencies..."
if [ ! -d "vendor" ]; then
    echo "🔧 Running composer install..."
    composer install
else
    echo "✅ Vendor already exists."
fi

echo "📂 Fixing permissions..."
chmod -R 777 database storage bootstrap/cache

echo "🧨 Running migrations..."
php artisan migrate:fresh --seed

echo "✅ Starting Apache..."
exec apache2-foreground
