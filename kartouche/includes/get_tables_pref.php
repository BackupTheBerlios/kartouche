<table>
        <tr>
                <td>

<?
switch ($lg)
        {
        case "en":
?>

                <p><h1>Select a file to translate</h1></p>
                <p>
                        Click on a filename below in order to add suggested translations. If you want a
						text version on your own PC, just click the export icon
						<img src="images/export.png" width=40 height=15 border=0> and save the resulting
						screen from the browser as "filename.txt".  Then open it in a text editor, use
						Find-and-Replace to get rid of the &lt;br&gt; tags, and save it as "filename.po".
						It can then be opened in KBabel or any other .po editor for final checking.
						Note that this file will contain only comments, source strings (msgids) and
						translations (msgstrs) - it will NOT contain any suggestions.
                </p>
                <p>
                        <?
                        // This $view switch allows the user to see all the items, or only the ones still needing a suggested translation.
                        // The latter may be useful when most of a file is translated, but there are a few outstanding items here
                        // and there; this option will minimise leafing through the file.
                        // The values for the switch are "all" (the default) or "empty", and the default is set in get_tables.php.
                        if ($view=="empty")
                        {
                        ?>

                        <h3>Showing untranslated items only</h3>
                        The files are currently set to show only items which still need a translation.
                        (Note that with this option the page indicator will be incorrect.)
                        To see all items, including those already translated, click
                        <a href="get_tables.php?lg=<? echo $lg; ?>&view=all">HERE</a>, and then select a file.

                        <? } else { ?>

                        <h3>Showing all (translated and untranslated) items</h3>
                        The files are currently set to show both translated and untranslated items.
                        To see only those items still requiring a translation, click
                        <a href="get_tables.php?lg=<? echo $lg; ?>&view=empty">HERE</a>, and then select a file.
                </p>

        <?
        }
        break;
        case "cy":
        ?>

                <p><h1>Dewis ffeil i'w gyfieithu</h1></p>
                <p>
                        Cliciwch ar enw ffeil yn isod er mwyn ychwanegu cyfieithiadau awgrymiedig.  Os
						ydych eisiau fersiwn testun ar eich CP eich hun, cliciwch ar yr eicon allforio
						<img src="images/export.png" width=40 height=15 border=0> a cadwch y sgrîn
						canlynol oddiwrth y porydd fel "enwffeil.txt".  Wedyn, agorwch y ffeil gan
						ddefnyddio golygydd testun, defnyddiwch Canfod-ac-Amnewid i gael gwared ar
						y tagiau &lt;br&gt;, a cadwch fo fel "enwffeil.po".  Gellir ei agor wedyn
						yn KBabel neu unrhyw golygydd .po arall am cywiro terfynol.  Noder: bydd y
						ffeil yma yn cynnwys dim ond sylwadau, llinynnau tarddiad (msgids) a
						cyfieithiadau (msgstrs) - bydd o DDIM yn cynnwys awgrymiadau.
                </p>
                <p>
                        <?
                        // This $view switch allows the user to see all the items, or only the ones still needing a suggested translation.
                        // The latter may be useful when most of a file is translated, but there are a few outstanding items here
                        // and there; this option will minimise leafing through the file.
                        // The values for the switch are "all" (the default) or "empty", and the default is set in get_tables.php.
                        if ($view=="empty")
                        {
                        ?>

                        <h3>Dangos 'mond eitemau sydd heb eu cyfieithu</h3>
                        Mae'r ffeiliau ar hyn o bryd yn dangos 'mond eitemau sydd angen eu cyfieithu.
                        (Dalier sylw bod efo'r dewisiad yma bydd y dangosydd tudalennau yn anghywir.)
                        Os ydych eisiau gweld pob eitem cliciwch
                        <a href="get_tables.php?lg=<? echo $lg; ?>&view=all">YMA</a>, ac wedyn dewisiwch ffeil.

                        <? } else { ?>

                        <h3>Dangos pob un eitem (wedi eu cyfieithu ac heb eu cyfieithu)</h3>
                        Mae'r ffeiliau ar hyn o bryd yn dangos eitemau sydd wedi eu cyfieithu wrth ymyl rhai sydd heb eu cyfieithu.
                        Os ydych eisiau gweld 'mond rhai sydd angen eu cyfieithu, cliciwch
                        <a href="get_tables.php?lg=<? echo $lg; ?>&view=empty">YMA</a>, ac wedyn dewisiwch ffeil.
                </p>

<?
         }
         break;
         }
?>

                </td>
        </tr>
</table>
