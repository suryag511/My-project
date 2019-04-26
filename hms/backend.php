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

error_reporting(1);
if($_SESSION['admin']=="")
{
	header('location:admin.php');
}
else
{

//logout
if(isset($_POST['logout']))
{
	header('location:adminlogout.php');
}

include('config.php');
//header marquee
if(isset($_POST['m1save']))
{
	$marquee = $_POST['marquee1'];
	$query = "UPDATE admin SET marquee1='$marquee' WHERE  id=1";
	mysqli_query($con,$query);
	$confirm ="<b style='color:red'>Page Saved</b>";
}

//event name
if(isset($_POST['cnsave']))
{
	$cname = $_POST['colgname'];
	$query2 = "UPDATE admin SET colgname='$cname' WHERE id=1";
	mysqli_query($con,$query2);
	$confirm2 = "<b style='color:red'>Page Saved</b>";
}

//event intro
if(isset($_POST['intsave']))
{
	$intro = $_POST['colgintro'];
	$query3 = "UPDATE admin SET colgintro='$intro' WHERE id=1";
	mysqli_query($con,$query3);
	$confirm3 = "<b style='color:red'>Page Saved</b>";
}

//footer info
if(isset($_POST['footersave']))
{
	$footer = $_POST['footerinfo'];
	$query4 = "UPDATE admin SET footerinfo='$footer' WHERE id=1";
	mysqli_query($con,$query4);
	$confirm4 = "<b style='color:red'>Page Saved</b>";
}

//about page
if(isset($_POST['aboutsave']))
{
	$abouthead = $_POST['abouthead'];
	$aboutinfo = $_POST['aboutinfo'];
	$query5 = "UPDATE admin SET abouthead='$abouthead' WHERE id=1";
	$query6 = "UPDATE admin SET aboutinfo='$aboutinfo' WHERE id=1";
	mysqli_query($con,$query5);
	mysqli_query($con,$query6);
	$confirm5 = "<b style='color:red'>Page Saved</b>";
}



?>


<html>
<div align="center">
<form method="post">
<table width="1328" height="628" border="1">
  <tbody>
    <tr>
      <td colspan="6" bgcolor="#5D5CEC"><center><font size="+2"><strong style="color: #FFFFFF">Administrator Control Panel</strong></font></center><div align="right"><input type="submit" value="Logout" name="logout"></div></td>
    </tr>
    <tr>
      <td width="323" height="543">
      <center><p><b>[ Content of Header Marquee ]</b>
      <textarea placeholder="Input Marquee for the header of the Page!" name="marquee1"></textarea><br>
      <input type="submit" value="Save" name="m1save"><br><?php echo $confirm; ?>
      </p></center><br>
      <p><center><b>Change Events Name : </b><br>
      <input type="text" placeholder="Event Name" name="colgname" size="50"><input type="submit" value="Save" name="cnsave"><br><?php echo $confirm2; ?></center></p><br>
      <center><p><b>Change Events Intoduction</b><br>
      <textarea placeholder="Input Introduction for Evens mngmt" name="colgintro"></textarea><br>
      <input type="submit" value="Save" name="intsave"><br><?php echo $confirm3; ?></p></center><br>
      <center><p><b>Change Footer</b><br>
      <input type="text" placeholder="copyright information etc," name="footerinfo" size="50"><br>
      <input type="submit" value="Save" name="footersave"><br><?php echo $confirm4; ?></p></center>
      </td>
      <td width="475">
      <p><center><b>Edit "About" Page</b><br><br>
      Page Heading : <input type="text" placeholder="heading" name="abouthead" size="30"><br><br>
     [ Page Content ]<br>
      <textarea placeholder="Input Content" name="aboutinfo"></textarea><br>


      <input type="submit" value="Save" name="aboutsave"><br><?php echo $confirm5; ?></p></center>

      </td>

		<td width="323" height="543">
		<table width="100%">
		<p><center><b>Booked Appointment</b><br><br>
<tr>


 <?php

 // Fetching the Booking Details
$link = mysqli_connect("localhost", "root", "", "events");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Attempt select query execution
$sql = "SELECT * FROM booking";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>Sl</th>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Email</th>";
				echo "<th>Mobile</th>";
				echo "<th>Address</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['fname'] . "</td>";
                echo "<td>" . $row['lname'] . "</td>";
                echo "<td>" . $row['umail'] . "</td>";
				echo "<td>" . $row['umob'] . "</td>";
				echo "<td>" . $row['address'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
?>
</table>

  </tbody>
</table>
</form>
</div>
</html>


<?php

}
?>
