<?

include("kartouche/config.php");
include("../includes/fns.php");

if (isset($lg))
                {
                $lg=$lg;
                }
                else
                {
                $lg="en";
                }

checklg($lg);

include("../includes/trans.php");
include("../includes/header.php");

echo "<div class=\"content\">";

include("includes/sel_sweep_pref.php");

echo "
        <form action=\"sweep.php?lg=$lg\" method=\"POST\">
        <table border=\"0\" width=\"600\">";

dbconnect();

$i=0;

$result=mysql_list_tables(DBNAME) or die("Can't access the db");

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

                        echo "
                                <tr bgcolor=$bgcolor>
                                        <td width=\"400\">$db_table</td>
                                        <td width=\"100\"><input type=\"checkbox\" name=\"sweep_me[]\" value=\"$db_table\"></td>
                
                                </tr>
                                ";
                
                        $i++;
                
                }
        }

}

echo "</table>
        <table>
        <tr>
                <td id=\"crumbs\"><div class=\"data\"><input type=\"submit\" name=\"submit\" value=\"$sweep\"></div><td>
        </tr>

        </table>
        </form>";

echo "<table><tr><td id=\"crumbs\">";
include("includes/navbar.php");
echo "</td></tr></table></div>";

include("../includes/footer.php");

?>