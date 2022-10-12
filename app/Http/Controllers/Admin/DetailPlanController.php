<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    protected $repository, $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }

    public function index($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        // $details = $plan->details();
        $details = $plan->details()->paginate();

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details,
        ]);
    }

    public function create($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }
        return view('admin.pages.plans.details.create', [
            'plan' => $plan,
        ]);
    }

    public function store(Request $request, $urlPlan)
    {

        // recupera o plano aqui
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        // details --> vem do relacionamento que está na Model Plan.php
        // cria um novo detalhe para este plano create()
        $plan->details()->create($request->all());

        return redirect()->route('details.plans.index', $plan->url); /*espera a url do plano */
    }

    public function edit($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first(); /*recupera pela url do plano */
        $detail = $this->repository->find($idDetail);/*se existir um detalhe do plano recupera pelo ID */

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit', [
            'plan' => $plan,
            'detail' => $detail,
        ]);
    }


    public function update(Request $request, $urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first(); 
        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        // dd($request->all()); para debugar e ver se os dados estão chegando corretamente

        $detail->update($request->all());

        return redirect()->route('details.plans.index', $plan->url); /*atualiza e enviar o registro */
    }

}
