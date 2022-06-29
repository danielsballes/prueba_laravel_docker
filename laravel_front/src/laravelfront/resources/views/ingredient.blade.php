<table id="ingredient-table">
    <thead>
        <tr>
            <th>Ingrediente</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stock as $name => $qt)
            <tr>
                <td>
                    {{ $name }}
                </td>
                <td>
                    {{ $qt }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready( function () {
        $('#ingredient-table').DataTable();
    } );
</script>