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
    <x-menu :id="$roles->id" />
    <div class="block max-w-xl p-6 bg-white border border-gray-500 rounded-lg shadow mx-auto mt-28">
        <h2 class="text-2xl font-bold text-center">Visualización de Rol</h2>
        <div>
            <input type="hidden" name="id" value="{{ $roles->id }}">
            <label class="block text-sm font-bold mb-2">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="{{ $roles->nombre }}" disabled
                class="form-input w-full rounded-full border border-slate-300 bg-transparent px-4 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary" required><br>
            <label class="block text-sm font-bold mb-2">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" value="{{ $roles->descripcion }}" disabled
                class="form-input w-full rounded-full border border-slate-300 bg-transparent px-4 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary" required><br>

            <label class="block text-sm font-bold mb-2">Accesos:</label>
            <div class="text-left">
                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="usuarios" value="0">
                        <input type="checkbox" name="usuarios" id="usuarios" value="1" class="sr-only peer" disabled 
                            @if ($roles->usuarios == true) checked @endif>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Usuarios</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="roles" value="0">
                        <input type="checkbox" name="roles" id="roles" value="1" class="sr-only peer" disabled 
                            @if ($roles->roles == true) checked @endif>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Roles</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="maquinarias" value="0">
                        <input type="checkbox" name="maquinarias" id="maquinarias" value="1" class="sr-only peer" disabled
                            @if ($roles->maquinarias == true) checked @endif>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Maquinarias</span>
                    </label>
                </div>
                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="departamentos" value="0">
                        <input type="checkbox" name="departamentos" id="departamentos" value="1" class="sr-only peer" disabled
                            @if ($roles->departamentos == true) checked @endif>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Departamentos</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="proveedores" value="0">
                        <input type="checkbox" name="proveedores" id="proveedores" value="1" class="sr-only peer" disabled
                            @if ($roles->proveedores == true) checked @endif>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">proveedores</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="productos" value="0">
                        <input type="checkbox" name="productos" id="productos" value="1" class="sr-only peer" disabled
                            @if ($roles->productos == true) checked @endif>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">productos</span>
                    </label>
                </div>
                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="stock" value="0">
                        <input type="checkbox" name="stock" id="stock" value="1" class="sr-only peer" disabled
                            @if ($roles->stock == true) checked @endif>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">stock</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="ingreso_stock" value="0">
                        <input type="checkbox" name="ingreso_stock" id="ingreso_stock" value="1" class="sr-only peer" disabled
                            @if ($roles->ingreso_stock == true) checked @endif>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">ingreso_stock</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="retiro_stock" value="0">
                        <input type="checkbox" name="retiro_stock" id="retiro_stock" value="1" class="sr-only peer" disabled
                            @if ($roles->retiro_stock == true) checked @endif>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">retiro_stock</span>
                    </label>
                </div>
                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="analizar_stock" value="0">
                        <input type="checkbox" name="analizar_stock" id="analizar_stock" value="1" class="sr-only peer" disabled
                            @if ($roles->analizar_stock == true) checked @endif>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">analizar_stock</span>
                    </label>
                    <br>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="reporteria" value="0">
                        <input type="checkbox" name="reporteria" id="reporteria" value="1" class="sr-only peer" disabled
                            @if ($roles->reporteria == true) checked @endif>
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
                    class="text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:outline-none font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center mr-2">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>