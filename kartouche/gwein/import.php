<?

include("kartouche/config.php");
include("../includes/fns.php");

checklg($lg);

include("../includes/trans.php");
include("../includes/header.php");

echo "<div class=\"content\">";

dbconnect();

// $path needs to refer to a dir within the gwein dir - it is recommended that a symlink named something
// like "cvstemplates" is made to the templates idr of the cvs download
// other paths can be used, but note that if this is done the line
// "list ($path,$kde_dir)=explode("/",$dir_name);" needs to be adjusted too, because the path
// is split at each slash, and only the second, ie the one after the first slash ("home" in the case of
// something like "/home/kevin/public_html/kartouche") will get put into the $kde_dir variable
// the line would need to be amended to build an array from the exploded pieces, with these then
// being reassembled to give an appropriate tablename; there's enough of that around already,
// so for an easy life I suggest the symlink
$found=get_dir_files($path);

reset($found);

//loop through the top level in the $found array
while (list($dir_name,$dir_value)=each($found))
{
        if (is_array($dir_value))
        {
                // loop through the next level in the $found array
                while (list($file_name,$file_value)=each($dir_value))
                {
                        // ignore the dirs
                        if ($file_value=="file")
                        {

                                // set up a name to report progress to the user
                                $import_file=$dir_name."/".$file_name;

                                // split $path off the top level info to leave just the kde dir
                                // note that this assumes a flat dir structure of only two levels
                                list ($path,$kde_dir)=explode("/",$dir_name);

                                // replace a hyphen in the filename with two underlines
                                // a hyphen is not a legal character in a MySQL tablename
                                $file_name=ereg_replace("-","__",$file_name);

                                // lose the file extension
                                list ($db_table,$file_ext)=explode(".",$file_name);

                                // if the files are in a kde subdir, prepend it to the filename, separated by three underlines
                                if ($kde_dir=="")
                                        {
                                        $kde_pre="";
                                        }
                                        else
                                        {
                                        $kde_pre=$kde_dir."___";
                                        }

                                $db_table=$kde_pre.$db_table;

                                // create the new table, named as above, and report to the user
                                if (mk_table($db_table))
                                        {
                                        echo $create_msg." ".$db_table."<br>";
                                        }
                                        else
                                        {
                                        echo "Can't create the new table $db_table<br>";
                                        }

                                echo $import_msg." ".$db_table." ...<br>";

                                // open the file and read it; also set up two status variables
                                $fp=fopen($import_file,"r") or die("Can't open ".$import_file." ...");
                                $type="id";
                                $commstat="new";

                                echo $read_msg." ".$import_file." ... <br>";

                                while ($line=fgets($fp,1024))
        
                                        {
        
                                        if (ereg("^#", $line))
                                                {
                                                list($label,$comment)=explode('#',$line);
                                                $comment=addslashes(trim($comment));
                                                $comment="#".$comment;
                                                switch ($commstat)
                                                        {
                                                        case "new":
                                                                $sql="insert into $db_table(comment) values('$comment')";
                                                                $result=mysql_query($sql) or die("Can't do the comment insert");
                                                                $commstat="old";
                                                                $last_id=mysql_insert_id();
                                                                break;
                                                        case "old":
                                                                $sql="select comment from $db_table where id=$last_id";
                                                                $result=mysql_query($sql) or die("Can't get the comment");
                                                                $row=mysql_fetch_object($result);
                                                                $oldcomment=$row->comment;
                                                                $comment=addslashes($oldcomment)." ".$comment;
                                                                $sql="update $db_table set comment='$comment' where id=$last_id";
                                                                $result=mysql_query($sql) or die("Can't do the additional comment insert");
                                                                break;
                                                        } // end of switch statement
                                                } // end of if statement

                                       elseif (ereg("^msgid",$line))
                                                {
                                                $commstat="new";
                                                // we need to shift annoying \" sequences out of the way temporarily
                                                // or they will interfere with the segmentation of the line
                                                $line=preg_replace('^\\\"^','@~',$line);
                                                // segment the line
                                                list($label,$msgid)=explode('"',$line);
                                                // shift the \" sequences back
                                                $msgid=preg_replace('^@~^','\"',$msgid);
                                                $msgid=addslashes(trim($msgid));
                                                $sql="update $db_table set msgid = '$msgid' where id=$last_id";
                                                $result=mysql_query($sql) or die("Can't do the msgid insert");
                                                $type="id";
                                                } // end of elseif statement

                                        elseif (ereg("^msgstr",$line))
                                                {
                                                $line=preg_replace('^\\\"^','@~',$line);
                                                list($label,$msgstr)=explode('"',$line);
                                                $msgstr=preg_replace('^@~^','\"',$msgstr);
                                                $msgstr=addslashes(trim($msgstr));
                                                $sql="update $db_table set msgstr = '$msgstr' where id=$last_id";
                                                $result=mysql_query($sql) or die("Can't do the msgstr insert");
                                                $type="str";
                                                } // end of elseif statement

                                        elseif (ereg("^\"+",$line))
                                                {
                                                $line=preg_replace('^\\\"^','@~',$line);
                                                list($label,$extra)=explode('"',$line);
                                                $extra=preg_replace('^@~^','\"',$extra);
                                                $extra=addslashes(trim($extra));
                                                switch ($type)
                                                       {
                                                        case "str":
                                                                $sql="select msgstr from $db_table where id=$last_id";
                                                                $result=mysql_query($sql) or die("Can't get msgstr");
                                                                $row=mysql_fetch_object($result);
                                                                $msgstr=$row->msgstr;
                                                                $msgstr=addslashes($msgstr)." ".$extra;
                                                                $sql="update $db_table set msgstr = '$msgstr' where id=$last_id";
                                                                $result=mysql_query($sql) or die("Can't do the additional msgstr insert");
                                                                break;
        
                                                        case "id":
                                                                $sql="select msgid from $db_table where id=$last_id";
                                                                $result=mysql_query($sql) or die("Can't get msgid");
                                                                $row=mysql_fetch_object($result);
                                                                $msgid=$row->msgid;
                                                                $msgid=addslashes($msgid)." ".$extra;
                                                                $sql="update $db_table set msgid = '$msgid' where id=$last_id";
                                                                $result=mysql_query($sql) or die("Can't do the additional msgid insert");
                                                                break;
                                                        } // end of switch statement
                                                } // end of elseif statement

                                        } // end of while (fileread) loop
        
                                // close the file
                                fclose($fp) or die("Can't close ".$import_file." ...");
        
                                // replace the header info in the file with standard kartouche headers
                                // specify the headers in the replace_comment and replace_msgstr functions in
                                // includes/fns.php
                                $comment=replace_comment();
                                $msgstr=addslashes(replace_msgstr());

                                $sql="update $db_table
                                        set comment='$comment',
                                        msgstr='$msgstr',
                                        suggestion=' '
                                        where id=1";
                                $result=mysql_query($sql) or die("Can't update the header");

                                // report success to the user
                                echo $import_file." ".$success_msg."<br>";

                        }
                }
        }
        else
        {
                echo $dir_name." ~~~ ".$dir_value."<br>";
        }
}

echo "</div>";

include("../includes/footer.php");

?>