<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listados de empleados') }}
        </h2>
    </x-slot>

    <div class="py-12 px-12">
        <div class="flex">
            <div class="w-3/4 p-4">
                <div class="w-full mx-auto sm:px-6 lg:px-8 bg-white py-5 rounded-lg">
                    <table class="table-auto w-full border border-collapse border-gray-800">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border border-gray-600 w-auto">ID</th>
                                <th class="px-4 py-2 border border-gray-600 w-1/4">Nombre</th>
                                <th class="px-4 py-2 border border-gray-600 w-1/4">Cargo</th>
                                <th class="px-4 py-2 border border-gray-600 w-1/4">Salario</th>
                                <th class="px-4 py-2 border border-gray-600 w-auto">OP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($listaEmpleados as $empleado)
                                <tr>
                                    <td class="px-4 py-2 ">{{ $empleado->emp_id }}</td>
                                    <td class="px-4 py-2 ">{{ $empleado->nombre }}</td>
                                    <td class="px-4 py-2 ">{{ $empleado->cargo }}</td>
                                    <td class="px-4 py-2 ">{{ $empleado->salario }}</td>
                                    <td class="px-4 py-2 ">
                                        <a
                                            class="text-sm font-semibold bg-slate-300 leading-6 text-gray-900 p-2"
                                            href="{{ url('empleados.edit/'.$empleado->emp_id) }}"
                                        >Editar</a>
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="w-1/4 p-4">
                @if (session('data'))
                    {{-- @dump(session('data')) --}}
                    @php
                        $infoEmpleado = session('data');
                    @endphp
                    <div id="actualizar">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white py-5 rounded-lg">
                            <p class="text-center">Actualizar empleado</p>
                            <form method="POST" action="{{ url('empleados.update/'.$infoEmpleado->emp_id) }}">
                                @csrf
                                @method('PUT')
                                <div class=" leading-6 hidden">
                                    <x-input-label value="ID" />
                                    <x-text-input class="w-full hidden" type="number" name="emp_id" maxlength="2" value="{{ $infoEmpleado->emp_id }}" required/>
                                    @error('emp_id')
                                        <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class=" leading-6">
                                    <x-input-label value="Nombre" />
                                    <x-text-input class="w-full" name="nombre" maxlength="100" value="{{ $infoEmpleado->nombre }}" required/>
                                    @error('nombre')
                                        <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class=" leading-6">
                                    <x-input-label value="Cargo" />
                                    <x-text-input class="w-full" name="cargo" maxlength="50" value="{{ $infoEmpleado->cargo }}" required/>
                                    @error('cargo')
                                        <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class=" leading-6">
                                    <x-input-label value="Salario" />
                                    <x-text-input type="number" class="w-full" name="salario" max="999999999" step="0.01" value="{{ $infoEmpleado->salario }}" required/>
                                    @error('salario')
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
                @else
                    <div id="registrar">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white py-5 rounded-lg">
                            <p class="text-center">Nuevo empleado</p>
                            <form method="POST" action="{{ route('empleados.store') }}">
                                @csrf
                                <div class=" leading-6">
                                    <x-input-label value="ID" />
                                    <x-text-input class="w-full" type="number" name="emp_id" maxlength="2" value="{{ old('emp_id') }}" required/>
                                    @error('emp_id')
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
                                    <x-input-label value="Cargo" />
                                    <x-text-input class="w-full" name="cargo" maxlength="50" value="{{ old('cargo') }}" required/>
                                    @error('cargo')
                                        <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class=" leading-6">
                                    <x-input-label value="Salario" />
                                    <x-text-input type="number" class="w-full" name="salario" max="999999999" step="0.01" value="{{ old('salario') }}" required/>
                                    @error('salario')
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
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
