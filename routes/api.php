<?php

use App\Http\Controllers\GroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    /**
     * User routes
     */
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('user.show');

    /**
     * Group Routes
     */
    Route::get('/v1/groups', [GroupController::class, 'show'])
        ->name('group.show');
    Route::post('/v1/groups', [GroupController::class, 'store'])
        ->name('group.store');
    Route::patch('/v1/groups/{id}', [GroupController::class, 'update'])
        ->name('group.update');
    Route::delete('/v1/groups/{id}', [GroupController::class, 'destroy'])
        ->name('group.destroy');
});
