<?

/*
Kartouche 0.1 (22 October 2003)
Name of file: adm_acc_sugg.php
Purpose of file: takes accepted suggestions and stores them in the db
Upstream file: edit_sugg.php
Downstream file: edit_sugg.php
Copyleft Kevin Donnelly
Released under the GPL
SuSE Linux 8.2: simply change
*/

// do includes and checks

include("kartouche/config.php");
include("../includes/fns.php");
include("../includes/trans.php");

checktext($db_table);

// connect to the db

dbconnect();

// Thanks to Frikkie Thirion for most of this code
// and to Onslaught on the Devshed forums for pointers on an earlier version

// Now we extract each piece of info from the previous page

// First, set a loop as large as row_counter
// For each variable passed from the results page, format it to the form variable_number
// where "number" is the same as the value in row_counter
// Then convert the contents of this variable ($$) to an element of an array, numbered
// as the value in row_counter
// We therefore get a set of corresponding elements in the three arrays, giving the
// accept/delete status of the suggestion for that record, the record's id number, and
// the text of the suggestion itself

for ($i=0;$i<$row_counter;$i++)
{
   $entry_number=sprintf ("entry_%d",$i);
   $entry[$i]=$$entry_number;

   $row_id_number=sprintf ("rowid_%d",$i);
   $rowid[$i]=$$row_id_number;

   $suggestion_number=sprintf ("suggestion_%d",$i);
   $suggestion[$i] = $$suggestion_number;

}

// If no records have the accept/delete status set, but the submit button has been
// pressed, give an error message (else clause) and let the user try again.

if (in_array("Accept", $entry) | in_array("Delete", $entry))
{

// Set another loop to the size of the row_counter
// Check the accept/delete status for each element of the entry array
// If it is "accept", add slashes to the equivalent element in the suggestion array,
// (because magic_quotes is disabled) and // then clear the suggestion field and
// insert the text into the msgstr field where the record number matches the id
// number in the equivalent element of the rowid array
// If the status is "delete", just clear the suggestion field

	for ($i=0;$i<$row_counter;$i++)
	{
		switch ($entry[$i])
		{

			case "Accept":
				$my_suggestion=addslashes($suggestion[$i]);
				$sql1="update $db_table set suggestion='',msgstr='$my_suggestion' where id=$rowid[$i]";
				$result1=mysql_query($sql1) or die($kerr3);

				// For all accepted suggestions, update the hall of fame by getting the name of
				// the person who submitted that suggestion from the table, and adding it
				// to the hall of fame table

				$sql2="select * from $db_table where id=$rowid[$i]";
				$result2=mysql_query($sql2) or die($kerr4);
				$row2=mysql_fetch_object($result2);
				$submitter=$row2->submitter;
				$string=$row2->id;
				$suggupd=$row2->suggupd;

				$sql3="insert into admin_hallfame(handle,file,string,date)
					values('$submitter','$db_table','$string','$suggupd')";
				$result3=mysql_query($sql3) or die($kerr5);

				break;

			case "Delete":
				$sql4="update $db_table set suggestion='',ipaddress='',submitter='' where id=$rowid[$i]";
				$result4=mysql_query($sql4) or die($kerr6);
				break;

		}

	}

	// Re-display the page with the changes made, so that the user can check that all is OK

	header("location: $HTTP_REFERER");


}
else
{
	echo $kerr7;
}


?>
