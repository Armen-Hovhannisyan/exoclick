<?php

use App\Http\Controllers\ExoClickController;
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

Route::get('/', [ExoClickController::class, 'index'])->name('list.campaigns');
Route::get('/campaigns/create', [ExoClickController::class, 'createCampaignShow'])->name('new.campaign');
Route::post('/campaigns/create', [ExoClickController::class, 'createCampaign'])->name('campaign.create');
