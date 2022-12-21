Socialite adalah sebuah aplikasi web untuk mentesting fitur dari library Socialite
milik Laravel untuk keperluan autentikasi. Fitur yang diimplementasikan dalam
projek ini adalah Login (menggunakan register manual atau OAuth milik Google),
Register, Forgot Password, dan Email Verification.

Langkah Instalasi Projek :

1) Unzip Projek
2) Jalankan terminal
3) Pastikan sudah berada dalam directory projek
3) Jalankan "composer update"
4) Jalankan "composer require laravel/socialite"
5) Isi GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET pada file '.env'
6) Ubah DB_DATABASE sesuai yang ada di phpmyadmin pada file '.env'
7) Jalankan "php artisan migrate:fresh" pada terminal
8) Jalankan "php artisan serve" dan "ctrl + klik kiri" URL yang diberikan di terminal

Homepage URL => http://localhost:8000
Callback URL => http://localhost:8000/login/google/callback
