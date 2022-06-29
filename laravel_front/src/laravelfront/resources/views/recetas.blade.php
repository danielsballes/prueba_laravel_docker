@foreach ($recetas as $receta)
    <ul class="list-group">
        <li class="list-group-item active">{{ $receta['nombre'] }}</li>
        @foreach (json_decode($receta['ingredientes'], true) as $nombre => $qt)
            <li class="list-group-item">{{ $nombre }} - {{ $qt }}</li>
        @endforeach
    </ul>
@endforeach