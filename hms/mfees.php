

<?php

session_start();


require('config.php');

//Preventing clickjacking
header("X-Frame-Options: DENY");
header("Content-Security-Policy: frame-ancestors 'none'", false);



if(isset($_POST['submit']))
{
	$fname = mysqli_real_escape_string($con,$_POST['fname']);
	$lname = mysqli_real_escape_string($con,$_POST['lname']);
	$em = mysqli_real_escape_string($con,$_POST['umail']);
	$mob = mysqli_real_escape_string($con,$_POST['umob']);
	$add = mysqli_real_escape_string($con,$_POST['address']);

//insert into database
$query = "INSERT INTO booking VALUES ('','$fname','$lname','$em','$mob','$add')";
mysqli_query($con,$query);
echo "<center><h2 style='color:green'>Details Saved!</h2></center>";
}

?>
<html>
<head>
<script>
	function go()
	{
		document.location='./profile.php';
	}
	function refresh()
	{
		document.location='./mfees.php';
	}
</script>
<div align="center">
<form method="post" enctype="multipart/form-data">
	<fieldset style="display: inline-flex; background-color: #D8D8D8;">
	<div class="registration-page">
      <h1>Booking appointment</h1>
      <form class="signup" action="mfees.php" method="post" class="register-form" enctype="multipart/form-data">
        <div class="alert alert-error"></div>
<p><b>First Name </b><input type="text" name="fname" id="fname" placeholder="Enter Firstname" pattern="[A-Za-z0-9]{5,}" title="First name must be greater than 5 characters." autocomplete="off" required/>
<p><b>Last Name </b><input type="text" name="lname" id="lname" placeholder="Enter Lastname" pattern="[A-Za-z0-9]{5,}" title="Last name must be greater than 5 characters." autocomplete="off" required/>
<p><b>E-Mail </b><input type="email" name="umail" id="umail"  placeholder="Email ID" pattern="[A-Za-z0-9,_]+@[a-zA-Z0-9,-]+\.[a-z]{2,3}$" title="Please enter valid email address" autocomplete="off" required/>
<p><b>Mobile No. : </b><input type="numb" name="umob" id="umob" placeholder="Enter Mobile No." pattern="[0-9]{10}" title="Only 10 numbers are allowed" autocomplete="off" required/></p>
<b>Address : </b><textarea placeholder="Input Address" id="addr"  name="address" pattern="[A-Za-z]{3,}" title="Address must contain atleast 3 letters." required/></textarea>
<p><input type="submit" name="submit" id="submit" value="Register">&nbsp;<input type="reset" onClick="refresh()"></p>
<body>
<div align="center">
<h1 style="color:#414040"><u>MAINTENANCE FEES</u></h1>
<table width="1058" height="204" border="0">
  <tbody>
    <tr>
      <td width="170" height="49" style="background-color:#CCD3FF"><center><font size="+1"><b>Total Maintenance Fees</b></font></center></td>
      <td width="872" style="background-color:#C0C0C0"><center><b>5000 Euros</b></center></td>
    </tr>
    <tr>
      <td height="34" colspan="2">
        <p>&nbsp;</p>
        <p><font size="+2"><b>Additional Charges <font size="-1">(not mandatory)</font></b></font></p>
      </td>
    </tr>
    <tr>
      <td height="43" style="background-color:#CCD3FF"><center><font size="+1"><b>TAX Charges</b></font></center></td>
      <td style="background-color:#C0C0C0"><center><b> 500 EUROS/- (per Contract)</b></center></td>
    </tr>
  </tbody>
</table>

</head>
</div>
</body>
</html>
