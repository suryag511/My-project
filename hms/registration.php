<?php

// **PREVENTING SESSION HIJACKING**
// Prevents javascript XSS attacks aimed to steal the session ID
ini_set('session.cookie_httponly', 1);

// **PREVENTING SESSION FIXATION**
// Session ID cannot be passed through URLs
ini_set('session.use_only_cookies', 1);

// Uses a secure connection (HTTPS) if possible
ini_set('session.cookie_secure', 1);

//preventing CSRF
include("csrf.php");

//connectivity
require('config.php');

//Preventing clickjacking
header("X-Frame-Options: DENY");
header("Content-Security-Policy: frame-ancestors 'none'", false);


//captcha
$num1 = range(9,0);
	$num2 = range(9,0);
	$rnum1 = array_rand($num1);
	$rnum2 = array_rand($num2);
	$n1 = $num1[$rnum1];
	$n2 = $num2[$rnum2];
	$sum = $n1 + $n2;
	$res = $n1." + ".$n2;
if(isset($_POST['submit']))
{
if($_POST['c1']==$_POST['c2'])
{
	$n = mysqli_real_escape_string($con,$_POST['uname']);
	$pass = mysqli_real_escape_string($con,$_POST['upass']);
//	$p = md5($pass);
	$p = crypt($pass,$n);	//encrypted password using hash + salt
	$em = mysqli_real_escape_string($con,$_POST['umail']);
	$gen = mysqli_real_escape_string($con,$_POST['gender']);
	$mob = mysqli_real_escape_string($con,$_POST['umob']);
	$add = mysqli_real_escape_string($con,$_POST['address']);


//check user if already exists


$q = "SELECT username FROM users WHERE username='$n'";
$cq = mysqli_query($con,$q);
$ret = mysqli_num_rows($cq);
if($ret == true)
{
	echo "<center><h2 style='color:red'>User with same UserName already exists</h2></center>";
}
//insert into database
else
{
	//prepare statement
	$stmt = $con->prepare("INSERT INTO users (username,password,email,gender,mob,address)VALUES (?,?,?,?,?,?)");
	$stmt->bind_param("ssssis",$n,$p,$em,$gen,$mob,$add);

	$stmt->execute();
   //echo "your account created successs";
	$result = $stmt->get_result();
	echo '<script>alert("Account Added Successfully!!")</script>';
}
}
else
{
	echo '<script>alert("Unsuccessfull,Please try again!")</script>';
}
}


?>
<html>
<head>
<script>
	function go()
	{
		document.location='./login.php';
	}
	function refresh()
	{
		document.location='./index.php';
	}
</script>
</head>
<body style="background-color:#E5E5E5">
<div align="center">
<form method="post" enctype="multipart/form-data">
	<fieldset style="display: inline-flex; background-color: #D8D8D8;">
	<div class="registration-page">
      <h1>Register account</h1>
      <form class="signup" action="registration.php" method="post" class="register-form" enctype="multipart/form-data">
        <div class="alert alert-error"></div>
<p><b>User Name </b><input type="text" name="uname" id="uname" placeholder="Enter username" pattern="[A-Za-z0-9]{6,}" title="Username must be greater than 5 characters." autocomplete="off" required/>
<!--<span id="username"></span>-->
<p><b>Password </b><input type="password" name="upass" id="upass" placeholder="Enter Password"  title="Password not strong enough." onkeyup="checkPassword(this.value)" autocomplete="off" required/>
<br><br><progress value="0" max="100" id="strength" style="width: 100px"></progress>
<!-- <span id="userpassword" class="font-weight-bold"></span>-->
<p><b>E-Mail </b><input type="email" name="umail" id="umail"  placeholder="Email ID" pattern="[A-Za-z0-9,_]+@[a-zA-Z0-9,-]+\.[a-z]{2,3}$" title="Please enter valid email address" autocomplete="off" required/>
<!-- <span id="usermail" class="font-weight-bold"></span>-->
<p><b>Gender : </b><input type="radio" name="gender" value="m">Male&nbsp;<input type="radio" name="gender" value="f">Female</p>
<p><b>Mobile No. : </b><input type="numb" name="umob" id="umob" placeholder="Enter Mobile No." pattern="[0-9]{10}" title="Only 10 numbers are allowed" autocomplete="off" required/></p>
<b>Address : </b><textarea placeholder="Input Address" id="addr"  name="address" pattern="[A-Za-z]{3,}" title="Address must contain atleast 3 letters." required/></textarea>
<fieldset style="display: inline-flex; background-color: #D8D8D8;"><legend><strong>Verification</strong></legend><p>
<?php
error_reporting(1);
echo $res." = ";
?>
<input type="hidden" name="c1" value="<?php echo $sum; ?>">
<input type="text" name="c2" autofocus placeholder="Enter Sum">*</p></fieldset><br>



<p><input type="submit" name="submit" id="submit" value="Register">&nbsp;<input type="reset" onClick="refresh()"></p>

	<!-- csrf -->
<input type="hidden" name="_token" class="form-control" value="<?php echo $_session['_token'];?>"/>
	<script type="text/javascript">
  var pass = document.getElementById("password")
   pass.addEventListening('keyup', function() {
       checkPassword(pass.value)
   })
   function checkPassword(password) {
       var strengthBar = document.getElementById("strength")
       var strength = 0;
       if (password.match(/[a-zA-Z0-9][a-zA-Z0-9]+/)) {
           strength += 1
       }
       if (password.match(/[~<>?]+/)) {
           strength += 1
       }
       if (password.match(/[!@#$%^&*()]+/)) {
           strength += 1
       }
       if (password.length > 5) {
           strength += 1
       }
       if (password.length == 0) {
           strength = 0;
       }
			 if (password.length < 0) {
			 		console.log('')
			 }
       switch(strength) {
           case 0:
           strengthBar.value = 20;
           break
           case 1:
           strengthBar.value = 40;
           break
           case 2:
           strengthBar.value = 60;
           break
           case 3:
           strengthBar.value = 80;
           break
       }
   }

</script>
</form>
</div>
</body>


</html>
