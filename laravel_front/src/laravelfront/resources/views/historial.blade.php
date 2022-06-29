<table id="historial-table">
    <thead>
        <tr>
            <th>Ingrediente comprado</th>
            <th>Cantidad</th>
            <th>Fecha de solicitud</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($historial as $historic)
            <tr>
                <td>
                    {{ $historic['ingrediente'] }}
                </td>
                <td>
                    {{ $historic['cantidad_vendida'] }}
                </td>
                <td>
                    {{ date('d/m/Y H:i:s', strtotime($historic['created_at'])) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready( function () {
        $('#historial-table').DataTable();
    } );
</script>