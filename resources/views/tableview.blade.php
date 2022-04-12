<table border="2">
	<tr>
		<th>Name</th>
		<th>Mobile</th>
	</tr>

	@foreach($data as $val)
	<tr>
		<td>{{$val->name}}</td>
		<td>{{$val->mobile}}</td>
	</tr>
	@endforeach
</table>