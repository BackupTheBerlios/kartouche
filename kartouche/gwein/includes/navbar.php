<?

echo "
<a href=\"../../kyfieithu/index.php?lg=$lg\">".$adm_main." ></a>
<a href=\"index.php?lg=$lg\">".$adm_home." ></a>
<a href=\"adm_get_tables.php?lg=$lg&view=$all\">".$adm_acc_file." ></a>
<a href=\"sel_exp.php?lg=$lg\">".$adm_export." ></a>
<a href=\"sel_imp.php?lg=$lg\">".$adm_import." ></a>
<a href=\"sel_sweep.php?lg=$lg\">".$adm_sweep." ></a>
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
