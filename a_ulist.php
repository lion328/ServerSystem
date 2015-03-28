<?
session_start();
require_once("function/func_connect.php");
require_once("function/func_static.php");
pageperm("admin");
head("a_ulist");
?>
<?
if(isset($_POST['act']) && $_POST['act'] == "delete")
{
	if($_POST["subact"] == "1")
	{
		$error = redBox("You cannot delete this account.");
	}
	if($error != "")
	{
		echo "<tr><td>";
		echo $error;
		echo "</td></tr></table>";
		exit();
	}
	$strSQL1 = "SELECT * FROM authme WHERE id = '".$_POST["subact"]."'";
	$objQuery1 = mysql_query($strSQL1);
	$objResult1 = mysql_fetch_array($objQuery1);
	if($objResult1['status'] == "admin")
	{
		$error = redBox("You cannot delete admin account.");
	}
	if($error != "")
	{
		echo "<tr><td>";
		echo $error;
		echo "</td></tr></table>";
		exit();
	}
	if($objResult1)
	{
		if($_POST['act'] == "delete")
		{
			$strSQL = "DELETE FROM authme WHERE username = '".$objResult1['username']."'";
			$objQuery = mysql_query($strSQL);
			if($objQuery)
			{
				$strSQL = "DELETE FROM iconomy WHERE username = '".$objResult1['username']."'";
				$objQuery = mysql_query($strSQL);
				if($objQuery)
				{
					$error = greenBox("Username ".$objResult1['username']." deleted.","0");
					echo "<tr><td>";
					echo $error;
					echo "</td></tr></table>";
					exit();
				}
			}
		}
	}
}
if(isset($_POST['act']))
{
	$strSQL1 = "SELECT * FROM authme WHERE id = '".$_POST["subact"]."'";
	$objQuery1 = mysql_query($strSQL1);
	$objResult1 = mysql_fetch_array($objQuery1);
	if($objResult1)
	{
		if($_POST['act'] == "editsend")
		{
			$strSQL = "UPDATE iconomy SET balance = '".$_POST["balance"]."' WHERE id = '".$_POST["subact"]."'";
			$objQuery = mysql_query($strSQL);
			$strSQL2 = "UPDATE authme SET status = '".$_POST["status"]."' WHERE id = '".$_POST["subact"]."'";
			$objQuery2 = mysql_query($strSQL2);
			if($objQuery and $objQuery2)
			{
				$error = greenBox("Change username ".$objResult1['username']." info success.","0");
				echo "<tr><td>";
				echo $error;
				echo "</td></tr></table>";
				exit();
			}
		}
		if($_POST['act'] == "delete" && $_POST["subact"] != "1")
		{
			$strSQL = "DELETE FROM authme WHERE username = '".$objResult1['username']."'";
			$objQuery = mysql_query($strSQL);
			if($objQuery)
			{
				$strSQL = "DELETE FROM iconomy WHERE username = '".$objResult1['username']."'";
				$objQuery = mysql_query($strSQL);
				if($objQuery)
				{
					$error = greenBox("Username ".$objResult1['username']." deleted.","0");
					echo "<tr><td>";
					echo $error;
					echo "</td></tr></table>";
					exit();
				}
			}
		}
	}
}
?>
<?
$strSQL = "SELECT * FROM authme";
$objQuery = mysql_query($strSQL);
$strSQL2 = "SELECT * FROM iconomy";
$objQuery2 = mysql_query($strSQL2);
?>
<tr height="30">
<th width="40">ID</th>
<th>Username</th>
<th>Balance</th>
<th>Status</th>
<th>Action</th>
</tr>
<?
while($objResult = mysql_fetch_array($objQuery) and $objResult2 = mysql_fetch_array($objQuery2))
{
	if($objResult["id"] == $_POST["subact"] and $_POST["act"] == "edit")
	{
?>
<!--editing table-->
<tr>
<td height="20" align="center"><?=$objResult["id"];?></td>
<td><?=$objResult["username"];?></td>
<td><input type="text" name="balance"></td>
<td align="center">
<select class="input-small" name="status">
<?
	if($objResult["status"] == "admin")
	{
		$oppo_status = "member";
	}
	if($objResult["status"] == "member")
	{
		$oppo_status = "admin";
	}
?>
<option value="<?=$objResult["status"];?>" selected><?=$objResult["status"];?></option>
<option value="<?=$oppo_status;?>"><?=$oppo_status;?></option>
</select>
</td>
<td align="center"><input class="btn btn-success" type="button" value="OK" onclick="mainform.act.value='editsend';mainform.subact.value='<?=$objResult["id"];?>';mainform.submit();"></td>
<td align="center"><input class="btn btn-warning" type="button" value="Cancel" onclick="window.location='a_ulist.php'"></td>
</tr>
<?
	}
	else
	{
?>
<!--normal table-->
<tr>
<td height="20" align="center"><?=$objResult["id"];?></td>
<td><?=$objResult["username"];?></td>
<td><?=$objResult2["balance"];?></td>
<td align="center"><?=$objResult["status"];?></td>
<td align="center">
<input class="btn btn-warning" type="button" value="edit" onclick="mainform.act.value='edit';mainform.subact.value='<?=$objResult["id"];?>';mainform.submit();">
<input class="btn btn-danger" type="button" value="delete" onclick="mainform.act.value='delete';mainform.subact.value='<?=$objResult["id"];?>';mainform.submit();">
</td>
</tr>
<?
	}
}
?>
<tr>
<td colspan="6"></td>
</tr>
</table>
</form>
</div>
<br>
</body>
</html>