<?

header ("Content-type: image/png");

include("kartouche/config.php");
include("includes/fns.php");

dbconnect();

$sql2="select count(*) as total from kabc_file";
$result2=mysql_query($sql2) or die("Can't select the total count");
$row2=mysql_fetch_object($result2);
$total=$row2->total;

$sql3="select count(*) as untrans from kabc_file where msgstr=\"\"";
$result3=mysql_query($sql3) or die("Can't select the untranslated count");
$row3=mysql_fetch_object($result3);
$untrans=$row3->untrans;

$trans=rounded(($total-$untrans)/$total*100,0);

$im = imagecreate(200,10);

$bg_col = imagecolorallocate ($im, 255, 204, 255);
$border = imagecolorallocate ($im, 153, 0, 51);
$bar = imagecolorallocate ($im,204,153,255);

imagefilledrectangle ($im, 0, 0, 2*$trans, 10, $bar);
imagerectangle ($im, 0, 0, 199, 9, $border);

imagepng($im);

?>