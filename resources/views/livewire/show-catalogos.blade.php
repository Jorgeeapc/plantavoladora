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
          @livewire('show-prenda', ['prenda' => $prenda], key($prenda->id_prenda))
            
        @endforeach
          
      </div>
        
      @if ($this->take <= $count)
        <div>
          <x-jet-button wire:click="loadmore()">Cargar más</x-jet-button>
        </div>
      @endif
        

        {{-- Paginacion 
        @if ($prendas->hasPages())
          <div class="py-6">
            {{$prendas->links()}}
          </div>  
        @endif
        --}}

    </div>
    
    @livewireScripts
  </div>  
</div>