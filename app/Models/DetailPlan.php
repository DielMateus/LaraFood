<?php

namespace App\Models\Models;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{
    protected $table = 'details_plan';

    /*Um detalhe eu retorno o plano dele */
    public function plan(){
        $this->belongsTo(Plan::class);
    }
}
