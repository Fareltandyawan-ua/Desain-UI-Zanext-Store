# ZANEXT STORE — Laravel + Blade Edition

Proyek e-commerce sneakers & streetwear futuristik, dibangun dari nol dengan Laravel 12, Blade, Tailwind v4, dan Alpine.js. Hasil migrasi dari versi React/TanStack Start — tampilan sengaja dipertahankan persis sama.

## Tech Stack

- **Backend**: Laravel 12, PHP 8.4
- **Database**: SQLite (default)
- **Frontend**: Blade templates + Tailwind CSS v4 + Alpine.js
- **Build**: Vite 8

## Cara Menjalankan

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm run build
php artisan serve
```

Buka `http://localhost:8000` atau via Laragon `http://zanext-laravel.test`.

## Akun Demo

| Role  | Email                | Password   |
|-------|----------------------|------------|
| Admin | admin@zanext.io      | password   |
| User  | alex@zanext.io       | password   |

## Halaman Wajib (Modul UAS)

| # | Halaman          | Route                              | Status |
|---|------------------|------------------------------------|--------|
| 1 | Landing Page     | `/`                                | OK     |
| 2 | Arsip Artikel    | `/articles`                        | OK     |
| 3 | Detail Artikel   | `/articles/{id}`                   | OK     |
| 4 | Katalog Produk   | `/catalog`                         | OK     |
| 5 | Detail Produk    | `/product/{id}`                    | OK     |
| 6 | Keranjang        | `/cart`                            | OK     |
| 7 | Pembayaran       | `/checkout`                        | OK     |
| 8 | History Transaksi | `/history`                        | OK     |
| 9 | Dashboard        | `/dashboard`                       | OK     |
| 10 | Kelola Artikel  | `/dashboard/articles`              | OK     |
| 11 | Kelola Produk   | `/dashboard/products`              | OK     |
| 12 | Kelola Pengguna | `/dashboard/users`                 | OK     |
| 13 | Kelola Transaksi | `/dashboard/transactions`         | OK     |
| 14 | Login           | `/login`                           | OK     |
| 15 | Register        | `/register`                        | OK     |

## Struktur Folder Inti

```
app/Http/Controllers/        → HomeController, CatalogController, ProductController, ...
app/Http/Controllers/Admin/  → DashboardController, ProductController, ...
app/Models/                  → Product, Article, Transaction, User
database/migrations/         → schema 4 tabel
database/seeders/            → mock data dari versi React
resources/css/app.css        → tema (warna, font, animasi)
resources/js/app.js          → bootstrap Alpine.js
resources/views/
├── layouts/site.blade.php   → SiteShell (Navbar + Footer)
├── layouts/admin.blade.php  → AdminShell (sidebar)
├── partials/                → navbar, footer
├── components/              → product-card (reusable)
└── pages/                   → semua halaman per route
routes/web.php               → semua route definition
```

## Konvensi Migrasi React → Blade

| React                              | Blade                                     |
|------------------------------------|-------------------------------------------|
| `<Link to="/catalog">`             | `<a href="{{ route('catalog') }}">`       |
| `useState`                         | `x-data="{ ... }"` (Alpine)                |
| `useEffect`                        | `x-init` (Alpine)                          |
| `useNavigate()`                    | `return redirect()->route(...)` di controller |
| `localStorage` (cart, wishlist)    | Laravel `session()`                        |
| `lucide-react` icons               | SVG inline                                 |
| `@/assets/x.jpg` import            | `{{ asset('assets/x.jpg') }}`             |
| `@radix-ui/react-dropdown-menu`    | Alpine `x-data` + `x-show`                |
| `react-hook-form` + Zod            | `$request->validate([...])`                |
| Mock data `src/lib/data.ts`        | Eloquent models + seeder                   |

## Tambah Halaman Baru — Resep

1. Generate controller: `php artisan make:controller WhateverController`
2. Tambah route di `routes/web.php`:
   ```php
   Route::get('/whatever', [WhateverController::class, 'index'])->name('whatever');
   ```
3. Controller method:
   ```php
   public function index() {
       return view('pages.whatever', ['data' => ...]);
   }
   ```
4. Buat view `resources/views/pages/whatever.blade.php`:
   ```blade
   @extends('layouts.site')
   @section('title', 'Whatever — ZANEXT')
   @section('content')
       {{-- konten --}}
   @endsection
   ```

## Komponen Reusable

```blade
<x-product-card :product="$product" />
```

Tambah komponen baru di `resources/views/components/<name>.blade.php`.

## Interaktivitas dengan Alpine

```html
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    <div x-show="open" x-transition>Content</div>
</div>
```

## Tema CSS

Variabel warna, font, dan utility class (`gradient-text`, `glow-primary`, `grid-bg`, `card-hover`, `animate-fade-up`, `animate-float`, `marquee`) ada di `resources/css/app.css`.

## Ganti ke MySQL (Opsional)

Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=zanext
DB_USERNAME=root
DB_PASSWORD=
```

Lalu: `php artisan migrate:fresh --seed`

## Catatan

- Cart & Wishlist disimpan di **session server-side**, bukan localStorage.
- Order ID di-generate server saat checkout (stabil saat refresh).
- Auth pakai Laravel session standar dengan kolom role enum (`user` / `admin`).
- Middleware admin masih basic (cuma cek auth) — untuk produksi, tambahkan role check.

## Lisensi

Project edukasi untuk UAS Workshop UI.
