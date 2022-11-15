<html>
<head>
@include('including.allscriptlinks')
@include('including.nav')
@include('including.stylessidenav')
</head>
<body>
<div class="main">
  <h2>Edit Form</h2>
  <form  method="POST" action="/update/{{$crudid}}" enctype="multipart/form-data">
    @csrf
    <br>
            Enter First Name:
            <input type="text" value="{{$crud->first_name}}" class="form-control" name="first_name" placeholder="Enter your first name"></td>
            Enter Last Name
            <input type="text"  class="form-control" value="{{$crud->last_name}}" name="last_name">
        </tr>
        <tr style="font-size:25px;">
            Enter Phone Number
        <input type="number"  class="form-control" name="number" value="{{$crud->number}}">

            Select Gender<br>
            <input type="radio" name="gender" value="Male"{{$crud->gender =='Male' ? 'checked':''}} required><span style="font-size:25px;">Male</span>
            <input type="radio" name="gender" value="Female"{{$crud->gender =='Female' ? 'checked':''}} required><span style="font-size:25px;">Female</span><br>
            Enter Email
           <input type="email" class="form-control" name="email" value="{{$crud->email}}">
        </tr>
      Select State
          <select name="states" class="form-control">
                <option value="Gujarat"{{$crud->states =='Gujarat' ? 'selected':''}}>Gujarat</option>
                <option value="Maharashtra"{{$crud->states =='Maharashtra' ? 'selected':''}}>Maharashtra</option>
                <option value="Punjab"{{$crud->states =='Punjab' ? 'selected':''}}>Punjab</option>
          </select>
       Upload Photo<br>
            <input type="file" value="{{$crud->profilepic}}"  name="profilepic">{{$crud->profilepic}}<br>
        Choose your Education Qualification<br>
            @foreach ($listall as $list)
            @php $checkedqualify=array_column($checkedone,'qid'); @endphp
            @php $checked=(in_array($list->qid,$checkedqualify)) ? 'checked="checked"':''; @endphp
                <input type="checkbox" name="qualification[]" value="{{$list->qid}}" {{$checked}}/>{{$list->qname}}
            @endforeach
            <br>
            <div align="center">
                <input type="submit" class="btn btn-warning" style="width:100px;height:40px;" name="Submit" >
                <input type="reset" class="btn btn-warning" style="width:100px;height:40px;" name="Clear">
            </div>
</form>
</div>

</body>
</html>



