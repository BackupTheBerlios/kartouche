<?

include("kartouche/config.php");
include("includes/fns.php");

checktext($db_table);

dbconnect();

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
						echo $comment."<br>";
						}
				}
				else
				{
				$comment="#".$comment."\n";
				echo $comment."<br>";
				}

		$msgid=$row->msgid;
		$msgid_array=explode('\n',$msgid);
		if (sizeof($msgid_array)>1)
				{
				$preid="msgid \"\"\n";
				echo $preid."<br>";
				foreach ($msgid_array as $id=>$msgid)
						{
						$msgid="\"".$msgid."\\n\"\n";
						echo $msgid."<br>";
						}
				}
				else
				{
				$msgid="msgid \"".$msgid."\"\n";
				echo $msgid."<br>";
				}

		$msgstr=$row->msgstr;
		$msgstr_array=explode('\n',$msgstr);
		if (sizeof($msgstr_array)>1)
				{
				$prestr="msgstr \"\"\n";
				echo $prestr."<br>";
				foreach ($msgstr_array as $id=>$msgstr)
						{
						$msgstr="\"".$msgstr."\\n\"\n";
						echo $msgstr."<br>";
						}
				}
				else
				{
				$msgstr="msgstr \"".$msgstr."\"\n";
				echo $msgstr."<br>";
				}

		$spbuff="\n";
		echo $spbuff."<br>";

		} // end of while (record) loop


?>
