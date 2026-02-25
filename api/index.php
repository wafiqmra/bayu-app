<?php

// Jalankan autoload manual agar vendor terbaca
require __DIR__ . '/../vendor/autoload.php';

// Panggil aplikasi Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);