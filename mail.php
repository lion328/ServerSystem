<?
session_start();
require_once("function/func_connect.php");
require_once("function/func_static.php");
pageperm("normal");
head("mail");
?>
<?
$date = date("Y-m-d H:i:s");
/*recieved page*/
if($_POST["page"] == "recv")
{
?>
<tr height="40">
<td align="center" colspan="4">[ Received Mail ]</td>
</tr>
<tr height="30">
<th>Mail ID</th>
<th>Header</th>
<th>Sender</th>
<th>Date</th>
</tr>
<?
	$strSQL = "SELECT * FROM mail WHERE receiver = '".$_SESSION['username']."'";
	$objQuery = mysql_query($strSQL);
	while($objResult = mysql_fetch_array($objQuery))
	{
?>
<tr height="20" align="center">
<td><?=$objResult['id'];?></td>
<td><a onclick="mainform.act.value='read';mainform.sub_act.value='<?=$objResult['id'];?>';mainform.submit();"><?=$objResult['header'];?></a></td>
<td><?=$objResult['sender'];?></td>
<td><?=$objResult['date'];?></td>
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
<?
	exit();
}
/*send new mail page*/
if($_POST["page"] == "send")
{
?>
<tr height="40">
<td align="center" colspan="4">[ Send New Mail ]</td>
</tr>
<tr height="50">
<td colspan="3"><label class="control-label">Mail Header :</label><div class="controls"><input type="text" name="send_header"></div>
<br>
<label class="control-label">To :</label><div class="controls"><input type="text" name="send_receiver"></div>
<br>
<label class="control-label">Mail info :</label><div class="controls"><textarea class="input-xlarge" name="send_mailinfo" rows="10" cols="50"></textarea></div>
</td>
</tr>
<tr>
<td height="50" colspan="3" align="right"><input class="btn btn-success" type="button" value="Send" onclick="mainform.act.value='send';mainform.submit();">&nbsp;&nbsp;<input class="btn btn-danger" type="button" value="Cancel" onclick="window.location='mail.php';"></td>
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
/*mail sent list page*/
if($_POST["page"] == "sentlst")
{
?>
<tr height="40">
<td align="center" colspan="4">[ Mail Sent List ]</td>
</tr>
<tr height="30">
<th>Mail ID</th>
<th>Header</th>
<th>Receiver</th>
<th>Date</th>
</tr>
<?
	$strSQL = "SELECT * FROM mail WHERE sender = '".$_SESSION['username']."'";
	$objQuery = mysql_query($strSQL);
	while($objResult = mysql_fetch_array($objQuery))
	{
?>
<tr height="20" align="center">
<td><?=$objResult['id'];?></td>
<td><a onclick="mainform.act.value='read';mainform.subact.value='<?=$objResult['id'];?>';mainform.submit();"><?=$objResult['header'];?></a></td>
<td><?=$objResult['receiver'];?></td>
<td><?=$objResult['date'];?></td>
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
<?
	exit();
}
/*action read mail*/
if($_POST["act"] == "read")
{
	$strSQL = "SELECT * FROM mail WHERE id = '".$_POST['subact']."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
		$error = redBox("Can't find that mail");
		if($error != "")
		{
			echo "<tr><td align='center'>";
			echo $error;
			echo "</td></tr></table>";
			exit();
		}
	}
	else
	{
?>
<tr height="40">
<td align="center" colspan="3">[ Read Mail ]</td>
</tr>
<tr height="100">
<td>
Mail Header : <?=$objResult['header'];?>
<br>
From : <?=$objResult['sender'];?>
<br>
To : <?=$objResult['receiver'];?>
<br>
Sent Date : <?=$objResult['date'];?>
<br>
Mail info : 
<br><br><div class="well"><?=$objResult['mailinfo'];?></div>
</td>
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
<?
	exit();
}
/*action send mail*/
if($_POST["act"] == "send")
{
	$strSQL = "INSERT INTO mail (header,mailinfo,sender,receiver,date) VALUES ('".$_POST['send_header']."','".$_POST['send_mailinfo']."','".$_SESSION['username']."','".$_POST['send_receiver']."','".$date."')";
	$objQuery = mysql_query($strSQL);
	if($objQuery)
	{
		$error = greenBox("Mail sent.","0");
	}
}
if($error != "")
{
	echo "<tr><td>";
	echo $error;
	echo "</td></tr></table>";
	exit();
}
?>
<tr height="50">
<td align="center"><input class="btn btn-large" type="button" value="Received Mail" onClick="mainform.page.value='recv';mainform.submit();"></td>
<td align="center"><input class="btn btn-large" type="button" value="Send New Mail" onClick="mainform.page.value='send';mainform.submit();"></td>
<td align="center"><input class="btn btn-large" type="button" value="Mail Sent List" onClick="mainform.page.value='sentlst';mainform.submit();"></td>
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