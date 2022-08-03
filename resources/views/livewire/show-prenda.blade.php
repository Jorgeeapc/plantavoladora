<div>

    
        <x-jet-dialog-modal wire:model='open'>
            <x-slot name='title'>
                <div class="justify-center">
                    <h1 class="text-2xl  text-gray-500">Detalle</h1>
                </div>
            </x-slot>
            <x-slot name='content'>
                <div class="mt-4 flex justify-between">
                    <img src={{$prenda->img}} alt="imagen" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                </div>
                <div>
                    <h3 class="text-sm text-gray-700">   
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        {{$prenda->descripcion}} 
                        <p class="text-xl font-medium text-gray-900">${{number_format($prenda->precio_prenda)}}</p>
                    </h3>
                    <div class="mt-4 flex justify-between">  
                        <div>
                            <p class="mt-1 text-sm text-gray-500">{{$prenda->material_prenda}}</p>
                            <p class="mt-1 text-sm text-gray-500">{{$prenda->color_prenda}}</p>
                            <br>
                        </div>
                    </div>     
                    <h3 class="text-sm text-gray-700">Medidas</h3>
                    <div class="flex justify-between my-2">
                        <p class="mt-1 text-sm text-gray-500">Cintura: {{$talla->cintura_talla}}</p>
                        <p class="mt-1 text-sm text-gray-500">Busto: {{$talla->busto_talla}}</p>
                        <p class="mt-1 text-sm text-gray-500">Hombros: {{$talla->cadera_talla}}</p>
                    </div>                   
                </div>
            </x-slot>
            <x-slot name='footer'>
                {{--
                    <div  >
                        <button type="button" wire:click="$set('open', 'false')">volver</button>
                     </div>
                    <x-jet-danger-button>Agregar al carrito</x-jet-danger-button>   --}}
                
            </x-slot>
        </x-jet-dialog-modal>


   
    <div class="container group relative cursor-pointer" wire:click="$set('open', true)">

        
            <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 sm:h-30 md:h-30 lg:h-40 lg:aspect-none">
                <img src={{$prenda->img}} alt="imagen" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
            </div>
    
            <div class="mt-4 justify-between">
           
                <p class="truncate">{{$prenda->descripcion}}</p>
                <p class="mt-1 text-sm text-gray-500">{{$prenda->material_prenda}}</p>
                <p class="mt-1 text-sm text-gray-500">{{$prenda->categoria}}</p>     
                <p class="text-right text-sm font-medium text-gray-900">${{number_format($prenda->precio_prenda)}}</p>    
            </div>
        
    </div>

   
</div>
