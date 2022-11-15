<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    </head>
    <body>
        <form  method="POST" action="/checklogin" enctype="multipart/form-data">
            @csrf
            <br><br><br><br><br><br><br>
            <table align="center" border="0">
                <tr style="font-size: 30px;">
                    <td colspan="2" align="center"><b>Login Form</td>
                </tr>
                <tr style="font-size:25px;">

                    <td><br><br>Enter Email: </td>
                    <td><br><br><input type="email" style="height:40px;width:300px;" name="email" placeholder="Enter your emailid"></td>
                </tr>
                <tr style="font-size:25px;">
                    <td><br>Enter Password: </td>
                    <td><br><input type="password" style="height:40px;width:300px;" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><br><br><br><br><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" ></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><br><br><a href="insert">New Customer?? Register Here...</a></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><br><a href="viewforgotpassword">Forgot Password? Click Here...</a></td>
                </tr>
            </table>
        </form>
    </body>
</html>
