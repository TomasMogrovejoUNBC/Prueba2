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
        <div class="flex mb-2">
            <div class="mr-24">
                <label class="text-1xl font-bold">Nombre:</label>
                <p>{{ $productos->nombre }}</p>
                <label class="text-1xl font-bold">SKU:</label>
                <p>{{ $productos->sku }}</p>
                <label class="text-1xl font-bold">Descripcion:</label>
                <p>{{ $productos->descripcion }}</p>
            </div>
            <div class="mr-24">
                <label class="text-1xl font-bold">Stock Actual:</label>
                <p>
                    @if ($productos->cantidad != '')
                        {{ $productos->cantidad }}
                    @else
                        0
                    @endif

                </p>
                <label class="text-1xl font-bold">Stock Retirado:</label>
                <p>
                    @if ($productos->retirado != '')
                        {{ $productos->retirado }}
                    @else
                        0
                    @endif
                </p>
            </div>
            <div>
                <label class="text-1xl font-bold">Valor Unitario:</label>
                <p>$
                    @if ($productos->valor_unidad_bruto != '')
                        {{ $productos->valor_unidad_bruto }}
                    @else
                        0
                    @endif
                </p>
                <label class="text-1xl font-bold">Valor Total:</label>
                <p>$
                    @if ($productos->valor_total_bruto != '')
                        {{ $productos->valor_total_bruto }}
                    @else
                        0
                    @endif
                </p>
            </div>
        </div>
        <table class="is-hoverable w-full text-center bg-white mb-20">
            <thead>
                <tr class="text-black">
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        #
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        Movimiento
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        Estado
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        Retira/Ingresa
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        Valores
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        Al momento
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase lg:px-5">
                        Fecha
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $combinedData = array_merge($stock->where('estado', 'disponible')->toArray(), $retiros->where('estado', 'aprovado')->toArray());
                    // Ordenar el array combinado por fecha
                    usort($combinedData, function ($a, $b) {
                        $dateA = $a['fecha'] ?? ($a['updated_at'] ?? $a['created_at']);
                        $dateB = $b['fecha'] ?? ($b['updated_at'] ?? $b['created_at']);
                        return strtotime($dateB) - strtotime($dateA);
                    });
                @endphp
                @foreach ($combinedData as $item)
                    @if ($item['producto_id'] == $productos->id)
                        <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                @if (isset($item['marca']))
                                    INGRESO
                                @else
                                    <!-- Datos de retiros -->
                                    RETIRO
                                    <br>
                                    <strong>Usuario:</strong> {{ $nombre[intval($item['solicitor'])] }}
                                    {{ $apellido[intval($item['solicitor'])] }}
                                    <br>
                                    <strong>Departamento:</strong> {{ $departamento[intval($item['departamento'])] }}
                                    @if (!empty($item['maquina']))
                                        <br>
                                        <strong>Maquinaria:</strong> {{ $maquina[intval($item['maquina'])] }}
                                    @endif
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                @if (isset($item['marca']))
                                    <!-- Datos de stock -->
                                    @if ($item['estado'] == 'pendiente')
                                        Pendiente
                                    @elseif ($item['estado'] == 'disponible')
                                        Disponible
                                    @endif
                                @else
                                    <!-- Datos de retiros -->
                                    @if ($item['estado'] == 'pendiente')
                                        Pendiente
                                    @elseif ($item['estado'] == 'aprovado')
                                        <strong style="color: green">Aprobado</strong>
                                    @elseif ($item['estado'] == 'rechazado')
                                        <strong style="color: red">Rechazado</strong>
                                    @endif
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                @if ($item['estado'] == 'pendiente')
                                    A ingresar:
                                @elseif ($item['estado'] == 'disponible')
                                    Ingresa:
                                @else
                                    Retira:
                                @endif
                                <br>
                                {{ $item['cantidad'] }} U
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                @if (isset($item['producto_id']))
                                    <!-- Datos de stock -->
                                    <strong>Valor/U:</strong> ${{ $item['valor_unidad_bruto'] }}
                                    <br>
                                    <strong>Valor/T:</strong> ${{ $item['valor_total_bruto'] }}
                                @else
                                    <!-- Datos de retiros -->
                                    <strong>Valor/U:</strong> ${{ $item['valor_unidad_bruto'] }}
                                    <br>
                                    <strong>Valor/T:</strong> ${{ $item['valor_total_bruto'] }}
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <strong>Cantidad:</strong>
                                {{ $item['actual'] }} U
                                <br>
                                <strong>Saldo:</strong>
                                ${{ $item['valor_momento'] }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                @if (isset($item['marca']))
                                    <!-- Datos de stock -->
                                    {{ \Carbon\Carbon::parse($item['fecha'])->format('m/d/Y') }}
                                @else
                                    <!-- Datos de retiros -->
                                    @if ($item['estado'] == 'aprovado')
                                        @if (isset($item['updated_at']) && !empty($item['updated_at']))
                                            {{ \Carbon\Carbon::parse($item['updated_at'])->format('m/d/Y') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($item['created_at'])->format('m/d/Y') }}
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
