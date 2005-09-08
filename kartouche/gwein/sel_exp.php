<?

include("kartouche/config.php");
include("../includes/fns.php");

checklg($lg);

include("../includes/trans.php");
include("../includes/header.php");

echo "<div class=\"content\">";

include("includes/sel_exp_pref.php");

echo "
        <form action=\"export.php?lg=$lg\" method=\"POST\">
        <table border=\"0\" width=\"600\">";

dbconnect();

$i=0;

$result=mysql_list_tables(DBNAME) or die("Can't access the db");

while ($i<mysql_num_rows($result))
{
$bgcolor=(++$n&1) ? "#ffccff" : "#ffbbff";
        {

        $db_table=mysql_tablename($result,$i);

        echo "
                <tr bgcolor=$bgcolor>
                        <td width=\"400\">$db_table</td>
                        <td width=\"100\"><input type=\"checkbox\" name=\"choose_me[]\" value=\"$db_table\"></td>

                </tr>
                ";

        $i++;

        }
}

echo "</table>
        <table>
        <tr>
                <td id=\"crumbs\"><div class=\"data\"><input type=\"submit\" name=\"submit\" value=\"$export\"></div><td>
        </tr>

        </table>
        </form>";

echo "<table><tr><td id=\"crumbs\">";
include("includes/navbar.php");
echo "</td></tr></table></div>";

include("../includes/footer.php");

?>