<?

// This is an alternative layout based on one by some French users of Kartouche - it is included as
// an alternative to the default editpot.php
// This layout is probably good for long strings, but on short one-liners the amount of text in
// the layout makes it (IMHO) harder to read.  It would probably also be good for beginners, but
// those with a bit of experience would likely prefer the more spartan traditional Kartouche interface.

include("kartouche/config.php");
include("includes/fns.php");

checklg($lg);
checkval($total);
checktext($db_table);
checkview($view);
if (isset($pointer)) checkval($pointer);

include("includes/trans.php");
include("includes/header.php");

$address=$REMOTE_ADDR;

if (!isset($pointer)) $pointer=1;

$shown=$pointer;
$pointer=$pointer-1;

dbconnect();

if ($view=="empty")
        {
        $sql="select * from $db_table where msgstr='' limit $pointer,".RECS_SHOWN;
        }
        else
        {
        $sql="select * from $db_table limit $pointer,".RECS_SHOWN;
        }
$result=mysql_query($sql) or die($kerr1);

$query="select count(*) as count from $db_table";
$q_result=mysql_query($query);
$q_row=mysql_fetch_object($q_result);
$numrows = $q_row->count;

$next=$shown+RECS_SHOWN;
$endno=$pointer+RECS_SHOWN;
if ($endno>$numrows)
        {
        $endno=$numrows;
        }
$prev=$shown-RECS_SHOWN;

echo "<div class=\"content\">";

include("includes/editpot_pref.php");

echo "
        <table>
				<tr>
					<td colspan=\"4\" align=\"right\">$classic_int <a href=\"editpot.php?lg=$lg&db_table=$db_table&view=$view&total=$total\">$click_here</a>.</td>
			    </tr>
                <tr>
                        <td colspan=\"4\" id=\"crumbs\">
                                <h3>".$show_rec." ".$shown."-".$endno." ".$out_of." ".$total." ".$in." ".$db_table."</h3>
                                <div class=\"data\">$ipaddr $address</div>
                        </td>
                </tr>
                <tr>
                        <td width=\"5%\">
                                &nbsp;
                        </td>
                        <td width=\"30%\">";
                                if ($numrows>$next)
                                {
                                echo "
                                <form action=\"editpot_alternative.php?lg=$lg&view=$view&db_table=$db_table&total=$total&pointer=$next&submitter=$submitter\" method=\"POST\">
                                <input type=\"submit\" name=\"next\" value=\"$nextlot\">
                                </form>";
                                }
                        echo "
                        </td>
                        <td width=\"30%\">";
                                if ($prev>0)
                                {
                                echo "
                                <form action=\"editpot.php?lg=$lg&view=$view&db_table=$db_table&total=$total&pointer=$prev&submitter=$submitter\" method=\"POST\">
                                <input type=\"submit\" name=\"prev\" value=\"$prevlot\">
                                </form>";
                                }
                        echo "
                        </td>
                        <td width=\"30%\">
								<!-- we use goto.php as a diversion page, because the form action contains a record id
									which the form cannot act on because it has not been entered yet -->
                                <form action=\"goto.php?lg=$lg&view=$view&db_table=$db_table&total=$total&submitter=$submitter\" method=\"POST\">
                                <input type=\"submit\" name=\"gotobutton\" value=\"$gothere\">
                                <input type=\"text\" name=\"goto\" maxlength=\"4\" size=\"4\">
                                </form>

                        </td>
                </tr>
                <tr>
                        <td>&nbsp;</td>
                </tr>
        </table>
        ";

echo "<form action=\"make_sugg.php?lg=$lg&db_table=$db_table\" method=\"POST\">
	<table>";

if (mysql_num_rows($result)>0)

        {

        while ($row=mysql_fetch_object($result))
        {
		$bgcolor=(++$n&0) ? "#ffccff" : "#ffbbff";
        
                echo "
						<tr bgcolor=$bgcolor>
							<td width=\"10%\" id=\"crumbs\">$row->id</td>
							<td width=\"45%\" id=\"crumbs\">$alt_orig_text<br><b>".htmlspecialchars($row->msgid)."</b></td>
							<td width=\"45%\" id=\"crumbs\">$alt_curr_trans<br><b>".htmlspecialchars($row->msgstr)."</b></td>
						</tr>
						";

                        if ($row->suggestion=="")
                                {
                                echo "
									<tr>
									<td><input type=\"checkbox\" name=\"list_me[]\" value=\"$row->id\"></td>
									<td colspan=\"2\">".$alt_sugg_trans."
									<textarea cols=\"80\" rows=\"4\" wrap=\"soft\" name=\"add_me[{$row->id}][suggestion]\"></textarea>
									<input type=\"hidden\" name=\"add_me[{$row->id}][id]\" value=\"$row->id\">
									</td>
                                 	";
                                }
                                else
                                {

									if ($row->msgid=="")
									{
									echo "
										<tr>
										<td>&nbsp;</td>
										<td colspan=\"2\">&nbsp;</td>";
									}
									else
									{
									echo "
										<tr>
										<td>&nbsp;</td>
										<td colspan=\"2\">".$alt_input_trans."<br><b>".htmlspecialchars($row->suggestion)."</b></td>";
									}
                                }

                echo "
                        </tr>
                        ";

        }

        }
        else
        {
        echo $kerr2;
        }


echo "
        </table>
        <table>
        <tr>
                <td id=\"crumbs\" width=\"60%\">$hallfame1 <a href=\"hallfame.php?lg=$lg\">$hallfame2</a></td>
                <td id=\"crumbs\" width=\"40%\">
                        <div class=\"data\"><input type=\"text\" maxlength=\"200\" name=\"submitter\" value=\"$submitter\" size=\"30\"></div>
                </td>
        </tr>
        </table>
        <table>
        <tr>
                <td id=\"crumbs\"><div class=\"data\"><input type=\"submit\" name=\"submit\" value=\"$submit\"></div></td>
        </tr>

        </table>
        </form>";

echo "<table><tr><td id=\"crumbs\">";
include("includes/navbar.php");
echo "</td></tr></table></div>";

include("includes/footer.php");

?>
