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

include("csrf.php");
//connectivity
require('config.php');

// Preventing Clickjacking
header("X-Frame-Options: DENY");
header("Content-Security-Policy: frame-ancestors 'none'", false);





//marquee display
$q = "SELECT marquee1 FROM admin WHERE id=1";
$q1 = mysqli_query($con,$q);
$disp = mysqli_fetch_array($q1);
//echo $disp['marquee1'];

//change colg name
$q2 = "SELECT colgname FROM admin WHERE id=1";
$q21 = mysqli_query($con,$q2);
$colgdisp = mysqli_fetch_array($q21);


?>
<html>
<head>
<title>WILDCRAFT EVENTS</title>
<link rel="stylesheet" type="text/css" href="engine/css/slideshow.css" media="screen" />
	<style type="text/css">.slideshow a#vlb{display:none}</style>
	<script type="text/javascript" src="engine/js/mootools.js"></script>
	<script type="text/javascript" src="engine/js/visualslideshow.js"></script>
    <link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="engine1/jquery.js"></script>

    <style type="text/css" media="screen">
#horizontalmenu ul
{
padding:1; margin:1; list-style:none;
}
#horizontalmenu li
{
float:left;
 position:relative;
 padding-right:89;
 display:block;
border:0px solid #CC55FF;
border-style:inset;
margin-left:20px;
}
#horizontalmenu li ul
 {
display:none;
position:absolute;
}
#horizontalmenu li:hover ul{
    display:block;
    background:#C4C4C4;
height:auto; width:8em;
}
#horizontalmenu li ul li
{
    clear:both;
border-style:none;}
</style>
</head>
<table width="1050px" align="center"  border="1">
 <tbody>
    <tr>
      <th height="39" colspan="2" style="background-color:#4E4E4E"><div style="text-align:left;color:#FFFFFF"><b><font size="+3"><a href="profile.php" style="text-decoration:none; color:#FFFFFF">
	<!--		This Message will be editable by Administrator After Login!</marquee></div></th>-->
	<?php echo $colgdisp['colgname'];?>
	  </a></font></b><marquee direction="left" height="100%">
			<?php echo $disp['marquee1']; ?></marquee></div></th>
    </tr>
    <tr>
      <th height="317" colspan="2">
     <!--Slider-->
    <div id="wowslider-container1">
	<div class="ws_images"><ul>
		<li><img src="data1/images/dsc_37504.jpg" alt="" title="" id="wows1_0"/></li>
		<li><img src="data1/images/dsc_3783.jpg" alt="" title="" id="wows1_1"/></li>
		<li><img src="data1/images/eventplanningcompany.jpg" alt="jquery image carousel" title="" id="wows1_2"/></a></li>
		<li><img src="data1/images/zoofari0_12488761_5056_b3a8_49f93ef57c5f568d_52284d95196f4739aa61e869461d339d.jpg" alt="" title="" id="wows1_3"/></li>
	</ul></div>
	<div class="ws_bullets"><div>
		<a href="#" title=""><span><img src="data1/tooltips/dsc_37504.jpg" alt=""/>1</span></a>
		<a href="#" title=""><span><img src="data1/tooltips/dsc_3783.jpg" alt=""/>2</span></a>
		<a href="#" title=""><span><img src="data1/tooltips/eventplanningcompany.jpg" alt=""/>3</span></a>
		<a href="#" title=""><span><img src="data1/tooltips/zoofari0_12488761_5056_b3a8_49f93ef57c5f568d_52284d95196f4739aa61e869461d339d.jpg" alt=""/>4</span></a>
	</div></div>

<span class="wsl"></span>
	<!--<a href="#" class="ws_frame"></a>-->
	</div>
	<script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>
	<!--slider end-->
      </th>
    </tr>
    <tr>
      <td height="38" colspan="2" style="background-color:#6E68FF">
      	<div>
		<a href="profile.php?option=gallery" style="text-decoration:none ; color:#010101" id="horizontalmenu li"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GALLERY</b></a>
        <a href="profile.php?option=about" style="text-decoration:none ; color:#010101"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ABOUT</b></a>
        <a href="profile.php?option=mfees" style="text-decoration:none ; color:#010101"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MAINTENANCE FEES</b></a>
        <a href="profile.php?option=rfees" style="text-decoration:none ; color:#010101"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EVENT FEES</b></a>
		<a href="profile.php?option=contact" style="text-decoration:none ; color:#010101"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONTACT</b></a>
  <a href="logout.php" style="text-decoration:none;margin-left:150px;"><input type="submit" value="Logout" name="logout"></a></td>
    </tr>
    <tr>
      <td width="974" height="647" bgcolor="#D9D9D9" style="vertical-align:text-top">
      	<?php
	@$opt = $_GET['option'];
	if($opt=="")
	{
	?>
    <html>
	<input type="hidden" name="_token" class="form-control" value="<?php echo $_session['_token'];?>"/>
	<h1><center>Welcome <?php echo $_SESSION['user']; ?></center></h1>
    </html>
	<?php
    error_reporting(1);
	}
	else{
	switch($opt)
	{
		case 'regs':
		include('registration.php')	;
		break;
		case 'login':
		include('login.php');
		break;
        case 'about':
		include('about.php');
		break;
		case 'contact':
		include('contact.php');
		break;
		case 'gallery':
		include('gallery.php');
		break;
		case 'course':
		include ('course.php');
		break;
		case 'mfees':
		include('mfees.php');
		break;
		case 'rfees':
		include('rfees.php');
		break;

	}}

	?>


     </td>
    </tr>
    <tr>
      <td height="25" colspan="2" style="background-color:#B8AFFF"><center><b>&copy; Copyright under 2018-2019</b></center></td>
    </tr>
  </tbody>
</table>
</html>
