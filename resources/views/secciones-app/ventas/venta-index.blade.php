<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de ventas') }}
        </h2>
    </x-slot>

    <div class="py-12 px-12">
        <div class="flex">
            <div class="w-3/4 p-4">
                <div class="w-full mx-auto sm:px-6 lg:px-8 bg-white py-5 rounded-lg">
                    {{-- @dump($listaVentas) --}}
                    <table class="table-auto w-full border border-collapse border-gray-800">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border border-gray-600 w-auto">ID</th>
                                <th class="px-4 py-2 border border-gray-600 w-1/5">Cliente</th>
                                <th class="px-4 py-2 border border-gray-600 w-1/5">Producto</th>
                                <th class="px-4 py-2 border border-gray-600 w-1/5">Cantidad(Kg)</th>
                                <th class="px-4 py-2 border border-gray-600 w-1/5">Fecha venta</th>
                                <th class="px-4 py-2 border border-gray-600 w-1/5">Valor unitario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($listaVentas as $venta)
                                <tr>
                                    <td class="px-4 py-2 ">VT-{{ $venta->venta_id }}</td>
                                    <td class="px-4 py-2 ">C-{{ $venta->cliente_id .' - '. $venta->nombre}}</td>
                                    <td class="px-4 py-2 ">{{ $venta->tipopapafrita }}</td>
                                    <td class="px-4 py-2 ">{{ $venta->cantidad }}</td>
                                    <td class="px-4 py-2 ">{{ $venta->fecha_venta }}</td>
                                    <td class="px-4 py-2 ">$ {{ $venta->preciounitario }}</td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="w-1/4 p-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white py-5 rounded-lg">
                    <p class="text-center">Nueva venta</p>
                    <form method="POST" action="{{ route('ventas.store') }}">
                        @csrf
                        <div class=" leading-6">
                            <x-input-label value="ID" />
                            <x-text-input class="w-full" type="number" name="venta_id" maxlength="2" value="{{ old('venta_id') }}" required/>
                            @error('venta_id')
                                <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class=" leading-6">
                            <x-input-label value="Cliente" />
                            <select  class="w-full" name="cliente_id" id="" required>
                                <option value="">Seleccione</option>
                                @forelse ($listaClientes as $cliente)
                                    <option value="{{ $cliente->cliente_id }}">C-{{ $cliente->cliente_id .' - '. $cliente->nombre }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            @error('cliente_id')
                                <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class=" leading-6">
                            <x-input-label value="Fecha venta" />
                            <x-text-input class="w-full" type="date" name="fecha_venta" min="{{ Date('Y-m-d') }}" value="{{ Date('Y-m-d') }}" required/>
                            @error('fecha_venta')
                                <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class=" leading-6">
                            <x-input-label value="Producto" />
                            <select  class="w-full" name="papitafrita_id" id="" required>
                                <option value="">Seleccione</option>
                                @forelse ($listaPapitasFritas as $producto)
                                    <option value="{{ $producto->papitafrita_id }}">{{ $producto->tipopapafrita }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            @error('papitafrita_id')
                                <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class=" leading-6">
                            <x-input-label value="Cantidad(Kg)" />
                            <x-text-input class="w-full" type="number" name="cantidad" value="{{ old('cantidad') }}" required/>
                            @error('cantidad')
                                <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class=" leading-6">
                            <x-input-label value="Precio unitario" />
                            <x-text-input class="w-full" type="number" name="precio_unitario" step="0.01" value="{{ old('precio_unitario') }}" required/>
                            @error('precio_unitario')
                                <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                        {{-- <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button> --}}
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('Guardar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
