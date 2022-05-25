<div>

    <x-jet-dialog-modal wire:model='open'>
        <x-slot name='title'>
            <p class="mt-1 text-sm text-gray-500">Detalle</p>
        </x-slot>
        <x-slot name='content'>
            <div class="grid">
                <div>
                    <img src="{{'storage/'.$prenda->img}}" alt="imagen prenda">
                    <p class="mt-1 text-sm text-gray-500">{{$prenda->categoria}}</p>
                    <p class="text-sm font-medium text-gray-900">${{$prenda->precio_prenda}}</p>
                </div>
                
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-button wire:click="setClose">agregar al carrito</x-jet-button>
        </x-slot>

    </x-jet-dialog-modal>

</div>
