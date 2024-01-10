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
    <div class="block max-w-xl p-6 bg-white border border-gray-500 rounded-lg shadow mx-auto mt-28">
        <h2 class="text-2xl font-bold text-center">Ingreso de Stock</h2>
        <form action="{{ url('stock') }}" method="post" id="orden_trabajo_form" onsubmit="return validarFormulario()"
            enctype="multipart/form-data">
            {!! csrf_field() !!}

            <label class="block text-sm font-bold mb-2">Producto:</label>
            <select name="producto_id" id="producto_id" class="select-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" required>
                @foreach ($productos as $prod)
                    @if ($prod->activo == '1')
                        <option value="{{ $prod->id }}">{{ $prod->nombre }}</option>
                    @endif
                @endforeach
            </select>
            <label class="block text-sm font-bold mb-2">Proveedor:</label>
            <select name="proveedor_id" id="proveedor_id" class="select-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" required onchange="calcularValores()">
                @foreach ($proveedores as $prov)
                    <option value="{{ $prov->id }}" data-nacionalidad="{{ $prov->nacionalidad }}">
                        {{ $prov->nombre }} @if ($prov->nacionalidad == 1)
                            (Con IVA)
                        @else
                            (Exento de IVA)
                        @endif
                    </option>
                @endforeach
            </select>
            <label class="block text-sm font-bold mb-2">Fecha:</label>
            <input type="date" id="fecha" name="fecha" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" required>

            <label class="block text-sm font-bold mb-2">Marca</label>
            <input type="text" id="marca" name="marca" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" required>
            <label class="block text-sm font-bold mb-2">Modelo</label>
            <input type="text" id="modelo" name="modelo" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" required>
            <label class="block text-sm font-bold mb-2">Cantidad</label>
            <input type="number" id="cantidad" name="cantidad" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" required
                oninput="calcularValores();">
            <label class="block text-sm font-bold mb-2">Estado:</label>
            <select name="estado" id="estado" class="select-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400">
                <option value="pendiente">Pendiente</option>
                <option value="disponible" selected>Disponible</option>
            </select>

            <label class="block text-sm font-bold mb-2">Valor Unitario:</label>
            <input type="string" id="valor_unitario_neto" name="valor_unidad_neto" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400"
                oninput="calcularValores(); this.value = this.value.replace(/[^0-9]/g, '');" required>
            <input type="hidden" id="valor_unidad_bruto" name="valor_unidad_bruto" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" required
                readonly>
            <input type="hidden" id="valor_total_neto" name="valor_total_neto" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" required readonly>
            <label for="">Sub Total</label>
            <input type="text" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" id="sub-total" readonly>
            <label class="block text-sm font-bold mb-2">Descuento:</label>
            <input type="number" id="descuento" name="descuento" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" oninput="calcularValores();"
                step="0.01">
            <label for="">Sub Total 2</label>
            <input type="text" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" id="sub-total2" readonly>
            <label class="block text-sm font-bold mb-2">Gastos:</label>
            <div id="gastos-container" class="mb-3">
                <!-- Aquí se agregarán dinámicamente los campos de gastos -->
            </div>
            <button type="button" id="agregar-gasto" class="btn text-white bg-gray-400 hover:bg-gray-500 font-medium">Agregar Gasto</button>
            <button type="button" id="sumar-gastos" class="btn text-white bg-green-700 hover:bg-green-900 font-medium">Sumar Gastos</button>
            <br>
            <label class="block text-sm font-bold mb-2">Total</label>
            <input type="string" id="valor_total_bruto" name="valor_total_bruto" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" required
                readonly>

            <label class="block text-sm font-bold mb-2">Orden de compra:</label>
            <input type="file" name="orden_compra" id="orden_compra" accept=".jpg, .png, .pdf" max-size="2000000"
                class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400">
            <p>Acepta formato jpg, png y pdf, máximo 2MB</p>
            <label class="block text-sm font-bold mb-2">Factura:</label>
            <input type="file" name="factura" id="factura" accept=".jpg, .png, .pdf" max-size="2000000"
                class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400">
            <p>Acepta formato jpg, png y pdf, máximo 2MB</p>
            <label class="block text-sm font-bold mb-2">Guía de despacho:</label>
            <input type="file" name="guia_despacho" id="guia_despacho" accept=".jpg, .png, .pdf"
                max-size="2000000" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400">
            <p>Acepta formato jpg, png y pdf, máximo 2MB</p>

            {{-- <label class="block text-sm font-bold mb-2">Descripción de Gastos:</label> --}}
            <textarea id="lista-gastos" name="lista_gastos" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-2 placeholder:text-slate-400/70 hover:border-slate-400" rows="4" readonly hidden></textarea>
            <script>
                // Función para agregar campos de gastos dinámicamente
                var numGastos = 0;
                document.getElementById("agregar-gasto").addEventListener("click", function() {
                    // Verificar si se ha alcanzado el límite de 5 gastos
                    if (numGastos >= 5) {
                        alert("Se ha alcanzado el límite de 5 gastos.");
                        return;
                    }

                    var gastosContainer = document.getElementById("gastos-container");

                    var gastoField = document.createElement("div");
                    gastoField.className = "gasto-field";

                    var gastoDescripcion = document.createElement("input");
                    gastoDescripcion.type = "text";
                    gastoDescripcion.name = "gasto_descripcion[]";
                    gastoDescripcion.placeholder = "Descripción";
                    gastoDescripcion.className = "form-control gasto-descripcion";
                    gastoField.appendChild(gastoDescripcion);

                    var gastoMonto = document.createElement("input");
                    gastoMonto.type = "number";
                    gastoMonto.name = "gasto_monto[]";
                    gastoMonto.placeholder = "Monto";
                    gastoMonto.className = "form-control gasto-monto";
                    gastoMonto.min = 0;
                    gastoField.appendChild(gastoMonto);

                    gastosContainer.appendChild(gastoField);

                    // Actualiza el textarea con la descripción y monto del nuevo gasto cuando haya valores
                    gastoDescripcion.addEventListener("input", function() {
                        actualizarListaDeGastos();
                    });

                    gastoMonto.addEventListener("input", function() {
                        // Validar el valor ingresado y eliminar caracteres no numéricos
                        gastoMonto.value = validarNumeros(gastoMonto.value);
                        actualizarListaDeGastos();
                    });

                    // Incrementa el contador de gastos
                    numGastos++;

                    // Desactiva el botón "Agregar Gasto" si se alcanza el límite
                    if (numGastos >= 5) {
                        document.getElementById("agregar-gasto").disabled = true;
                    }
                });

                function validarNumeros(inputValue) {
                    // Reemplazar cualquier caracter no numérico por una cadena vacía
                    return inputValue.replace(/\D/g, '');
                }

                // Función para actualizar la lista de gastos en el textarea
                function actualizarListaDeGastos() {
                    var listaGastosTextarea = document.getElementById("lista-gastos");
                    var gastos = [];

                    // Agregar el título "Descuentos" y el descuento al principio de la lista
                    var descuento = parseFloat(document.getElementById("descuento").value) || 0;
                    if (descuento > 0) {
                        gastos.push("Descuentos:");
                        gastos.push("Descuento aplicado: $" + descuento.toFixed(2));
                    }

                    // Agregar el título "Gastos"
                    gastos.push("Gastos:");

                    // Recorre todos los campos de descripción y monto para recopilar la información
                    var gastoDescripcionInputs = document.getElementsByName("gasto_descripcion[]");
                    var gastoMontoInputs = document.getElementsByName("gasto_monto[]");

                    for (var i = 0; i < gastoDescripcionInputs.length; i++) {
                        var descripcion = gastoDescripcionInputs[i].value.trim();
                        var monto = gastoMontoInputs[i].value.trim();
                        if (descripcion && monto) {
                            gastos.push(descripcion + ": $" + monto);
                        }
                    }

                    // Actualiza el textarea con la lista de gastos
                    listaGastosTextarea.value = gastos.join("\n");
                }
                // Función para calcular el valor total de los gastos
                function calcularTotalGastos() {
                    var gastoMontoInputs = document.getElementsByName("gasto_monto[]");
                    var totalGastos = 0;

                    for (var i = 0; i < gastoMontoInputs.length; i++) {
                        totalGastos += parseFloat(gastoMontoInputs[i].value) || 0;
                    }

                    return totalGastos;
                }
                document.getElementById("sumar-gastos").addEventListener("click", function() {
                    var totalGastos = calcularTotalGastos();
                    calcularValores(totalGastos);
                });

                function calcularValores(totalGastos) {
                    var valorUnitarioNeto = parseFloat(document.getElementById("valor_unitario_neto").value) || 0;
                    var valorUnitarioBruto = parseFloat(valorUnitarioNeto) + (parseFloat(valorUnitarioNeto) * 0.19);
                    var cantidad = parseFloat(document.getElementById("cantidad").value) || 0;
                    var descuento = parseFloat(document.getElementById("descuento").value) || 0;

                    var subtotalNeto = (valorUnitarioNeto * cantidad) - descuento;
                    var gastoDescripcionInputs = document.getElementsByName("gasto_descripcion[]");
                    var gastoMontoInputs = document.getElementsByName("gasto_monto[]");

                    document.getElementById("valor_unidad_bruto").value = valorUnitarioBruto.toFixed(2);

                    var proveedorSelect = document.getElementById("proveedor_id");
                    var nacionalidad = proveedorSelect.options[proveedorSelect.selectedIndex].getAttribute("data-nacionalidad");
                    var valorUnitarioNeto = parseFloat(document.getElementById("valor_unitario_neto").value) || 0;

                    var valorUnitarioBruto = 0;
                    if (nacionalidad == 1) {
                        // Nacionalidad 1: valor_unitario_bruto = valor_unitario_neto + iva
                        valorUnitarioBruto = valorUnitarioNeto + (valorUnitarioNeto * 0.19);
                    } else if (nacionalidad == 2) {
                        // Nacionalidad 2: valor_unitario_bruto = valor_unitario_neto
                        valorUnitarioBruto = valorUnitarioNeto;
                    } else if (nacionalidad == 3) {
                        // Nacionalidad 2: valor_unitario_bruto = valor_unitario_neto
                        valorUnitarioBruto = 0;
                    }

                    // Calcular la suma de los gastos
                    var totalGastos = calcularTotalGastos();

                    // Calcular el subtotal con IVA, incluyendo gastos
                    var subtotalBruto = (valorUnitarioBruto * cantidad) - descuento + totalGastos;

                    var subsub = valorUnitarioBruto * cantidad;
                    var subsub2 = (valorUnitarioBruto * cantidad) - descuento;
                    document.getElementById("valor_total_neto").value = subtotalNeto.toFixed(2);
                    document.getElementById("valor_total_bruto").value = subtotalBruto.toFixed(2);
                    document.getElementById("valor_unidad_bruto").value = valorUnitarioBruto.toFixed(2);
                    document.getElementById("sub-total").value = subsub.toFixed(2);
                    document.getElementById("sub-total2").value = subsub2.toFixed(2);
                }
            </script>
            <div class="flex justify-center">
                <a href="{{ url('stock') }}"
                    class="text-white bg-gray-400 hover:bg-gray-500 focus:ring-4 focus:outline-none font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center mr-2">Volver</a>
                <input type="submit" value="Guardar" id="submitButton"
                    class="text-white bg-green-700 hover:bg-green-900 disabled:bg-gray-600 focus:ring-4 focus:outline-none font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center">
            </div>
        </form>

    </div>
</body>

</html>
