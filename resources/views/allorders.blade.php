<html>
<head>
@include('including.allscriptlinks')
@include('including.bootstraptable')
@include('including.stylessidenav')
@include('including.nav')
<!-- Datatable CSS -->
<link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Datatable JS -->
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
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
    <h1>All Customer Orders</h1>
    <br><br>
    <div class="container">
        <div class="row">
            @php $userid=0; @endphp
            @php $totalamt=0; @endphp
            @foreach ($listallcustomersorders as $key=>$listss)
            @if($userid!=0 && $listss->uid!=$userid)
            <tr>
                <td align="right" colspan="4">Total Amt: Rs <span style="color: green"><strong>{{$totalamt}}/-</strong></span></td>
            </tr>
                </tbody>
            </table>
            @php
                $totalamt=0;
            @endphp
            @endif

                @if($listss->uid!=$userid)
                   <table  class="table table-striped table-bordered" style="width:100%">
                   <thead>
                    <tr>
                        <td colspan="4">
                            <h4>Customer Name: {{$listss->first_name}} {{$listss->last_name}}</h4>
                        </td>
                    </tr>
                       <tr>
                           <th>Product Image </th>
                           <th>Product Name</th>
                           <th>Product Quantity</th>
                           <th>Product Total Cost</th>
                       </tr>
                   </thead>
                   <tbody>

                @endif
                    <tr>

                        <td align='center'><img alt='' src='productimages/{{$listss->productimage}}' style='height:40px;width:40px;'>
                        </td>
                        <td>{{$listss->productname}}</td>
                        <td>{{$listss->totalq}}</td>
                        <td>{{$listss->totalp}}</td>
                        @php
                        $totalamt= $totalamt + $listss->totalp;
                        @endphp
                    </tr>

                    @php $userid = $listss->uid @endphp
                    @if(($listallcustomersorders->count()-1) == $key)
            <tr>
                <td align="right" colspan="4">Total Amt: Rs <span style="color: green"><strong>{{$totalamt}}/-</strong></span></td>
            </tr>
                </tbody>
            </table>
            @endif
            @endforeach
        </div>
      </div>

{{-- end of container --}}
</div>
{{-- end of main --}}
</body>
{{-- <script type="text/javascript">
$(document).ready(function(){
    $('#loadtables').DataTable({
        processing:true,
        severSide:true,
        ajax:"{{route('getdata')}}",
        columns:[
            {data:oid},
            {data:name},
            {data:productquantity},
            {data:productprice},
            {data:}
        ]
    });

});
</script> --}}
</html>
