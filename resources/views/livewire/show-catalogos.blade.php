<div>
  <div class="flex row-span-2 px-4 mb-4">
    {{-- busqueda & filtrado--}}
    <div class='px-2 py-6'>
    
      <div class="px-2 py-2">
        <x-jet-input type='text' wire:model='busqueda' placeholder='Búsqueda'/>

        <div class="mt-2">
          @if (!empty($busqueda))
            <h1>Buscando "{{$busqueda}}" en descripción de los artículos</h1> 
          @endif
        </div>

        <div class="mt-2">
          @if ($prendas->isEmpty())
              <h1 >No se encontraron resultados</h1>   
          @endif
        </div>
      </div>
  

    <div class="grid py-2 px-2">
      @foreach ($categorias as $categoria)
        <div class="py-2">
          <x-jet-button wire:click="filtroCategoria('{{$categoria->categoria}}')">{{$categoria->categoria}}</x-jet-button>
        </div>
      @endforeach
    </div>

    </div>


    <div class="grid py-2 px-2">
    
      {{-- catálogo --}}
     
      <div class="grid  gap-y-10 gap-x-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:gap-x-8">
        
        {{-- recorrido de la coleccion --}}
        @foreach ($prendas as $prenda)
            
          @if (empty($prendas))
            <h1>No se encontraron resultados</h1>   
          @endif
          
          {{-- Tarjeta de producto --}}
       
          <div wire:click="mostrar_prenda({{$prenda->id_prenda}})">
            <x-modal-prenda :prenda="$prenda"/> 
          </div>
          
       
        @endforeach
          
      </div>
        
      @if ($this->take <= $count)
        <div>
          <x-jet-button wire:click="loadmore()">Cargar más</x-jet-button>
        </div>
      @endif
        
    </div>
  </div> 

  @if(!empty($prendas))
  <x-jet-dialog-modal wire:model="open">
    <x-slot name='title'>
        <div class="justify-center">
            <h1 class="text-2xl  text-gray-500">Detalle</h1>
        </div>
    </x-slot>
    <x-slot name='content'>
        <div class="mt-4 flex justify-between">
            <img src={{$prenda_imagen}} alt="imagen" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
        </div>
        <div>
            <h3  class="text-sm text-gray-700">   
             
                  {{$prenda_descripcion}} 
                
                <p class="text-xl font-medium text-gray-900">${{number_format($prenda_precio)}}</p>
            </h3>
            <div class="mt-4 flex justify-between">  
                <div>
                    <p class="mt-1 text-sm text-gray-500">{{$prenda_material}}</p>
                    <p class="mt-1 text-sm text-gray-500">{{$prenda_color}}</p>
                    <br>
                </div>
            </div>     
        </div>
               
            <h3 class="text-sm text-gray-700">Medidas</h3>
            <div class="flex justify-between my-2">
              <p class="mt-1 text-sm text-gray-500">Disponibles: {{$prenda_stock}}</p>
              <p class="mt-1 text-sm text-gray-500">Cintura: {{$talla_cintura}}</p>
              <p class="mt-1 text-sm text-gray-500">Busto: {{$talla_busto}}</p>
              <p class="mt-1 text-sm text-gray-500">Hombros: {{$talla_hombros}}</p>
            </div>                   
    </x-slot>

    <x-slot name='footer'>
      <x-jet-danger-button wire:click="$set('open', false)" wire:loading.attr="disabled" class="px-2">Agregar al carrito</x-jet-danger-button>
    </x-slot>
  </x-jet-dialog-modal>
  @endif
  @livewireScripts
</div>