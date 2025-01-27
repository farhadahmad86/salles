@foreach($data as $row)
    <tr>
        <td>{{ $row->id}}</td>
        <td>{{ $row->post_title }}</td>
        <td>{{ $row->post_description }}</td>
    </tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $data->links() !!}
    </td>
</tr>
