<?

/*
Kartouche 0.0.1a (7 February 2003)
Name of file: navbar.php
Purpose of file: provide a navbar on each userland page (and also at the bottom of the page, in a slightly different format)
Upstream file: header.php
Downstream file: none
Copyleft Kevin Donnelly
Released under the GPL
*/

echo "
<a href=\"../kyfieithu/index.php?lg=$lg\">".$main." ></a>
<a href=\"index.php?lg=$lg\">".$home." ></a>
<a href=\"remember.php?lg=$lg\">".$remember." ></a>
<a href=\"use.php?lg=$lg\">".$use." ></a>
<a href=\"get_tables.php?lg=$lg&view=$all\">".$sel_file." ></a>
<a href=\"hallfame.php?lg=$lg\">".$fame." ></a>
<a href=\"../omnivore/index.php?lg=$lg\">".$omnivore." ></a>
";

$querystring=explode("&", $_SERVER['QUERY_STRING']);
$lgstring=array_shift($querystring);
$remstring=implode("&",$querystring);

switch($lg)
        {
        case "en":
                echo "&nbsp;&nbsp;&nbsp;<a href=".$PHP_SELF."?lg=cy&".$remstring.">[".$change_lg."]</a>";
                break;
        case "cy":
                echo "&nbsp;&nbsp;&nbsp;<a href=".$PHP_SELF."?lg=en&".$remstring.">[".$change_lg."]</a>";
                break;
        }

?>
