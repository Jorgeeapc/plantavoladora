<?php

namespace App\Http\Livewire;

use App\Models\Prenda;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Talla;
use App\Models\Compra;
use Carbon\Carbon;
use App\Models\Comprasprenda;
use App\Models\Pedido;
use Livewire\Livewire;

class ShowCatalogos extends Component
{
    use WithPagination;

    protected $rules = [
           'cintura'=>'required',
           'largo'=>'required',
           'busto'=>'required',
            'telefono'=>'required|max:9|min:9',
            'comentarios'=>'required|max:100'
       ];

    
    // Busqueda
    public $busqueda;

    // Detalle del productos mostrado en modal 
    public $prenda_descripcion, $prenda_precio, $prenda_material, $prenda_categoria, $prenda_color, $prenda_stock, $prenda_imagen;
    //Detalles de medidas mostrados en modal
    public $talla_cintura, $talla_hombros, $talla_busto;

    // Para manejar listado se prendas segun categoria
    public $filtro= '';

    // Se muestran 16 prendas en catalogo, el numero aumenta con el boton mostrar mas
    public $take=16;

    // Abrir y cerrar modal prenda
    public $open=false, $open_medida=false;

    // Articulo que se agrega al carrito
    public $articulo, $id_prenda;

    public $cantidad=1;

    public $carrito='';

    // Información pedido a medida
    public $cintura, $busto, $largo, $comentarios, $telefono;
    

    public function mount(){
        $user = auth()->user();
        $this->carrito = Compra::where('id_cliente', $user->id)->first();

        if (empty($this->carrito)) {
            $carrito = new Compra();
            $carrito->fecha_compra=Carbon::now();
            $carrito->valor_compra=0;
            $carrito->compra_fecha_estado=Carbon::now();
            $carrito->id_estado=2;
            $carrito->id_cliente=$user->id;
            $carrito->save();
           
        }
    }

    public function updatingBusq(){
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
       
        $this->id_prenda=$id;
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

    public function agregar_carrito(){
        
        $prenda = Prenda::where('id_prenda', $this->id_prenda)->first();

        $user = auth()->user();
        $carrito = Compra::where('id_cliente', $user->id)->where('id_estado', 2)->first();
        
        if (empty($carrito)) {
            $carrito = new Compra();
            $carrito->fecha_compra=Carbon::now();
            $carrito->valor_compra=0;
            $carrito->compra_fecha_estado=Carbon::now();
            $carrito->id_estado=2;
            $carrito->id_cliente=$user->id;
            $carrito->save();
            $this->carrito=$carrito;
        }

        $compra = Comprasprenda::where('id_compra', $carrito->id_compra)->where('id_prenda', $prenda["id_prenda"])->get();
        
        if (empty($compra[0])) {
            $item = new Comprasprenda();
            $item->cantidad= $this->cantidad;
            $item->precio_total = (int)$this->cantidad*(int)$prenda->precio_prenda;
            $item->id_compra = $carrito->id_compra;
            $item->id_prenda = $prenda->id_prenda;
            $item->save();
            $this->open = false;
            session()->flash('message', $prenda->descripcion.' agregado al carrito.');
        }
        else{
            $compra = Comprasprenda::where('id_compra', $carrito->id_compra)->where('id_prenda', $prenda["id_prenda"])->update(['cantidad'=>$this->cantidad]);
            $this->open = false;
            session()->flash('message', 'Este producto ya está en tu carrito. Se ha actualizado la cantidad');
        }

        

        
    }

    public function agregar_medida(){
        $prenda = Prenda::where('id_prenda', $this->id_prenda)->first();

        $user = auth()->user();
        $carrito = Compra::where('id_cliente', $user->id)->where('id_estado', 2)->first();
        
        if (empty($carrito)) {
            $carrito = new Compra();
            $carrito->fecha_compra=Carbon::now();
            $carrito->valor_compra=0;
            $carrito->compra_fecha_estado=Carbon::now();
            $carrito->id_estado=2;
            $carrito->id_cliente=$user->id;
            $carrito->save();
            $this->carrito=$carrito;
        }

        $compra = Comprasprenda::where('id_compra', $carrito->id_compra)->where('id_prenda', $prenda["id_prenda"])->get();
        
        $this->validate([
            'cintura'=>'required|min:2|max:3',
           'largo'=>'required|min:2|max:3',
           'busto'=>'required|min:2|max:3',
            'telefono'=>'required|max:9|min:9',
            'comentarios'=>'required|max:100'
        ]);

        if (empty($compra[0])) {
            $item = new Comprasprenda();
            $item->cantidad= $this->cantidad;
            $item->precio_total = (int)$this->cantidad*(int)$prenda->precio_prenda;
            $item->id_compra = $carrito->id_compra;
            $item->id_prenda = $prenda->id_prenda;
            $item->save();
            
           

                $amedida = new Pedido();
                $amedida->id_prenda=$this->id_prenda;
                $amedida->id_cliente=$user->id;
                $amedida->cintura=$this->cintura;
                $amedida->largo=$this->largo;
                $amedida->busto=$this->busto;
                $amedida->telefono=$this->telefono;
                $amedida->comentarios=$this->comentarios;
                $amedida->cantidad=$this->cantidad;
                $amedida->id_estado=2;
                $amedida->id_comprasprenda=$item->id;
                $amedida->save();

                $this->cintura='';
                $this->largo='';
                $this->busto='';
                $this->telefono='';
                $this->comentarios='';
            $this->open_medida = false;
            session()->flash('message', $prenda->descripcion.' a medida agregado al carrito.');
        }
        else {
            $compra = Comprasprenda::where('id_compra', $carrito->id_compra)->where('id_prenda', $prenda["id_prenda"])->update(['cantidad'=>$this->cantidad]);
            $this->open = false;
            
        }

    }

   public function pedir_medida(){
        $this->open=false;
        $this->open_medida=true;    
   }

   public function volver(){
        $this->open=true;
        $this->open_medida=false;
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

