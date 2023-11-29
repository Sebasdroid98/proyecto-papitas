@php
    $modulos = [
        ['title' => 'Gestión de empleados', 'info' => 'Gestiona la información de los empleados', 'url' => 'empleados.index','rol'=>[1]],
        ['title' => 'Gestión de tareas', 'info' => 'Gestiona la información de las tareas', 'url' => 'tareas.index','rol'=>[1,2]],
        ['title' => 'Gestión de clientes', 'info' => 'Gestiona la información de los clientes', 'url' => 'clientes.index','rol'=>[1,2]],
        ['title' => 'Gestión de ventas', 'info' => 'Gestiona la información de las ventas', 'url' => 'ventas.index','rol'=>[1,2]],
    ];

    $rolUser = Auth::user()->rol;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- @dump($rolUser) --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Lista de secciones del sistema") }}
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ul role="list" class="divide-y divide-gray-100">
                @forelse ($modulos as $modulo)
                    @continue(!in_array($rolUser, $modulo['rol']))
                    <li class="flex justify-between gap-x-6 py-5 mt-2 bg-white p-6 shadow-sm sm:rounded-lg">
                        <div class="min-w-0 gap-x-4">
                            <p>{{ $modulo['title'] }}</p>
                            {{-- <div class="min-w-0 flex-auto"> --}}
                                <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $modulo['info'] }}</p>
                        </div>
                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <a class="text-sm font-semibold bg-slate-300 leading-6 text-gray-900 p-2" href="{{ url($modulo['url']) }}">Ir a la página</a>
                        </div>
                    </li>
                @empty

                @endforelse
            </ul>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

    </div>
</x-app-layout>
