<html>
<head>
@include('including.allscriptlinks')
@include('including.bootstraptable')
@include('including.stylessidenav')
@include('including.nav')
<style>
.generate
{
    border-radius:7px;
    color:white;
    font-size: 20px;
    background-color: red;
    height: 40px;
}
</style>
</head>
<body>

<div class="main" >
<br>
    <h1>My Orders</h1>
    <br><br>
  @if($listallorders->count() > 0)

    <div class="container">
        <div class="row">
            <div style="padding-left:980px;"><a href="{{route('downloadpdf',['pdfid'=>$pdfid])}}"><input class="generate" type="button" value="Generate PDF"></a><br><br></div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      <th>Product Image </th>
                      <th>Product Name</th>
                      <th>Product Quantity</th>
                      <th>Product Total Cost</th>
                  </tr>
              </thead>
              <tbody>
                @php
                    $totalamt=0;
                @endphp

                @foreach ($listallorders as $listss)
                  <tr>
                    <td align="center"><img src="productimages/{{$listss->productimage}}" alt="" style="height:40px;width:40px;"></td>
                    <td>{{$listss->productname}}</td>
                    <td>{{$listss->totalq}}</td>
                    <td>Rs.{{$listss->totalp}}</td>
                    @php
                    $totalamt= $totalamt + $listss->totalp;
                @endphp
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="4" style="padding-left: 800px;">
                        <strong>Total Amt: <span style="color:green">Rs.{{$totalamt}}/-</span></strong>
                  <input  class='btn btn-warning'  type='button' value='Proceed to Checkout'/>
                    </td>
              </tbody>
          </table>

          <table>
            <tr>
          <form method="POST" action="upload" id="fileupload" enctype="multipart/form-data">
            @csrf
            The file total rows is: <span id="getcsvrowvalue"></span>
            <td>Upload csv file:(for batch)<input type="file" id="inputFile" name="inputFile" required><span class="text-danger" id="fileinputerror"></span></td>
            <td><button type="submit">Submit</button></td>
            <td><progress style="height:40px;width:200px;" id="progressinupload" value="0" max="100"></progress><br>Total Progress: <span id="putpercent">0</span>%</td>
          </form>
            </tr>
            <tr>
            </tr>
        </table>

        <form method="POST" action="softdelete">
            @csrf
            <input type="submit" value="Soft Delete">
        </form>
        </div>


    @else
     <div>No Orders</div>
    @endif
</div>

{{-- end of container --}}
</div>

{{-- end of main --}}
</body>
<script type="text/javascript">
$('#fileupload').submit(function(e) {
        e.preventDefault();
        let formdata=new FormData(this);
        $('#fileinputerror').text('');
        $.ajax(
                {
                  url:"/upload",
                  type:'POST',
                  data: formdata,
                  contentType:false,
                  processData:false,
                  success:function(data){

                    if(data.status==1){
                      alert("CSV uploaded");
                      $('#getcsvrowvalue').text(data.csvrowscount);
                    }else{
                        alert("No Response");
                    }
                  },
                  error: function(data)
                  {
                   // $('#fileinputerror').text(response.responseJSON.message);
                  }
                });

});


function fetchdata(){
var counter=$("#getcsvrowvalue").text();
 $.ajax({
    data:{
        "_token": "{{csrf_token()}}",
        counts:counter
},
    url: 'fetchdata',
    type: 'GET',
  success: function(response)
  {
   // alert(response.total);
   $( "#progressinupload" ).val(response.total);
   $("#putpercent").text(Math.floor(response.total));
  }
 });
}

$(document).ready(function(){
 setInterval(fetchdata,1000);
});
    </script>
</html>
