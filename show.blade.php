<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Ministerio de Obras Publicas</title>
</head>

<body>
    <x-menu :id="$productos->id" />
    <div class="mt-28 md:ml-52">
        <div class="flex justify-between mb-8">
            <h2 class="text-2xl font-bold">Visualización de Ingresos:</h2>
            <a href="{{ url('stock') }}"
                class="focus:outline-none text-white bg-cyan-700 hover:bg-cyan-900 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
                title="Añadir nuevo usuarios">
                Volver
            </a>
        </div>
        <div>
            <label class="text-1xl font-bold">Nombre:</label>
            <p>{{ $productos->nombre }}</p>
            <label class="text-1xl font-bold">SKU:</label>
            <p>{{ $productos->sku }}</p>
            <label class="text-1xl font-bold">Descripcion:</label>
            <p>{{ $productos->descripcion }}</p>
        </div>
        <table class="is-hoverable w-full text-center bg-white mb-20">
            <thead>
                <tr class="text-black">
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        #
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        Estado
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        Cantidad
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        Valores
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        Gastos
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        Documentos
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stock as $item)
                    @if ($item->producto_id == $productos->id)
                        <tr class="border border-transparent border-b-slate-200">
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                @if ($item->estado == 'pendiente')
                                    Pedido
                                @elseif($item->estado == 'disponible')
                                    Recibido
                                @elseif($item->estado == 'cancelado')
                                    Cancelado
                                    <br>
                                    <button type="button" class="btn bg-red-600 text-white"
                                        onclick="toggleModal('retiro{{ $item->id }}')">
                                        Ver Motivo
                                    </button>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ $item->cantidad }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <br>
                                <strong>Valor/U:</strong> ${{ $item->valor_unidad_bruto }}
                                <br>
                                <strong>Valor/T:</strong> ${{ $item->valor_total_bruto }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                @if ($item->lista_gastos != '')
                                    <button type="button" class="btn bg-primary text-white"
                                        onclick="toggleModal('vergasto{{ $item->id }}')">Ver Cargos
                                    </button>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                @if ($item->orden_compra != '' or $item->factura != '' or $item->guia_despacho != '')
                                    <button type="button" class="btn bg-success"
                                        onclick="toggleModal('verdocs{{ $item->id }}')">Ver Documentacion
                                    </button>
                                @else
                                    No hay doumentos adjuntos
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <div class="flex justify-center">
                                    @if ($item->estado == 'pendiente')
                                        <a type="button" onclick="toggleModal('aprobar{{ $item->id }}')"
                                            class="mx-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                data-bs-toggle="tooltip" data-bs-title="Confirmar Ingreso"
                                                viewBox="0 0 16 16" fill="none">
                                                <path
                                                    d="M14 1C14.5523 1 15 1.44772 15 2V14C15 14.5523 14.5523 15 14 15H2C1.44772 15 1 14.5523 1 14V2C1 1.44772 1.44772 1 2 1H14ZM2 0C0.895431 0 0 0.895431 0 2V14C0 15.1046 0.895431 16 2 16H14C15.1046 16 16 15.1046 16 14V2C16 0.895431 15.1046 0 14 0H2Z"
                                                    fill="green" />
                                                <path
                                                    d="M10.9697 4.96967C11.2626 4.67678 11.7374 4.67678 12.0303 4.96967C12.3196 5.25897 12.3232 5.72582 12.041 6.01947L8.04876 11.0097C8.043 11.0169 8.03685 11.0238 8.03032 11.0303C7.73743 11.3232 7.26256 11.3232 6.96966 11.0303L4.32322 8.38388C4.03032 8.09099 4.03032 7.61612 4.32322 7.32322C4.61611 7.03033 5.09098 7.03033 5.38388 7.32322L7.4774 9.41674L10.9498 4.9921C10.9559 4.98423 10.9626 4.97674 10.9697 4.96967Z"
                                                    fill="green" />
                                            </svg>
                                        </a>
                                        <a type="button" onclick="toggleModal('desaprobar{{ $item->id }}')"
                                            class="mx-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 16 16" fill="none" data-bs-toggle="tooltip"
                                                data-bs-title="Cancelar Ingreso">
                                                <path
                                                    d="M14 1C14.5523 1 15 1.44772 15 2V14C15 14.5523 14.5523 15 14 15H2C1.44772 15 1 14.5523 1 14V2C1 1.44772 1.44772 1 2 1H14ZM2 0C0.895431 0 0 0.895431 0 2V14C0 15.1046 0.895431 16 2 16H14C15.1046 16 16 15.1046 16 14V2C16 0.895431 15.1046 0 14 0H2Z"
                                                    fill="red" />
                                                <path
                                                    d="M4.64645 4.64645C4.84171 4.45118 5.15829 4.45118 5.35355 4.64645L8 7.29289L10.6464 4.64645C10.8417 4.45118 11.1583 4.45118 11.3536 4.64645C11.5488 4.84171 11.5488 5.15829 11.3536 5.35355L8.70711 8L11.3536 10.6464C11.5488 10.8417 11.5488 11.1583 11.3536 11.3536C11.1583 11.5488 10.8417 11.5488 10.6464 11.3536L8 8.70711L5.35355 11.3536C5.15829 11.5488 4.84171 11.5488 4.64645 11.3536C4.45118 11.1583 4.45118 10.8417 4.64645 10.6464L7.29289 8L4.64645 5.35355C4.45118 5.15829 4.45118 4.84171 4.64645 4.64645Z"
                                                    fill="red" />
                                            </svg>
                                        </a>
                                        <a href="{{ url('/stock/' . $item->id . '/edit') }}" title="Editar stock"
                                            class="mx-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 16 16" fill="none" data-bs-toggle="tooltip"
                                                data-bs-title="Editar stock">
                                                <path
                                                    d="M14.5016 1.93934C14.6969 2.1346 14.6969 2.45118 14.5016 2.64645L13.4587 3.68933L11.4587 1.68933L12.5016 0.646447C12.6969 0.451184 13.0134 0.451185 13.2087 0.646447L14.5016 1.93934Z"
                                                    fill="#0d6efd" />
                                                <path
                                                    d="M12.7516 4.39644L10.7516 2.39644L3.93861 9.20943C3.88372 9.26432 3.84237 9.33123 3.81782 9.40487L3.01326 11.8186C2.94812 12.014 3.13405 12.1999 3.32949 12.1348L5.74317 11.3302C5.81681 11.3057 5.88372 11.2643 5.93861 11.2094L12.7516 4.39644Z"
                                                    fill="#0d6efd" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M0 13.5C0 14.3284 0.671573 15 1.5 15H12.5C13.3284 15 14 14.3284 14 13.5V7.5C14 7.22386 13.7761 7 13.5 7C13.2239 7 13 7.22386 13 7.5V13.5C13 13.7761 12.7761 14 12.5 14H1.5C1.22386 14 1 13.7761 1 13.5V2.5C1 2.22386 1.22386 2 1.5 2H8C8.27614 2 8.5 1.77614 8.5 1.5C8.5 1.22386 8.27614 1 8 1H1.5C0.671573 1 0 1.67157 0 2.5V13.5Z"
                                                    fill="#0d6efd" />
                                            </svg></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
    </div>
    @foreach ($stock as $item)
        <div id="retiro{{ $item->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden w-full md:w-1/2 p-4 overflow-x-hidden overflow-y-auto max-h-screen">
            <!-- Modal content -->
            <div class="relative w-full max-w-2xl mx-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-center p-4 border-b rounded-t">
                        <h1 class="modal-title text-lg">
                            Motivo de Cancelación:
                        </h1>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 text-center">
                        <p>{{ $item->motivo }}</p>
                        <div class="mt-2 flex justify-center">
                            <button onclick="closeModal('retiro{{ $item->id }}')" type="button"
                                class="btn bg-gray-400 font-medium text-white hover:bg-gray-500 hover:shadow-lg hover:shadow-gray-500/50 focus:bg-gray-500 focus:shadow-lg focus:shadow-gray-500/50 active:bg-gray-500/80 mr-2 px-5 py-2.5">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="vergasto{{ $item->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden w-full md:w-1/2 p-4 overflow-x-hidden overflow-y-auto max-h-screen">
            <!-- Modal content -->
            <div class="relative w-full max-w-2xl mx-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-center p-4 border-b rounded-t">
                        <h1 class="modal-title text-lg">
                            Motivo de Cancelación:
                        </h1>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 text-center">
                        <textarea name="" id="" cols="30" rows="10" readonly>{{ $item->lista_gastos }}</textarea>
                        <div class="mt-2 flex justify-center">
                            <button onclick="closeModal('vergasto{{ $item->id }}')" type="button"
                                class="btn bg-gray-400 font-medium text-white hover:bg-gray-500 hover:shadow-lg hover:shadow-gray-500/50 focus:bg-gray-500 focus:shadow-lg focus:shadow-gray-500/50 active:bg-gray-500/80 mr-2 px-5 py-2.5">
                                Volver
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="verdocs{{ $item->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden w-full md:w-1/2 p-4 overflow-x-hidden overflow-y-auto max-h-screen">
            <!-- Modal content -->
            <div class="relative w-full max-w-2xl mx-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-center p-4 border-b rounded-t">
                        <h1 class="modal-title text-lg">
                            Documentos:
                        </h1>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 text-center">
                        @if ($item->orden_compra != '')
                            <a href="{{ asset('storage/documentacion/' . $item->orden_compra) }}" target="_blank"
                                class="btn bg-fuchsia-300 mt-2">Orden de Compra</a>
                            <br>
                        @endif

                        @if ($item->factura != '')
                            <a href="{{ asset('storage/documentacion/' . $item->factura) }}" target="_blank"
                                class="btn bg-fuchsia-300 mt-2">Factura</a>
                            <br>
                        @endif

                        @if ($item->guia_despacho != '')
                            <a href="{{ asset('storage/documentacion/' . $item->guia_despacho) }}" target="_blank"
                                class="btn bg-fuchsia-300 mt-2">Guia de Despacho</a>
                            <br>
                        @endif
                        <div class="mt-2 flex justify-center">
                            <button onclick="closeModal('verdocs{{ $item->id }}')" type="button"
                                class="btn bg-gray-400 font-medium text-white hover:bg-gray-500 hover:shadow-lg hover:shadow-gray-500/50 focus:bg-gray-500 focus:shadow-lg focus:shadow-gray-500/50 active:bg-gray-500/80 mr-2 px-5 py-2.5">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="aprobar{{ $item->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden w-full md:w-1/2 p-4 overflow-x-hidden overflow-y-auto max-h-screen">
            <!-- Modal content -->
            <div class="relative w-full max-w-2xl mx-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-center p-4 border-b rounded-t">
                        <h1 class="modal-title text-lg">
                            Confirmar Ingreso
                        </h1>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 text-center">
                        <form action="{{ url('stock/' . $item->id) }}" method="post" id="orden_trabajo_form"
                            enctype="multipart/form-data" onsubmit="return validarFormulario()">
                            {!! csrf_field() !!}
                            @method('PATCH')
                            <div>
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="estado" id="estado" value="disponible">
                                <label for="fecha">Fecha:</label>
                                <input type="date" name="fecha" id="fecha" value="{{ $item->fecha }}"
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400">
                            </div>
                            <div class="flex justify-center mt-2">
                                <button onclick="closeModal('aprobar{{ $item->id }}')" type="button"
                                    id="submitButton2"
                                    class="btn bg-gray-400 font-medium text-white hover:bg-gray-500 hover:shadow-lg hover:shadow-gray-500/50 focus:bg-gray-500 focus:shadow-lg focus:shadow-gray-500/50 active:bg-gray-500/80 mr-2 px-5 py-2.5">
                                    Cancelar
                                </button>
                                <button type="submit" title="Guardar" id="submitButton"
                                    class="text-white bg-green-700 hover:bg-green-900 focus:ring-4 focus:outline-none font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center">
                                    Confirmar
                                </button>
                            </div>
                            <script>
                                // Seleccionar el formulario y el botón de envío
                                const form2 = document.getElementById('orden_trabajo_form');
                                const submitButton3 = document.getElementById('submitButton');
                                const submitButton4 = document.getElementById('submitButton2');

                                // Deshabilitar el botón de envío al hacer clic en él
                                submitButton.addEventListener('click', () => {
                                    submitButton3.disabled = true;
                                    submitButton4.disabled = true;
                                    form2.submit();
                                });
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="desaprobar{{ $item->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden w-full md:w-1/2 p-4 overflow-x-hidden overflow-y-auto max-h-screen">
            <!-- Modal content -->
            <div class="relative w-full max-w-2xl mx-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-center p-4 border-b rounded-t">
                        <h1 class="modal-title text-lg">
                            Cancelar Ingreso
                        </h1>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 text-center">
                        <form action="{{ url('stock/' . $item->id) }}" method="post" id="orden_trabajo_form"
                            enctype="multipart/form-data" onsubmit="return validarFormulario()">
                            {!! csrf_field() !!}
                            @method('PATCH')
                            <div>
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="estado" id="estado" value="cancelado">
                                <label>Motivo:</label>
                                <input type="text" name="motivo" id="motivo"
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400">
                            </div>
                            <div class="flex justify-center mt-2">
                                <button onclick="closeModal('desaprobar{{ $item->id }}')" type="button"
                                    id="submitButton2"
                                    class="btn bg-gray-400 font-medium text-white hover:bg-gray-500 hover:shadow-lg hover:shadow-gray-500/50 focus:bg-gray-500 focus:shadow-lg focus:shadow-gray-500/50 active:bg-gray-500/80 mr-2 px-5 py-2.5">
                                    Cancelar
                                </button>
                                <button type="submit" title="Guardar" id="submitButton"
                                    class="text-white bg-green-700 hover:bg-green-900 focus:ring-4 focus:outline-none font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center">
                                    Confirmar
                                </button>
                            </div>
                            <script>
                                // Seleccionar el formulario y el botón de envío
                                const form2 = document.getElementById('orden_trabajo_form');
                                const submitButton3 = document.getElementById('submitButton');
                                const submitButton4 = document.getElementById('submitButton2');

                                // Deshabilitar el botón de envío al hacer clic en él
                                submitButton.addEventListener('click', () => {
                                    submitButton3.disabled = true;
                                    submitButton4.disabled = true;
                                    form2.submit();
                                });
                            </script>
                        </form>
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
