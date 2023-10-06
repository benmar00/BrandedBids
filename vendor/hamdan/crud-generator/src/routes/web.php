<?php
/** Code By HAMDAN */
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/crud-generator', [Hamdan\CrudGenerator\Controllers\ProcessController::class,'getGenerator'])->name('generator');
    Route::post('process', [Hamdan\CrudGenerator\Controllers\ProcessController::class,'postGenerator'])->name('postGenerator');
});

