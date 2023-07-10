<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SynthesisController;
use App\Http\Controllers\Bot\WhatsappBotGPTController;

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

Route::get('synthesis', [SynthesisController::class, 'index'])->name('synthesis.index');

Route::get('incoming', [WhatsappBotGPTController::class, 'incoming'])->name('whatsapp.index');

Route::get('/', function () {
    return view('welcome');
});