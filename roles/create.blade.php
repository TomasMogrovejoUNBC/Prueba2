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
        <h2 class="text-2xl font-bold text-center">Creación de Rol</h2>
        <form action="{{ url('roles') }}" method="post" id="orden_trabajo_form" onsubmit="return validarFormulario()">
            @csrf
            <label class="block text-sm font-bold mb-2">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                class="form-input w-full rounded-full border border-slate-300 bg-transparent px-4 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary" required><br>
            <label class="block text-sm font-bold mb-2">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion') }}"
                class="form-input w-full rounded-full border border-slate-300 bg-transparent px-4 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary" required><br>

            <label class="block text-sm font-bold mb-2">Accesos:</label>
            <div class="text-left">
                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="usuarios" id="usuarios" value="1" class="sr-only peer"
                            @if (old('usuarios') == true) checked @endif onchange="verificarCheckboxes()">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Usuarios</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="roles" id="roles" value="1" class="sr-only peer"
                            @if (old('roles') == true) checked @endif onchange="verificarCheckboxes()">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Roles</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="maquinarias" id="maquinarias" value="1" class="sr-only peer"
                            @if (old('maquinarias') == true) checked @endif onchange="verificarCheckboxes()">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Maquinarias</span>
                    </label>
                </div>
                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="departamentos" id="departamentos" value="1" class="sr-only peer"
                            @if (old('departamentos') == true) checked @endif onchange="verificarCheckboxes()">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Departamentos</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="proveedores" id="proveedores" value="1" class="sr-only peer"
                            @if (old('proveedores') == true) checked @endif onchange="verificarCheckboxes()">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">proveedores</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="productos" id="productos" value="1" class="sr-only peer"
                            @if (old('productos') == true) checked @endif onchange="verificarCheckboxes()">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">productos</span>
                    </label>
                </div>
                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="stock" id="stock" value="1" class="sr-only peer"
                            @if (old('stock') == true) checked @endif onchange="verificarCheckboxes(); Gestiones()">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">stock</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="ingreso_stock" id="ingreso_stock" value="1" class="sr-only peer"
                            @if (old('ingreso_stock') == true) checked @endif onchange="verificarCheckboxes(); verStock()">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">ingreso_stock</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="retiro_stock" id="retiro_stock" value="1" class="sr-only peer"
                            @if (old('retiro_stock') == true) checked @endif onchange="verificarCheckboxes(); verStock()">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">retiro_stock</span>
                    </label>
                </div>
                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="analizar_stock" id="analizar_stock" value="1" class="sr-only peer"
                            @if (old('analizar_stock') == true) checked @endif onchange="verificarCheckboxes(); verStock()">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">analizar_stock</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="reporteria" id="reporteria" value="1" class="sr-only peer"
                            @if (old('reporteria') == true) checked @endif onchange="verificarCheckboxes()">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">reporteria</span>
                    </label>
                </div>
            </div>
            <br>
            <div class="flex justify-center">
                <a href="{{ url('roles') }}"
                    class="text-white bg-gray-400 hover:bg-gray-500 focus:ring-4 focus:outline-none font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center mr-2">Volver</a>
                <input type="submit" value="Guardar" id="submitButton"
                    class="text-white bg-green-700 hover:bg-green-900 disabled:bg-gray-600 focus:ring-4 focus:outline-none font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center">
            </div>
        </form>
    </div>
    <script>
        // Función para verificar si al menos un checkbox está seleccionado
        function verificarCheckboxes() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var guardarButton = document.getElementById('submitButton');
        
            var alMenosUnCheckboxSeleccionado = false;
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    alMenosUnCheckboxSeleccionado = true;
                    break; // Sale del bucle si se encuentra al menos un checkbox seleccionado
                }
            }
        
            guardarButton.disabled = !alMenosUnCheckboxSeleccionado; // Deshabilita el botón si ningún checkbox está seleccionado, de lo contrario, lo habilita
        }
        
        // Agrega el evento "change" a todos los checkboxes
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', verificarCheckboxes);
        });
        function verStock() {
            var ver = document.getElementById('stock');
            var retirar = document.getElementById('retiro_stock');
            var ingresar = document.getElementById('ingreso_stock');
            var analizar = document.getElementById('analizar_stock');
            if (retirar.checked || ingresar.checked || analizar.checked) {
                ver.checked = true;
            }
        }
        function Gestiones() {
        var ver = document.getElementById('stock');
        var retirar = document.getElementById('retiro_stock');
        var ingresar = document.getElementById('ingreso_stock');
        var analizar = document.getElementById('analizar_stock');
        if (ver.checked) {
            // ver.checked = true;
        } else{
            retirar.checked = false;
            ingresar.checked = false;
            analizar.checked = false;
        }
    }
        // Llama a la función verificarCheckboxes para inicializar el estado del botón
        verificarCheckboxes();
    </script>
</body>
</html>