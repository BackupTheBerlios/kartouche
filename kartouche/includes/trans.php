<?
// the translation system for LIP is based on an idea by J Wynia
// (www.phpgeek.net), and this code is lifted from his site - respect is due! 

// the use of WEBURL below is to allow the admin pages to find the trans
// directory, otherwise there is a clash of paths with the normal pages

switch ($lg)
        {
        case "en":
                $trans_file=WEBURL."trans/trans_en.txt";
                break;
        case "cy":
                $trans_file=WEBURL."trans/trans_cy.txt";
                break;
        }

$fp=fopen($trans_file,"r") or die("Can't open the translations file");

while ($line=fgets($fp,1024))
        {
        $line=ereg_replace("#.*$","",$line);
        list($name,$value)=explode('=',$line);
        $name=trim($name);
        $value=trim($value);
        $$name=$value;
        }

fclose($fp) or die("Can't close the translations file");

?>
