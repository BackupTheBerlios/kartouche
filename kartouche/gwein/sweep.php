<?

include("kartouche/config.php");
include("../includes/fns.php");

checklg($lg);

include("../includes/trans.php");
include("../includes/header.php");

echo "<div class=\"content\">";

dbconnect();

foreach ($sweep_me as $id=>$db_table)
{

echo "Sweeping in $db_table<br>";

        $sql="select * from $db_table";
        $result=mysql_query($sql) or die("Can't access $db_table");

        while ($row=mysql_fetch_object($result))
        {

                        if ($row->msgstr != '' and $row->id > 1)
                        {

                                $english=addslashes($row->msgid);
                                $welsh=addslashes($row->msgstr);
								$id=addslashes($row->id);
								$submitter=addslashes($row->submitter);

								mysql_select_db(OMNAME);

                                $sweep="insert into dict(english, welsh, source, source_id, submitter)
									values('$english','$welsh','$db_table','$id','$submitter')";
                                $sweep_result=mysql_query($sweep) or die("Can't do the sweep");

								mysql_select_db(DBNAME);

                        }

        }

echo "$db_table swept in successfully!<br>";

} // end of foreach loop

echo "</table></div>";

include("../includes/footer.php");




?>
