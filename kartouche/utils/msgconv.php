<?

include("kartouche/config.php");
include("../includes/fns.php");

checklg($lg);

include("../includes/trans.php");
include("../includes/header.php");

echo "<div class=\"content\">";

dbconnect();

$found=get_dir_files("exports_orig/testing_utf");

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

                                // note that msgconv must be fed the full path to the file
                                // also note that the server must be able to write to the files - ie they must have permissions of at least 666

                                $result=`/usr/bin/msgconv exports_orig/testing_utf/$file_name -t UTF-8 -o exports_orig/testing_utf/$file_name`;
                                echo "Converted $file_name to UTF-8<br>";

                        }

                }

        }

}

echo "</div>";

include("../includes/footer.php");

?>