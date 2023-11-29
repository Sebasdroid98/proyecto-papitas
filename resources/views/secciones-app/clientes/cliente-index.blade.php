<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de clientes') }}
        </h2>
    </x-slot>

    <div class="py-12 px-12">
        <div class="flex">
            <div class="w-3/4 p-4">
                <div class="w-full mx-auto sm:px-6 lg:px-8 bg-white py-5 rounded-lg">
                    {{-- @dump($listaClientes) --}}
                    <table class="table-auto w-full border border-collapse border-gray-800">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border border-gray-600 w-1/6">ID</th>
                                <th class="px-4 py-2 border border-gray-600 w-1/4">Nombre</th>
                                <th class="px-4 py-2 border border-gray-600 w-1/4">Dirección</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($listaClientes as $cliente)
                                <tr>
                                    <td class="px-4 py-2 ">{{ $cliente->cliente_id }}</td>
                                    <td class="px-4 py-2 ">{{ $cliente->nombre }}</td>
                                    <td class="px-4 py-2 ">{{ $cliente->direccion }}</td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="w-1/4 p-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white py-5 rounded-lg">
                    <p class="text-center">Nuevo cliente</p>
                    <form method="POST" action="{{ route('clientes.store') }}">
                        @csrf
                        <div class=" leading-6">
                            <x-input-label value="ID" />
                            <x-text-input class="w-full" type="number" name="cliente_id" maxlength="2" value="{{ old('cliente_id') }}" required/>
                            @error('cliente_id')
                                <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class=" leading-6">
                            <x-input-label value="Nombre" />
                            <x-text-input class="w-full" name="nombre" maxlength="100" value="{{ old('nombre') }}" required/>
                            @error('nombre')
                                <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class=" leading-6">
                            <x-input-label value="Dirección" />
                            <textarea name="direccion" maxlength="255" cols="30" rows="5" required>{{ old('direccion') }}</textarea>
                            @error('direccion')
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
