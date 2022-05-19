<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminLogoutController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ToppingController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserCheckout;
use App\Http\Controllers\UserHistoryOrderController;
use App\Http\Controllers\UserHistoryReservationController;
use App\Http\Controllers\UserInvoiceController;
use App\Http\Controllers\UserMenuController;
use App\Http\Controllers\UserReservationCheckoutController;
use App\Http\Controllers\UserReservationController;
use App\Http\Controllers\UserReservationInvoiceController;
use App\Models\AdminUsers;
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
    if (session()->get('login') == null) {
        return view('auth.login');
    }

    return view('home');
})->name('index');

Route::get('login', [UserAuthController::class, 'index'])->name('login.index');
Route::post('login/store', [UserAuthController::class, 'store'])->name('login.store');
Route::post('login/logout', [UserAuthController::class, 'logout'])->name('login.logout');
Route::get('logout', [UserAuthController::class, 'navLogout'])->name('navLogout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('menu', [UserMenuController::class, 'index'])->name('menu');
Route::post('menu/store', [UserMenuController::class, 'store'])->name('menu.store');
Route::put('menu/update', [UserMenuController::class, 'update'])->name('menu.update');

Route::get('checkout', [UserCheckout::class, 'index'])->name('checkout');
Route::delete('checkout/delete/{id}', [UserCheckout::class, 'destroy'])->name('checkout.delete');
Route::put('checkout/update', [UserCheckout::class, 'update'])->name('checkout.update');

Route::get('reservasi', [UserReservationController::class, 'index'])->name('reservasi');
Route::post('reservasi-detail', [UserReservationController::class, 'detail'])->name('reservasi.detail');
Route::get('reservasi-cart/{table}', [UserReservationController::class, 'cart'])->name('reservasi.cart');
Route::delete('reservasi-cart/update/{table}', [UserReservationController::class, 'delete'])->name('reservasi.delete');

Route::get('reservasi-checkout', [UserReservationCheckoutController::class, 'index'])->name('reservasi.checkout');
Route::get('reservasi-checkout/update', [UserReservationCheckoutController::class, 'update'])->name('reservasi.update');

Route::get('invoice-reservation/{invoice}', [UserReservationInvoiceController::class, 'index'])->name('invoice.reservation');
Route::put('invoice-reservation/{invoice}/update', [UserReservationInvoiceController::class, 'update'])->name('invoice.reservation.update');

Route::get('history-order', [UserHistoryOrderController::class, 'index'])->name('history.index');
Route::post('history-order', [UserHistoryOrderController::class, 'search'])->name('history.search');

Route::get('invoice-order/{invoice}', [UserInvoiceController::class, 'index'])->name('invoice-order');
Route::put('invoice-order/{invoice}/update', [UserInvoiceController::class, 'update'])->name('invoice.update');

Route::get('history-reservation', [UserHistoryReservationController::class, 'index'])->name('history.reservation.index');
Route::post('history-reservation', [UserHistoryReservationController::class, 'search'])->name('history.reservation.search');


Route::get('admin/login', [AdminLoginController::class, 'index'])->name('admin.login.index');
Route::post('admin/login/store', [AdminLoginController::class, 'store'])->name('admin.login.store');
Route::get('admin/logout', [AdminLogoutController::class, 'index'])->name('admin.logout');

Route::get('admin/users', [AdminUsersController::class, 'index'])->name('admin.users.index');
Route::get('admin/users/add', [AdminUsersController::class, 'add'])->name('admin.users.add');
Route::post('admin/users/store', [AdminUsersController::class, 'store'])->name('admin.users.store');
Route::get('admin/users/edit/{id}', [AdminUsersController::class, 'edit'])->name('admin.users.edit');
Route::put('admin/users/edit/{id}/update', [AdminUsersController::class, 'update'])->name('admin.users.update');

Route::get('admin/topping', [ToppingController::class, 'index'])->name('admin.topping.index');
Route::get('admin/topping/add', [ToppingController::class, 'add'])->name('admin.topping.add');
Route::post('admin/topping/store', [ToppingController::class, 'store'])->name('admin.topping.store');
Route::get('admin/topping/edit/{id}', [ToppingController::class, 'edit'])->name('admin.topping.edit');
Route::put('admin/topping/edit/{id}/update', [ToppingController::class, 'update'])->name('admin.topping.update');
Route::delete('admin/topping/edit/{id}/delete', [ToppingController::class, 'destroy'])->name('admin.topping.destroy');

Route::get('admin/menu-edit', [MenuController::class, 'index'])->name('admin.menu-edit');
Route::put('admin/menu-edit/update', [MenuController::class, 'update'])->name('admin.menu-edit.update');

Route::get('/admin/history-order', [AdminOrderController::class, 'index'])->name('admin.history-order');
Route::get('/admin/detail-order/{invoice}', [AdminOrderController::class, 'detail'])->name('admin.detail-order');
Route::put('/admin/detail-order/{invoice}/update', [AdminOrderController::class, 'update'])->name('admin.detail-order.update');

Route::get('/admin/table', [TableController::class, 'index'])->name('admin.table.index');
Route::get('/admin/table/{table}', [TableController::class, 'edit'])->name('admin.table.edit');
Route::put('/admin/table/update', [TableController::class, 'update'])->name('admin.table.update');

Route::get('/admin/history-reservation', [AdminReservationController::class, 'index'])->name('admin.history-reservation');
Route::get('/admin/detail-reservation/{invoice}', [AdminReservationController::class, 'detail'])->name('admin.detail-reservation');
Route::put('/admin/detail-reservation/{invoice}/update', [AdminReservationController::class, 'update'])->name('admin.detail-reservation.update');

require __DIR__.'/auth.php';
