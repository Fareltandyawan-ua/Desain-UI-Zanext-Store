<?php
// 1. Jalankan aplikasi lewat public/index.php bawaan Laravel
require __DIR__ . '/../public/index.php';

// 2. Ambil instans app yang sudah tercipta di dalam public/index.php tadi
// (Jangan pakai require_once bootstrap/app.php lagi karena bikin crash)
$app = app();

// 3. Pindahkan folder storage ke /tmp agar Laravel bisa menulis cache/session di Vercel
$app->useStoragePath($_ENV['APP_STORAGE'] ?? '/tmp/storage');
