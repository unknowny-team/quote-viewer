<?php

use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/quote', function () {
    $quote = Quote::inRandomOrder()->first();
    return response()->json([
        "quote" => $quote->makeHidden(['id'])
    ]);
})->name('get_quote');
