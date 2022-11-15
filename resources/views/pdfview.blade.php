<html>
<head>
{{-- @include('including.allscriptlinks')
@include('including.bootstraptable') --}}

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
    <div class="container">
        <div class="row">

        <table id="example" border="1" style="width:100%">
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

               @foreach ($show as $listss)
                  <tr>
                     <td align="center"><img src="productimages/{{$listss->productimage}}" alt="" style="height:40px;width:40px;"></td>
                    <td>{{$listss->productname}}</td>
                    <td>{{$listss->totalq}}</td>
                    <td>Rs.{{$listss->totalp}}</td>
                    @php
                        $totalamt=$totalamt + $listss->totalp
                    @endphp
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="4" style="padding-left:540px;">
                        <strong>Total Amt: <span style="color:green">Rs.{{$totalamt}}/-</span></strong>
                    </td>
                  </tr>
              </tbody>
          </table>
        </div>
      </div>


{{-- end of container --}}
</div>
{{-- end of main --}}
</body>
</html>
