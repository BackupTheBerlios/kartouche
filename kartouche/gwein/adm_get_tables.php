<?

include("kartouche/config.php");
include("../includes/fns.php");
include("../includes/trans.php");
include("../includes/header.php");

checklg($lg);

if (isset($view))
                {
                $view=$view;
                }
                else
                {
                $view=$all;
                }

echo "<div class=\"content\">";

include("includes/adm_get_table_pref.php");

// pretty amazingly (well, *I* thought it was amazing!), PHP allows you to use the decision
// strings in either language, provided you use a variable (which is translated to the
// relevant language in the appropriate trans_lg.txt file)

// Unfortunately, the code below leads to a "lag" - the address bar shows the original view that
// the page was called with, even though you may go on to change that view using the radio buttons.
// Likewise, the English term for the view persists if you switch to Welsh, until you use the
// radio buttons in Welsh to change the view (and that then persists if you switch to English,
// until you use the radio buttons) - not ideal, but not a showstopper.

echo "
		<table>
		<form action=\"adm_get_tables.php?lg=$lg&view=$view\" method=\"POST\">
        <tr>
			<td><input type=\"radio\" name=\"view\" value=$all> $all_view</td>
		</tr>
		<tr>
			<td><input type=\"radio\" name=\"view\" value=$empty> $empty_view</td>
		</tr>
		<tr>
			<td><input type=\"radio\" name=\"view\" value=$sugg> $sugg_view</td>
		</tr>
		<tr>
			<td><input type=\"radio\" name=\"view\" value=$done> $done_view</td>
		</tr>
		<tr>
			<td><input type=\"submit\" name=\"submit\" value=\"$change_view\"> $curr_view \"$view\"<td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
       	</form>
		</table>

		<table border=\"0\" width=\"600\">

		<tr>
                <td width=\"200\" id=\"crumbs\"><h3>".$filename."</h3></td>
                <td width=\"50\" align=\"right\" id=\"crumbs\"><h3>".$total_str."</h3></td>
                <td width=\"200\" align=\"right\" id=\"crumbs\"><h3>&nbsp;</h3></td>
                <td width=\"100\" align=\"right\" id=\"crumbs\"><h3>".$percent_tr."</h3></td>
                <td width=\"100\" align=\"right\" id=\"crumbs\"><h3>".$sugg_no."</h3></td>
        </tr>

        ";

dbconnect();

$i=0;

$result=mysql_list_tables(DBNAME) or die($kerr8);

while ($i<mysql_num_rows($result))
{
$bgcolor=(++$n&1) ? "#ffccff" : "#ffbbff";
        {

        $db_table=mysql_tablename($result,$i);

         if (ereg("^admin_",$db_table))
                {
                $i++;
                }
                else
                {

                $sql2="select count(*) as total from $db_table";
                $result2=mysql_query($sql2) or die($kerr9);
                $row2=mysql_fetch_object($result2);
                $total=$row2->total;
                $g_total += $total; // added to give grand total of all strings
        
                $sql3="select count(*) as untrans from $db_table where msgstr=\"\"";
                $result3=mysql_query($sql3) or die($kerr10);
                $row3=mysql_fetch_object($result3);
                $untrans=$row3->untrans;
                $g_untrans += $untrans; // added to give grand total of all untranslated strings

                $sql4="select count(*) as sugg_no from $db_table where suggestion!=\"\"";
                $result4=mysql_query($sql4) or die($kerr11);
                $row4=mysql_fetch_object($result4);
                $sugg_no=$row4->sugg_no;
                $g_sugg_no += $sugg_no; // added to give grand total of all suggestions made
        
                $trans=rounded(($total-$untrans)/$total*100,0)."%";
        
                echo "
                        <tr bgcolor=$bgcolor>
                                <td><a href=edit_sugg.php?lg=$lg&view=$view&db_table=$db_table&total=$total>$db_table</a></td>
                                <td align=\"right\">$total</td>
                                <td align=\"right\"><img border=\"0\" height=\"10\" src=\"../makebar.php?trans=$trans\" width=\"200\"></td>
                                <td align=\"right\">$trans</td>
                                <td align=\"right\">$sugg_no</td>
                        </tr>
                        ";

                $i++;
        
                }
         }
}

$g_trans=rounded(($g_total-$g_untrans)/$g_total*100,0)."%";

echo "
		<tr>
                <td id=\"crumbs\"><h3>Grand total:</h3></td>
                <td align=\"right\"  id=\"crumbs\">$g_total</td>
                <td align=\"right\"  id=\"crumbs\">&nbsp;</td>
                <td align=\"right\"  id=\"crumbs\">$g_trans</td>
                <td align=\"right\"  id=\"crumbs\">$g_sugg_no</td>
        </tr>

        </table>";

echo "<table><tr><td id=\"crumbs\">";
include("includes/navbar.php");
echo "</td></tr></table></div>";

include("../includes/footer.php");

?>
