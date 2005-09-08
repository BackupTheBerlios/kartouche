<table>
        <tr>
                <td>

<?
switch ($lg)
        {
        case "en":
?>

                <p><h1>Kartouche administration</h1></p>
                <p>
                        Welcome to Kartouche!  Use the links above to access the various functions. 
                </p>
                <p>
                        <h3>Userland pages: </h3>
                        <ul>
                        <li><a href="../use.php?lg=en">Notes on using Kartouche</a></li>
                        <li><a href="../remember.php?lg=en">Notes on translation</a></li>
						<li><a href="../get_tables.php?lg=en"><? echo $adm_sel_file; ?></a></li>
                        </ul>
                </p>
                <p>&nbsp;</p>

        <?
        break;
        case "cy":
        ?>

                <p><h1>Gweinyddu Kartouche</h1></p>
                <p>
                        Croeso i Kartouche!  Defnyddiwch y cysylltau uchod i gyrchu'r ffwythiannau gwahanol.
                </p>
                <p>
                        <h3>Tudalennau tir-defnyddwyr: </h3>
                        <ul>
                        <li><a href="../use.php?lg=cy">Nodiadau ar ddefnyddio Kartouche</a></li>
                        <li><a href="../remember.php?lg=cy">Nodiadau ar gyfieithu</a></li>
						<li><a href="../get_tables.php?lg=cy"><? echo $adm_sel_file; ?></a></li>
                        </ul>
                </p>
                <p>&nbsp;</p>

<?
         break;
         }
?>

                </td>
        </tr>
</table>
