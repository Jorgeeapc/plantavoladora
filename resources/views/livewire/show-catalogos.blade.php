<div>
  <div class="flex row-span-2 px-4 mb-4 ml-4 mr-4">
    {{-- busqueda & filtrado--}}
    <div class='px-2 py-6'>
      
      @if (session()->has('message'))
      <div class="bg-green-300 text-green-700">
        {{ session('message') }}
      </div> 
      @endif

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

    {{-- Modal detalle producto --}}
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
                <p class="mt-1 text-sm text-gray-500">Largo: {{$talla_hombros}}</p>
              </div>   
          <div>
            <p class="mt-1 text-sm text-gray-800">Cantidad:</p>
            <select wire:model='cantidad' name="cantidad" id="cantidad">
              @for ($i = 0; $i < $prenda_stock; $i++)
                <option value="{{$i+1}}">{{$i+1}}</option>
              @endfor
            </select>
          </div>
         
              
      </x-slot>

      <x-slot name='footer'>
        <div class="px-1">
          <x-jet-button wire:click="$set('open', false)" wire:loading.attr="disabled" class="px-2">Volver</x-jet-button>
        </div>
        <div class="px-1">
          @if ($prenda_stock<1)
            <x-jet-button wire:click="pedir_medida()" disabled class="px-2">A medida</x-jet-button>
          @endif
          @if ($prenda_stock>0)
            <x-jet-button wire:click="pedir_medida()" wire:loading.attr="disabled" class="px-2">A medida</x-jet-button>
          @endif
        </div>
        <div class="px-1">
          @if ($prenda_stock<1)
            <x-jet-danger-button wire:click="agregar_carrito()" disabled>Agregar al carrito</x-jet-danger-button>
          @endif
          @if ($prenda_stock>0)
            <x-jet-danger-button wire:click="agregar_carrito()" wire:loading.attr="disabled">Agregar al carrito</x-jet-danger-button>
          @endif
        </div>
      </x-slot>
    </x-jet-dialog-modal>

    {{-- Modal pedir a medida --}}
  <x-jet-dialog-modal wire:model="open_medida">
    <x-slot name='title'>
        <div class="justify-center">
            <h1 class="text-2xl  text-gray-500">Pedir a medida</h1>
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
               
            <h3 class="text-sm text-gray-700">Medidas (en centímetros)</h3>
            <div class="flex justify-between my-2">
             <form action="">
                <div class="flex justify-between">
                    <x-jet-label class="px-1">Cintura: </x-jet-label>
                    <x-jet-input wire:model='cintura' id='cintura'  placeholder="Cintura"></x-jet-input>
                    @error('cintura')
                        <small>{{$message}}</small>
                    @enderror
                </div>
                <div class="flex justify-between">
                  <x-jet-label class="px-1">Busto: </x-jet-label>
                  <x-jet-input wire:model='busto' id='busto' placeholder="Busto"></x-jet-input>
                  @error('busto')
                    <small>{{$message}}</small>
                  @enderror
                </div>
                <div class="flex justify-between">
                  <x-jet-label class="px-1">Largo: </x-jet-label>
                  <x-jet-input wire:model='largo' id='largo' placeholder="Largo"></x-jet-input>
                  @error('largo')
                    <small>{{$message}}</small>
                  @enderror
                </div>
                <br>
                <h3 class="text-sm text-gray-700">Contacto</h3>
                <div class="flex justify-between">
                  <x-jet-label class="px-1">Teléfono: </x-jet-label>
                  <x-jet-input wire:model='telefono' id='telefono' maxlengh="9" placeholder="987654321"></x-jet-input>
                  @error('telefono')
                    <small>{{$message}}</small>
                  @enderror
                </div>
                <br>
                <h3 class="text-sm text-gray-700">Escríbenos comentarios adicionales</h3>
                <div class="flex justify-between">
                  <x-jet-label class="px-1">Comentarios: </x-jet-label>
                  <x-jet-input wire:model='comentarios' id='comentarios' maxlengh=100 placeholder="Máximo 100 caracteres"></x-jet-input>
                  @error('comentarios')
                    <small>{{$message}}</small>
                  @enderror
                </div>
              </form>
            </div>   
        <div>
          <p class="mt-1 text-sm text-gray-800">Cantidad:</p>
          <select wire:model='cantidad' name="cantidad" id="cantidad">
            @for ($i = 0; $i < $prenda_stock; $i++)
               <option value="{{$i+1}}">{{$i+1}}</option>
            @endfor
          </select>
        </div>    
    </x-slot>

    <x-slot name='footer'>
      <div class="px-1">
        <x-jet-button wire:click="volver()" wire:loading.attr="disabled" class="px-2">Volver</x-jet-button>
      </div>
      <div class="px-1">
        <x-jet-danger-button wire:click="agregar_medida()" wire:loading.attr="disabled">Agregar al carrito</x-jet-danger-button>
      </div>
    </x-slot>
  </x-jet-dialog-modal>
  @endif

  
  @livewireScripts

  
</div>