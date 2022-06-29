<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/pedidos.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .col {
        border-style: solid;
        border-width: 1px;
        border-color: aquamarine;
    }
</style>
<body>
    <div class="container">
        <h1>Comedor benefico</h1>
        <div class="row">
            <div class="col-md-8">
                <label for="cantidad" class="col-sm-2 col-form-label col-form-label-sm">Cantidad de platos a pedir</label>
                <input type="number" class="form-control" id="cantidad" placeholder="Cantidad de platos" value=1>
                <br>
                <button class="btn btn-primary" id="pedir">Hacer pedido</button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <h2>Cola de pedidos</h2>
                <div id="cola-pedidos">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2>Bodega de alimentos</h2>
                <div id="ingredients">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2>Historial de compras</h2>
                <div id="historial-compras">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2>Historico de pedidos</h2>
                <div id="historico-pedidos">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2>Recetas</h2>
                <div id="recetas">

                </div>
            </div>
        </div>
    </div>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
      <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="..." class="rounded me-2" alt="...">
          <strong class="me-auto">Bootstrap</strong>
          <small>11 mins ago</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          Hello, world! This is a toast message.
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</body>
<script>
    sessionStorage.setItem("baseUrl", "{{$app->make('url')->to('/');}}");
</script>
</html>