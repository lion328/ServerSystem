<?
session_start();
require_once("function/config.php");
require_once("function/func_connect.php");
require_once("function/func_static.php");
pageperm("admin");
head("a_approve");
?>
<?
if($Cfg["web"]["wlsys"] == "Auto")
{
	$error = redBox("Your whitelist system is \"auto\", You don't need to approve users.");
	echo "<tr><td>";
	echo $error;
	echo "</tr></td></table>";
	exit();
}
if(isset($_POST['act']))
{
	$strSQL1 = "SELECT * FROM unapprove WHERE id = '".$_POST['subact']."'";
	$objQuery1 = mysql_query($strSQL1);
	$objResult1 = mysql_fetch_array($objQuery1);
	$strSQL2 = "SELECT * FROM authme WHERE username = '".$objResult1["username"]."'";
	$objQuery2 = mysql_query($strSQL2);
	$objResult2 = mysql_fetch_array($objQuery2);
	if(!$objResult1 or $objResult2)
	{
		$error = redBox('This username has already aprrove.');
	}
	if($error != "")
	{
		echo "<tr><td>";
		echo $error;
		echo "</td></tr></table>";
		exit();
	}
	if($objResult1 and !$objResult2)
	{
		if($_POST['act'] == "approve")
		{
			$strSQL = "INSERT INTO authme (id,username,password,status,email) VALUES ('0','".$objResult1['username']."','".$objResult1['password']."','member','".$objResult1['email']."')";
			$objQuery = mysql_query($strSQL);
			if($objQuery)
			{
				$strSQL = "INSERT INTO iconomy (username,balance,status) VALUES ('".$objResult1['username']."','30','0')";
				$objQuery = mysql_query($strSQL);
				if($objQuery)
				{
					$strSQL = "DELETE FROM unapprove WHERE id = '".$_POST['subact']."'";
					$objQuery = mysql_query($strSQL);
					if($objQuery)
					{
						$strSQL = "DELETE FROM unapprove WHERE id = '".$_POST['subact']."'";
						$objQuery = mysql_query($strSQL);
						if($objQuery)
						{
							$error = greenBox("Username ".$objResult1['username']." approved.","0");
							echo "<tr><td>";
							echo $error;
							echo "</td></tr></table>";
							exit();
						}
					}
				}
			}
		}
		if($_POST['act'] == "ignore")
		{
			$strSQL = "DELETE FROM unapprove WHERE id = '".$_POST['subact']."'";
			$objQuery = mysql_query($strSQL);
			$error = greenBox("Username ".$objResult1['username']." ignored.","0");
			echo "<td>";
			echo $error;
			echo "</tr></td></table>";
			exit();
		}
	}
}
?>
<?
$strSQL = "SELECT * FROM unapprove ORDER BY id";
$objQuery = mysql_query($strSQL);
$Num_Rows = mysql_num_rows($objQuery);
?>
<tr height="30">
<th width="40">ID</th>
<th width="150">Username</th>
<th width="150">Email</th>
<th>Reason</th>
<th colspan="2">Action</th>
</tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
?>
<tr height="20">
<td align="center"><?=$objResult["id"];?></td>
<td align="center"><?=$objResult["username"];?></td>
<td align="center"><?=$objResult["email"];?></td>
<td align="center"><a onclick="alert('<?=$objResult["reason"];?>');">Click to view</a></td>
<td align="center"><input class="btn btn-success" type="button" value="approve" onclick="mainform.act.value='approve';mainform.subact.value='<?=$objResult["id"];?>';mainform.submit();"></td>
<td align="center"><input class="btn btn-danger" type="button" value="ignore" onclick="mainform.act.value='ignore';mainform.subact.value='<?=$objResult["id"];?>';mainform.submit();"></td>
</tr>
<?
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