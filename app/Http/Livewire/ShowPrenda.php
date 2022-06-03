<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Prenda;
use App\Models\Talla;

class ShowPrenda extends Component
{
    public $prenda, $talla;
    public $open = false;
    

    protected $rules = [
        'prenda.material_prenda'=> 'required',
        'prenda.color_prenda'=> 'required',
        'prenda.stock_prenda'=> 'required',
        'prenda.precio_prenda'=> 'required',
        'prenda.descripcion' => 'required',
        'prenda.img'=> 'required|image',
    ];

    public function mount(Prenda $prenda){
        $this->prenda = $prenda;
        $this->talla = Talla::where('id_talla', $prenda->id_talla)->first();
        
    }


    public function render()
    {
         return view('livewire.show-prenda');
    }
}
