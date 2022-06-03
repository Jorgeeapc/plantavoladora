<div>

  {{-- busqueda & filtrado--}}
  <div class='relative max-w-2xl max-h-0 mx-auto px-4 sm:py-2 sm:px-6 lg:max-w-7xl lg:px-2'>
    
    <div class="mt-4 ml-3 flex max-w-min gap-x-6">
      <x-jet-input type='text' wire:model='busqueda' placeholder='Busqueda'/>
      @if ($prendas->isEmpty())
        <h1>No se encontraron resultados</h1>   
      @endif
    </div>

    <div class="mt-1 flex max-w-min gap-x-6">
      @foreach ($categorias as $categoria)
        <x-jet-button wire:click="filtroCategoria('{{$categoria->categoria}}')">{{$categoria->categoria}}</x-jet-button>
      @endforeach
    </div>
     
  
  </div>

  {{-- catálogo --}}
  <div class="relative max-w-2xl mx-auto py-2 px-4 sm:py-12 sm:px-6 lg:max-w-7xl lg:px-8">

    {{-- Columnas --}}
    <div class="grid gap-y-10 gap-x-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:gap-x-8">
    
      {{-- recorrido de la coleccion --}}
     
      @foreach ($prendas as $prenda)

        @if (empty($prendas))
          <h1>No se encontraron resultados</h1>   
        @endif
        {{-- Tarjeta de producto --}}
        @livewire('show-prenda', ['prenda' => $prenda], key($prenda->id_prenda))
        
      @endforeach
      
    </div>
        
    {{-- Paginacion --}}
    @if ($prendas->hasPages())
      <div class="py-6">
        {{$prendas->links()}}
      </div>  
    @endif
       
  </div>
  
@livewireScripts
  
</div>