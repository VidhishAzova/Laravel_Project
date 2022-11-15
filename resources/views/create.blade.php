<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    </head>
    <body>
        <form  method="POST" action="{{route('customer.store')}}" enctype="multipart/form-data">
            @csrf
            @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>

@endif
            <br><br><br><br><br><br><br>
            <table align="center" border="0">
                <tr style="font-size: 30px;">
                    <td colspan="2" align="center"><b>Registration Form</td>
                </tr>
                <tr style="font-size: 25px;">
                    <td style="padding-top:50px; width:300px;">Enter First Name</td>
                    <td style="padding-top:50px;"><input type="text" style="height:40px;width:300px;" name="first_name" placeholder="Enter your first name"></td>
                </tr>
               <tr style="font-size: 25px;">
                    <td>Enter Last Name</td>
                    <td><input type="text" style="height:40px;width:300px;" name="last_name" placeholder="Enter your last name"></td>
                </tr>
                <tr style="font-size:25px;">
                    <td>Enter Phone Number</td>
                    <td><input type="number" style="height:40px;width:300px;" name="number" placeholder="Enter your phone number"></td>
                </tr>
                <tr style="font-size: 25px;">
                    <td>Select Gender</td>
                    <td>
                    <input type="radio" name="gender" value="Male"><span style="font-size:25px;" required>Male</span>
                    <input type="radio" name="gender" value="Female"><span style="font-size:25px;" required>Female</span>
                    </td>
                </tr>
                <tr style="font-size:25px;">
                    <td>Enter Email</td>
                    <td><input type="email" style="height:40px;width:300px;" name="email" placeholder="Enter your emailid"></td>
                </tr>
                <tr style="font-size:25px;">
                    <td>Select State</td>
                    <td><select name="states" style="height:40px;width:300px;font-size:17px;">
                        <option value="Gujarat">Gujarat</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Punjab">Punjab</option>
                    </td>
                </tr>
                <tr style="font-size:25px;">
                    <td>Upload Photo</td>
                    <td><input type="file" name="profilepic"></td>
                </tr>
                <tr>
                    <td style="font-size: 25px;">Choose your Education Qualification</td>
                    <td style="font-size:25px;">
                        @foreach ($listallqualification as $listallqualification)
                        <input type='checkbox' style='height:17px;width:20px;' value='{{$listallqualification->qid}}' name='qualification[]'>{{$listallqualification->qname}}
                        @endforeach
                    </td>
                </tr>
                <tr style="font-size:25px">
                    <td>Enter Password</td>
                    <td><input type="password" style="height:40px;width:300px;" name="password" placeholder="Enter a password"></td>
                </tr>

                <tr style="font-size: 25px;">
                    <td colspan="2" align="center">
                        <br>
                        <input type="submit" name="Submit" style="font-weight:bold;font-size:20px;">&nbsp;&nbsp;&nbsp;
                        <input type="reset" style="font-weight:bold;font-size:20px;">

                        <br><br>
                        <a href="/login" style="color:blue">Already a User?? Login Here...</a>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
