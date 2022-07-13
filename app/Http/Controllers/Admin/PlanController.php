<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan) /*Plan --> é a model que temos que importar */
    {
        $this->repository = $plan;
    }

    public function index()
    {
        $plans = $this->repository->latest()->paginate();

        return view('admin.pages.plans.index', [
            'plans' => $plans, /*passa essa variável($plans) para a view  */
        ]);
    }


    public function create()
    {
        return view('admin.pages.plans.create');
    }


    
    public function store(Request $request)
    { /*Request pega os dados que vem do formulário */


        $data = $request->all();
        $data['url'] = Str::kebab($request->name); /*como não tenho esse campo criado para cadastro ele gera por debaixo dos panos por hora um dado/informação sem precisar inserir */
        $this->repository->create($data);


        return redirect()->route('plans.index');
    }
}
