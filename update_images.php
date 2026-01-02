<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Update categories to use default.png
$categoriesUpdated = DB::table('categories')->update(['icon' => 'default.png']);
echo "Updated $categoriesUpdated categories to use default.png\n";

// Update app_users to use default.png for missing images
$usersUpdated = DB::table('app_users')
    ->whereNotNull('image')
    ->where('image', '!=', 'default.png')
    ->update(['image' => 'default.png']);
echo "Updated $usersUpdated app_users to use default.png\n";

// Update owner_shops to use default.png for missing images  
$shopsUpdated = DB::table('owner_shops')
    ->whereNotNull('image')
    ->where('image', '!=', 'default.png')
    ->update(['image' => 'default.png']);
echo "Updated $shopsUpdated owner_shops to use default.png\n";

echo "\nAll images updated successfully!\n";
