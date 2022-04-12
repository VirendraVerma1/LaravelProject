<form action="/save_data" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}">
Name : <input type="text" name="name"><br/><br/>
Email : <input type="email" name="email"><br/><br/>
Mobile : <input type="number" name="mobile"><br/><br/>
Password : <input type="password" name="password"><br/><br/>
<button>Submit</button>

	
</form>