<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\SubscriptionController;



Route::redirect('/', '/orders')->name('home');
Route::get('currency/{currency}', [CurrencyController::class, '__invoke'])->name('currency');

Route::get('orders', [OrderController::class,'index'])->name('orders');
Route::get('orders/{order:uuid}', [OrderController::class,'show'])->name('orders.show')->whereUuid('orders');
Route::post('orders/{order:uuid}/payment', [OrderController::class,'payment'])->name('orders.payment')->whereUuid('orders');


Route::get('subscriptions', [SubscriptionController::class,'index'])->name('subscriptions');
Route::get('subscriptions/{subscription:uuid}', [SubscriptionController::class,'show'])->name('subscriptions.show');
Route::get('payments/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscriptions.create');
Route::post('subscriptions', [SubscriptionController::class,'store'])->name('subscriptions.store');
Route::post('subscriptions/{subscription:uuid}', [SubscriptionController::class,'payment'])->name('subscriptions.payment');

Route::get('payments/{payment:uuid}/checkout', [PaymentController::class, 'checkout'])->name('payments.checkout')->whereUuid('payments');
Route::post('payments/{payment:uuid}/method', [PaymentController::class, 'method'])->name('payments.method')->whereUuid('payments');
Route::get('payments/{payment:uuid}/process', [PaymentController::class, 'process'])->name('payments.process')->whereUuid('payments');
Route::post('payments/{payment:uuid}/complete', [PaymentController::class, 'complete'])->name('payments.complete')->whereUuid('payments');
Route::post('payments/{payment:uuid}/cancel', [PaymentController::class, 'cancel'])->name('payments.cancel')->whereUuid('payments');
Route::get('payments/success', [PaymentController::class, 'success'])->name('payments.success');
Route::get('payments/failure', [PaymentController::class, 'failure'])->name('payments.failure');
