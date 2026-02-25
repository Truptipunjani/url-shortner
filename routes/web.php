<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\RedirectController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function(){

Route::get('/dashboard',[ShortUrlController::class,'index'])->name('dashboard');

Route::get('/create-company',[CompanyController::class,'createCompanyForm']);
Route::post('/store-company',[CompanyController::class,'storeCompany']);

Route::get('/create-member',[MemberController::class,'createMemberForm']);
Route::post('/store-member',[MemberController::class,'storeMember']);

Route::post('/create-url',[ShortUrlController::class,'store']);
Route::get('/invite-member',[MemberController::class,'createMemberForm']);
Route::post('/store-member',[MemberController::class,'storeMember']);
});

// THIS BLOCK ADD NOW
Route::middleware('auth')->group(function () {

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
Route::get('/{code}',[RedirectController::class,'redirect']);