<?php

use App\Http\Controllers\CustomUrlController;
use App\Http\Controllers\DeleterShortLinkController;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\ShortLinkController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


require __DIR__.'/auth.php';

Route::get('auth/github', [GitHubController::class, 'gitRedirect']);
Route::get('auth/github/callback', [GitHubController::class, 'gitCallback']);
Route::get('/dashboard', [ShortLinkController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::post('/generate-shorten-link', [ShortLinkController::class, 'store'])->name('generate.shorten.link.post');

Route::get('/{code}/{secret}', [ShortLinkController::class, 'shortenLinkWithSecretKey']);
Route::get('/{code}', [ShortLinkController::class, 'shortenLink'])->name('shorten.link');

Route::post('/delete-shortUrl', [DeleterShortLinkController::class, 'delete']);



