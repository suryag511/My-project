<?php

// **PREVENTING SESSION HIJACKING**
// Prevents javascript XSS attacks aimed to steal the session ID
ini_set('session.cookie_httponly', 1);

// **PREVENTING SESSION FIXATION**
// Session ID cannot be passed through URLs
ini_set('session.use_only_cookies', 1);

// Uses a secure connection (HTTPS) if possible
ini_set('session.cookie_secure', 1);


include("csrf.php");

//connectivity
require('config.php');


if(isset($_POST['login']))
{
	$u = mysqli_real_escape_string($con,$_POST['uname']);
	$pass = mysqli_real_escape_string($con,$_POST['upass']);

	$p = crypt($pass,$u); //encrypted password using hash + salt
	$_SESSION['user']=$u;
	$_SESSION['pass']=$p;


	//Prepared Statement
	$stmt = $con->prepare("SELECT id, username, password FROM users WHERE username=? AND password=?");
    $stmt->bind_param('ss', $u, $p);
    $stmt->execute();
    $stmt->bind_result($id, $u, $p);
    $stmt->store_result();
	 if($stmt->num_rows == 1)  //To check if the row exists
        {
            if($stmt->fetch()) //fetching the contents of the row
            {
               if ($stmt == 'd') {
                   echo "YOUR account has been DEACTIVATED.";
                   exit();
               } else {
                   $_SESSION['user'] = $u;
                   $_SESSION['pass'] = $p;
                   echo "<script>document.location='profile.php'</script>";
                   exit();
               }
           }

    }
    else {
        echo "<center><h2 style='color:red'>ACCESS DENIED</h2></center>";
    }
    $stmt->close();
}

?>


<html>

<body style="background-color:#E5E5E5">


<div align="center">
<form method="post">
<fieldset style="display: inline-flex; background-color: #D8D8D8;"><legend><font size="+2">




<strong>Login Panel</strong></font></legend>
<p><b>UserName : </b><input type="text" name="uname" id="uname" placeholder="input type username" required/>*</p>
<p><b>Password : </b><input type="password" name="upass" id="upass" placeholder="input type password" required/>*</p><br>

<!-- csrf -->
<input type="hidden" name="_token" class="form-control" value="<?php echo $_session['_token'];?>"/>
<p><input type="submit" value="Login" name="login"id="login_btn" onsubmit="return validate()"/></p>
</fieldset>
</form>


	</div>
</body>

</html>
