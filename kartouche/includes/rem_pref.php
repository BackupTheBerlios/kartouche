<table>
        <tr>
                <td>

<?
switch ($lg)
        {
        case "en":
?>

                <p><h1>Notes on translation - please read these before starting</h1></p>
                <p>
                These are initial notes which will be refined as the project develops.  Don't agonise too much over
                what is the "proper" thing to do - just be consistent, and if something is not covered here, email me
                at kyfieithu-wrth-dotmon(.com) to ask me about what you should do.
                </p>
                <p>
                        <ol>
                          <li>
                          What about the circumflex (t&#244; bach, het)?  The short answer is, don't worry too much about it.  If you want to
                          forget about it completely, do so - at this point, translations are more important than orthography.  If you do
                          want to add them, they depend on your PC, operating system, and font encoding, so please use the
                          guidance below.<br><br>
                          <b>&#373; &#372; &#375; &#374;</b><br>
                          Use these if they are available to you on your PC - on Windows, you may be able to get them by using Alt+0175,
                          Alt+0174, Alt+0177 and Alt+0176 respectively (see next paragraph).  Otherwise, use
                          <b>w^</b> and <b>y^</b> if you want to show the circumflex, or just <b>w</b> and <b>y</b> if you don't.  Alternatively,
                          you can cut-and-paste the characters from the line at the top of each suggestion page (note
                          that in this case the letter may be in a different font compared to the others - this is normal).<br><br>
                          <b>&#226; &#234; &#238; &#244; &#251; &#194; &#202; &#206; &#212; &#219;</b><br>
                          The default Latin encoding for most fonts includes characters for the other circumflexed
                          vowels, so they can be used if you want (or again, you can just leave out the circumflex).  You can also use cut-and
                          paste with these if you like, or there are
                          shortcut keys you can use on Windows to produce them - the numbers below should be typed on the numeric keypad:<br><br>
                          &#226; : Alt+0226 - &#234; : Alt+0234 - &#238; : Alt+0238 - &#244; : Alt+0244 - &#251; : Alt+0251<br>
                          &#194; : Alt+0194 - &#202; : Alt+0202 - &#206; : Alt+0206 - &#212; : Alt+0212 - &#219; : Alt+0219<br><br>
                          On Linux, things are (not surprisingly) a bit easier - X allows you to use key combinations to get the characters.  First, you have to
                          find out what key(s) on your system are set up as <b>Multi-key</b>, the key combination that tells X that a special
                          character is coming.  You can find this by looking in the system-wide <b>Xmodmap</b> file (in SuSE Linux 8.0 that is in
                          <i>/usr/X11R6/lib/X11/Xmodmap</i>, which is a symlink to <i>/etc/X11/Xmodmap</i>).  With SuSE the Multi-key is a combined
                          keypress of <b>Shift + right-hand Ctrl</b>.  So to get <b>&#244;</b>, you would just press those two keys simultaneously, and then
                          <b>o</b> and <b>^</b> (or <b>^</b> and <b>o</b>) sequentially.  Similarly for the other characters.
                          </li>

                          <li>
                          In the translation you MUST type in all the "odd" characters such as "\n", "<? echo htmlspecialchars("<b>"); ?>", "%2",
                          and so on.  All punctuation must also be replicated.  Thus: <br>
                          <b><? echo htmlspecialchars("Unable to add resource '%1' to address book."); ?></b><br>
                          should be translated as: <br>
                          <b><? echo htmlspecialchars("Methu ychwanegu adnodd '%1' i'r gyfeiriadur."); ?></b><br>
                          retaining the "%1" and the single quote-marks, as well as the full-stop.  Likewise:<br>
                          <b><? echo htmlspecialchars("Font size<br><i>fixed</i> or <i>relative</i><br>to environment"); ?></b><br>
                          should be translated as:<br>
                          <b><? echo htmlspecialchars("Maint y ffont yn <br><i>osodedig</i> neu <i>gymharol</i><br> i'r amgylchedd."); ?></b>, <br>
                          retaining the "br" and "i" tags which will insert linebreaks in the output message, and italicise some words in it.<br>
                          <b>\t Font:\t</b> is another example - this should be translated:  <b>\t Ffont:\t</b>
                          </li>

                          <li>
                          Words between "_:" and "\n" do not need to be translated.  Thus<br>
                          <b>_: January\nJan</b><br>
                          should be translated as:<br>
                          <b>Ion</b><br>
                          Items of the form  "_: NAME OF TRANSLATORS\n Your names" (where all that is needed in the translation
                          is the translator's name) can be left blank, because they will be filled with a standard text referring to Kyfieithu.
                          </li>

                          <li>
                          In the desktop files in particular, you will see items of the form:<br>
                          <b>Name=Display</b><br>
                          In such cases, translate ONLY what follows the equals sign, and leave what precedes it in English, thus:<br>
                          <b>Name=Arddangos</b> - NOT Enw=Arddangos!<br>
                          </li>

                          <li>
                          In cases where a phrase appears to be a "proper" noun, keep it as is, thus:<br>
                          <b>Name=SQL</b><br>
                          should be translated as:<br>
                          <b>Name=SQL</b> (see previous point as to why "Name" is retained)<br>
                          But in other cases where it is more generic, translate it.  Thus:<br>
                          <b>GenericName=User Manager</b><br>
                          should be translated as:<br>
                          <b>GenericName=Rheolwr Defnyddwyr</b><br>
                          </li>

                          <li>
                          In KDE, the ampersand (&) appears in strings as a marker for the shortcut underline in menus (the "keyboard
                          accelerator").  Thus:<br>
                          <b>&File</b><br>
                          would appear in menus as:<br>
                          <b><u>F</u>ile</b><br>
                          which allows the File menu to be opened by using Alt+F.  Clearly, all these markers need to be
                          checked for overlap, so that no two shortcuts use the same letter.  This is a complex issue, so
                          the guidance here is simply to replicate the ampersand in the translation, and let us worry about the
                          consequences!  Thus:<br>
                          <b>&Ffeil </b><br>
                          In Gnome, the underline (_) denotes the keyboard accelerator.
                          </li>
                        </ol>
                </p>
                <p>&nbsp;</p>

        <?
        break;
        case "cy":
        ?>

                <p><h1>Nodiadau am gyfieithu - darllenwch y rhain cyn cychwyn</h1></p>
                <p>
                Nodiadau cychwynnol yw rhain, a fydd eu gwella wrth ddatblygu'r fenter.  Peidiwch &#226; phoeni gormod
                am y peth "iaen" i'w wneud - 'mond bod yn gyson sydd angen, ac os nad oes gwybodaeth am rywbeth yma,
                ebostio imi wrth kyfieithu-wrth-dotmon(.com) i ofyn am beth i'w wneud.
                </p>
                <p>
                        <ol>
                          <li>
                          Beth am yr acen grom (y t&#244;  bach neu het)?  Yr ateb byr yw, peidiwch &#226;  phoeni gormod amdano.  Os ydych eisiau anghofio
                          amdano yn hollol, gwnewch - ar hyn o bryd, mae cyfieithiadau yn fwy bwysig na sillafu.  Os ydych eisiau
                          ei ddefnyddio, mae'n dibynnu ar eich CP, cysawd gweithredu ac amgodiad ffont, felly dilynnwch y
                          canllawiau yma.<br><br>
                          <b>&#373; &#372; &#375; &#374;</b><br>
                          Defnyddiwch y rhain os maent ar gael ar eich CP - ar Windows, efallai gallwch eu cael drwy ddefnyddio Alt+0175,
                          Alt+0174, Alt+0177 and Alt+0176 yn eu tro (gweler y paragraff nesaf).  Fel arall, defnyddiwch
                          <b>w^</b> and <b>y^</b> os ydych eisiau dangos y t&#244; bach, neu 'mond <b>w</b> and <b>y</b> os nad ydych.
                          Neu gallwch torri-a-gludo'r nodau o'r llinell ar ben pob tudalen awgrymiad (noder y byddent efallai yn ymddangos
                          mewn ffont gwahanol yn cymharu &#226;'r lleill - mae hyn yn arferol).<br><br>
                          <b>&#226; &#234; &#238; &#244; &#251; &#194; &#202; &#206; &#212; &#219;</b><br>
                          Mae'r amgodiad rhagosodedig Lladin i'r mwyafrif o ffontiau yn cynnwys nodau i'r llafariaid eraill efo tô bach, felly gallwch eu
                          defnyddio os ydych eisiau (neu eto, cewch adael allan y t&#244; bach).  Cewch ddefnyddio torri-a-gludo efo'r rhain os
                          ydych eisiau, neu mae bysellau brys i'r rhain ar Windows (teipiwch y rhifau ar a bysellfwrdd rhifau):<br><br>
                          &#226; : Alt+0226 - &#234; : Alt+0234 - &#238; : Alt+0238 - &#244; : Alt+0244 - &#251; : Alt+0251<br>
                          &#194; : Alt+0194 - &#202; : Alt+0202 - &#206; : Alt+0206 - &#212; : Alt+0212 - &#219; : Alt+0219<br><br>
                          Ar Linux (dim syrpreis!) mae pethau dipyn yn haws - mae X yn gadael i chi ddefnyddio cyfuniad o allweddau i greu'r
                          nodau.  Yn gyntaf, darganfyddwch pa allweddau ar eich cysawd sydd wedi eu cydosod fel <b>Multi-key</b>,
                          y gyfuniad o allweddau sy'n dweud wrth X bod nod arbennig yn dod.  Cewch ddarganfod hynny drwy edrych yn y
                          ffeil lled-gysawd <b>Xmodmap</b> (yn SuSE Linux 8.0 mae hwn yn <i>/usr/X11R6/lib/X11/Xmodmap</i>, sy'n
                          symgyswllt i <i>/etc/X11/Xmodmap</i>).  Efo SuSE mae'r Multi-key yn gyfuniad o allweddau
                          <b>Shift + de-Ctrl</b>.  Fell, er mwyn cael <b>&#244;</b>, cewch wthio'r ddwy allwedd yna yr un pryd, ac wedyn
                          <b>o</b> a <b>^</b> (neu <b>^</b> a <b>o</b>) ar ôl eu gilydd.  Yr un peth i'r nodau eraill.
                          </li>

                          <li>
                          Yn y cyfieithiad RHAID i chi deipio i mewn y nodau "rhyfedd" i gyd fel "\n", "<? echo htmlspecialchars("<b>"); ?>", "%2",
                          ac ati.  Rhaid i chi gopio hefyd pob atalnod.  Felly cyfieithir: <br>
                          <b><? echo htmlspecialchars("Unable to add resource '%1' to address book."); ?></b><br>
                          fel: <br>
                          <b><? echo htmlspecialchars("Methu ychwanegu adnodd '%1' i'r gyfeiriadur."); ?></b><br>
                          yn cadw'r "%1" a'r collnodau sengl, a'r atalnod llawn hefyd.  Yn yr un ffordd, cyfieithir:<br>
                          <b><? echo htmlspecialchars("Font size<br><i>fixed</i> or <i>relative</i><br>to environment"); ?></b><br>
                          fel:<br>
                          <b><? echo htmlspecialchars("Maint y ffont yn <br><i>osodedig</i> neu <i>gymharol</i><br> i'r amgylchedd."); ?></b>, <br>
                          yn cadw'r tagiau "br" and "i" a fydd yn mewnosod torriad llinell yn y neges ac eidaleiddio rhai geairiau ynddo.<br>
                          Mae <b>\t Font:\t</b> yn enghraifft arall - dylid cyfieithu hwn fel:  <b>\t Ffont:\t</b>
                          </li>

                          <li>
                          Does dim angen cyfieithu geiriau rhwng "_:" a "\n".  Felly cyfieithir<br>
                          <b>_: January\nJan</b><br>
                          fel:<br>
                          <b>Ion</b><br>
                          Gallwch adael eitemau fel  "_: NAME OF TRANSLATORS\n Your names" (lle mae angen 'mond enw'r cyfieithydd
                          yn y cyfieithiad) yn wag, achos mi fyddent yn cael eu llenwi efo testun safonol yn s&#244;n am Kyfieithu.
                          </li>

                          <li>
                          Yn y ffeiliau bwrdd gwaith yn arbennig, byddwch yn gweld eitemau fel<br>
                          <b>Name=Display</b><br>
                          Yma mae angen cyfieithu 'MOND be sy'n dilyn y nod hafal, a gadael be sydd o'i flaen yn Saesneg, felly:<br>
                          <b>Name=Arddangos</b> - DIM Enw=Arddangos!<br>
                          </li>

                          <li>
                          Pan mae'r dywediad yn enw  "priod", cadwch fo, felly cyfieithir:<br>
                          <b>Name=SQL</b><br>
                          fel:<br>
                          <b>Name=SQL</b> (edrychwch ar y pwynt o'r blaen i weld pam y cadwer "Name")<br>
                          Ond mewn llefydd eraill lle mae'r enw yn fwy enerig, cyfieithwch fo.  Felly cyfieithir:<br>
                          <b>GenericName=User Manager</b><br>
                          fel:<br>
                          <b>GenericName=Rheolwr Defnyddwyr</b><br>
                          </li>

                          <li>
                          Yn KDE, mae'r ampersand (&) yn ymddangos mewn dywediadau fel dynodwr i'r danlinell brys yn y dewislenni (y "cyflymydd
                          bysellfwrdd").  Felly buasai:<br>
                          <b>&File</b><br>
                          yn ymddangos mewn dewislenni fel:<br>
                          <b><u>F</u>ile</b><br>
                          sy'n gadael i'r dewislen File gael ei hagor drwy ddefnyddio Alt+F.  Wrth gwrs, mae angen gwirio y marcwyr i gyd yma,
                          er mwyn sicrhau nad ydy dau bryslwybrau yn defnyddio'r un llythyren.  Mae hynny yn beth cymhleth, felly y
                          canllawiau yma yw 'mond copio'r ampersand yn y cyfieithiad, a gadael i ni sortio fo allan!  Felly cyfieithir:<br>
                          <b>&Ffeil</b><br>
                          Yn Gnome, mae'r danlinell (_) yn dynodi'r cyflymydd bysellfwrdd.
                          </li>
                        </ol>
                </p>
                <p>&nbsp;</p>

<?
         break;
         }
?>

                </td>
        </tr>
</table>