<div>
    <div class="container group relative cursor-pointer">
        
       
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