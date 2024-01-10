<?php
use App\Models\Usuarios;

use App\Models\Roles;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Ministerio de Obras Publicas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<script>
    $(document).ready(function() {
        // Inicializar la tabla DataTable y asignarla a la variable 'table'
        const table = $('#customTable').DataTable({
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "NingÃºn dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Ãšltimo",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
        table.draw();

        $.fn.dataTable.ext.search.pop();
    });
</script>

<body>
    <x-menu :id="null" />
    <div class="mt-28 md:ml-52">
        @if (session('flash_message'))
            <div class="bg-green-300 text-black text-xs font-medium mr-2 px-2.5 py-1.5 rounded w-64">
                {{ session('flash_message') }}
            </div>
        @endif
        <div class="flex justify-between mb-8">
            <h2 class="text-2xl font-bold">Listado de Stock:</h2>
            <a href="{{ url('/stock/create') }}"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-900 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
                title="Añadir nuevo usuarios">
                Agregar nuevo
            </a>
        </div>
        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
            <table class="is-hoverable w-full text-center bg-white mb-20" id="customTable">
                <thead>
                    <tr class="text-black">
                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                            #
                        </th>
                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                            Nombre
                        </th>
                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                            SKU
                        </th>
                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                            Ult. Proveedor
                        </th>
                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                            Cant. Stock
                        </th>
                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                            Imagen
                        </th>
                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $item)
                        @if ($item->activo == '1')
                            <tr class="border border-transparent border-b-slate-200"
                                @if ($item->cantidad <= $item->stock_minimo) style="background-color: #EF5350"
                                @endif>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $item->nombre }}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $item->sku }}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    @if ($item->proveedor != '')
                                        {{ $proveedor[intval($item->proveedor)] }}
                                        @if ($tipoProv[intval($item->proveedor)] == 1)
                                            (Con IVA)
                                        @else
                                            (Exento de IVA)
                                        @endif
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    @if ($item->cantidad != '')
                                        {{ $item->cantidad }}
                                    @else
                                        0
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <button type="button" onclick="toggleModal('vermaquina{{ $item->id }}')"
                                        class="bg-primary text-white font-medium rounded-md p-2">
                                        Ver Producto
                                    </button>
                                </td>
                                <td>
                                    <div class="flex justify-center">
                                        <?php $role = roles::where('id', Session::get('rols'))
                                            ->where('retiro_stock', 0)
                                            ->first();
                                        if ($role) {
                                            $role->roles = $role->roles;
                                        } ?>
                                        <?php if ($role) {
                                        ?>
                                        @if ($item->cantidad > 0)
                                            <a type="button" data-bs-toggle="modal"
                                                onclick="toggleModal('retiro{{ $item->id }}')"
                                                title="Solicitar Retiro" class="mx-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                    viewBox="0 0 16 16" fill="none" data-bs-toggle="tooltip"
                                                    data-bs-title="Solicitar Retiro">
                                                    <path
                                                        d="M9.5 0C9.77614 0 10 0.223858 10 0.5C10 0.776142 10.2239 1 10.5 1C10.7761 1 11 1.22386 11 1.5V2C11 2.27614 10.7761 2.5 10.5 2.5H5.5C5.22386 2.5 5 2.27614 5 2V1.5C5 1.22386 5.22386 1 5.5 1C5.77614 1 6 0.776142 6 0.5C6 0.223858 6.22386 0 6.5 0H9.5Z"
                                                        fill="blue" />
                                                    <path
                                                        d="M3 2.5C3 2.22386 3.22386 2 3.5 2H4C4.27614 2 4.5 1.77614 4.5 1.5C4.5 1.22386 4.27614 1 4 1H3.5C2.67157 1 2 1.67157 2 2.5V14.5C2 15.3284 2.67157 16 3.5 16H12.5C13.3284 16 14 15.3284 14 14.5V2.5C14 1.67157 13.3284 1 12.5 1H12C11.7239 1 11.5 1.22386 11.5 1.5C11.5 1.77614 11.7239 2 12 2H12.5C12.7761 2 13 2.22386 13 2.5V14.5C13 14.7761 12.7761 15 12.5 15H3.5C3.22386 15 3 14.7761 3 14.5V2.5Z"
                                                        fill="blue" />
                                                    <path
                                                        d="M5.25512 5.78615C5.24753 5.92237 5.35992 6.03271 5.49635 6.03271H6.32083C6.45891 6.03271 6.56869 5.92013 6.58724 5.78331C6.6762 5.12718 7.12651 4.64893 7.92923 4.64893C8.61478 4.64893 9.2432 4.9917 9.2432 5.81689C9.2432 6.45166 8.86869 6.74365 8.27835 7.18799C7.6055 7.67676 7.0723 8.24805 7.11038 9.1748L7.11335 9.39161C7.11523 9.52833 7.2266 9.63818 7.36333 9.63818H8.17435C8.31242 9.63818 8.42435 9.52625 8.42435 9.38818V9.28271C8.42435 8.56543 8.6973 8.35596 9.43363 7.79736C10.043 7.33398 10.6778 6.81982 10.6778 5.74072C10.6778 4.22998 9.40189 3.5 8.0054 3.5C6.73833 3.5 5.34965 4.09061 5.25512 5.78615ZM6.81204 11.5488C6.81204 12.082 7.23734 12.4756 7.82132 12.4756C8.4307 12.4756 8.84964 12.082 8.84964 11.5488C8.84964 10.9966 8.4307 10.6094 7.82132 10.6094C7.23734 10.6094 6.81204 10.9966 6.81204 11.5488Z"
                                                        fill="blue" />
                                                </svg>
                                            </a>
                                        @endif
                                        <?php }; ?>
                                        <?php $role = roles::where('id', Session::get('rols'))->where('analizar_stock', 1)->first();
                                            if ($role) { $role->roles = $role->roles; }
                                            if ($role) { ?>
                                        <a href="{{ url('/stock/' . $item->id . '/showall') }}"
                                            style="text-decoration:none" title="Visualizar Movimientos" class="mx-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                viewBox="0 0 12 16" fill="none" data-bs-toggle="tooltip"
                                                data-bs-title="Visualizar Movimientos">
                                                <path
                                                    d="M7.5 0C7.77614 0 8 0.223858 8 0.5C8 0.776142 8.22386 1 8.5 1C8.77614 1 9 1.22386 9 1.5V2C9 2.27614 8.77614 2.5 8.5 2.5H3.5C3.22386 2.5 3 2.27614 3 2V1.5C3 1.22386 3.22386 1 3.5 1C3.77614 1 4 0.776142 4 0.5C4 0.223858 4.22386 0 4.5 0H7.5Z"
                                                    fill="black" />
                                                <path
                                                    d="M1 2.5C1 2.22386 1.22386 2 1.5 2H2C2.27614 2 2.5 1.77614 2.5 1.5C2.5 1.22386 2.27614 1 2 1H1.5C0.671573 1 0 1.67157 0 2.5V14.5C0 15.3284 0.671572 16 1.5 16H10.5C11.3284 16 12 15.3284 12 14.5V2.5C12 1.67157 11.3284 1 10.5 1H10C9.72386 1 9.5 1.22386 9.5 1.5C9.5 1.77614 9.72386 2 10 2H10.5C10.7761 2 11 2.22386 11 2.5V14.5C11 14.7761 10.7761 15 10.5 15H1.5C1.22386 15 1 14.7761 1 14.5V2.5Z"
                                                    fill="black" />
                                                <path
                                                    d="M8 7C8 6.44772 8.44772 6 9 6C9.55228 6 10 6.44772 10 7V12C10 12.5523 9.55228 13 9 13C8.44772 13 8 12.5523 8 12V7Z"
                                                    fill="green" />
                                                <path
                                                    d="M2 11C2 10.4477 2.44772 10 3 10C3.55228 10 4 10.4477 4 11V12C4 12.5523 3.55228 13 3 13C2.44772 13 2 12.5523 2 12V11Z"
                                                    fill="red" />
                                                <path
                                                    d="M6 8C5.44772 8 5 8.44772 5 9V12C5 12.5523 5.44772 13 6 13C6.55228 13 7 12.5523 7 12V9C7 8.44772 6.55228 8 6 8Z"
                                                    fill="black" />
                                            </svg>
                                        </a>
                                        <?php } 
                                        ?>
                                        <?php $role = roles::where('id', Session::get('rols'))->where('ingreso_stock', 1)->first();
                                            if ($role) { $role->roles = $role->roles; }
                                            if ($role) { ?>
                                        <a href="{{ url('/productos/' . $item->id . '/stock') }}"
                                            title="Gestionar Ingresos" class="mx-1" style="text-decoration:none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 16 16" fill="none" data-bs-toggle="tooltip"
                                                data-bs-title="Gestionar Ingresos">
                                                <path
                                                    d="M0.5 9.90002C0.776142 9.90002 1 10.1239 1 10.4V12.9C1 13.4523 1.44772 13.9 2 13.9H14C14.5523 13.9 15 13.4523 15 12.9V10.4C15 10.1239 15.2239 9.90002 15.5 9.90002C15.7761 9.90002 16 10.1239 16 10.4V12.9C16 14.0046 15.1046 14.9 14 14.9H2C0.895431 14.9 0 14.0046 0 12.9V10.4C0 10.1239 0.223858 9.90002 0.5 9.90002Z"
                                                    fill="green" />
                                                <path
                                                    d="M7.64645 11.8536C7.84171 12.0488 8.15829 12.0488 8.35355 11.8536L11.3536 8.85355C11.5488 8.65829 11.5488 8.34171 11.3536 8.14645C11.1583 7.95118 10.8417 7.95118 10.6464 8.14645L8.5 10.2929V1.5C8.5 1.22386 8.27614 1 8 1C7.72386 1 7.5 1.22386 7.5 1.5V10.2929L5.35355 8.14645C5.15829 7.95118 4.84171 7.95118 4.64645 8.14645C4.45118 8.34171 4.45118 8.65829 4.64645 8.85355L7.64645 11.8536Z"
                                                    fill="green" />
                                            </svg>
                                        </a>
                                        <?php } 
                                        ?>
                                        <?php $role = roles::where('id', Session::get('rols'))->where('retiro_stock', 1)->first();
                                            if ($role) { $role->roles = $role->roles; }
                                            if ($role) { ?>
                                        <a href="{{ url('/productos/' . $item->id . '/retiros') }}"
                                            title="Gestionar Retiros" class="mx-1" style="text-decoration:none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 16 16" fill="none" data-bs-toggle="tooltip"
                                                data-bs-title="Gestionar Retiros">
                                                <path
                                                    d="M0.5 9.90002C0.776142 9.90002 1 10.1239 1 10.4V12.9C1 13.4523 1.44772 13.9 2 13.9H14C14.5523 13.9 15 13.4523 15 12.9V10.4C15 10.1239 15.2239 9.90002 15.5 9.90002C15.7761 9.90002 16 10.1239 16 10.4V12.9C16 14.0046 15.1046 14.9 14 14.9H2C0.895431 14.9 0 14.0046 0 12.9V10.4C0 10.1239 0.223858 9.90002 0.5 9.90002Z"
                                                    fill="red" />
                                                <path
                                                    d="M7.64645 1.14645C7.84171 0.951184 8.15829 0.951184 8.35355 1.14645L11.3536 4.14645C11.5488 4.34171 11.5488 4.65829 11.3536 4.85355C11.1583 5.04882 10.8417 5.04882 10.6464 4.85355L8.5 2.70711V11.5C8.5 11.7761 8.27614 12 8 12C7.72386 12 7.5 11.7761 7.5 11.5V2.70711L5.35355 4.85355C5.15829 5.04882 4.84171 5.04882 4.64645 4.85355C4.45118 4.65829 4.45118 4.34171 4.64645 4.14645L7.64645 1.14645Z"
                                                    fill="red" />
                                            </svg>
                                        </a>
                                        <?php } 
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach ($productos as $item)
        <div id="retiro{{ $item->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden w-full md:w-1/2 p-4 overflow-x-hidden overflow-y-auto max-h-screen">
            <!-- Modal content -->
            <div class="relative w-full max-w-2xl mx-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-center p-4 border-b rounded-t">
                        <h1 class="modal-title text-lg">
                            Solicitar Retiro
                        </h1>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 flex justify-center">
                        <form action="{{ url('retirostock') }}" method="post" id="orden_trabajo_form"
                            onsubmit="return validarFormulario()" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <input type="hidden" name="solicitor" id="solicitor" value="{{ session('ids') }}">
                            <input type="hidden" name="producto_id" id="producto_id" value="{{ $item->id }}">
                            <div>
                                <label for="departamento">Departamento:</label>
                                <select name="departamento" id="departamento_{{ $item->id }}"
                                    class="select-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" required>
                                    @foreach ($departamento as $depto)
                                        <option value="{{ $depto->id }}">{{ $depto->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="maquina">Maquinaria:</label>
                                <select name="maquina" id="maquina_{{ $item->id }}" class="select-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400">
                                </select>
                            </div>
                            <div>
                                <label>Cantidad:</label>
                                <input type="number" id="cantidad_{{ $item->id }}" name="cantidad"
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" required
                                    oninput="validarCantidad({{ $item->id }}, {{ $item->cantidad }})">

                                <script>
                                    function validarCantidad(itemID, stockDisponible) {
                                        var cantidadInput = document.getElementById("cantidad_" + itemID);
                                        var cantidadIngresada = parseInt(cantidadInput.value);
                                        console.log(stockDisponible)
                                        if (cantidadIngresada > stockDisponible) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: 'La cantidad ingresada no puede ser mayor que el stock disponible. Cant. maxima: ' +
                                                    stockDisponible + '',
                                            });

                                            cantidadInput.value = stockDisponible; // Restaurar el valor máximo
                                        }
                                    }
                                </script>
                            </div>
                            <div class="mt-2 flex justify-center">
                                <button onclick="closeModal('retiro{{ $item->id }}')" type="button"
                                    class="btn bg-gray-400 font-medium text-white hover:bg-gray-500 hover:shadow-lg hover:shadow-gray-500/50 focus:bg-gray-500 focus:shadow-lg focus:shadow-gray-500/50 active:bg-gray-500/80 mr-2 px-5 py-2.5">Cancelar</button>
                                <button type="submit" title="Guardar"
                                    class="text-white bg-green-700 hover:bg-green-900 focus:ring-4 focus:outline-none font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center">
                                    Solicitar
                                </button>
                            </div>
                        </form>
                        <script>
                            // Función para cargar las maquinarias basadas en el departamento seleccionado
                            function cargarMaquinarias(itemID) {
                                // Obtener el select del departamento y maquina basado en el itemID
                                var departamentoSelect = document.getElementById("departamento_" + itemID);
                                var maquinaSelect = document.getElementById("maquina_" + itemID);

                                // Obtener el valor seleccionado en el select de departamento
                                var selectedDepartamento = departamentoSelect.value;

                                // Limpiar las opciones actuales del select de maquina
                                maquinaSelect.innerHTML = "";

                                // Agregar la opción nula por defecto
                                var nullOption = document.createElement("option");
                                nullOption.value = "";
                                nullOption.text = "Seleccione una máquina (opcional)";
                                maquinaSelect.appendChild(nullOption);

                                // Recorrer las maquinarias y agregar las opciones correspondientes
                                @foreach ($maquina as $maqui)
                                    if ({{ $maqui->departamento_id }} == selectedDepartamento) {
                                        var option = document.createElement("option");
                                        option.value = "{{ $maqui->id }}";
                                        option.text = "{{ $maqui->nombre }}";
                                        maquinaSelect.appendChild(option);
                                    }
                                @endforeach
                            }

                            // Obtener todos los elementos con atributos personalizados y asignar eventos
                            var selects = document.querySelectorAll('[id^="departamento_"]');
                            selects.forEach(function(select) {
                                var itemID = select.id.split("_")[1]; // Obtener el itemID
                                select.addEventListener("change", function() {
                                    cargarMaquinarias(itemID);
                                });
                                cargarMaquinarias(itemID);
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div id="vermaquina{{ $item->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden w-full md:w-1/2 p-4 overflow-x-hidden overflow-y-auto max-h-screen">
            <!-- Modal content -->
            <div class="relative w-full max-w-2xl mx-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-center p-4 border-b rounded-t">
                        <h1 class="modal-title text-lg">Maquinarias a cargo:</h1>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6">
                        @if (pathinfo($item->imagen, PATHINFO_EXTENSION) == 'pdf')
                            <iframe src="{{ asset('storage/documentacion/' . $item->imagen) }}" width="100%"
                                height="350"></iframe>
                        @else
                            <div>
                                <div class="flex justify-center">
                                    <img src="{{ asset('storage/documentacion/' . $item->imagen) }}" alt="Imagen"
                                        style="max-width: 200px">
                                </div>
                                <br>
                                <div class="text-center">
                                    <a href="{{ asset('storage/documentacion/' . $item->imagen) }}"
                                        download="imagen_{{ $item->nombre }}"
                                        class="bg-purple-400 rounded-lg mt-2 p-2 text-white">Descargar
                                        Imagen</a>
                                </div>
                            </div>
                        @endif
                        <div class="text-center mt-4 border-t-gray-400 border-t pt-2">
                            <button onclick="closeModal('vermaquina{{ $item->id }}')" type="button"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 mr-2 text-center">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                if (modal.classList.contains('hidden')) {
                    modal.classList.remove('hidden');
                } else {
                    modal.classList.add('hidden');
                }
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
            }
        }
    </script>
</body>

</html>
