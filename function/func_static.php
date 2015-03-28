<?
function redBox($str)
{
	$objResult = "&nbsp;<font color='#ff0000'><b>".$str."</b></font><div class='controls' align='right'><input type='button' class='btn' value='Back' onclick=\"window.location='".$_SERVER['PHP_SELF']."'\"></div>";
	return $objResult;
}
function greenBox($str,$page)
{
	if($page == "0")
	{
		$objResult = "&nbsp;<font color='#339900'><b>".$str."</b></font><div class='controls' align='right'><input type='button' class='btn btn-success' value='OK' onclick=\"window.location='".$_SERVER['PHP_SELF']."'\"></div>";
	}
	if($page != "0")
	{
		$objResult = "&nbsp;<font color='#339900'><b>".$str."</b></font><div class='controls' align='right'><input type='button' class='btn btn-success' value='OK' onclick=\"window.location='".$page."'\"></div>";
	}
	return $objResult;
}
function pageperm($perm)
{
	if($perm == "admin")
	{
		if(!isset($_SESSION["id"]))
		{
			header("location:login.php");
		}
		else if($_SESSION["id"] == "")
		{
			header("location:login.php");
		}
		if(!isset($_SESSION["status"]))
		{
			header("location:login.php");
		}
		else if($_SESSION["status"] != "admin")
		{
			header("location:index.php");
		}
		if(!file_exists("installed"))
		{
			header("location:install.php");
		}
	}
	if($perm == "normal")
	{
		if(!isset($_SESSION["id"]))
		{
			header("location:login.php");
		}
		else if($_SESSION["id"] == "")
		{
			header("location:login.php");
		}
		if(!file_exists("installed"))
		{
			header("location:install.php");
		}
	}
}
function head($actpage)
{
	require("config.php");
?>
<!doctype html>
<html>
<head>
<title><?echo $Cfg["web"]["name"]." : ";
switch($actpage)
	{
		case "index":
			$title = "HOME PAGE";
		break;
		case "refill":
			$title = "REFILL CODE";
		break;
		case "buy":
			$title = "BUY NEW CODE";
		break;
		case "info":
			$title = "PERSONAL INFOMATION";
		break;
		case "changepw":
			$title = "CHANGE PASSWORD";
		break;
		case "mail":
			$title = "MAIL";
		break;
		case "a_approve":
			$title = "ADMIN - APPROVE";
		break;
		case "a_ulist":
			$title = "ADMIN - USERLIST";
		break;
		case "a_announce":
			$title = "ADMIN - ANNOUNCE";
		break;
	}
	if(!isset($title))
	{
		$title = $actpage;
	}
	echo $title;
?></title>
<meta http-equiv="content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</head>
<body>
<br>
<div class="container whitebg borderrad shadow">
<form method="post" name="mainform" action="">
<input type="hidden" name="act" value="">
<input type="hidden" name="subact" value="">
<input type="hidden" name="page" value="">
<input type="hidden" name="status" value="">
<input type="hidden" name="money" value="">
<fieldset>
<legend>
<h1><?=$title?></h1>
</legend>
</fieldset>
<div class="well well-small">Announce : <marquee width="80%" onMouseOut="this.start()" onMouseOver="this.stop()">
<?
$strSQL = "SELECT * FROM announce ORDER BY id";
$objQuery = mysql_query($strSQL);
while($objResult = mysql_fetch_array($objQuery))
{
	echo " : ".$objResult['announce']." :  ";
}
?>
</marquee></div>
<table align="center" width="850" bor/der="1">
<tr>
<td width="200"><b>Welcome, <font color="#33ccff">
<?
if($_SESSION["status"] == "admin")
{
	echo "<i class='icon-star'></i> ".$_SESSION['username']."";
}
else
{
	echo "<i class='icon-user'></i> ".$_SESSION['username']."";
}
?></font>.</b></td>
<td width="50"></td>
<td align="center" width="500" colspan="6"></td>
</tr>
<tr height="50">
<td rowspan="50">
<p class="help-block"></p>
<ul class='nav nav-pills nav-stacked'>
<li class="nav-header">MENU</li>
<li <?if($actpage == "index"){echo "class='active'";}?>><a href="index.php">Home</a></li>
<li <?if($actpage == "refill"){echo "class='active'";}?>><a href="refill.php">Refill Code</a></li>
<li <?if($actpage == "buy"){echo "class='active'";}?>><a href="buy.php">Buy Code</a></li>
<li <?if($actpage == "info"){echo "class='active'";}?>><a href="info.php">Personal Info</a></li>
<li <?if($actpage == "changepw"){echo "class='active'";}?>><a href="changepw.php">Change Password</a></li>
<li <?if($actpage == "mail"){echo "class='active'";}?>><a href="mail.php">Mail</a></li>
<?if($_SESSION["status"] == "admin")
{?>
<li class="nav-header">ADMIN MENU</li>
<li <?if($actpage == "a_approve"){echo "class='active'";}?>><a href="a_approve.php">Aprrove User</a></li>
<li <?if($actpage == "a_ulist"){echo "class='active'";}?>><a href="a_ulist.php">User List</a></li>
<li <?if($actpage == "a_announce"){echo "class='active'";}?>><a href="a_announce.php">Announce</a></li>
<?}
?>
<li class="nav-header">Logout</li>
<li><a href="logout.php">Logout</a></li>
</ul>
</td>
<td rowspan="50">
</td>
</tr>
<?}
function createSalt($length)
{
	srand(date("s")); 
	$chars = "abcdefghigklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; 
	$ret_str = ""; 
	$num = strlen($chars); 
	for($i=0;$i<$length;$i++)
	{ 
		$ret_str.= $chars[rand()%$num];
	} 
	return $ret_str;
}
function hashPassword($orgPassword)
{
	$salt = createSalt(16);
	$hashedPassword = "\$SHA\$".$salt."\$".hash('sha256',hash('sha256',$orgPassword).$salt);
	return $hashedPassword;
}
function checkPassword($nickname,$password)
{
	require_once("function/func_connect.php");
	$a = mysql_query("SELECT password FROM authme where username = '$nickname'");
	if(mysql_num_rows($a) == 1)
	{
		$password_info = mysql_fetch_array($a);
		$sha_info = explode("$",$password_info[0]);
	}
	else return false;
	if($sha_info[1] === "SHA")
	{
		$salt = $sha_info[2];
		$sha256_password = hash('sha256', $password);
		$sha256_password .= $sha_info[2];;
		if(strcasecmp(trim($sha_info[3]),hash('sha256', $sha256_password)) == 0) return true;
		else return false;
	}
}
?>