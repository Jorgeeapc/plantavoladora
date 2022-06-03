<?php

namespace App\Http\Livewire;

use App\Models\Prenda;
use Livewire\Component;
use Livewire\WithPagination;



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

    public function updatingBusq()
    {
        $this->resetPage();
    }


    public function filtroCategoria($categoria){
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

        if (empty($this->filtro)) {
                $prendas = Prenda::where('descripcion', 'like', '%' . $this->busqueda . '%')
                                ->orWhere('color_prenda','like','%' . $this->busqueda . '%')
                                ->paginate(12);
            }
            else {
                $prendas = Prenda::where('descripcion', 'like', '%' . $this->busqueda . '%')
                                ->where('categoria', $this->filtro)
                                ->orWhere('color_prenda', $this->busqueda)
                                ->paginate(12);
            }
       
        return view('livewire.show-catalogos', compact('prendas', 'categorias'));
    }
}
