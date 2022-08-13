<?php

namespace App\Models;

use App\Models\Models\DetailPlan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    // use HasFactory;

    protected $fillable = ['name', 'url', 'price', 'description'];

    // Vai exibir os detalhes de um plano(um plano com muitos detalhes)
    public function details(){
        return $this->hasMany(DetailPlan::class);/*hasMany--> Um pra muitos */
    }


    // ESTE MÉTODO FAZ A QUERY QUE LIGA O CONTROLLER
    public function search($filter = null){
        $results = $this->where('name', 'LIKE', "%{$filter}%")->orWhere('description', 'LIKE', "%{$filter}%")->paginate();

        return $results;
    }

}
