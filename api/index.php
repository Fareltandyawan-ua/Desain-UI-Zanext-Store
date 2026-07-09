<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Pindahkan storage ke /tmp agar bisa nulis di Vercel
$app->useStoragePath(getenv('APP_STORAGE') ?: '/tmp/storage');

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(Request::capture());
$response->send();
$kernel->terminate(Request::capture(), $response);
