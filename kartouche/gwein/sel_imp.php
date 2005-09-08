<?

include("kartouche/config.php");
include("../includes/fns.php");

checklg($lg);

include("../includes/trans.php");
include("../includes/header.php");

echo "<div class=\"content\">";

include("includes/sel_imp_pref.php");

echo "
        <form action=\"import.php?lg=$lg\" method=\"post\">
        <table border=\"0\" width=\"600\">
        <tr>
                <td width=\"400\">$file_path</td>
                <td width=\"200\" align=\"right\">
                        <input type=\"text\" name=\"path\" value=\"cvstemplates\" maxlength=\"100\" size=\"50\">
                </td>
        </tr>
        </table>
        <table>
        <tr>
                <td id=\"crumbs\"><div class=\"data\"><input type=\"submit\" name=\"submit\" value=\"$import\"></div><td>
        </tr>
        </table>
        </form>";

echo "<table><tr><td id=\"crumbs\">";
include("includes/navbar.php");
echo "</td></tr></table></div>";

include("../includes/footer.php");

?>