<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Empleados') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}

    {{-- @dump($listaEmpleados) --}}

    <div class="py-12">
        <div class="row">
            <div class="col-6 col-md-6 col-lg-6 col-xl-6 bg-white">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>Nombre</td>
                            <td>Cargo</td>
                            <td>Salario</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listaEmpleados as $empleado)
                            <tr>
                                <td>{{ $empleado->nombre }}</td>
                                <td>{{ $empleado->cargo }}</td>
                                <td>{{ $empleado->salario }}</td>
                            </tr>
                        @empty
                        
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
