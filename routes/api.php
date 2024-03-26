<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('user.show');

    Route::apiResources([
        'groups' => GroupController::class,
        'groups.tasks' => TaskController::class,
    ]);
});
