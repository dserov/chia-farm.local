<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HostController;
use App\Http\Controllers\Admin\StorageController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\CryptoBoxCallbackController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlotController;
use App\Http\Controllers\SpeedtestController;
use App\Http\Controllers\WalletController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;

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

Route::get('/', [IndexController::class, 'index'])->name('index::index')->middleware('referral');

Route::get('/speedtest', [SpeedtestController::class, 'index'])->name('speedtest::index');

Route::get('/faq', [FaqController::class, 'index'])->name('faq::index');

Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs::index');

Route::post('/payment/callback', [CryptoBoxCallbackController::class, 'callback'])->name('payment::callback')->withoutMiddleware(VerifyCsrfToken::class);

Auth::routes([
    'register' => false,
    'logout' => false,
]);
Route::get('register', [AuthRegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthRegisterController::class, 'register']);
Route::get('logout',  [AuthLoginController::class, 'logout'])->name('logout::get');

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/dashboard', [App\Http\Controllers\DasboardController::class, 'index'])->name('dashboard::index');

    Route::get('/profile', [ProfileController::class, 'update'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'save'])->name('profile::save');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders::index');
    Route::get('/auctions/{auctionId?}/orders/new', [OrderController::class, 'new'])->name('orders::new');
    Route::post('/orders/save', [OrderController::class, 'save'])->name('orders::save_new');

    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders::show');
    Route::post('/orders/{order}/delete', [OrderController::class, 'delete'])->name('orders::delete');
    Route::get('/orders/{order}/pay', [OrderController::class, 'pay'])->name('orders::pay');

    Route::group([
        'prefix' => '/plots',
        'as' => 'plots::',
    ], function () {
        Route::get('/', [PlotController::class, 'index'])->name('index');
        Route::get('/text', [PlotController::class, 'text'])->name('text');
        Route::get('/create', [PlotController::class, 'create'])->name('create');
        Route::post('/save', [PlotController::class, 'save'])->name('save');
//        Route::get('/update/{plot}', [PlotController::class, 'update'])->name('update');
//        Route::post('/delete/{plot}', [PlotController::class, 'delete'])->name('delete');
    });

    Route::group([
        'prefix' => '/wallet',
        'as' => 'wallet::',
    ], function () {
        Route::get('/', [WalletController::class, 'index'])
            ->name('index');
        Route::get('/create', [WalletController::class, 'create'])
            ->name('create');
        Route::post('/save', [WalletController::class, 'save'])
            ->name('save');
        Route::get('/update/{wallet}', [WalletController::class, 'update'])
            ->name('update');
        Route::post('/delete/{wallet}', [WalletController::class, 'delete'])
            ->name('delete');
    });

});


Route::group([
    'prefix' => '/admin',
    'as' => 'admin::',
    'middleware' => 'auth.admin',
], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard::index');

    Route::group([
        'prefix' => 'hosts',
        'as' => 'hosts::',
    ], function () {
        Route::get('/', [HostController::class, 'index'])->name('index');
        Route::get('/index.json', [HostController::class, 'indexJson'])->name('index::json');
        Route::get('/create', [HostController::class, 'create'])->name('create');
        Route::post('/save', [HostController::class, 'save'])->name('save');
        Route::get('/update/{host}', [HostController::class, 'update'])->name('update');
        Route::post('/delete/{host}', [HostController::class, 'delete'])->name('delete');
    });

    Route::group([
        'prefix' => 'storages',
        'as' => 'storages::',
    ], function () {
        Route::get('/index.json', [StorageController::class, 'indexJson'])->name('index::json');
    });

    Route::group([
        'prefix' => 'auctions',
        'as' => 'auctions::',
    ], function () {
        Route::get('/', [AuctionController::class, 'index'])->name('index');
        Route::get('/create', [AuctionController::class, 'create'])->name('create');
        Route::post('/save', [AuctionController::class, 'save'])->name('save');
        Route::get('/update/{auction}', [AuctionController::class, 'update'])->name('update');
        Route::post('/delete/{auction}', [AuctionController::class, 'delete'])->name('delete');
    });

    Route::group([
        'prefix' => 'tasks',
        'as' => 'tasks::',
    ], function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('/{task}', [TaskController::class, 'show'])->name('show');
        Route::get('/index.json', [TaskController::class, 'indexJson'])->name('index::json');
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('/save', [TaskController::class, 'save'])->name('save');
        Route::post('/delete/{task}', [TaskController::class, 'delete'])->name('delete');
        Route::post('/delete/', [TaskController::class, 'manyDelete'])->name('many::delete');
    });

});
