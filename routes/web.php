<?php

use App\Http\Controllers\AdminAdminsController;
use App\Http\Controllers\AdminExportController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminLogoutController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminOrderToppingController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderToppingController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ToppingController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserCheckout;
use App\Http\Controllers\UserCheckoutToppingController;
use App\Http\Controllers\UserHistoryOrderController;
use App\Http\Controllers\UserHistoryOrderToppingController;
use App\Http\Controllers\UserHistoryReservationController;
use App\Http\Controllers\UserInvoiceController;
use App\Http\Controllers\UserInvoiceToppingController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('login', [UserAuthController::class, 'index'])->name('login.index');
Route::post('login/store', [UserAuthController::class, 'store'])->name('login.store');
Route::post('login/logout', [UserAuthController::class, 'logout'])->name('login.logout');
Route::post('register/store', [UserAuthController::class, 'register'])->name('register.store');
Route::post('forgot-password/store', [UserAuthController::class, 'forgotPassword'])->name('forgot-password.store');
Route::post('reset-password/store', [UserAuthController::class, 'changePassword'])->name('reset-password.store');
Route::get('account/reset-password/{token}', [UserAuthController::class, 'resetPassword'])->name('reset-password.index');
Route::get('logout', [UserAuthController::class, 'navLogout'])->name('navLogout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('menu', [UserMenuController::class, 'index'])->name('menu');
Route::get('topping', [UserMenuController::class, 'topping'])->name('topping');
Route::post('menu/store', [UserMenuController::class, 'store'])->name('menu.store');
Route::put('menu/update', [UserMenuController::class, 'update'])->name('menu.update');

Route::get('order-topping', [OrderToppingController::class, 'index'])->name('order-topping');
Route::post('order-topping/store', [OrderToppingController::class, 'store'])->name('order-topping.store');
Route::put('order-topping/update', [OrderToppingController::class, 'update'])->name('order-topping.update');

Route::get('checkout', [UserCheckout::class, 'index'])->name('checkout');
Route::delete('checkout/delete/{id}', [UserCheckout::class, 'destroy'])->name('checkout.delete');
Route::put('checkout/update', [UserCheckout::class, 'update'])->name('checkout.update');

Route::get('checkout-topping', [UserCheckoutToppingController::class, 'index'])->name('checkout-topping');
Route::delete('checkout-topping/delete/{id}', [UserCheckoutToppingController::class, 'destroy'])->name('checkout-topping.delete');
Route::put('checkout-topping/update', [UserCheckoutToppingController::class, 'update'])->name('checkout-topping.update');

Route::get('invoice-order/{invoice}', [UserInvoiceController::class, 'index'])->name('invoice-order');
Route::post('invoice-order/{invoice}', [UserInvoiceController::class, 'payment'])->name('invoice-order.payment');
Route::get('invoice-order/{invoice}/update', [UserInvoiceController::class, 'update'])->name('invoice.update');

Route::get('invoice-topping/{invoice}', [UserInvoiceToppingController::class, 'index'])->name('invoice-topping');
Route::post('invoice-topping/{invoice}', [UserInvoiceToppingController::class, 'payment'])->name('invoice-topping.payment');
Route::get('invoice-topping/{invoice}/update', [UserInvoiceToppingController::class, 'update'])->name('invoice-topping.update');

Route::get('reservasi', [UserReservationController::class, 'index'])->name('reservasi');
Route::post('reservasi-detail', [UserReservationController::class, 'detail'])->name('reservasi.detail');
Route::get('reservasi-cart/{table}', [UserReservationController::class, 'cart'])->name('reservasi.cart');
Route::delete('reservasi-cart/update/{table}', [UserReservationController::class, 'delete'])->name('reservasi.delete');

Route::get('reservasi-checkout', [UserReservationCheckoutController::class, 'index'])->name('reservasi.checkout');
Route::get('reservasi-checkout/update', [UserReservationCheckoutController::class, 'update'])->name('reservasi.update');

Route::get('invoice-reservation/{invoice}', [UserReservationInvoiceController::class, 'index'])->name('invoice.reservation');
Route::post('invoice-reservation/{invoice}', [UserReservationInvoiceController::class, 'payment'])->name('invoice.reservation.payment');
Route::put('invoice-reservation/{invoice}/update', [UserReservationInvoiceController::class, 'update'])->name('invoice.reservation.update');

Route::get('history-order', [UserHistoryOrderController::class, 'index'])->name('history.index');
Route::post('history-order', [UserHistoryOrderController::class, 'search'])->name('history.search');

Route::get('history-reservation', [UserHistoryReservationController::class, 'index'])->name('history.reservation.index');
Route::post('history-reservation', [UserHistoryReservationController::class, 'search'])->name('history.reservation.search');

Route::get('history-order-topping', [UserHistoryOrderToppingController::class, 'index'])->name('history-order-topping.index');
Route::post('history-order-topping', [UserHistoryOrderToppingController::class, 'search'])->name('history-order-topping.search');

Route::get('admin/', function () {
    return redirect('admin/login');
});

Route::get('admin/login', [AdminLoginController::class, 'index'])->name('admin.login.index');
Route::post('admin/login/store', [AdminLoginController::class, 'store'])->name('admin.login.store');
Route::get('admin/logout', [AdminLogoutController::class, 'index'])->name('admin.logout');

Route::get('admin/admins', [AdminAdminsController::class, 'index'])->name('admin.admins.index');
Route::get('admin/admins/add', [AdminAdminsController::class, 'add'])->name('admin.admins.add');
Route::post('admin/admins/store', [AdminAdminsController::class, 'store'])->name('admin.admins.store');
Route::get('admin/admins/edit/{id}', [AdminAdminsController::class, 'edit'])->name('admin.admins.edit');
Route::put('admin/admins/edit/{id}/update', [AdminAdminsController::class, 'update'])->name('admin.admins.update');

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

Route::get('admin/menus', [MenuController::class, 'index'])->name('admin.menus.index');
Route::get('admin/menus/add', [MenuController::class, 'add'])->name('admin.menus.add');
Route::post('admin/menus/store', [MenuController::class, 'store'])->name('admin.menus.store');
Route::get('admin/menus/edit/{id}', [MenuController::class, 'edit'])->name('admin.menus.edit');
Route::put('admin/menus/edit/{id}/update', [MenuController::class, 'update'])->name('admin.menus.update');
Route::delete('admin/menus/edit/{id}/delete', [MenuController::class, 'destroy'])->name('admin.menus.destroy');

Route::get('/admin/table', [TableController::class, 'index'])->name('admin.table.index');
Route::get('/admin/table/{table}', [TableController::class, 'edit'])->name('admin.table.edit');
Route::put('/admin/table/update', [TableController::class, 'update'])->name('admin.table.update');

Route::get('/admin/history-order', [AdminOrderController::class, 'index'])->name('admin.history-order');
Route::get('/admin/export/history-order', [AdminOrderController::class, 'export'])->name('admin.export.history-order');
Route::get('/admin/detail-order/{invoice}', [AdminOrderController::class, 'detail'])->name('admin.detail-order');
Route::put('/admin/detail-order/{invoice}/update', [AdminOrderController::class, 'update'])->name('admin.detail-order.update');

Route::get('/admin/history-reservation', [AdminReservationController::class, 'index'])->name('admin.history-reservation');
Route::get('/admin/export/history-reservation', [AdminReservationController::class, 'export'])->name('admin.export.history-reservation');
Route::get('/admin/detail-reservation/{invoice}', [AdminReservationController::class, 'detail'])->name('admin.detail-reservation');
Route::put('/admin/detail-reservation/{invoice}/update', [AdminReservationController::class, 'update'])->name('admin.detail-reservation.update');

Route::get('/admin/history-order-topping', [AdminOrderToppingController::class, 'index'])->name('admin.history-order-topping');
Route::get('/admin/export/history-order-topping', [AdminOrderToppingController::class, 'export'])->name('admin.export.history-order-topping');
Route::get('/admin/detail-order-topping/{invoice}', [AdminOrderToppingController::class, 'detail'])->name('admin.detail-history-order-topping');
Route::put('/admin/detail-order-topping/{invoice}/update', [AdminOrderToppingController::class, 'update'])->name('admin.detail-history-order-topping.update');

Route::get('admin/export/history-order/download', [AdminExportController::class, 'order'])->name('admin.export.order.download');
Route::get('admin/export/history-reservation/download', [AdminExportController::class, 'reservation'])->name('admin.export.reservation.download');
Route::get('admin/export/history-order-topping/download', [AdminExportController::class, 'topping'])->name('admin.export.order-topping.download');

require __DIR__.'/auth.php';
