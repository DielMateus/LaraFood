<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /*o nosso repository é a nossa própria model Plan */
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



    public function store(StoreUpdatePlan $request)
    { /*Request pega os dados que vem do formulário, como criamos o StoreUpdatePlan dentro de Requests/StoreUpdatePlan para validar, aí tirei o request */


        //$data = $request->all();
        //$data['url'] = Str::kebab($request->name); /*como não tenho esse campo criado para cadastro ele gera por debaixo dos panos por hora um dado/informação sem precisar inserir */
        $this->repository->create($request->all());


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
        $plan = $this->repository
        ->with('details')
        ->where('url', $url)
        ->first(); /*encontra o plano pela url */

        if (!$plan) /*se não encontrar o plano, url digitada errada direciona de volta */
            return redirect()->back();

        if($plan->details->count() > 0 ){
            return redirect()
                        ->back()
                        ->with('error', 'Existem detalhes vinculados a esse plano, portanto terá que deletar primeiro o detalhe relacionado');
        }

        $plan->delete();/*exclui o plano */

        return redirect()->route('plans.index'); /*após excluir o plano retorna para a listagem dos planos */
    }

    //filtros de pesquisa
    public function search(Request $request){

        $filters = $request->except('_token');/*pega os dados exceto o token */

        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters,
        ]);
    }

    public function edit($url)
    {
        $plan = $this->repository->where('url', $url)->first(); /*encontra o plano pela url */

        if (!$plan) /*se não encontrar o plano, url digitada errada direciona de volta */
            return redirect()->back();

            return view('admin.pages.plans.edit',[
                'plan' => $plan
            ]);

    }

    public function update(StoreUpdatePlan $request, $url){
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        $plan->update($request->all());/*pega todos os planos */

        return redirect()->route('plans.index');
    }

}
