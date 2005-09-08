<?php

if (get_magic_quotes_gpc()==1) {

   echo ( "Magic quotes gpc is on" );

} else {

   echo ( "Magic quotes gpc is off" );

}

echo "<br>";

if (get_magic_quotes_runtime()==1) {

   echo ( "Magic quotes runtime is on" );

} else {

   echo ( "Magic quotes runtime is off" );

}

?> 