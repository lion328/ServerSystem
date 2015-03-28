<?
if(!file_exists("installed"))
{
	header("location:install.php");
}
session_start();
require_once("function/func_connect.php");
require_once("function/func_static.php");
pageperm("normal");
head("index");
?>
<tr>
<td align="center">
<?
if($Cfg["web"]["xat"] == "")
{
	echo "Please enter your xat id at config.php file.";
	exit();
}
else
{
?>
<embed src="http://www.xatech.com/web_gear/chat/chat.swf" quality="high" width="500" height="350" FlashVars="id=<?=$Cfg["web"]["xat"]?>" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://xat.com/update_flash.shtml">
<?}
?>
</td>
</tr>
<td colspan="6"></td>
</tr>
</table>
</form>
</div>
<br>
</body>
</html>