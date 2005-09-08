<?

include("kartouche/config.php");
include("includes/fns.php");

checklg($lg);

include("includes/trans.php");
include("includes/header.php");

echo "<div class=\"content\">";

include("includes/use_pref.php");

echo "<table><tr><td id=\"crumbs\">";
include("includes/navbar.php");
echo "</td></tr></table></div>";

include("includes/footer.php");

?>