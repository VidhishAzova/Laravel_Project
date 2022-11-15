<html>
<head>

@include('including.allscriptlinks')
@include('including.stylessidenav')
@include('including.nav')

</head>
<body>
    @if(session()->has('message'))
    echo "<script>window.alert('Product Added Sucessfully')</script>";
@endif
@include('including.nav')
<div class="main">
    <br>
  <h1>Add Product</h1>
  <div class="form-group">
  <form  method="POST" action="/add" enctype="multipart/form-data">
    @csrf
    <br>
    <span style="font-size: 15px;"><img  id="uploadPreview" alt="Please upload product image" style="width:100px;height:100px;padding-left:700px;"/></span>
    <br><br>
    <p style="font-size:25px;">Enter Product name:
        <input type="text"  class="form-control" name="productname" style="height:40px;width:1500px;" placeholder="Enter product name">
    Select Product category:
    <select name="productcategory" class="form-control" style="height:40px;width:1500px;font-size:17px;" required>
        <option value="" disabled selected>Select product type</option>
        @foreach ($listcategory as $category)
        echo "<option value={{$category->pcid}}>{{$category->productcategoryname}}</option>";
        @endforeach
    </select>
    Enter product Description:<br>
    <input type="textarea" name="productdescription" class="form-control" style="height:40px;width:1500px;" placeholder="Enter product description">
    Upload product image:<br>
    <span style="font-size: 20px;"><input id="uploadImage" class="form-control-file" name="productimage" type="file" onchange="PreviewImage();"></span>
    Enter Product Quantity:
            <td><input type="number" class="form-control" name="productqauntity" min="1" max="99" pattern="/^\d{1|2}$/" style="height:40px;width:1500px;" placeholder="Enter product quantity">
            Enter Product Price:<br>
            <input type="number" name="productprice" class="form-control" style="height:40px;width:1500px;" placeholder="Enter the price per quantity">
            <br>
            <div align="center"><input type="submit"  class="btn btn-warning" style="height:45px;width:100px;" value="Submit">&nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-warning" style="height:45px;width:100px;" value="Clear"></div>
  </form>
  </div>
</div>

</body>
<script type="text/javascript">
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>
</html>

