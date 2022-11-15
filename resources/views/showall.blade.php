<html>
<head>
@include('including.allscriptlinks')
@include('including.bootstraptable')
@include('including.stylessidenav')
@include('including.nav')

</head>
<body>
    @if(session()->has('messagedel'))
    echo "<script>window.alert('Product Removed Sucessfully')</script>";
@endif
@if(session()->has('messageupt'))
echo "<script>window.alert('Product Updated Sucessfully')</script>";
@endif


<div class="main" >
<br>
    <h1>Our Customers</h1>
    <br><br>
    <div class="container">
        <div class="row">
        <table id="example">
              <thead>
                  <tr>
                      <th>Profile </th>
                      <th>Full Name</th>
                      <th>Gender</th>
                      <th>State</th>
                      <th>Email</th>
                      <th>Phonenumber</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($allcustomers as $cust)
                  <tr>
                    <td align="center"><img alt="" src="uploads/{{$cust->profilepic}}" style="height:40px;width:40px;"></td>
                    <td>{{$cust->first_name}} {{$cust->last_name}}</td>
                    <td>{{$cust->gender}}</td>
                    <td>{{$cust->states}}</td>
                    <td>{{$cust->email}}</td>
                    <td>{{$cust->number}}</td>
                  </tr>
                  @endforeach

                </tbody>

          </table>
        </div>
      </div>

{{-- end of container --}}
</div>
{{-- end of main --}}
</body>
<script>
    $(document).ready(function(){
      // DataTable
      $('#example').dataTable({"pageLength": 2});

    });
</script>

</html>

