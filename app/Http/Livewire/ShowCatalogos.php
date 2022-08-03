<?php

namespace App\Http\Livewire;

use App\Models\Prenda;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class ShowCatalogos extends Component
{
    use WithPagination;

    protected $rules = [
           'material_prenda'=> 'required',
           'color_prenda'=> 'required',
           'stock_prenda'=> 'required',
           'precio_prenda'=> 'required',
           'descripcion' => 'required',
           'img'=> 'required|image'
       
    ];

    
    public $busqueda;
    public $filtro= '';
    public $filtrocolor='';
    public $take=16;
    


    public function updatingBusq()
    {
        $this->resetPage();
    }


    public function loadmore(){
        $this->take+=8;
    }


    public function filtroCategoria($categoria){
        
        $this->take=16;
        if ($this->filtro==$categoria)
        {
            $this->filtro='';
        }
        else
        {
            $this->filtro=$categoria;
        }
        
    }

   
    

    public function render()
    {
        $categorias = Prenda::select('categoria')->distinct()->get();
        
        $prendas = Prenda::take($this->take)->orWhere('descripcion', 'like', "%$this->busqueda%")->get();
        //$prendas = Prenda::select()->orWhere('descripcion', 'like', "%$this->busqueda%")->paginate(16);
        
        if(!empty($this->filtro)){
            $prendas = Prenda::take($this->take)
                        ->where('categoria', 'like', "%$this->filtro%")
                        ->where('descripcion', 'like', "%$this->busqueda%")
                        ->get();
        }
        
        $count = $prendas->count();


        return view('livewire.show-catalogos', compact(
            'prendas',
            'categorias',
            'count'
        ));
    }
}

