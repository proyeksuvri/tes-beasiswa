<?php
use Illuminate\Support\Facades\Artisan;
Artisan::command('about:beasiswa', function () {
    $this->comment('Aplikasi Pengelolaan Beasiswa — Modul 1 Penetapan Beasiswa dari SK.');
})->purpose('Show a short description of the scholarship application');
