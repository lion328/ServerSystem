<?
session_start();
require_once("function/func_connect.php");
require_once("function/func_static.php");
pageperm("normal");
head("info");
?>
<tr height="40">
<td><b>Username</b> : <?echo $_SESSION["username"];?></td>
</tr>
<tr height="40">
<td><b>Member ID</b> : <?echo $_SESSION["id"];?></td>
</tr>
<tr height="40">
<td><b>Status</b> : <?echo $_SESSION["status"];?></td>
</tr>
<tr height="40">
<td><b>Money</b> : <?echo $_SESSION["money"];?></td>
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
