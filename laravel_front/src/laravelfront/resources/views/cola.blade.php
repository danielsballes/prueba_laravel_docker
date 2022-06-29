<table id="cola-table">
    <thead>
        <tr>
            <th>Receta</th>
            <th>Ingredientes</th>
            <th>Fecha de solicitud</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($colas as $cola)
            <tr>
                <td>
                    {{ $cola['receta'] }}
                </td>
                <td>
                    {{ $cola['ingredientes'] }}
                </td>
                <td>
                    {{ date('d/m/Y H:i:s', strtotime($cola['created_at'])) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready( function () {
        $('#cola-table').DataTable();
    } );
</script>