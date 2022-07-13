<?php

use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;

Route::delete('admin/plans/{url}', [PlanController::class,  'destroy'])->name('plans.destroy'); /*deletar os planos ao clicar em VER */
Route::get('admin/plans/{url}', [PlanController::class,  'show'])->name('plans.show'); /*Vai exibir os detalhes do plano */
Route::post('admin/plans', [PlanController::class,  'store'])->name('plans.store');
Route::get('admin/plans/create', [PlanController::class, 'create'])->name('plans.create');
Route::get('admin/plans', [PlanController::class, 'index'])->name('plans.index');

Route::get('/', function () {
    return view('welcome');
});
