<table>
        <tr>
                <td>

<?
switch ($lg)
        {
        case "en":
?>

                <p><h1>Export file</h1></p>
                <p>
                        Select one or more files (tables) to export to .pot files.  These will be stored in the "exports"
                        directory.  Remember that you must set this up either by creating an <i>exports</i> directory in
						/kartouche/gwein, or (better) by symlinking your working directory to this by running:
						<b>ln -s /your/export/dir exports</b> from the /kartouche/gwein directory.
                </p>
                <p>&nbsp;</p>

        <?
        break;
        case "cy":
        ?>

                <p><h1>Allforio ffeil</h1></p>
                <p>
                        Dewiswch un neu mwy o ffeiliau i'w allforio i ffeiliau .pot.  Cadwer rheiny yn y cyfeiriadur
                        "exports".  Cofiwch bod rhaid i chi sefydlu hwn unai gan greu cyfeiriadur <i>exports</i> yn
						/kartouche/gwein, neu (yn well) gan greu cyswllt symbolaidd o'ch cyfeiriadur gwaith at hwn
						gan redeg: <b>ln -s /eich/cyfeiriadur/allforio exports</b> o'r cyfeiriadur /kartouche/gwein.
                </p>
                <p>&nbsp;</p>

<?
         break;
         }
?>

                </td>
        </tr>
</table>
