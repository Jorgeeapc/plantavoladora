<div>
    
    {{-- comment
    @livewire('create-detalles', ['prenda' => $prenda], key($prenda->id_prenda))
     --}}
    <div class="group relative" wire:click="setOpen">
        
        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
            <img src={{'storage/'.$prenda->img}} alt="imagen" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
        </div>
            
        <div class="mt-4 flex justify-between">
            <div>
                <h3 class="text-sm text-gray-700">
                        
                    <span aria-hidden="true" class="absolute inset-0"></span>
                    {{$prenda->descripcion}}
                     
                </h3>
                    
                    <p class="mt-1 text-sm text-gray-500">{{$prenda->categoria}}</p>
                    <p class="mt-1 text-sm text-gray-500">{{$prenda->material_prenda}}</p>
                    
                   
            </div>
                
            <p class="text-sm font-medium text-gray-900">${{$prenda->precio_prenda}}</p>
                
        </div>
        {{-- boton agregar al carrito --}}
    
    </div>
</div>
