<table>
        <tr>
                <td>

<?
switch ($lg)
        {
        case "en":
?>

                <p><h1>Import file</h1></p>
                <p>
                        Enter a directory path where the files you wish to import are located.  The default is "cvstemplates",
                        which you can set up either by creating a <i>cvstemplates</i> directory in /kartouche/gwein, or (better)
						by symlinking your working directory to this by running: <b>ln -s /your/import/dir cvstemplates</b>
						from the /kartouche/gwein directory.  To import a subdir, enter something
						like "cvstemplates/kdemultimedia".  Do not use a trailing slash.
                </p>
                <p>&nbsp;</p>

        <?
        break;
        case "cy":
        ?>

                <p><h1>Mewnforio ffeil</h1></p>
                <p>
                        Rhowch llwybr cyfeiriadur lle y lleolir y ffeiliau y dymunwch fewnforio.  Y llwybr rhagosod yw "cvstemplates",
						a gallwch sefydlu hwn unai gan greu cyfeiriadur <i>cvstemplates</i> yn /kartouche/gwein, neu (yn well)
						gan greu cyswllt symbolaidd o'ch cyfeiriadur gwaith at hwn gan redeg: <b>ln -s /eich/cyfeiriadur/mewnforio cvstemplates</b>
						o'r cyfeiriadur /kartouche/gwein.  Er mwyn mewnforio is-gyfeiriadur, rhowch rywbeth
						fel "cvstemplates/kdemultimedia".  Peidiwch a defnyddio slaes pen-linell.
                </p>
                <p>&nbsp;</p>

<?
         break;
         }
?>

                </td>
        </tr>
</table>
