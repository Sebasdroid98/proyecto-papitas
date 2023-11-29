<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de tareas') }}
        </h2>
    </x-slot>

    <div class="py-12 px-12">
        <div class="flex">
            <div class="w-3/4 p-4">
                <div class="w-full mx-auto sm:px-6 lg:px-8 bg-white py-5 rounded-lg">
                    {{-- @dump($listaTareas) --}}
                    <table class="table-auto w-full border border-collapse border-gray-800">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border border-gray-600 w-auto">ID</th>
                                <th class="px-4 py-2 border border-gray-600 w-1/4">Descripción</th>
                                <th class="px-4 py-2 border border-gray-600 w-1/4">Fecha asignación</th>
                                <th class="px-4 py-2 border border-gray-600 w-1/4">Empleado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($listaTareas as $tarea)
                                <tr>
                                    <td class="px-4 py-2 ">{{ $tarea->tarea_id }}</td>
                                    <td class="px-4 py-2 ">{{ $tarea->descripcion }}</td>
                                    <td class="px-4 py-2 ">{{ $tarea->fecha_asignacion }}</td>
                                    <td class="px-4 py-2 ">{{ $tarea->emp_id.' - '.$tarea->nombre }}</td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="w-1/4 p-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white py-5 rounded-lg">
                    <p class="text-center">Nueva tarea</p>
                    <form method="POST" action="{{ route('tareas.store') }}">
                        @csrf
                        <div class=" leading-6">
                            <x-input-label value="ID" />
                            <x-text-input class="w-full" type="number" name="tarea_id" maxlength="2" value="{{ old('tarea_id') }}" required/>
                            @error('tarea_id')
                                <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class=" leading-6">
                            <x-input-label value="Descripción" />
                            <textarea name="descripcion" maxlength="255" cols="30" rows="5" required>{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class=" leading-6">
                            <x-input-label value="Fecha asignación" />
                            <x-text-input class="w-full" type="date" name="fecha_asignacion" min="{{ Date('Y-m-d') }}" value="{{ old('fecha_asignacion') }}" required/>
                            @error('fecha_asignacion')
                                <small class="text-sm font-semibold text-red-600 mb-4">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class=" leading-6">
                            <x-input-label value="Empleado" />
                            <select  class="w-full" name="emp_id" id="" required>
                                <option value="">Seleccione</option>
                                @forelse ($listaEpleados as $empleado)
                                    <option value="{{ $empleado->emp_id }}">{{ $empleado->emp_id .' - '. $empleado->nombre }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            @error('emp_id')
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
