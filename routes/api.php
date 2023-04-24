<?php

use App\Http\Controllers\Integration\CashFree\LinkController;
use Illuminate\Support\Facades\Route;

Route::any('cf/webhook', [LinkController::class, 'updateLinkUsingWebhook'])->name('updateLinkUsingWebhook');
