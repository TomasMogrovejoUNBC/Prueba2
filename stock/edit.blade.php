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
    <x-menu :id="$stock->id" />
    <div class="block max-w-xl p-6 bg-white border border-gray-500 rounded-lg shadow mx-auto mt-28">
        <h2 class="text-2xl font-bold text-center">Ingreso de Stock</h2>
        <form action="{{ url('stock/' . $stock->id) }}" method="post" id="orden_trabajo_form" onsubmit="return validarFormulario()"
            enctype="multipart/form-data">
            {!! csrf_field() !!}
                @method('PATCH')
                <input type="hidden" name="id" value="{{ $stock->id }}">
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
                <div class="flex justify-center">
                    <a href="{{ url('productos/'. $stock->producto_id. '/stock') }}"
                        class="text-white bg-gray-400 hover:bg-gray-500 focus:ring-4 focus:outline-none font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center mr-2">Volver</a>
                    <input type="submit" value="Guardar" id="submitButton"
                        class="text-white bg-green-700 hover:bg-green-900 disabled:bg-gray-600 focus:ring-4 focus:outline-none font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center">
                </div>
            </form>
    </div>
</body>
</html>