#!/bin/bash
git fetch --all
git reset --hard origin/master
composer update
cp -R vendor-patch/. vendor/
composer ide-optimize
php artisan migrate
npm install