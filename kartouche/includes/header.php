<?header("Content-type: text/html; charset=utf-8");?>
<html>
<head>
        <!DOCTYPE public "-//w3c//dtd html 4.01 transitional//en"
		"http://www.w3.org/TR/html4/loose.dtd">

        <title><?=$title?></title>
                <META name="description" content="KGyfieithu - cyfieithu KDE a Gnome efo Kartouche">
                <META name="keywords" content="cyfieithu translate cd-agored lleoli localization l10n i18n internationalisation Linux Wales Cymru Cymraeg KDE open-source Gnome desktop penbwrdd bwrdd gwaith swyddfa office PC work cyfrifiadur">

        <?
        $agent=getenv("HTTP_USER_AGENT");

        // the use of WEBURL below is to allow the admin pages to find the stylesheet,
        // otherwise there is a clash of paths with the normal pages

        if (preg_match("/MSIE/i","$agent"))
                {
                        echo "<link rel=stylesheet type=\"text/css\" href=\"".WEBURL."stylesheet.css\">";
                }

        else
                {
                        echo "<link rel=stylesheet type=\"text/css\" href=\"".WEBURL."stylesheet.css\">";
                }
        ?>

</head>
<body>
        <table cellspacing=0>
                <tr>
                        <td width="380">
                                <a href="<? echo WEBURL; ?>index.php"><img border="0" height="50" src="<? echo WEBURL; ?>images/kyf2.png" width="330"></a>
                        </td>

                        <?
                        //$dbconnect=dbconnect();
                        //$result = mysql_query("select * from ads") or die("Can't do ads query");
                        //$num = mysql_num_rows($result);
                        //$i = time() % $num;
                        //$record = mysql_data_seek($result, $i);
                        //$row = mysql_fetch_object($result);

                        // the use of WEBURL below is to allow the admin pages to find the ads
                        // directory, otherwise there is a clash of paths with the normal pages

                        ?>

                         <td id="advert">
                                <!--<a href="http://<? echo $row->ad_url; ?>">-->
                                <!--<img border="0" height="47" src="<? echo WEBURL."images/ads/".$row->filename; ?>" width="450">-->
                                <img border="0" height="50" src="<? echo WEBURL; ?>images/kartouche2.png" width="330">
                                <!--</a>-->
                         </td>

                </tr>
                <tr>
                        <td colspan="2" id="sections">
                        <?
                        include("includes/navbar.php");
                        ?>
                        </td>
                </tr>
        </table>
