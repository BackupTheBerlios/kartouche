<?

include("kartouche/config.php");
include("includes/fns.php");

checklg($lg);
if (isset($view))
                {
                $view=$view;
                }
                else
                {
                $view="all";
                }

include("includes/trans.php");
include("includes/header.php");

echo "<div class=\"content\">";

include("includes/get_tables_pref.php");

echo "
        <table border=\"0\" width=\"600\">
        <tr>
                <td width=\"200\" colspan=\"2\" id=\"crumbs\"><h3>".$filename."</h3></td>
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
$bgcolor=(++$n&1) ? "#ffbbff" : "#ffccff";


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
                                <td><a href=editpot.php?lg=$lg&db_table=$db_table&view=$view&total=$total>$db_table</a></td>
								<td><a href=screen_export.php?db_table=$db_table><img src=\"images/export.png\" alt=\"Export to screen\" width=\"40\" height=\"15\" border=\"0\"></a></td>
                                <td align=\"right\">$total</td>
                                <td align=\"right\"><img border=\"0\" height=\"10\" src=\"makebar.php?trans=$trans\" width=\"200\"></td>
                                <td align=\"right\">$trans</td>
                                <td align=\"right\">$sugg_no</td>
                        </tr>
                        ";

                $i++;
                }
        
}

$g_trans=rounded(($g_total-$g_untrans)/$g_total*100,0)."%";

echo "
        <tr>
                <td colspan=\"2\" id=\"crumbs\"><h3>Grand total:</h3></td>
                <td align=\"right\"  id=\"crumbs\">$g_total</td>
                <td align=\"right\"  id=\"crumbs\">&nbsp;</td>
                <td align=\"right\"  id=\"crumbs\">$g_trans</td>
                <td align=\"right\"  id=\"crumbs\">$g_sugg_no</td>
        </tr>
        </table>";

echo "<table><tr><td id=\"crumbs\">";
include("includes/navbar.php");
echo "</td></tr></table></div>";

include("includes/footer.php");

?>
