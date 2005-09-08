<?

// IMPORTANT: remember to activate the email notification if this file is uploaded to the
// webserver to replace the existing version there !!!!!

include("kartouche/config.php");
include("includes/fns.php");

checklg($lg);
checktext($db_table);

dbconnect();

//thanks for pointers from: Onslaught on the Devshed forums
if (count($list_me)>0)
        {

        foreach ($add_me as $id=>$contents)
                {
                $suggestion=addslashes($contents[suggestion]);
                $suggestion=clean_me($suggestion);
                $id=$contents[id];
                $submitter=addslashes($submitter);

                if (in_array($id,$list_me))
                                {

                                $sql="update $db_table set
                                        suggestion='$suggestion',
                                        ipaddress='$REMOTE_ADDR',
                                        submitter='$submitter'
                                        where id=$id";
                                $result=mysql_query($sql) or die("Can't do the suggestion updates");
                                $changes.=$id." - ".$suggestion."\n";

                                }
                }

                header("location: $HTTP_REFERER&submitter=$submitter");

        }
        else
        {

        include("includes/trans.php");
        include("includes/header.php");
        include("includes/error_tick.php");
        include("includes/footer.php");

        //echo "You did not tick the Confirm box for these records.<br>
                //Please press the Back button on your browser and try again.";

        }

// Email notification:
// Uncomment the following lines if you want an email to be sent to you
// each time someone makes a suggestion for a translated string.  You would
// normally only want to uncomment these lines if Kartouche is being hosted
// on a website, or a LAN where an email server is operational

//$to="you@yourisp.com";
//$subject="Kartouche update";
//$message="$submitter at $REMOTE_ADDR has added to Kartouche:\n\n";
//$message.="The suggestions:\n\n";
//$message.=$changes."\n\n";
//$message.="were put forward for $db_table";
//mail ($to,$subject,$message,"From: Kartouche");

//End of email notification

?>
