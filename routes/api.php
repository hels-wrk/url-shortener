<?php

use App\Http\Controllers\DeleterShortLinkController;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\ShortLinkWorkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('auth/github', [GitHubController::class, 'gitRedirect']);
Route::get('auth/github/callback', [GitHubController::class, 'gitCallback']);
Route::get('dashboard', [ShortLinkController::class, 'showDashboard'])->name('dashboard');
Route::put('generate-shorten-link', [ShortLinkController::class, 'getShortLink'])->name('generate.shorten.link.post');

Route::get('{code}/{secret}', [ShortLinkWorkController::class, 'shortenLinkWithSecretKey']);
Route::get('{code}', [ShortLinkWorkController::class, 'shortenLinkWork'])->name('shorten.link');

Route::delete('delete-shortUrl', [DeleterShortLinkController::class, 'delete']);

