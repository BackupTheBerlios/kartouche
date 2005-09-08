<?

include("kartouche/config.php");
include("includes/fns.php");

include("includes/trans.php");
include("includes/header.php");

echo "<div class=\"content\">";

include("includes/hallfame_pref.php");

echo "
        <table>
                <tr>
						<td width=\"20%\"><h3>$nick</h3></td>
						<td width=\"10%\"><h3>$total_acc</h3></td>
                        <td width=\"30%\"><h3>$files</h3></h3></td>
                        <td width=\"10%\"><h3>$sub_total</h3></td>
						<td width=\"30%\"><h3>$strings</h3></td>
                </tr>
        </table>
                ";

dbconnect();

$sql="select handle, count(handle) as accepted
	from admin_hallfame
	group by handle
	order by accepted desc,handle";
$result=mysql_query($sql) or die($kerr13);

while ($row=mysql_fetch_object($result))
{

$handle=$row->handle;
$g_accepted+=$row->accepted;

if ($handle==''){$handle="Kartouche";}

echo "
        <table>
		<tr bgcolor=\"#ffbbff\">
			<td width=\"20%\">$handle</td>
			<td width=\"10%\">$row->accepted</td>
			<td width=\"70%\" colspan=\"3\">&nbsp;</td>
		</tr>
        ";


		$sql2="select file, count(string) as total
			from admin_hallfame
			where handle='$handle'
			group by file";
		$result2=mysql_query($sql2) or die($kerr12);
		while ($row2=mysql_fetch_object($result2))
		{

		$file=$row2->file;

		if ($file=='') {$file=$unspec;}

			echo "
				<tr>
					<td width=\"30%\" colspan=\"2\">&nbsp;</td>
					<td width=\"30%\">$file</td>
					<td width=\"10%\">$row2->total</td>
					<td width=\"30%\">
				";

				$sql3="select string
					from admin_hallfame
					where handle='$handle'
					and file='$file'";
				$result3=mysql_query($sql3) or die($kerr14);
				while ($row3=mysql_fetch_object($result3))
    			{

					$string=$row3->string;

					if ($string=='0')
					{
						echo "";
					}
					else
					{
						echo "$row3->string, ";
					}

				}

			echo "</td></tr>";

		}

}

echo "<tr><td colspan=\"5\">&nbsp;</td></tr>
	<tr><td colspan=\"5\">".$cont_rec." ".$g_accepted."</td></tr>
	</table>";

echo "<table><tr><td>&nbsp;</td></tr>
	<tr><td id=\"crumbs\">";
include("includes/navbar.php");
echo "</td></tr></table></div>";

include("includes/footer.php");

?>
