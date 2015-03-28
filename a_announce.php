<?
session_start();
require_once("function/func_connect.php");
require_once("function/func_static.php");
pageperm("admin");
head("a_announce");
?>
<?
$date = date("Y-m-d H:i:s");
if(isset($_POST['act']) && $_POST["act"] == "add")
{
	$strSQL = "INSERT INTO announce (id,announce,announcer,date) VALUES ('0','".$_POST["add_announce"]."','".$_SESSION["username"]."','".$date."')";
	$objQuery = mysql_query($strSQL);
	$error = greenBox("Announce added.","0");
}
if(isset($_POST['act']) && $_POST["act"] == "update")
{
	$strSQL = "UPDATE announce SET announce = '".$_POST["edit_announce"]."',announcer = '".$_SESSION["username"]."',date = '".$date."' WHERE id = '".$_POST["edit_id"]."'";
	$objQuery = mysql_query($strSQL);
	$error = greenBox("Announce edited.","0");
}
if(isset($_POST['act']) && $_POST["act"] == "delete")
{
	$strSQL = "DELETE FROM announce WHERE id = '".$_POST["subact"]."'";
	$objQuery = mysql_query($strSQL);
	$error = greenBox("Announce deleted.","0");
}
if($error != "")
{
	echo "<td>";
	echo $error;
	echo "</td></tr></table>";
	exit();
}
$strSQL = "SELECT * FROM announce ORDER BY id";
$objQuery = mysql_query($strSQL);
$Num_Rows = mysql_num_rows($objQuery);
?>
<tr height="30">
<th width="40">ID</th>
<th width="200">Announce info</th>
<th>Announcer</th>
<th width="10">Date</th>
<th width="10">Options</th>
</tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
	if($objResult["id"] == $_POST["subact"] and $_POST["act"] == "edit")
	{
  ?>
<!--editing table-->
<tr height="20">
<td align="center"><?echo $objResult["id"];?><input type="hidden" name="edit_id" value="<?=$objResult["id"];?>"></td>
<td><textarea name="edit_announce"><?=$objResult["announce"];?></textarea></td>
<td align="center"><?echo $_SESSION["username"];?></td>
<td><?echo $date;?></td>
<td align="center">
<input class="btn btn-success" name="edit_update" type="button" value="Update" onclick="javascript:mainform.act.value='update';mainform.submit();">
<input class="btn btn-danger" name="edit_cancel" type="button" value="Cancel" onclick="javascript:window.location='a_announce.php';">
</td>
</tr>
<?
	}
	else
	{
?>
<!--normal table-->
<tr height="20">
<td align="center"><?=$objResult["id"];?></td>
<td><?=$objResult["announce"];?></td>
<td align="center"><?=$objResult["announcer"];?></td>
<td align="center"><?=$objResult["date"];?></td>
<td align="center">
<input class="btn btn-warning" name="norm_edit" type="button" value="Edit" onclick="javascript:mainform.act.value='edit';mainform.subact.value='<?=$objResult["id"];?>';mainform.submit();">
<input class="btn btn-danger" name="norm_delete" type="button" value="Delete" onclick="javascript:mainform.act.value='delete';mainform.subact.value='<?=$objResult["id"];?>';mainform.submit();">
</td>
</tr>
<?
	}
}
?>
<tr height="100">
<td></td>
<td align="center"><textarea name="add_announce" onclick="this.value='';">Add new announcement. Type your announce information here...</textarea></td>
<td align="center"><?=$_SESSION["username"];?></td>
<td align="center"><?=$date?></td>
<td colspan="2" align="center"><input class="btn btn-success" name="btnAdd" type="button" value="Add" onclick="javascript:mainform.act.value='add';mainform.submit();"></td>
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