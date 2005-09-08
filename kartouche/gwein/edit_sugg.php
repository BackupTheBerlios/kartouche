<?

/*
Kartouche 0.1 (22 October 2003)
Name of file: edit_sugg.php
Purpose of file: allows admin to review suggestions, accept them, delete them, or leave them in place
Upstream file: adm_get_tables.php, edit.sugg.php (navigation)
Downstream file: edit.sugg.php and adm_goto.php (navigation), adm_acc_sugg.php (to commit suggestions or edits),
        adm_del_sugg.php (to delete suggestions)
Copyleft Kevin Donnelly
Released under the GPL
SuSE Linux 8.2: simply change
*/

// Do includes and checks

include("kartouche/config.php");
include("../includes/fns.php");

checklg($lg);
checkval($total);
checktext($db_table);
if (isset($pointer)) checkval($pointer);

// Use the selected language and display the page header

include("../includes/trans.php");
include("../includes/header.php");

// Set up the variables to allow paging:
// if $pointer is not set, set it to 1
// set $shown to the same figure
// but then decrement $pointer by one, because table rows start at 0 (not 1),
// whereas record ids start at 1

if (!isset($pointer)) $pointer=1;

$shown=$pointer;
$pointer=$pointer-1; // because table rows start at 0 (not 1), whereas record ids start at 1

// Connect to the db and run two queries to get the records and sort out the paging

dbconnect();

// The scope of the first query will depend on the "view" chosen on the previous page (adm_get_tables)
// Four options are possible:
// all: this will show all the records in the table
// empty: this will show all those records which have not yet been translated
// suggestions: this will show all those records for which a suggested translation has been put forward
// done: this will show all those records for which translations exist
// For each view, the query gets enough records to fill a page (REC_SHOWN), starting at the
// record in $pointer

switch ($view)
{

	// pretty amazingly (well, *I* thought it was amazing!), PHP allows you to use the decision
	// strings in either language, provided you use a variable (which is translated to the
	// relevant language in the appropriate trans_lg.txt file)

	// Unfortunately, the code leads to a "lag" - the address bar shows the original view that
	// the page was called with, even though you may go on to change that view using the radio buttons.
	// Likewise, the English term for the view persists if you switch to Welsh, until you use the
	// radio buttons in Welsh to change the view (and that then persists if you switch to English,
	// until you use the radio buttons) - not ideal, but not a showstopper.

	case $all:
		$sql="select * from $db_table limit $pointer,".RECS_SHOWN;
		break;

	case $empty:
		$sql="select * from $db_table where msgstr='' limit $pointer,".RECS_SHOWN;
		break;

	case $sugg:
		$sql="select * from $db_table where suggestion!='' limit $pointer,".RECS_SHOWN;
		break;

	case $done:
		$sql="select * from $db_table where msgstr!='' limit $pointer,".RECS_SHOWN;
		break;

}
$result=mysql_query($sql) or die($kerr1);

// Second query: get the total number of records in the table ($numrows) ...

$query="select count(*) as count from $db_table";
$q_result=mysql_query($query);
$q_row=mysql_fetch_object($q_result);
$numrows = $q_row->count;

// ...  and then set up variables to allow paging to work
// $next will be the pointer record plus 20
// $prev will be the pointer record minus 20
// $endno will also be the pointer record plus 20, but will be used as an end-stop to prevent
// the paging mechanism overshooting the number of records in the table - if endno is larger
// than the number of records (numrows), then it is set to that number
// Note: perhaps this should be set to numrows-1, because ISTR that on one occasion when there
// was just one record on the last page, it didn't show - check this

$next=$shown+RECS_SHOWN;
$endno=$pointer+RECS_SHOWN;
if ($endno>$numrows)
        {
        $endno=$numrows;
        }
$prev=$shown-RECS_SHOWN;

// Start the layout - open the content div, bring in the intro text, and open a table

echo "<div class=\"content\">";

include("includes/edit_sugg_pref.php");

// Start summary and paging header

// The following table summarises the number of records, and then sets up the paging buttons,
// and also the "goto" option; the "next" button only appears if there are records beyond the
// current 20, and the "previous" button only appears if there are records before the current 20

echo "
		<table>
			   <tr>
                        <td colspan=\"4\" id=\"crumbs\">
                                <h3>".$show_rec." ".$shown."-".$endno." ".$out_of." ".$total." ".$in." ".$db_table."</h3>
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
                                <form action=\"edit_sugg.php?lg=$lg&view=$view&db_table=$db_table&total=$total&pointer=$next\" method=\"POST\">
                                <input type=\"submit\" name=\"next\" value=\"$nextlot\">
                                </form>";
                                }
                        echo "
                        </td>
                        <td width=\"30%\">";
                                if ($prev>0)
                                {
                                echo "
                                <form action=\"edit_sugg.php?lg=$lg&view=$view&db_table=$db_table&total=$total&pointer=$prev\" method=\"POST\">
                                <input type=\"submit\" name=\"prev\" value=\"$prevlot\">
                                </form>";
                                }
                        echo "
                        </td>
                        <td width=\"30%\">
								<!-- we use adm_goto.php as a diversion page, because the form action contains a record id
									which the form cannot act on because it has not been entered yet -->
                                <form action=\"adm_goto.php?lg=$lg&view=$view&db_table=$db_table&total=$total\" method=\"POST\">
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

// End summary and paging header


// Output the records

// Set up a counter to identify what to do with each record on the next page

$row_counter=0;

echo "
   <form action=\"adm_acc_sugg.php?lg=$lg&view=$view&db_table=$db_table\" method=\"POST\">
   <table border='0' width=\"800\" >
";

// If there are records, do the while loop; if not, give out an error message (else clause)

if (mysql_num_rows($result)>0)
{

	while ($row=mysql_fetch_object($result))
	{

		// alternate the colour for each record's line

		$bgcolor=(++$n&1) ? "#ffbbff" : "#ffccff";

		// Thanks to Frikkie Thirion for most of this code
		// and to Onslaught on the Devshed forums for pointers on an earlier version

		// Display the record's id number, and the msgid and msgstr
		// Display the suggestion made for that record, which will be passed on as suggestion_number,
		// where "number" is the same as the value in row_counter
		// Note whether the suggestion is to be accepted or deleted, and pass that value on as
		// entry_number
		// Pass on the record's id number as rowid_number
		// Finally, increment the row_counter to handle the next record

		echo "
		<tr bgcolor=$bgcolor >
			<td width=\"20\">$row->id</td>
			<td  width=\"240\">".htmlspecialchars($row->msgid)."</td>
			<td  width='240'>".htmlspecialchars($row->msgstr)."</td>
			<td width='240'>
				<textarea cols='30' rows='5' wrap='soft' name='suggestion_$row_counter' value='$row->suggestion'>$row->suggestion</textarea>
			</td>
			<td width=\"60\" align=\"center\">
				<input type='radio' name='entry_$row_counter' value='Accept'><br>$accept
				<div class=\"warning\">
				<input type='radio' name='entry_$row_counter' value='Delete'><br>$delete
				</div>
				<input type='hidden' name='rowid_$row_counter' value='$row->id'>
			</td>
		</tr>
		";
		$row_counter++;

	}

		// The final value of row_counter is also passed to the next page

		echo "
		<input type='hidden' name='row_counter' value='$row_counter'>
		</table>

		<table>
		<tr>
			<td id=\"crumbs\"><div class=\"data\"><input type=\"submit\" name=\"submit\" value=\"$transfer\"></div><td>
		</tr>
		</table>

		</form>
		";

}
else
{
 	echo $kerr2;
}


// repeat the navbar for those who like this at the bottom too

echo "<table><tr><td id=\"crumbs\">";
include("includes/navbar.php");
echo "</td></tr></table>";

// close the content div, and finish off with the footer

echo "</div>";

include("../includes/footer.php");
?>
