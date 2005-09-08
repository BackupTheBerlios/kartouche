<?

include("kartouche/config.php");
include("../includes/fns.php");

checklg($lg);

include("../includes/trans.php");
include("../includes/header.php");

echo "<div class=\"content\">";

dbconnect();

foreach ($choose_me as $id=>$db_table)
{

        // extract dirs, where they exist, from the tablename
        if (ereg("_{3}",$db_table))
        {
                list($kde_dir,$file_name)=explode("___",$db_table);
        }
        else
        {
                $file_name=$db_table;
        }

        // replace hyphens in filenames
        $file_name=preg_replace("*_{2}*","-",$file_name);

        $export_dir="exports/".$kde_dir;

        if (!file_exists($export_dir))
        {
                mkdir($export_dir,0755);
        }

        $fp=fopen($export_dir."/".$file_name.".po","w") or die("Can't open file for export ...");

                $sql="select * from $db_table";
                $result=mysql_query($sql) or die("Can't access $db_table");;

                while ($row=mysql_fetch_object($result))
                        {

                        $comment=$row->comment;
                        $comment=substr($comment,1);
                        $comment_array=explode('#',$comment);
                        if (sizeof($comment_array)>1)
                                {
                                foreach ($comment_array as $id=>$comment)
                                        {
                                        $comment="#".$comment."\n";
                                        fwrite ($fp,$comment);
                                        }
                                }
                                else
                                {
                                $comment="#".$comment."\n";
                                fwrite ($fp,$comment);
                                }

                        $msgid=$row->msgid;
                        $msgid_array=explode('\n',$msgid);
                        if (sizeof($msgid_array)>1)
                                {
                                $preid="msgid \"\"\n";
                                fwrite ($fp,$preid);
                                foreach ($msgid_array as $id=>$msgid)
                                        {
                                        $msgid="\"".$msgid."\\n\"\n";
                                        fwrite ($fp,$msgid);
                                        }
                                }
                                else
                                {
                                $msgid="msgid \"".$msgid."\"\n";
                                fwrite ($fp,$msgid);
                                }

                        $msgstr=$row->msgstr;
                        $msgstr_array=explode('\n',$msgstr);
                        if (sizeof($msgstr_array)>1)
                                {
                                $prestr="msgstr \"\"\n";
                                fwrite ($fp,$prestr);
                                foreach ($msgstr_array as $id=>$msgstr)
                                        {
                                        $msgstr="\"".$msgstr."\\n\"\n";
                                        fwrite ($fp,$msgstr);
                                        }
                                }
                                else
                                {
                                $msgstr="msgstr \"".$msgstr."\"\n";
                                fwrite ($fp,$msgstr);
                                }

                        $spbuff="\n";
                        fwrite ($fp,$spbuff);

                        } // end of while (record) loop

                fclose ($fp);

                echo $db_table." ".$export_msg."<br>";

        // clear this variable for the next run
        unset($kde_dir);

} // end of foreach loop

echo "</table></div>";

include("../includes/footer.php");

?>