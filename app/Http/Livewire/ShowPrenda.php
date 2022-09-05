<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Compra;
use App\Models\Comprasprenda;
use App\Models\Pedido;
use App\Models\Prenda;
use Carbon\Carbon;
use Exception;

class ShowPrenda extends Component
{
    public $carrito, $prendas, $eliminar, $total=0;
    public $pagar;

    public function eliminar_articulo($prenda){
        $user = auth()->user();
      
        $compra = Compra::where('id_cliente',$user->id)->where('id_estado', 2)->first();
        $this->eliminar = Comprasprenda::where('id_compra', $compra->id_compra)->where('id_prenda', $prenda["id_prenda"])->first();
        $pedido= Pedido::where('id_comprasprenda', $this->eliminar->id)->first();
        if (!empty($pedido)) {
            $pedido->delete();
        }
        $this->eliminar->delete();
        
        
    }

    public function sumar_totales($total){
        $this->total= $this->total+$total;
    }

    public function pagar($prendas, $total){
        $user = auth()->user();
        $compra = Compra::where('id_cliente',$user->id)->where('id_estado', 2)->update(['id_estado'=>1, 'valor_compra'=>$total]);

        

        foreach ($prendas as $prenda) {
            $cantidad = Prenda::select('stock_prenda')->where('id_prenda', $prenda["id_prenda"])->first();
            $c = Prenda::where('id_prenda', $prenda["id_prenda"])->update(['stock_prenda'=>$cantidad->stock_prenda-(int)$prenda["cantidad"]]);
            
        }       

       
    }

    public function render(){
        $user = auth()->user();
        $carrito = Compra::where('id_cliente',$user->id)->where('id_estado', 2)->first();
       
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
       
        $this->prendas = Comprasprenda::where('id_compra', $carrito->id_compra)->join('prendas', 'comprasprendas.id_prenda', '=', 'prendas.id_prenda')->get();       
        
  

        return view('livewire.show-prenda');
    }
}
