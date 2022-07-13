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

    public function show($url)/*passo a url da rota para este método aqui. Listo os planos criados/existentes  */
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        return view('admin.pages.plans.show', [
            'plan' => $plan
        ]);
    }

    public function destroy($url)
    {
        $plan = $this->repository->where('url', $url)->first(); /*encontra o plano pela url */

        if (!$plan) /*se não encontrar o plano, url digitada errada direciona de volta */
            return redirect()->back();

        $plan->delete();/*exclui o plano */

        return redirect()->route('plans.index'); /*após excluir o plano retorna para a listagem dos planos */
    }
}
