
<div class="row">
<form action="/update_data/{{$single_data->id}}" method="post" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}">
Name : <input type="text" name="name" value="{{$single_data->name}}"><br/><br/>
Email : <input type="email" name="email" value="{{$single_data->email}}"><br/><br/>
Mobile : <input type="number" name="mobile" value="{{$single_data->mobile}}"><br/><br/>
{{--Password : <input type="password" name="password" value="{{$single_data->password}}"><br/><br/>--}}


Gender: <input type="radio" name="gender" value="Male" {{$single_data->gender=='Male'?'checked':''}}>Male
<input type="radio" name="gender" value="Female" {{$single_data->gender=='Female'?'checked':''}}>Female<br/><br/>


Hobby: <input type="checkbox" value="cooking" name="hobby[]" {{ str_contains($single_data->hobby, 'cooking') 

 ? 'checked' : '' }}>Cooking
 <input type="checkbox" value="dancing" name="hobby[]" {{ str_contains($single_data->hobby, 'dancing') 

 ? 'checked' : '' }}>Dancing
<input type="checkbox" value="singing" name="hobby[]" {{ str_contains($single_data->hobby, 'singing') 

 ? 'checked' : '' }}>Singing<br/><br/>
 
    File : <input type="file" name="profile"><br/><br/>
    <input type="hidden" name="old_img" value="{{$single_data->profile}}">

Company:<select name="company">
        <option value="0">Select</option>
        @foreach($company_data as $company)
        <option value="{{$company->id}}" {{$single_data->company_id==$company->id?'selected':''}}>{{$company->name}}</option>
        @endforeach
</select><br><br>

City : <select name="city">
<option value=""></option>
<option value="GKP" {{$single_data->city=='GKP'?'selected':''}}>GKP</option>
<option value="Lucknow" {{$single_data->city=='Lucknow'?'selected':''}}>Lucknow</option>
<option value="Mau" {{$single_data->city=='Mau'?'selected':''}}>Mau</option>
<option value="Kanpur" {{$single_data->city=='Kanpur'?'selected':''}}>Kanpur</option>
</select><br><br>
Address: <textarea name="address">{{$single_data->address}}</textarea><br><br>
<button>Submit</button>

	
</form>
</div>
					