<?php

namespace App\Http\Livewire;

use App\Models\Prenda;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Talla;



class ShowCatalogos extends Component
{
    use WithPagination;

    protected $rules = [
           'id_prenda'=>'required',
           'material_prenda'=> 'required',
           'color_prenda'=> 'required',
           'stock_prenda'=> 'required',
           'precio_prenda'=> 'required',
           'descripcion' => 'required',
           'img'=> 'required|image'
       ];

    
    public $busqueda;
    public $prenda_descripcion, $prenda_precio, $prenda_material, $prenda_categoria, $prenda_color, $prenda_stock, $prenda_imagen;
    public $talla_cintura, $talla_hombros, $talla_busto;
    public $filtro= '';
    public $filtrocolor='';
    public $take=16;
    public $open=false;
    

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

    public function mostrar_prenda($id){
       

        $this->prenda_descripcion=Prenda::select('descripcion')->where('id_prenda',$id)->value('descripcion');
        $this->prenda_precio=Prenda::select('precio_prenda')->where('id_prenda',$id)->value('precio_prenda');
        $this->prenda_material=Prenda::select('material_prenda')->where('id_prenda',$id)->value('material_prenda');
        $this->prenda_color=Prenda::select('color_prenda')->where('id_prenda',$id)->value('color_prenda');
        $this->prenda_stock=Prenda::select('stock_prenda')->where('id_prenda',$id)->value('stock_prenda');
        $this->prenda_categoria=Prenda::select('categoria')->where('id_prenda',$id)->value('categoria');
        $this->prenda_imagen=Prenda::select('img')->where('id_prenda', $id)->value('img');
        $prenda=Prenda::where('id_prenda', $id)->value('id_talla');
        $this->talla_busto=Talla::where('id_talla', $prenda)->value('busto_talla');
        $this->talla_cintura=Talla::where('id_talla', $prenda)->value('cintura_talla');
        $this->talla_hombros=Talla::where('id_talla', $prenda)->value('cadera_talla');
        $this->open=true;
    }

    public function close(){
        $this->open=false;
    }

    public function render()
    {
        $categorias = Prenda::select('categoria')->distinct()->get();
     
        $prendas = Prenda::take($this->take)->orWhere('descripcion', 'like', "%$this->busqueda%")->get();
        
        
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
            'count',
        ));
    }
}

