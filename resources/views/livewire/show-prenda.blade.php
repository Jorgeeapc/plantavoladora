<div>


 <div class="items-center flex flex-col">
        <div class="overflow-x-auto sm:mx-6 lg:mx-8">
          <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded">
              <table class="table-fixed sm:table-auto min-w-full text-center shadow-2xl" >
                <thead class="border-b bg-purple-300">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Producto
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Descripción
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Cantidad
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Precio
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                      Total
                    </th>
                    <th scope="col" class="text-sm font-medium text-white px-6 py-4"></th>
                  </tr>
                </thead class="border-b">
                <tbody class="border-b">
                  @if (empty($prendas[0]))
                  <tr class="bg-purple-200 border-b">
                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        Aún no tienes productos en tu carrito de compras...
                    </td>   
                  </tr class="bg-purple-200 border-b">
                  @endif
                    @foreach ($prendas as $prenda)
                        <tr class="bg-purple-200 border-b">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{$prenda["categoria"]}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{$prenda["descripcion"]}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{$prenda["cantidad"]}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    ${{number_format($prenda["precio_prenda"])}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    ${{number_format($prenda["precio_total"])}}
                                </td> 
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                  <x-jet-danger-button wire:click="eliminar_articulo({{$prenda}})">x</x-jet-danger-button>
                                </td>                
                          </tr class="bg-purple-200 border-b">
                          <div class="hidden">
                            {{$total += $prenda["precio_total"] }}
                          </div>
                    @endforeach
                
                    <tr wire:model='total' class="bg-purple-200 border-b">
                      @if (!empty($prendas[0]))
                        <td  colspan="4" class="px-6 py-4 whitespace-nowrap  font-bold text-gray-900">
                          Total
                        </td>   
                        <td colspan="1" class="px-6 py-4 whitespace-nowrap  font-bold text-gray-900">
                          ${{number_format($total)}}
                        </td> 
                      @endif
                    </tr class="bg-purple-200 border-b">
                    <tr class="bg-white border-b">
                      @if (!empty($prendas[0]))
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap  font-bold text-gray-900">
                          <x-jet-button wire:loading.attr="disabled" wire:click="pagar({{$prendas}}, {{$total}})">Pagar</x-jet-button>
                        </td> 
                      @endif
                      @if (empty($prendas[0]))
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap  font-bold text-gray-900">
                          <x-jet-button disabled>Pagar</x-jet-button>
                        </td> 
                      @endif
                    </tr class="bg-white border-b">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div> 
@livewireScripts
</div>