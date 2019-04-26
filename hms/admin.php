<?php
// **PREVENTING SESSION HIJACKING**
// Prevents javascript XSS attacks aimed to steal the session ID
ini_set('session.cookie_httponly', 1);

// **PREVENTING SESSION FIXATION**
// Session ID cannot be passed through URLs
ini_set('session.use_only_cookies', 1);

// Uses a secure connection (HTTPS) if possible
ini_set('session.cookie_secure', 1);

session_start();

//Preventing clickjacking
header("X-Frame-Options: DENY");
header("Content-Security-Policy: frame-ancestors 'none'", false);

include("csrf.php");

include('config.php');



if(isset($_POST['admlogin']))
{
	$u = mysqli_real_escape_string($con,$_POST['admname']);
	$pass = mysqli_real_escape_string($con,$_POST['admpass']);
	$_SESSION['admin']=$u;
	$p = crypt($pass,$u);


	$q = "SELECT * FROM admin WHERE auser='$u' AND apass='$p'";
	$cq = mysqli_query($con,$q);
	$ret = mysqli_num_rows($cq);
	if($ret == true)
	{
		header('location:backend.php');
	}
	else
	{
		echo "<script>alert('Wrong Login Details, Try Again!')</script>";
	}
}
?>
<div align="center">
<form method="post">
<table width="1067" height="493" border="1">
  <tbody>
    <tr>
      <td width="1057" height="59" bgcolor="#4D4C94"><center>
        <h1><strong style="color: #FFFFFF">CREDENTIAL LOGIN</strong></h1>
      </center></td>
    </tr>
<tr>
<th height="426" bgcolor="#969BEF">
<fieldset style="display:inline-flex"><legend><font size="+1">Admin Login</font></legend><p>Username : <input type="text" name="admname" placeholder="Admin Username">
<p>Password : <input type="password" name="admpass" placeholder="Admin Password">
	<input type="hidden" name="_token" class="form-control" value="<?php echo $_session['_token'];?>"/>
<p><input type="submit" value="Login" name="admlogin">&nbsp;<input type="reset" value="Reset"></p></fieldset>
</th>
</tr>
</tbody>
</table>
</form>
</div>
