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
    <x-menu :id="null" />
    <div class="mt-28 md:ml-52">
        @if (session('flash_message'))
            <div class="bg-green-300 text-black text-xs font-medium mr-2 px-2.5 py-1.5 rounded w-64">
                {{ session('flash_message') }}
            </div>
        @endif
        <div class="flex justify-between mb-8">
            <h2 class="text-2xl font-bold">Listado de Roles:</h2>
            <a href="{{ url('/roles/create') }}"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-900 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
                title="Añadir nuevo usuarios">
                Agregar nuevo
            </a>
        </div>
        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
            <table class="is-hoverable w-full text-center bg-white mb-20">
                <thead>
                    <tr class="text-black">
                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                            #
                        </th>
                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                            Nombre
                        </th>
                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                            Descripcion
                        </th>
                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $item)
                        <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $item->nombre }}</td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $item->descripcion }}</td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                @if ($item->id != '1')
                                    <div class="flex justify-center pt-4">
                                        <div class="mr-4">
                                            <a href="{{ url('/roles/' . $item->id) }}" title="Ver roles">
                                                <svg class="w-[20px] h-[20px] text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                                                    <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                      <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                                      <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z"/>
                                                    </g>
                                                  </svg>
                                            </a>
                                        </div>
                                        <div class="mr-4">
                                            <a href="{{ url('/roles/' . $item->id . '/edit') }}" title="Editar"
                                                class="mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 15 15" fill="none">
                                                    <path
                                                        d="M14.5016 1.93934C14.6969 2.1346 14.6969 2.45118 14.5016 2.64645L13.4587 3.68933L11.4587 1.68933L12.5016 0.646447C12.6969 0.451184 13.0134 0.451185 13.2087 0.646447L14.5016 1.93934Z"
                                                        fill="#1D4ED8" />
                                                    <path
                                                        d="M12.7516 4.39644L10.7516 2.39644L3.93861 9.20943C3.88372 9.26432 3.84237 9.33123 3.81782 9.40487L3.01326 11.8186C2.94812 12.014 3.13405 12.1999 3.32949 12.1348L5.74317 11.3302C5.81681 11.3057 5.88372 11.2643 5.93861 11.2094L12.7516 4.39644Z"
                                                        fill="#1D4ED8" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M0 13.5C0 14.3284 0.671573 15 1.5 15H12.5C13.3284 15 14 14.3284 14 13.5V7.5C14 7.22386 13.7761 7 13.5 7C13.2239 7 13 7.22386 13 7.5V13.5C13 13.7761 12.7761 14 12.5 14H1.5C1.22386 14 1 13.7761 1 13.5V2.5C1 2.22386 1.22386 2 1.5 2H8C8.27614 2 8.5 1.77614 8.5 1.5C8.5 1.22386 8.27614 1 8 1H1.5C0.671573 1 0 1.67157 0 2.5V13.5Z"
                                                        fill="#1D4ED8" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div>
                                            <button type="button"
                                                onclick="toggleModal('staticModal{{ $item->id }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 14 15" fill="none">
                                                    <path
                                                        d="M4.5 5.5C4.77614 5.5 5 5.72386 5 6V12C5 12.2761 4.77614 12.5 4.5 12.5C4.22386 12.5 4 12.2761 4 12V6C4 5.72386 4.22386 5.5 4.5 5.5Z"
                                                        fill="red" />
                                                    <path
                                                        d="M7 5.5C7.27614 5.5 7.5 5.72386 7.5 6V12C7.5 12.2761 7.27614 12.5 7 12.5C6.72386 12.5 6.5 12.2761 6.5 12V6C6.5 5.72386 6.72386 5.5 7 5.5Z"
                                                        fill="red" />
                                                    <path
                                                        d="M10 6C10 5.72386 9.77614 5.5 9.5 5.5C9.22386 5.5 9 5.72386 9 6V12C9 12.2761 9.22386 12.5 9.5 12.5C9.77614 12.5 10 12.2761 10 12V6Z"
                                                        fill="red" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M13.5 3C13.5 3.55228 13.0523 4 12.5 4H12V13C12 14.1046 11.1046 15 10 15H4C2.89543 15 2 14.1046 2 13V4H1.5C0.947715 4 0.5 3.55228 0.5 3V2C0.5 1.44772 0.947715 1 1.5 1H5C5 0.447715 5.44772 0 6 0H8C8.55229 0 9 0.447715 9 1H12.5C13.0523 1 13.5 1.44772 13.5 2V3ZM3.11803 4L3 4.05902V13C3 13.5523 3.44772 14 4 14H10C10.5523 14 11 13.5523 11 13V4.05902L10.882 4H3.11803ZM1.5 3V2H12.5V3H1.5Z"
                                                        fill="red" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach ($roles as $item)
        <div id="staticModal{{ $item->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 hidden w-full md:w-1/2 p-4 overflow-x-hidden overflow-y-auto max-h-screen">
            <!-- Modal content -->
            <div class="relative w-full max-w-2xl mx-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-center p-4 border-b rounded-t">
                        <h1 class="modal-title text-lg">¿Confirmar Eliminación?</h1>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 flex justify-center">
                        <button onclick="closeModal('staticModal{{ $item->id }}')" type="button"
                            class="text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 mr-2 text-center">Cancelar</button>
                        <form method="POST" action="{{ url('/roles' . '/' . $item->id) }}" accept-charset="UTF-8"
                            style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" title="Eliminar"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">Eliminar</button>
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
