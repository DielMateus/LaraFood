<?php

use App\Http\Controllers\Admin\DetailPlanController;
use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {


    /**
     * Routes Details Plans 
     */
    Route::get('plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');



    /**
     * Routes Plans 
     */
    Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');/*Estava dando redirect back, por que esta rota estava antes da show, ou seja estava entendendo que era pra listar antes de criar, então se algum formulário ou dado não estiver dando certo é por que a ordem das rotas importa muito */
    Route::put('plans/{url}', [PlanController::class,  'update'])->name('plans.update');
    Route::get('plans/{url}/edit', [PlanController::class,  'edit'])->name('plans.edit');
    Route::any('plans/search', [PlanController::class,  'search'])->name('plans.search');/*route do tipo any aceita qualquer tipo de requisição */
    Route::delete('plans/{url}', [PlanController::class,  'destroy'])->name('plans.destroy'); /*deletar os planos ao clicar em VER */
    Route::get('plans/{url}', [PlanController::class,  'show'])->name('plans.show'); /*Vai exibir os detalhes do plano */
    Route::post('plans', [PlanController::class,  'store'])->name('plans.store');
    Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
    
    /**
     * Home Dashboard
     */
    Route::get('/', [PlanController::class, 'index'])->name('admin.index'); /*Vai ser a home do admin */
});




Route::get('/', function () {
    return view('welcome');
});
