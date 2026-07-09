<?php

require __DIR__ . '/../public/index.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// Tambahkan kode ini untuk mengarahkan storage ke folder /tmp Vercel
$app->useStoragePath($_ENV['APP_STORAGE'] ?? '/tmp/storage');
