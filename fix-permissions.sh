#!/bin/bash

echo "📦 Checking for Composer dependencies..."
if [ ! -d "vendor" ]; then
    echo "🔧 Running composer install..."
    composer install
else
    echo "✅ Vendor already exists."
fi

echo "📂 Fixing runtime permissions..."
chmod -R 777 database storage bootstrap/cache

echo "🧨 Migrating DB..."
php artisan migrate:fresh --seed

echo "✅ Starting Apache..."
exec apache2-foreground
