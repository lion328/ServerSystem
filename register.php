<?
session_start();
if(isset($_SESSION["id"]))
{
	header("location:index.php");
}
else if($_SESSION["id"] != "")
{
	header("location:index.php");
}
?>
<!doctype html>
<html>
<head>
<title>SERVER SYSTEM : REGISTER</title>
<meta http-equiv="content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
<div class="container shadow whitebg borderrad">
<form method="post" name="mainform" action="" class="form-horizontal">
<input type="hidden" name="act" value="">
<fieldset>
<legend>
<h1>REGISTER</h1>
</legend>
</fieldset>
<table align="center" width="850">
<tr>
<td>
<?
require_once("function/func_static.php");
require_once("function/func_connect.php");
if(isset($_POST['act']) && $_POST['act'] == 'register')
{
	if(!isset($_POST['reg_user']) || $_POST['reg_user'] == "")
	{
		$error = redBox("Plese input your username.");
	}
	if(strlen($_POST['reg_user']) > "20")
	{
		$error = redBox("Your username is too long.");
	}
	if(!isset($_POST['reg_pass']) || $_POST['reg_pass'] == "")
	{
		$error = redBox("Plese input your password.");
	}
	if(strlen($_POST['reg_pass']) > "20")
	{
		$error = redBox("Your password is too long.");
	}
	if(!isset($_POST['reg_con_pass']) || $_POST['reg_con_pass'] == "")
	{
		$error = redBox("Plese input your confirm password box.");
	}
	if($_POST['reg_pass'] != $_POST['reg_con_pass'])
	{
		$error = redBox("Plese input your password as same as confirm password box.");
	}
	if($_POST['reg_mail'] == "")
	{
		$error = redBox("Plese input your email address.");
	}
	if($Cfg["web"]["wlsys"] == "Manual")
	{
		if($_POST['reg_reason'] == "")
		{
			$error = redBox("Plese input your reason.");
		}
	}
	$password = hashPassword($_POST['reg_pass']);
	$strSQL = "SELECT * FROM authme WHERE username = '".$_POST['reg_user']."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if($Cfg["web"]["wlsys"] == "Manual")
	{
		$strSQL2 = "SELECT * FROM unapprove WHERE username = '".$_POST['reg_user']."'";
		$objQuery2 = mysql_query($strSQL2);
		$objResult2 = mysql_fetch_array($objQuery2);
	}
	if($objResult or $objResult2)
	{
		$error = redBox("This username has already use.");
	}
	if($error != "")
	{
		echo "<tr><td>";
		echo $error;
		echo "</td></tr></table>";
		exit();
	}
	if($Cfg["web"]["wlsys"] == "Manual" and !$objResult and !$objResult2)
	{
		$strSQL = "INSERT INTO unapprove (id,username,password,email,reason) VALUES ('0','".$_POST['reg_user']."','".$password."','".$_POST['reg_mail']."','".$_POST['reg_reason']."')";
		$objQuery = mysql_query($strSQL);
		if($objQuery)
		{
			$error = greenBox("Register success.","login.php");
			echo "<tr><td>";
			echo $error;
			echo "</td></tr></table>";
			exit();
		}
	}
	if($Cfg["web"]["wlsys"] == "Auto" and !$objResult)
	{
		$strSQL = "INSERT INTO authme (username,password,email,status) VALUES ('".$_POST['reg_user']."','".$password."','".$_POST['reg_mail']."','member')";
		$objQuery = mysql_query($strSQL);
		if($objQuery)
		{
			$error = greenBox("Register success.","login.php");
			echo "<tr><td>";
			echo $error;
			echo "</td></tr></table>";
			exit();
		}
	}
	else
	{
		$error = redBox("ERROR : Plese contact administrator.");
		echo "<tr><td>";
		echo $error;
		echo "</tr></td></table>";
		exit();
	}
}
?>
<label class="control-label">Username :</label><div class="controls"><input type="text" name="reg_user">
<p class="help-inline">Limit only 20 characters</p></div>
<p class="help-block">&nbsp;</p>
<label class="control-label">Password :</label><div class="controls"><input type="password" name="reg_pass">
<p class="help-inline">Limit only 20 characters</p></div>
<p class="help-block">&nbsp;</p>
<label class="control-label">Confirm Password :</label><div class="controls"><input type="password" name="reg_con_pass">
<p class="help-inline">Same as password box</p></div>
<p class="help-block">&nbsp;</p>
<label class="control-label">Email Address :</label><div class="controls"><input type="text" name="reg_mail">
<p class="help-inline">&nbsp;</p></div>
<p class="help-block">&nbsp;</p>
<?if($Cfg["web"]["wlsys"] == "Manual")
{?>
<label class="control-label">Reason :</label><div class="controls">
<textarea class="input-xlarge" name="reg_reason" rows="10" cols="50"></textarea>
<p class="help-inline">Why do you want to play on this server ?<br>This will show on admin's approve page.</p></div>
<?}?>
<p class="help-block">&nbsp;</p>
<div class="form-actions">
<input type="submit" class="btn btn-success" value="Register" onclick="mainform.act.value='register';mainform.submit();">
<input type="button" class="btn btn-danger" value="Cancel" onclick="window.location='login.php';">
</div>
</td>
</tr>
</table>
</form>
</div>
<br>
</body>
</html>