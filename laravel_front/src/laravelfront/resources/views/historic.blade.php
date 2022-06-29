<table id="historico-table">
    <thead>
        <tr>
            <th>Receta</th>
            <th>Ingredientes</th>
            <th>Fecha de solicitud</th>
            <th>Fecha de ultima actualización</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($historics as $historic)
            <tr>
                <td>
                    {{ $historic['receta'] }}
                </td>
                <td>
                    {{ $historic['ingredientes'] }}
                </td>
                <td>
                    {{ date('d/m/Y H:i:s', strtotime($historic['created_at'])) }}
                </td>
                <td>
                    {{ date('d/m/Y H:i:s', strtotime($historic['updated_at'])) }}
                </td>
                <td>
                    {{ ($historic['activo'] == 1) ? 'Pendiente de preparar' : 'Preparado' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready( function () {
        $('#historico-table').DataTable();
    } );
</script>