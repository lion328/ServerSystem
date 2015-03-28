<?
session_start();
require_once("function/func_connect.php");
require_once("function/func_static.php");
pageperm("normal");
head("buy");
?>
<?
if(isset($_POST['act']) && $_POST['act'] == 'buy')
{
	if(!isset($_POST["bal"]) || $_POST["bal"] == "")
	{
		$error = redBox("Plese input balance you want to buy.");
	}
	if($_POST["bal"] == "0")
	{
		$error = redBox("You can't buy 0 dollars code.");
	}
	//thanks function randomToken code from webthaidd.com :)
	function codeGenerate($length)
	{ 
		srand(date("s")); 
		$chars = "abcdefghigklmnopqrstuvwxyz123456789"; 
		$ret_str = ""; 
		$num = strlen($chars); 
		for($i=0;$i<$length;$i++)
		{ 
			$ret_str.= $chars[rand()%$num];
		} 
		return $ret_str; 
	}
	$code = codeGenerate(15);
	$strSQL = "SELECT * FROM money_code WHERE code = '$code'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	$strSQL2 = "SELECT * FROM iconomy WHERE username = '".$_SESSION["username"]."'";
	$objQuery2 = mysql_query($strSQL2);
	$objResult2 = mysql_fetch_array($objQuery2);
	if($objResult2["balance"] < $_POST["bal"])
	{
		$error = redBox("You don't have enough money to buy this balance code");
	}
	if($objResult)
	{
		$error = redBox("Plese try again later.");
	}
	if($error != "")
	{
		echo "<tr><td>";
		echo $error;
		echo "</td></tr></table>";
		exit();
	}
	if(!$objResult)
	{
		$rem_point = $objResult2["balance"] - $_POST["bal"];
		$strSQL = "INSERT INTO money_code (id,code,balance) VALUES ('0','$code','".$_POST["bal"]."')";
		$objQuery = mysql_query($strSQL);
		if($objQuery)
		{
			$strSQL = "UPDATE iconomy SET balance = '$rem_point' WHERE username = '".$_SESSION["username"]."'";
			$objQuery = mysql_query($strSQL);
			$_SESSION["money"] = $rem_point;
			if($objQuery)
			{
				$error = "<font color='#339900'>Code buy success.</font>";
				$error.= "<br>Your buy code by using username [<font color='#33ccff'>".$_SESSION["username"]."</font>]";
				$error.= "<br>Your code is [<font color='#33ccff'>$code</font>]";
				$error.= "<br>Your code balance is : [<font color='#33ccff'>".$_POST["bal"]."</font>] Dollar(s)";
				$error.= "<br>Your remaining point is : [<font color='#33ccff'>$rem_point</font>] Dollar(s)";
				$error.= "<br><font color='#339900'>Plese keep your code safe. If you lost it we won't responsible.</font><br><br><div class='controls' align='right'><input type='button' class='btn btn-success' value='OK' onclick=\"window.location='".$page."'\"></div>";
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
			echo "</td></tr></table>";
			exit();
		}
	}
}
?>
<tr height="50">
<td align="center">Balance :</td>
<td align="center"><input type="text" name="bal"></td>
<td align="center"><input class="btn btn-success" type="submit" value="Done" onclick="mainform.act.value='buy';mainform.submit();"></td>
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