<?
session_start();
require_once("function/func_connect.php");
require_once("function/func_static.php");
pageperm("normal");
head("refill");
?>
<?
if(isset($_POST['act']) && $_POST['act'] == 'refill')
{
	if(!isset($_POST['code']) || $_POST["code"] == "")
	{
		$error = redBox("Plese input your code.");
	}
	$code = trim($_POST["code"]);
	$strSQL = "SELECT * FROM iconomy WHERE username = '".$_SESSION["username"]."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	$strSQL2 = "SELECT * FROM money_code WHERE code = '$code'";
	$objQuery2 = mysql_query($strSQL2);
	$objResult2 = mysql_fetch_array($objQuery2);
	if(!$objResult or !$objResult2)
	{
		$error = redBox("Your infomation is doesn't right or code has been use.");
	}
	if($error != "")
	{
		echo "<tr><td>";
		echo $error;
		echo "</td></tr></table>";
		exit();
	}
	if($objResult && $objResult2)
	{
		$rem_point = $objResult["balance"] + $objResult2["balance"];
		$strSQL = "UPDATE iconomy SET balance = '$rem_point' WHERE username = '".$_SESSION["username"]."'";
		$objQuery = mysql_query($strSQL);
		$_SESSION["money"] = $rem_point;
		if($objQuery)
		{
			$strSQL = "DELETE FROM money_code WHERE code = '".$code."'";
			$objQuery = mysql_query($strSQL);
			if($objQuery)
			{
				$error = greenBox("Refill success.","0");
				echo "<tr><td>";
				echo $error;
				echo "</td></tr></table>";
				exit();
			}
		}
	}
}
?>
<tr height="50">
<td align="center">Code :</td>
<td align="center"><input type="text" name="code"></td>
<td align="center"><input class="btn btn-success" type="submit" value="Done" onclick="mainform.act.value='refill';mainform.submit();"></td>
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