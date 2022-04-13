@extends('layouts.main')

@section('contentt')


@if(session('success'))
	{{session('success')}}
@endif

@if(session('last_user'))
	{{session('last_user')}}
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
	<div class="container mt-3">

		<!-- Button to Open the Modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
			Add
		</button>
		<br/><br/>


		<table >
			<tr>
				<th>SR</th>
				<th>Name</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Gender</th>
				<th>Hobby</th>
				<th>Company</th>
				<th>Profile</th>
				<th>City</th>
				<th>Address</th>
				<th>Action</th>

			</tr>
			@php
			$c=1;
			@endphp
			@foreach($data as $value)
			<tr>
				<td>{{$c++}}</td>
				<td>{{$value->name}}</td>
				<td>{{$value->email}}</td>
				<td>{{$value->mobile}}</td>
				<td>{{$value->gender}}</td>
				<td>{{$value->hobby}}</td>
				<td>{{$value->companyname}}</td>
				<td><img src="{{asset('upload/'.$value->profile)}}" height="50" width="50" /></td>
				<td>{{$value->city}}</td>
				<td>{{$value->address}}</td>
				<td>
					<a  type="button" class="btn btn-primary" id="myBtn" onclick="edit_data('{{$value->id}}')">Edit</a>
					<a  type="button" class="btn btn-primary" id="myBtn" onclick="testAjax({{$value->id}})">Ajax</a>
					<a href="/delete_data/{{$value->id}}" onclick="return confirm('Are you sure you want to delete this ?')">Delete</a>
					
				</td>
			</tr>

			@endforeach

		</table> 
		{{ $data->links() }}
		<!-- The Modal -->
		<div class="modal fade" id="myModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Modal Heading</h4>
						<button type="button" class="close" data-dismiss="modal">×</button>
					</div>
					
					<!-- Modal body -->
					<div class="modal-body">
						<form action="/save_data" method="post" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							Name : <input type="text" name="name"><br/><br/>
							Email : <input type="email" name="email"><br/><br/>
							Mobile : <input type="number" name="mobile"><br/><br/>
							Password : <input type="password" name="password"><br/><br/>
							Gender: <input type="radio" name="gender" value="Male">Male
							<input type="radio" name="gender" value="Female">Female<br/><br/>
							Hobby: <input type="checkbox" value="cooking" name="hobby[]">Cooking
							<input type="checkbox" value="dancing" name="hobby[]">Dancing
							<input type="checkbox" value="singing" name="hobby[]">Singing <br/><br/>

							File : <input type="file" name="profile"><br/><br/>

							Company : <select name="companyname">
								
									<option value=""></option>
									@foreach($company_data as $com)
									<option value="{{$com->id}}">{{$com->name}}</option>
									@endforeach
							
							</select><br><br>

							City : <select name="city">
										<option value="">select</option>
										<option value="GKP">GKP</option>
										<option value="Lucknow">Lucknow</option>
										<option value="Mau">Mau</option>
										<option value="Kanpur">Kanpur</option>
							</select><br><br>
							Address: <textarea name="address"></textarea><br><br>
							<button>Submit</button>
						</form>
					</div>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>



	<div id="editformTest">

	</div>

	</div>
</body>

<!-- The Modal -->
  <div class="modal fade" id="myModal2">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="editdiv">
           
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

<script type="text/javascript">

	
	function edit_data(id)
	{

		$.ajax({
		
			type   : "GET",
			url    : "edit_data/"+id,
			success: function(response){  
				
				$("#myModal2").modal('show');
				$("#editdiv").html(response);

			}
		});
	}

$(document).ready(function(){

//   $("#myBtn").click(function(){
//     $("#myModal").modal();
//   });
});



function testAjax(id_test)
{
  $.ajax({
      url: "{{route('testFunction')}}",
      type: 'POST',
      data: {
        key_id:id_test,
        _token:'{{ csrf_token() }}'
      },
         success: function(response){
          console.log(response);
        //   alert(response);
		  $("#editformTest").html(response);
        //   customLoadAndShowMSG("success",response);
      }
  });
}
</script>




@endsection


