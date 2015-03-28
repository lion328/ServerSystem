<?
session_start();
require_once("function/func_connect.php");
require_once("function/func_static.php");
pageperm("normal");
head("changepw");
?>
<?
if(isset($_POST['act']) && $_POST['act'] == 'changepw')
{
	if(!isset($_POST['old_pass']) || $_POST['old_pass'] == "")
	{
		$error = redBox("Plese input your old password box.");
	}
	if(!isset($_POST['old_pass']) || checkPassword($_SESSION["username"],$_POST["old_pass"]) == false)
	{
		$error = redBox("Your old password is incorrect.");
	}
	if(!isset($_POST['chng_pass']) || $_POST['chng_pass'] == "")
	{
		$error = redBox("Plese input your new password.");
	}
	if(!isset($_POST['chng_pass']) || strlen($_POST['chng_pass']) > "20")
	{
		$error = redBox("Your password is too long.");
	}
	if(!isset($_POST['chng_con_pass']) ||$_POST['chng_con_pass'] == "")
	{
		$error = redBox("Plese input your confirm password box.");
	}
	if(!isset($_POST['chng_pass']) || !isset($_POST['chng_con_pass']) || $_POST['chng_pass'] != $_POST['chng_con_pass'])
	{
		$error = redBox("Plese input your password as same as confirm password box.");
	}
	$strSQL = "SELECT * FROM authme WHERE id = '".$_SESSION["id"]."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if($error != "")
	{
		echo "<tr><td>";
		echo $error;
		echo "</td></tr></table>";
		exit();
	}
	if($objResult)
	{
		$passowrd = hashPassword($_POST['chng_pass']);
		$strSQL = "UPDATE authme SET password = '".$passowrd."' WHERE id = '".$_SESSION["id"]."'";
		$objQuery = mysql_query($strSQL);
		$error = greenBox("Change password success.","index.php");
		echo "<tr><td>";
		echo $error;
		echo "</td></tr></table>";
		exit();
	}
}
?>
<tr height="50">
<td width="170"><b>Username</b> : </td><td><?echo $_SESSION["username"];?></td>
</tr>
<tr height="50">
<td><b>Old Password</b> : </td><td><input type="password" name="old_pass"></td>
</tr>
<tr height="50">
<td><b>New Password</b> : </td><td><input type="password" name="chng_pass"></td>
</tr>
<tr height="50">
<td><b>Confirm New Password</b> : </td><td><input type="password" name="chng_con_pass"></td>
</tr>
<tr height="50">
<td colspan="6" align="right"><input class="btn btn-success" type="submit" value="Done" onclick="mainform.act.value='changepw';mainform.submit();"></td>
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