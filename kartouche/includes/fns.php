<?

function dbconnect()
{
		$conn=mysql_connect(DBHOST,DBUSER,DBPASS) or die("Can't connect to server");
        $dbselect=mysql_select_db(DBNAME) or die("Can't select database");
        return $conn;
}

function query_select ($name,$query,$default="")
// from the Welling and Thomson book - thanks for a cool little function!
{
        // some additions to allow the language on the select list to be selected correctly
        global $lg;
        switch ($lg)
                {
                case "en":
                        $opt_field=1;
                        $choose="-- Choose --";
                        break;
                case "cy":
                        $opt_field=2;
                        $choose="-- Dewis --";
                        break;
                }
        // that should do it

        $result=mysql_query($query);
        if (!result)
                return("Sorry, I couldn't connect to the database");

        $select="<select name=\"$name\">";
        $select .= "<option value=\"\">$choose</option>";

        for ($i=0; $i<mysql_numrows($result); $i++)
        {
                // $opt_code is the id field for the list of options, starting from 0
                // this assumes that your primary key field will always be the very first
                // field in the table
                $opt_code=mysql_result($result, $i, 0);
                // $opt_desc is the field for the label to be applied to the options
                // the placement number is selected by the switch statement above;
                // note that this implies that your languages will be in the same sequence
                // in each table, ie en always in field 1 (the second field), cy always
                // in field 2 (the third field in the table), etc
                $opt_desc=mysql_result($result, $i, $opt_field);
                $select .= "<option value=\"$opt_code\"";
                if ($opt_code==$default)
                {
                        $select .= " selected";
                }
                $select .= "> $opt_desc</option>";
        }
        $select .= "</select>\n";
        return $select;
}

function all_filled_out($form_vars)
{
        foreach ($form_vars as $key => $value)
        {
                if (!isset($key) || ($value==""))
                return false;
        }
        return true;
}

function fix_date_en($val)
// turns a MySQL date field into readable date format; 0s need to be fed to mktime to fill the h:m:s slots
{
        $datearr=explode("-",$val);
        return date("d M Y", mktime (0,0,0,$datearr[1],$datearr[2],$datearr[0]));
}

function fix_date_cy($val)
// turns a MySQL date field into readable date format; 0s need to be fed to mktime to fill the h:m:s slots
{
        $datearr=explode("-",$val);
        $date_cy=date("d M Y", mktime (0,0,0,$datearr[1],$datearr[2],$datearr[0]));
        $date_cy=ereg_replace("Jan","Ion",$date_cy);
        $date_cy=ereg_replace("Feb","Chw",$date_cy);
        $date_cy=ereg_replace("Mar","Maw",$date_cy);
        $date_cy=ereg_replace("Apr","Ebr",$date_cy);
        $date_cy=ereg_replace("May","Mai",$date_cy);
        $date_cy=ereg_replace("Jun","Meh",$date_cy);
        $date_cy=ereg_replace("Jul","Gor",$date_cy);
        $date_cy=ereg_replace("Aug","Aws",$date_cy);
        $date_cy=ereg_replace("Sep","Med",$date_cy);
        $date_cy=ereg_replace("Oct","Hyd",$date_cy);
        $date_cy=ereg_replace("Nov","Tac",$date_cy);
        $date_cy=ereg_replace("Dec","Rha",$date_cy);
        return $date_cy;
}

function fix_array($val)
{
        $list="";
        foreach ($val as $element)
                $list .= $element .", ";
        return $list;
}

function money($var)
// rounds currency fields to 2 decimal places
// use function "rounded" instead
{
        $var=sprintf("%.2f",$var);
        return $var;
}

function rounded($var,$n)
// rounds fields to n decimal places
{
        $var=sprintf("%.".$n."f",$var);
        return $var;
}

function checkval($var)
// tries to make db calls a little bit more secure
// by checking that they refer to integers and nothing else
{
        if ($var=intval($var))
        {
        return true;
        }
        else
        {
        global $title;
        $title="What happened there?";
        include("header.php");
        include("error2.php");
        include("footer.php");
        exit;
        }
}

function checklg($var)
// tries to make the language calls a bit more secure
// by checking that they contain only "en" or "cy"
{
        if ($var =="en" or $var=="cy")
        {
        return true;
        }
        else
        {
        global $title;
        $title="What happened there?";
        include("header.php");
        include("error2.php");
        include("footer.php");
        exit;
        }
}

function checkview($var)
// tries to make the language calls a bit more secure
// by checking that they contain only "en" or "cy"
{
        if ($var =="all" or $var=="empty")
        {
        return true;
        }
        else
        {
        global $title;
        $title="What happened there?";
        include("header.php");
        include("error2.php");
        include("footer.php");
        exit;
        }
}

function checktext($var)
// tries to make the table calls a bit more secure
// by checking that they consist only of a-z letters, and underlines
{
        if (ereg("^[a-z_]+$",$var))
        {
        return true;
        }
        else
        {
        global $title;
        $title="What happened there?";
        include("header.php");
        include("error2.php");
        include("footer.php");
        exit;
        }
}

function add_tags($text)
// adds HTML tags to the text entered into an additem form;
// set the tags you want as variables, and then map these
// to your desired abbreviation in the ereg_replace;
// you need one ereg_replace line for each tag, and the
// text variable needs to be incremented too
{
        $opentag="(open tag)"; // ~bt
        $closetag="(close tag)"; //~et

        $text1=ereg_replace("~bt", $opentag, $text);
        $text2=ereg_replace("~et", $closetag, $text1);

        return $text2;
}

function mk_table($table)
// creates a new table for the kartouche db
{
        mysql_query("CREATE TABLE $table
                                (
                                id int(10) unsigned NOT NULL auto_increment,
                                comment text,
                                msgid text,
                                msgstr text,
                                suggestion text,
                                ipaddress varchar(20) default NULL,
                                suggupd timestamp(14) NOT NULL,
                                submitter varchar(100) default NULL,
                                PRIMARY KEY  (id)
                                )
                                TYPE=MyISAM;");
        return $table;
}

function replace_comment()
{
        $comment="# Penbwrdd yn Gymraeg.";
        $comment.="# Copyright (C) 2003 Free Software Foundation, Inc.";
        $comment.="# www.kyfieithu.co.uk<kyfieithu@dotmon.com>, www.gyfieithu.co.uk<kyfieithu@dotmon.com>, 2003.##";
        return $comment;

}

function replace_msgstr()
{
        $nowdate=date("Y-m-d H:i");
        $msgstr="Project-Id-Version: PACKAGE VERSION\\n";
        $msgstr.="PO-Revision-Date: ".$nowdate."+0200\\n";
        $msgstr.="Last-Translator: www.kyfieithu.co.uk <kyfieithu@dotmon.com>, www.gyfieithu.co.uk<kyfieithu@dotmon.com>\\n";
        $msgstr.="Language-Team: Cymraeg <cy@li.org>\\n";
        $msgstr.="MIME-Version: 1.0\\n";
        $msgstr.="Content-Type: text/plain; charset=UTF-8\\n";
        $msgstr.="Content-Transfer-Encoding: 8-bit\\n";
        $msgstr.="X-Generator: ".KARTOUCHE."\\n";
        return $msgstr;
}

function myaddslashes( $string )
// stops addslashes multiplying slashes if magic quotes is on
// thanks to: http://www.pinkgoblin.com/quotesarticle.php
{
        if (get_magic_quotes_gpc()==1)
        {
        return($string);
        }
        else
        {
        return(addslashes($string));
        }
}

function show_array($array)
{
    foreach ($array as $value)
    {
        if (is_array($value))
        {
            show_array($value); 
        }
        else
        {
            echo $value . "<br>"; 
        } 
    }
}

function get_dir_files($path)
// packs the files in $path into an array
// thanks to: Peter Moulding (PHP Black Book)
{
        $chosen_dir=opendir($path);
        while ($file_name=readdir($chosen_dir))
        {
                if ($file_name != "." and $file_name != "..")
                {
                        $file_type=filetype($path."/".$file_name);
                        $found[$path][$file_name]=$file_type;
                        if ($file_type == "dir" and $file_name != "CVS" and $file_name != "docs")
                        // ignore the CVS and docs dirs
                        {
                                $file_array=get_dir_files($path."/".$file_name);
                                $found=array_merge($found,$file_array);
                        }
                }
        }
        closedir($chosen_dir);
        if (!isset($found))
        {
                $found=array();
        }
        return $found;
}

function clean_me($var)
// replaces profanities with 3 asterisks
// thanks to: Hermawan Haryanto (www.dmonster.com)
{
        $badwords = explode("|", PROFANITY);
        $eachword = explode(" ", $var);
        for($j=0;$j<count($badwords);$j++)
        {
                for ($i=0;$i<count($eachword);$i++)
                {
                        if (is_int(strpos(strtolower($eachword[$i]), $badwords[$j])))
                        {
                          $var=eregi_replace($eachword[$i],"***",$var);
                        }
                }
        }
        return $var;
}

?>
