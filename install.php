<?
session_start();
require_once("function/func_static.php");
?>
<!doctype html>
<html>
<head>
<title>INSTALL SERVER SYSTEM : INSTALL'S AGREEMENT</title>
<meta http-equiv="content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</head>
<body>
<br>
<div class="container whitebg borderrad shadow">
<form method="post" name="mainform" action="" class="form-horizontal">
<input type="hidden" name="act" value="">
<fieldset>
<legend>
<h1>INSTALL</h1>
</legend>
</fieldset>
<table align="center" width="850">
<?
if(file_exists("installed"))
{
	$error.= greenBox("You are already install system.","login.php");
}
if($error != "")
{
	echo "<tr><td>";
	echo $error;
	echo "</td></tr></table>";
	exit();
}
if(!isset($_POST['act']) || $_POST['act'] == '')
{
?>
<tr>
<td>
<br>
<div class="hero-unit"><h1><font color="#33ccff">ServerSystem</font> 0.8</h1>
<div style="font-size: 1px;" align="right">by BanK_z & lion328</div></div>
<br>
<div class="well" align="center">
<b>ยินดีต้อนรับสู่ตัวช่วยการติดตั้งของ ServerSystem 0.8</b>
<br>
<br>
กรณากดปุ่ม <input class="btn btn-success" type="button" value="Next"> ทางด้านล่าวขวา เพื่อไปยังขั้นตอนต่อไป
</div>
<br>
<div align="right"><input class="btn btn-success" type="button" value="Next" onclick="mainform.act.value='install1';mainform.submit();"></div>
</div>
<font size="1" color="#b6b6b6">ระบบ install พัฒนาโดย BanK_z</font>
</td>
</tr>
<tr>
<td colspan="6"></td>
</tr>
</table>
</form>
</div>
<br>
</body>
</html>
<?
	exit();
}
if($_POST['act'] == 'install1')
{
?>
<tr>
<td>
<br>
<div class="hero-unit"><h1><font color="#33ccff">ServerSystem</font> 0.8</h1>
<div style="font-size: 1px;" align="right">by BanK_z & lion328</div></div>
<br>
<div class="well">ขั้นตอนที่ 1 : <b>ชื่อผู้ใช้และรหัสผ่านสำหรับ Admin</b>
<br>
<br>
<label class="control-label">Admin Username :</label><div class="controls"><input type="text" name="adm_user"></div>
<br>
<label class="control-label">Admin Password :</label><div class="controls"><input type="password" name="adm_pass"></div>
</div>
<br>
<div align="right">
<input class="btn btn-success" type="button" value="Home" onclick="mainform.act.value='';mainform.submit();">
<input class="btn btn-success" type="button" value="Next" onclick="mainform.act.value='install2';mainform.submit();"></div>
</div>
<font size="1" color="#b6b6b6">ระบบ install พัฒนาโดย BanK_z</font>
</td>
</tr>
<tr>
<td colspan="6"></td>
</tr>
</table>
</form>
</div>
<br>
</body>
</html>
<?
	exit();
}
if($_POST['act'] == 'install2')
{
	$_SESSION["adm_user"] = $_POST["adm_user"];
	$_SESSION["adm_pass"] = $_POST["adm_pass"];
	session_write_close();
?>
<tr>
<td>
<br>
<div class="hero-unit"><h1><font color="#33ccff">ServerSystem</font> 0.8</h1>
<div style="font-size: 1px;" align="right">by BanK_z & lion328</div></div>
<br>
<div class="well">ขั้นตอนที่ 2 : <b>ฐานข้อมูลและรายละเอียดอื่นๆ</b>
<br>
<br>
<label class="control-label">Host :</label><div class="controls"><input type="text" name="host" value="localhost"><p class="help-block">โฮสต์ของฐานข้อมูล โดยทั่วไปจะเป็น localhost ไม่แนะนำให้เปลี่ยน</p></div>
<br>
<label class="control-label">phpmyadmin Username :</label><div class="controls"><input type="text" name="phpm_user" value="root"><p class="help-block">ชื่อผู้ใช้ของ phpmyadmin</p></div>
<br>
<label class="control-label">phpmyadmin Password :</label><div class="controls"><input type="text" name="phpm_pass" value="root"><p class="help-block">รหัสผ่านของ phpmyadmin</p></div>
<br>
<label class="control-label">Database :</label><div class="controls"><input type="text" name="db_name" value="minecraft"><p class="help-block">ฐานข้อมูล โดยทั่วไปจะเป็น minecraft ไม่แนะนำให้เปลี่ยน</p></div>
<br>
<label class="control-label">Website Name :</label><div class="controls"><input type="text" name="web_name"><p class="help-block">ข้อความนี้จะขึ้นบน title bar บนหน้าเว็ป</p></div>
<br>
<label class="control-label">Xat id :</label><div class="controls"><input type="text" name="xat_id"><p class="help-block">Xat id ดูตรง FlashVar ในโค้ด xat ว่าเป็นเลขอะไรนำมาใส่ในนี้</p></div>
<br>
<label class="control-label">Whitelist System :</label><div class="controls"><input type="radio" name="wl_sys" value="Auto">Auto&nbsp;&nbsp;<input type="radio" name="wl_sys" value="Manual">Manual<p class="help-block">ระบบไวท์ลิส Auto คือรับอัตโนมัติ Manual คือต้องกดรับเอง</p></div>
</div>
<br>
<div align="right">
<input class="btn btn-success" type="button" value="Home" onclick="mainform.act.value='';mainform.submit();">
<input class="btn btn-success" type="button" value="Next" onclick="mainform.act.value='install3';mainform.submit();"></div>
</div>
<font size="1" color="#b6b6b6">ระบบ install พัฒนาโดย BanK_z</font>
</td>
</tr>
<tr>
<td colspan="6"></td>
</tr>
</table>
</form>
</div>
<br>
</body>
</html>
<?
	exit();
}
if($_POST['act'] == 'install3')
{
	$_SESSION["host"] = $_POST["host"];
	$_SESSION["phpm_user"] = $_POST["phpm_user"];
	$_SESSION["phpm_pass"] = $_POST["phpm_pass"];
	$_SESSION["db_name"] = $_POST["db_name"];
	$_SESSION["wl_sys"] = $_POST["wl_sys"];
	$_SESSION["xat_id"] = $_POST["xat_id"];
	$_SESSION["web_name"] = $_POST["web_name"];
	session_write_close();
?>
<tr>
<td>
<br>
<div class="hero-unit"><h1><font color="#33ccff">ServerSystem</font> 0.8</h1>
<div style="font-size: 1px;" align="right">by BanK_z & lion328</div></div>
<br>
<div class="well">ขั้นตอนที่ 3 : <b>สรุป</b>
<br>
<br>
<div><b>Admin Username</b> : <input type="text" value="<?=$_SESSION["adm_user"];?>" disabled="disabled"></div>
<br>
<div><b>Admin Password</b> : <input type="text" value="<?=$_SESSION["adm_pass"];?>" disabled="disabled"></div>
<br>
<div><b>Host</b> : <input type="text" value="<?=$_SESSION["host"];?>" disabled="disabled"></div>
<br>
<div><b>phpmyadmin Username</b> : <input type="text" value="<?=$_SESSION["phpm_user"];?>" disabled="disabled"></div>
<br>
<div><b>phpmyadmin Password</b> : <input type="text" value="<?=$_SESSION["phpm_pass"];?>" disabled="disabled"></div>
<br>
<div><b>Database</b> : <input type="text" value="<?=$_SESSION["db_name"];?>" disabled="disabled"></div>
<br>
<div><b>Website Name</b> : <input type="text" value="<?=$_SESSION["web_name"];?>" disabled="disabled"></div>
<br>
<div><b>Xat id</b> : <input type="text" value="<?=$_SESSION["xat_id"];?>" disabled="disabled"></div>
<br>
<div><b>Whitelist System</b> : <input type="text" value="<?=$_SESSION["wl_sys"];?>" disabled="disabled"></div>
<br>
</div>
<br>
<div align="right">
<input class="btn btn-success" type="button" value="Home" onclick="mainform.act.value='';mainform.submit();">
<input class="btn btn-success" type="button" value="Next" onclick="mainform.act.value='install4';mainform.submit();"></div>
</div>
<font size="1" color="#b6b6b6">ระบบ install พัฒนาโดย BanK_z</font>
</td>
</tr>
<tr>
<td colspan="6"></td>
</tr>
</table>
</form>
</div>
<br>
</body>
</html>
<?
	exit();
}
if($_POST['act'] == 'install4')
{
	$strFileName = "function/config.php";
	$objFopen = fopen($strFileName, 'w');
	$strText1 = "<?
	// MySQL
		\$Cfg[\"mysql\"][\"host\"] = \"".$_SESSION["host"]."\";
		\$Cfg[\"mysql\"][\"user\"] = \"".$_SESSION["phpm_user"]."\";
		\$Cfg[\"mysql\"][\"pass\"] = \"".$_SESSION["phpm_pass"]."\";
		\$Cfg[\"mysql\"][\"db\"] = \"".$_SESSION["db_name"]."\";
	
	// Website
		\$Cfg[\"web\"][\"name\"] = \"".$_SESSION["web_name"]."\";
		\$Cfg[\"web\"][\"wlsys\"] = \"".$_SESSION["wl_sys"]."\"; //Auto | Manual case sensitive
		\$Cfg[\"web\"][\"xat\"] = \"".$_SESSION["xat_id"]."\";
?>
";
	fwrite($objFopen, $strText1);
	if($objFopen)
	{
		$error = "<b><font color='#339900'>Create config file at 'function/config.php' success.</font></b><br>";
	}
	else
	{
		$error = "<b><font color='#ff0000'>Create config file at 'function/config.php' fail.</font></b><br>";
	}
	fclose($objFopen);
?>
<tr>
<td>
<br>
<div class="hero-unit"><h1><font color="#33ccff">ServerSystem</font> 0.8</h1>
<div style="font-size: 1px;" align="right">by BanK_z & lion328</div></div>
<br>
<div class="well">ขั้นตอนที่ 4 : <b>สร้างไฟล์ config</b>
<br>
<br>
<div>
<?
	echo $error;
?>
กรุณาคลิกปุ่ม Next
</div>
<br>
</div>
<br>
<div align="right">
<input class="btn btn-success" type="button" value="Next" onclick="mainform.act.value='install5';mainform.submit();"></div>
</div>
<font size="1" color="#b6b6b6">ระบบ install พัฒนาโดย BanK_z</font>
</td>
</tr>
<tr>
<td colspan="6"></td>
</tr>
</table>
</form>
</div>
<br>
</body>
</html>
<?
	exit();
}
if($_POST['act'] == 'install5')
{
	require_once("function/func_connect.php");
	$strSQL = "CREATE DATABASE ".$_SESSION["db_name"]."";
	$objQuery = mysql_query($strSQL);
	if($objQuery)
	{
		$error = "<b><font color='#339900'>Create database '".$_SESSION["db_name"]."' success.</font></b><br>";
	}
	else
	{
		$error = "<b><font color='#ff0000'>Create database '".$_SESSION["db_name"]."' fail.</font></b><br>";
	}
?>
<tr>
<td>
<br>
<div class="hero-unit"><h1><font color="#33ccff">ServerSystem</font> 0.8</h1>
<div style="font-size: 1px;" align="right">by BanK_z & lion328</div></div>
<br>
<div class="well">ขั้นตอนที่ 5 : <b>สร้างฐานข้อมูล</b>
<br>
<br>
<div>
<?
	echo $error;
?>
กรุณาคลิกปุ่ม Next
</div>
<br>
</div>
<br>
<div align="right">
<input class="btn btn-success" type="button" value="Next" onclick="mainform.act.value='install6';mainform.submit();"></div>
</div>
<font size="1" color="#b6b6b6">ระบบ install พัฒนาโดย BanK_z</font>
</td>
</tr>
<tr>
<td colspan="6"></td>
</tr>
</table>
</form>
</div>
<br>
</body>
</html>
<?
	exit();
}
if($_POST['act'] == 'install6')
{
	require_once("function/func_connect.php");
	$error = "";
	$count = "0";
	$i = "1";
	if($i == "1")
	{
		$strSQL = 
		"
		CREATE TABLE `authme` (
		`id` int(11) NOT NULL auto_increment,
		`username` varchar(255) NOT NULL,
		`password` varchar(255) NOT NULL,
		`ip` varchar(40) NOT NULL,
		`lastlogin` bigint(20) default NULL,
		`x` smallint(6) default '0',
		`y` smallint(6) default '0',
		`z` smallint(6) default '0',
		`status` varchar(6) default 'member',
		`email` varchar(255) NOT NULL,
		PRIMARY KEY  (`id`),
		UNIQUE KEY `username` (`username`)
		)	
		";
		$objQuery = mysql_query($strSQL);
		if($objQuery)
		{
			$error.= "<b><font color='#339900'>Create table 'authme' success.</font></b><br>";
			$count++;
		}
		if(!$objQuery)
		{
			$error.= "<b><font color='#ff0000'>Create table 'authme' fail.</font></b><br>";
		}
	}
	if($i == "1")
	{
		$strSQL = 
		"
		CREATE TABLE IF NOT EXISTS `iconomy` (
		`id` int(255) NOT NULL auto_increment,
		`username` varchar(32) NOT NULL,
		`balance` double(64,2) NOT NULL,
		`status` int(2) NOT NULL default '0',
		PRIMARY KEY  (`id`),
		UNIQUE KEY `username` (`username`)
		)
		";
		$objQuery = mysql_query($strSQL);
		if($objQuery)
		{
			$error.= "<b><font color='#339900'>Create table 'iconomy' success.</font></b><br>";
			$count++;
		}
		if(!$objQuery)
		{
			$error.= "<b><font color='#ff0000'>Create table 'iconomy' fail.</font></b><br>";
		}
	}
	if($i == "1")
	{
		$strSQL = 
		"
		CREATE TABLE IF NOT EXISTS `money_code` (
		`id` int(5) NOT NULL auto_increment,
		`code` varchar(20) NOT NULL,
		`balance` varchar(255) NOT NULL,
		PRIMARY KEY  (`id`)
		)
		";
		$objQuery = mysql_query($strSQL);
		if($objQuery)
		{
			$error.= "<b><font color='#339900'>Create table 'money_code' success.</font></b><br>";
			$count++;
		}
		if(!$objQuery)
		{
			$error.= "<b><font color='#ff0000'>Create table 'money_code' fail.</font></b><br>";
		}
	}
	if($i == "1")
	{
		$strSQL = 
		"
		CREATE TABLE IF NOT EXISTS `unapprove` (
		`id` int(5) NOT NULL auto_increment,
		`username` varchar(255) NOT NULL,
		`password` varchar(255) NOT NULL,
		`email` varchar(255) NOT NULL,
		`reason` varchar(500) NOT NULL,
		PRIMARY KEY  (`id`)
		)
		";
		$objQuery = mysql_query($strSQL);
		if($objQuery)
		{
			$error.= "<b><font color='#339900'>Create table 'unapprove' success.</font></b><br>";
			$count++;
		}
		if(!$objQuery)
		{
			$error.= "<b><font color='#ff0000'>Create table 'unapprove' fail.</font></b><br>";
		}
	}
	if($i == "1")
	{
		$strSQL = 
		"
		CREATE TABLE IF NOT EXISTS `announce` (
		`id` int(3) NOT NULL auto_increment,
		`announce` varchar(500) NOT NULL,
		`announcer` varchar(20) NOT NULL,
		`date` DATETIME NOT NULL,
		PRIMARY KEY  (`id`)
		)
		";
		$objQuery = mysql_query($strSQL);
		if($objQuery)
		{
			$error.= "<b><font color='#339900'>Create table 'announce' success.</font></b><br>";
			$count++;
		}
		if(!$objQuery)
		{
			$error.= "<b><font color='#ff0000'>Create table 'announce' fail.</font></b><br>";
		}
	}
	if($i == "1")
	{
		$strSQL = 
		"
		CREATE TABLE IF NOT EXISTS `mail` (
		`id` int(10) NOT NULL auto_increment,
		`header` varchar(50) collate utf8_unicode_ci NOT NULL,
		`mailinfo` varchar(500) collate utf8_unicode_ci NOT NULL,
		`sender` varchar(20) collate utf8_unicode_ci NOT NULL,
		`receiver` varchar(20) collate utf8_unicode_ci NOT NULL,
		`date` varchar(20) collate utf8_unicode_ci NOT NULL,
		PRIMARY KEY  (`id`)
		)
		";
		$objQuery = mysql_query($strSQL);
		if($objQuery)
		{
			$error.= "<b><font color='#339900'>Create table 'mail' success.</font></b><br>";
			$count++;
		}
		if(!$objQuery)
		{
			$error.= "<b><font color='#ff0000'>Create table 'mail' fail.</font></b><br>";
		}
	}
	if($i == "1")
	{
		$password = hashPassword($_SESSION['adm_pass']);
		$strSQL = "INSERT INTO authme (id,username,password,status) VALUES ('0','".$_SESSION['adm_user']."','".$password."','admin')";
		$objQuery = mysql_query($strSQL);
		if($objQuery)
		{
			$error.= "<b><font color='#339900'>Create admin username '".$_SESSION['adm_user']."' success.</font></b><br>";
			$count++;
		}
		if(!$objQuery)
		{
			$error.= "<b><font color='#ff0000'>Create admin username '".$_SESSION['adm_user']."' fail.</font></b><br>";
		}
	}
	if($i == "1")
	{
		$strSQL = "INSERT INTO iconomy (id,username,balance,status) VALUES ('0','".$_SESSION['adm_user']."','30','0')";
		$objQuery = mysql_query($strSQL);
		if($objQuery)
		{
			$error.= "<b><font color='#339900'>Create admin account '".$_SESSION['adm_user']."' success.</font></b><br>";
			$count++;
		}
		if(!$objQuery)
		{
			$error.= "<b><font color='#ff0000'>Create admin account '".$_SESSION['adm_user']."' fail.</font></b><br>";
		}
	}
	if($i == "1")
	{
		$error.= "<b>Complete <font color='#00ccff'>$count<font color='#000000'>/</font>8</font> processes</b><br>";
	}
	if($count == '8')
	{
		$error.= "<b><font color='#339900'>Installation Complete</font> <a href='login.php'><font color='#00ccff'>Login</font></b></a><br>";
	}
	if($count < '8')
	{
		$error.= "<b><font color='#ff0000'>Installation fail.</font></b><br>";
	}
	if(!$objQuery)
	{
		$error = "<b><font color='#ff0000'>Installation fail.</font></b><br>";
	}
?>
<tr>
<td>
<br>
<div class="hero-unit"><h1><font color="#33ccff">ServerSystem</font> 0.8</h1>
<div style="font-size: 1px;" align="right">by BanK_z & lion328</div></div>
<br>
<div class="well">ขั้นตอนที่ 6 : <b>สร้างตาราง</b>
<br>
<br>
<div>
<?
	echo $error;
	fopen(installed, 'w');
?>
จบการติดตั้ง
</div>
<br>
</div>
<br>
<div align="right">
<input class="btn btn-success" type="button" value="End" onclick="window.location='login.php'"></div>
</div>
<font size="1" color="#b6b6b6">ระบบ install พัฒนาโดย BanK_z</font>
</td>
</tr>
<tr>
<td colspan="6"></td>
</tr>
</table>
</form>
</div>
<br>
</body>
</html>
<?
	exit();
}
?>
