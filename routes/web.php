<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GharpattiPanipattiController;
use App\Http\Controllers\GramBillsController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutGramController;
use App\Http\Controllers\RegisterToGramController;
use App\Http\Controllers\PopulationController;
use App\Http\Controllers\LCController;
use App\Http\Controllers\BonafidController;

use App\Http\Controllers\AnnualMaintenanceController;
use Illuminate\Support\Facades\Auth;
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



Route::get('/profileuser', [App\Http\Controllers\UserController::class, 'profileuser'])->name('profileuser')->middleware('auth');
Route::delete('/delete-file/{id}', [RegisterToGramController::class, 'destroyfile'])->name('file.destroy');

Route::resource('gharpatti-panipatti', GharpattiPanipattiController::class)->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('lc', LCController::class)->middleware('auth');
Route::get('/lcprint{id}', [App\Http\Controllers\LCController::class, 'lcprint'])->name('lc.print')->middleware('auth');
Route::get('schools/get-address', [BonafidController::class, 'getAddress'])->name('schools.getAddress');

Route::resource('bonafid', BonafidController::class)->middleware('auth');
Route::get('/bonafidprint{id}', [App\Http\Controllers\BonafidController::class, 'bonafidprint'])->name('bonafid.print')->middleware('auth');

Route::get('/otp-page', [App\Http\Controllers\UserController::class, 'getOTP'])->name('otp.page.view');
Route::get('/user-login', [App\Http\Controllers\UserController::class, 'userLogin'])->name('user.login');
Route::post('/login-otp', [App\Http\Controllers\UserController::class, 'loginWithOTP'])->name('login.otp');
Route::post('/verify-otp', [App\Http\Controllers\UserController::class, 'verifyOTP'])->name('verify.otp');
Route::get('/userprint/{id}', [App\Http\Controllers\UserController::class, 'userprint'])->name('userprint');
Route::get('/register-to-gram-print/{id}', [App\Http\Controllers\RegisterToGramController::class, 'registertogramprint'])->name('register-to-gram-print');
Route::get('/gharpattiprint/{id}', [App\Http\Controllers\GharpattiPanipattiController::class, 'gharpattiprint'])->name('gharpattiprint');
Route::get('/aboutgramprint/{id}', [App\Http\Controllers\AboutGramController::class, 'aboutgramprint'])->name('aboutgramprint');
Route::get('/populationprint/{id}', [App\Http\Controllers\PopulationController::class, 'populationprint'])->name('populationprint');
Route::get('/grambillsprint/{id}', [App\Http\Controllers\GramBillsController::class, 'grambillsprint'])->name('grambillsprint');
Route::get('/annualprint/{id}', [App\Http\Controllers\AnnualMaintenanceController::class, 'annualprint'])->name('annualprint');

Route::resource('about-gram', AboutGramController::class)->middleware('auth');
Route::resource('register-to-gram', RegisterToGramController::class)->middleware('auth');
Route::resource('population', PopulationController::class)->middleware('auth');
Route::resource('gram-bills', GramBillsController::class)->middleware('auth');
Route::resource('annual-maintenance', AnnualMaintenanceController::class)->middleware('auth');

Route::post('/get-category-count', [App\Http\Controllers\HomeController::class, 'getCategoryCount'])->name('get.category.count');

// In routes/web.php
Route::post('/get-gram-details', [App\Http\Controllers\HomeController::class, 'getGramDetails'])->name('get.gram.details');
// routes/web.php
Route::get('/get-ghar-patti-panipatti-counts', [App\Http\Controllers\HomeController::class, 'getCounts'])->name('get.ghar-panipatti.counts');

Route::get('/get-gram-bills-count', [App\Http\Controllers\HomeController::class, 'getGramBillsCount'])->name('get.gram-bills.count');

Route::get('/get-gram-counts', [App\Http\Controllers\HomeController::class, 'getGramCounts']);


Route::get('/category', [App\Http\Controllers\MasterController::class, 'index'])->name('categories.index')->middleware('auth');
Route::get('/categories/{id}', [App\Http\Controllers\MasterController::class, 'show'])->name('categories.show')->middleware('auth');

Route::post('/category-store', [App\Http\Controllers\MasterController::class, 'store'])->name('categories.store')->middleware('auth');
Route::delete('/categories/{category}', [App\Http\Controllers\MasterController::class, 'destroy'])->name('categories.destroy')->middleware('auth');
Route::put('/category/{id}', [App\Http\Controllers\MasterController::class, 'update'])->name('category.update')->middleware('auth');
Route::get('/get-tehsils', [App\Http\Controllers\MasterController::class, 'getTehsils'])->name('tehsils.get')->middleware('auth');
Route::get('/users-by-gram', [App\Http\Controllers\MasterController::class, 'getByGram'])->name('users.getByGram')->middleware('auth');
Route::post('/get-maintenance-amount', [App\Http\Controllers\MasterController::class, 'getMaintenanceAmount'])->name('get.maintenance.amount');

Route::get('/gramprint/{id}', [App\Http\Controllers\MasterController::class, 'gramprint'])->name('gramprint')->middleware('auth');

Route::get('/get-grams', [App\Http\Controllers\MasterController::class, 'getGrams'])->name('grams.get')->middleware('auth');
Route::get('/category/{id}/edit', [App\Http\Controllers\MasterController::class, 'edit'])->name('category.edit')->middleware('auth');


Route::get('/gram', [App\Http\Controllers\MasterController::class, 'gramIndex'])->name('grams.index')->middleware('auth');
Route::post('/gram-store', [App\Http\Controllers\MasterController::class, 'gramStore'])->name('grams.store')->middleware('auth');
Route::delete('/grams/{gram}', [App\Http\Controllers\MasterController::class, 'gramDestroy'])->name('grams.destroy')->middleware('auth');
Route::put('/gram/{id}', [App\Http\Controllers\MasterController::class, 'gramUpdate'])->name('gram.update')->middleware('auth');
Route::put('/profileupdate/{id}', [App\Http\Controllers\UserController::class, 'profileupdate'])->name('profileupdate')->middleware('auth');

Route::get('/gram/{id}/edit', [App\Http\Controllers\MasterController::class, 'gramEdit'])->name('gram.edit')->middleware('auth');

Route::get('/taluka', [App\Http\Controllers\MasterController::class, 'talukaIndex'])->name('talukas.index')->middleware('auth');
Route::post('/taluka-store', [App\Http\Controllers\MasterController::class, 'talukaStore'])->name('talukas.store')->middleware('auth');
Route::delete('/talukas/{taluka}', [App\Http\Controllers\MasterController::class, 'talukaDestroy'])->name('talukas.destroy')->middleware('auth');
Route::post('/taluka/{id}', [App\Http\Controllers\MasterController::class, 'talukaUpdate'])->name('taluka.update')->middleware('auth');

Route::get('/talukashow/{id}', [App\Http\Controllers\MasterController::class, 'talukashow'])->name('talukashow')->middleware('auth');
Route::get('/gramshow/{id}', [App\Http\Controllers\MasterController::class, 'gramshow'])->name('gramshow')->middleware('auth');

Route::get('/talukas/{id}/edit', [App\Http\Controllers\MasterController::class, 'talukaEdit'])->name('talukas.edit')->middleware('auth');
Route::get('/editprofile/{id}', [App\Http\Controllers\UserController::class, 'editprofile'])->name('editprofile')->middleware('auth');




Auth::routes();
//Language Translation
Route::get('/index/{locale}', [App\Http\Controllers\HomeController::class, 'lang'])->name('lang');

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

