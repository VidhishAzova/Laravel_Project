<div class="sidenav">
    <br><br>
    @php
    if(session()->get('first_name')== 'Admin')
    {
        echo "<span style='padding-left:80px;''><img src='bg2.jpg' style='height:120px;width:120px;border-radius:53px;'></span>";
    }
    else
    {
        echo "<span style='padding-left:80px;'><img src='".'/uploads/'.Auth::user()->profilepic."' style='height:120px;width:120px;border-radius:53px;'></span>";

    }
    @endphp
    <br><br><br>
    @php
    echo "<span style='font-size: 25px;color:white'>Welcome, ".Session::get('first_name')."</span>";
    @endphp
    <br><br><br>
  <a href="/welcome" class="navfont">Home</a><br>
  <a href="" class="navfont">About</a><br>
  @php
  if(session()->get('first_name')== 'Admin')
  {
    echo "<a href='/addproducts' class='navfont'>Add Products</a><br>";
    echo "<a href='/customers' class='navfont'>Our Customers</a><br>";
    echo "<a href='/allorders' class='navfont'>Orders</a><br>";
  }
  else
  {
    echo "<a href='/orders' class='navfont'>My Orders</a><br>";
    echo "<a href='/edit/".Auth::user()->uid."' class='navfont'>Edit Profile</a><br>";
  }
  @endphp
  <a href="/logout" class="navfont">Logout</a>
</div>
