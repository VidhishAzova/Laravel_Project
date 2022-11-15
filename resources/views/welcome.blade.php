<html>
<head>

@include('including.allscriptlinks')
@include('including.stylessidenav')
@include('including.productmodel')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@include('including.nav')

</head>
<body>
@if(session()->has('messagedel'))
    echo "<script>window.alert('Product Removed Sucessfully')</script>";
@endif
@if(session()->has('messageupt'))
    echo "<script>window.alert('Product Updated Sucessfully')</script>";
@endif


<div class="main">
    <br>
        <table align="center"><tr>
        <td><input type="search"  style="height:40px;width:500px;border-radius:7px;" placeholder="Search for the product..."/></td><td>
        <button type="submit" style="height:42px;width:120px;border-radius:7px;"><i class="fa fa-search"></i> Search</button></td></tr></table><br><br>

    <div id="model-popup" >
        <form class="contact-form" action="" id="p_upid" method="post" enctype="multipart/form-data">
            @csrf
            Product Details<a href="#" class="cancel"><i style="padding-left:211px;font-size:24px" class="fa">&#xf00d;</i></a>
            <div>
                <table>
                    <tr><td><img alt="" id="p_img" style="height:100px;width:100px"></td><td><input type="file" name="productimage"></td></tr>
                </table>
                    Product Name:<input type="text" class="form-control" name="productname" id="p_name"/>
                    Product Category:
                    <select id="p_type" name="productcategory" class="form-control">
                        @foreach ($listcategory as $category)
                        echo "<option value='{{$category->pcid}}' >{{$category->productcategoryname}}</option>";

                        @endforeach
                    </select>
                    Product Quantity:<input type="number" name="productqauntity" class="form-control" id="p_quantity"/>
                    Product Price:<input type="number" name="productprice" class="form-control" id="p_price"/>
            <div style="padding-top:30px" align="center">
                <table>
                    <tr><td><input type="submit"  class="btn btn-warning" style="width:300px" name="send" value="Update"/></td></tr>
                    <tr><td><br><a href="" id="p_id"> <input style="width:300px" type="button" class="btn btn-warning" name="cancel" value="Delete" /></a></td></tr>
                </table>
            </div>
            </div>
        </form>
    </div>
    <div id="model-popups">
        <form class="contact-forms" action=""  method="post" enctype="multipart/form-data">
            @csrf
            Product Details<a href="#" class="cancel"><i style="padding-left:211px;font-size:24px" class="fa">&#xf00d;</i></a>
            <div><br>
               <div align="center"> <img alt="" id="pu_img" style="height:100px;width:100px"></div><br>
               <input type="hidden" id="pu_id">
                    Product Name:<span id="pu_name"></span><br>
                    Product Category:<span id="pu_type"></span><span id="pu_quantity"></span><br>
                    Select Quantity: <input type="number" min="1" value="1" id="consume_qty" style="height:30px;width:80px;"  required/>&nbsp;&nbsp;<span id="error" style="font-size: 15px;color:red">quantity high</span><br>
                    <table style="padding-top: px;"><tr><td style="font-size:30px;color:grey">Product Price:</td><td style="font-size:30px;color:grey"><span id="pu_price" ></span><span id="totalprice"></span></td></tr></table><br>
            <div style="padding-top:7px" align="right">
                <input id="adding" class="btn btn-warning" style="width:200px" name="send" value="Add to Cart" data-product_name='{$product->productname}'/>

            </div>
            </div>
        </form>
    </div>

  @foreach ($productss as $product)
  <table class="table" border="0">
        <tr><td colspan="5" style="width: 30%">
        <div style="text-align: center"><img alt="" src="productimages/{{$product->productimage}}" style="height:200px;width:200px;"/></div></td>
        <td><br><br><span style="font-family:sans-serif;font-size:22px;">Product Name: {{$product->productname}}<br>
        Product Type: {{$product->productcategoryname}}<br>
        Product Quantity:
        <span class="newproductquantity{{$product->pid}}">{{$product->productquantity}}</span>
        <br>

        Product Price: {{$product->productprice}}</span><br><br>
      @php

        if(session()->get('first_name')== 'Admin')
        {
            echo "<div align='right'> <a href='#model-popup' class='popupviewproducts' data-product_id='{$product->pid}' data-product_img='{$product->productimage}' data-product_name='{$product->productname}' data-product_type='{$product->productcategory}' data-product_quantity='{$product->productquantity}' data-product_price='{$product->productprice}'><input  class='btn btn-warning'  type='button' value='View/Update Product'/></a></div></td></tr></table>";
        }
        else
        {
            echo "<div align='right'><a href='#model-popups' class='popupaddtocartproducts' data-product_id='{$product->pid}' data-product_img='{$product->productimage}' data-product_name='{$product->productname}' data-product_type='{$product->productcategoryname}' data-product_quantity='{$product->productquantity}' data-product_price='{$product->productprice}'><button class='btn btn-warning'>
                <i class='fa fa-shopping-cart'></i> Add to Cart</i></button></a></div></td></tr></table>";
        }
        @endphp

 @endforeach

</div>
</body>
<script type="text/javascript">

    $(document).ready(function () {
        $("#model-popup").hide();
        $(".popupviewproducts").click(function () {
            console.log($(this));
           $('#p_upid').attr('action','updateproduct/'+($(this).attr('data-product_id')));
            $('#p_id').attr('href','deleteproduct/'+($(this).attr('data-product_id')));
            $('#p_img').attr('src','productimages/'+($(this).attr('data-product_img')));
            $('#p_name').val($(this).attr('data-product_name'));
            $('#p_type option[value="'+$(this).attr('data-product_type')+'"]').prop('selected',true);
            $('#p_quantity').val($(this).attr('data-product_quantity'));
            $('#p_price').val($(this).attr('data-product_price'));
           $("#model-popup").show();
        });
        $(".cancel").click(function () {
            $("#model-popup").hide();
           $("#model-popups").hide();
        });
    });
    </script>
    {{-- scrpit for user side --}}
    <script type="text/javascript">
        $(function () {
            $("#model-popups").hide();
            $("#error").hide();
            $(".popupaddtocartproducts").click(function () {
                //console.log($(this));
                $('#pu_id').val($(this).attr('data-product_id'));
                $('#pu_img').attr('src','productimages/'+($(this).attr('data-product_img')));
                $('#pu_name').text($(this).attr('data-product_name'));
                $('#pu_type').text($(this).attr('data-product_type'));
                $('#pu_quantity').val($(this).attr('data-product_quantity'));
                $('#pu_price').text($(this).attr('data-product_price'));
               $("#model-popups").show();
            });

// script for checking consume quantity
            $("#consume_qty").on("input",function()
            {
                if(parseInt($("#consume_qty").val()) > parseInt($("#pu_quantity").val()))
                {
                   $("#error").show();
                   $('#adding').prop('disabled', true);
                }
                else if(parseInt($("#consume_qty").val()) <= parseInt($("#pu_quantity").val()))
                {
                    $("#error").hide();
                    $('#adding').prop('disabled', false);
                }
//script for total price
                if(parseInt($("#consume_qty").val())>1)
                {
                    $("#pu_price").css("display","none");
                    $("#totalprice").css("display","block");
                   $("#totalprice").text(parseInt($('#pu_price').text()) * parseInt($("#consume_qty").val()));
               }
               else if(parseInt($("#consume_qty").val())== 1)
               {
                $("#totalprice").css("display","none");
                $("#pu_price").css("display","block");
               }
            });
             $("#adding").click(function()
             {
               var pid=$('#pu_id').val();
               var pname=$("#pu_name").text();
               var totalquantity=$("#consume_qty").val();
               var productprice=$("#pu_price").text()
               // alert(productprice)
               $.ajax(
                {
                  url:"/storeorder/"+pid,
                  type:'POST',
                  data:
                  {
                    "_token": "{{csrf_token()}}",
                    pid: pid,
                    totalquantity: totalquantity,
                    perprice: productprice
                  } ,
                  success:function(data){

                    if(data.status==1){
                    console.log(data.message);
                      alert("Product Added to Cart");
                      //console.log(data.newquantity);
                      $(".newproductquantity"+pid).text(data.newquantity);
                    $("#model-popups").hide();

                    }else{
                        alert("Failed to Add Cart");
                    }
                  }
                });

             });
        });
        </script>
</html>

