<?php

// 1. Jalankan Autoload
require __DIR__ . '/../vendor/autoload.php';

// 2. Bootstrapping Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. Trik Sakti: Paksa jalur storage ke /tmp agar tidak Error 500
$app->useStoragePath('/tmp/storage');
if (!is_dir('/tmp/storage/framework/views')) {
    mkdir('/tmp/storage/framework/views', 0755, true);
}

// 4. Jalankan Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);