
See full formatted Master-Changelog on https://oop.ownonline.eu/changelog

This version of the Master-Changelog here on GitHub only exists to fill the documentation gap in the repository, as the project was already started before this Git entry was created. No such file is maintained here on GitHub, as the chjnagelog is now managed and listed by GitHub. You can find a changelog in this form here for each version in the changelog file of the release and in the respective commit.

---

# 0.0.1.0 _Abelia_ - 29.03.2024
Today @ps brings you the Abelias. The new Release for oOPlay
## Neuerungen:
- Beim Anklicken der Aktuellen Sendung im Hauptbildschirm wird der Senderplan geöffnet
- Die Menüpunkte „Sendeplan“ & „Über “ sind nun nicht mehr im Dropdown, sondern werden direkt im Hauptmenü oben angezeigt, sowie die Bildschirmgröße dies ermöglicht.
- Im Fenster „Über “ und im Menüpunkt wird nun der Anzeigename statt der Rohname verwendet (Beispiel: „Über Eins“ statt „Über eins“)
- Anzeigefehler, der dazu führte, dass Firefox den Anzeigebereich der gesamten Webseite auf 24px beschränkte, ist behoben.
- Zusätzlich zu fehlenden Parametern, erkennt der Player nun auch, wenn der Audiostream unterbrochen wurde, oder nicht aufgebaut werden kann. Der Player prüft im laut.fm-Modus sodann, ob der Dienst korrekt arbeitet. Die Antwort dieser Anfrage wird interpretiert und der Nutzer erhält Tipps zur Fehlerbehebung.
- Im Menü sind nun Icons hinzugefügt worden.
- Im Fenster für die Titelhistorie wird der erste Song hervorgehoben, da Aufgrund der API-Logik der erste Song der Antwort immer der aktuell spielende ist. Bei Livestreams funktioniert diese Anzeige zum Teil nicht, da die API vermutlich dann den aktuellen Song nicht direkt in die Historie einbindet.
- Der Player liefert nun OpenGraphTags aus. Diese werden vor allem von Social-Media-Kanälen aber auch von Foren hier wie Discuss benutzt. So kann ein Link in einen Informationsblock umgewandelt werden, der über die Quelle aufklärt und darauf verlinkt. (Ein solches System wird auch im Laut-fm-Forum eingesetzt.
- Convoyer (sorgt für die beweglichen Titelinformationen, wenn der Bildschirm zu klein ist) ist derzeit wieder deaktiviert, da nicht mehr funktionsfähig, es wird mit Tooltips und Elipssis gearbeitet. Convoyer kommt in einer zukünftigen Version vielleicht zurück.
- Variable „colors“ wurde durch „theme“ abgelöst. „theme“ erlaubt das Wählen eines voreingestellten Styles durch die Angabe seiner Bezeichnung (theme=light). Im Standardmodus wird immer ein dunkles Thema geladen. Ein helles Thema kann über „theme=light“ geladen werden. Eine noch mehr verdunkeltes Thema kann mit „theme=moredark“ geladen werden. Außerdem werden hierüber Spezialthemen geladen. Als Beispiel: Mit „theme=win2000“ kann ein an den Windows 2000-Desktop erinnerndes Thema geladen werden.
- Achtung: Die Themes „light“ und „moredark“ sind noch nicht hundertprozentig fertiggestellt.
- Der Sendeplan wird nun nicht mehr in einem Akkordion, sondern in einer einfacheren Tabansicht geladen und der aktuelle Wochentag wird automatisch angezeigt.
- Im Fenster über den Sender wird nun der Slogan angezeigt.
- Theming-Eninge-Verfahren verbessert für bessere Erkennung

## Was kommen sollte – aber nach hinten verschoben wird:
- Bestimmte Elemente können per Parameter abgeschaltet werden
- Verbesserung der Darstellung des Senderslogans und Einbindung des Senderbildes im Fenster „Über SENDER“
- Dokumentationsseite wird fertig gestellt
- Player-SourceCode wird veröffentlicht um diesen zu Forken.

## Aufsetzen von oOPlay Abelia:
- Aufrufen der Aktuellen Version: (Sender: radiomoodorf auf laut.fm)
&nbsp; https://oop.ownonline.eu/play/?lfmstream=radiomoordorf
- Aufrufen der alten Version 0.0.0.2 (Sender: radiomoodorf auf laut.fm)
&nbsp; https://oop.ownonline.eu/play/0-0-0-2/?lfmstream=radiomoordorf <br> <i>Wenn ihr weiterhin die Vorgängerversion nutzen wollt, könnt ihr das bis Ende 2024 tun. Hierzu könnt Ihr den Link um die Versionsnummer verwenden. Wenn ihr den Link auf eurer Homepage nicht bis Karfreitag entsprechend verändert, werden eure Besucher automatisch auf Version 0.0.1.0 geleitet.</i>

## Parameter zu Beachtung:
- <kbd>?lfmstream</kbd> = euer Sender, dies muss euer im laut-fm-Streamingserver verwendeter Name sein. Nicht der Displayname. Am besten den Namen aus der URL der Laut-FM-Seite eueres Edners nehmen. Die neue Version wird aber auch direkt meckern, wenn sie den Sender nicht findet.
- <kbd>?theme</kbd> =  Standard ist ‚dark‘ es gibt aber noch ‚light‘ und ‚moredark‘ (in Vollendung, könnt ihr aber schon probieren) und für Boomer gibt’s als Osterei noch ein nostalgisches Windows-Theme ‚win2000‘

Denkt bitte bei der Verwendung von mehrere Parametern daran, die Zeichen richtig zu setzen – Erster Parameter beginnt mit ? und alle folgenden mit & . Es wird in neueren Versionen noch mehr Parameter zur Einstellung geben.

----

# 0.0.0.2A - 17.02.2024
Dieser Realese passt die Oberfläche der Version 0.0.0.2 optisch ein wenig an die Oberfläche der in der Entwicklung befindelichen Version 0.0.1.0 an. Dies geschieht, um Nutzer ohne große Umstellungen an die neue Version gewöhnen zu können.

 

Neuerungen:

================================

- Schaltflächen zum Schlißen der Fenster wurden von Uncidoe-Symbols auf Font-Awesome umgestellt.

- Symbole von den einzelnen Songs unter "Letzte Titel" wurden von Uncidoe-Symbols auf Font-Awesome umgestellt.

- Schaltfläche für Google Cast zeigt nun nurnoch das Symbol und keinen Text mehr. Das Symbol ist eigentlich so bekannt, dass das Label "Streamen" nicht mehr erforderlich ist"

- Die Standardlautstärke des Player wurde von 50 auf 30% heruntergsetzt. Dies wird zukünftig der neue Standardwert sein. Ab Version 0.0.1.0 kann dieser Wert per Parameter angepasst werden. Dieser Wert wir per Paramter aber nur auf maximal 60% gestellt werden können. Wer lauter hören möchte, kann den Regler bis 100% aufdrehen. Dadurch entscheidet der Hörer, dass er lauter hören möchte und je nach Lautsprecher Hörschäden in Kauf nehemen möchte.

 

WICHTIGE INFORMATION ZUR UPDATEPOLITIK

=====================================

Version 0.0.0.2A ist weiterhin über 'https://oop.ownonline.eu/play.php' abrufbar. Mit Version 0.0.1.0 wird die jeweils aktuelle Version anders angesprochen. Wer zum Beispiel für eine Weile auf einer Version beleiben möchte ohne Updates zu erhalten, wird dies bald können. Allerdings gebe ich nur für die aktuelle und die jeweilige Vorgängerversion Abrufgarantie. Mit Version 0.0.1.0 wird deshalb auch Version 0.0.0.1 abgestellt. Jetzt ist das noch nicht wichtig, aber wer manuell updaten möchte, sollte das für die Zukunft wissen.

Version 0.0.1.0 wird bald (noch nicht jetzt) über 'https://oop.ownonline.eu/player' abrufbar sein. Wer direkt eine bestimmte Version ansprechen möchte, verweist auf 'https://oop.ownonline.eu/versions/'. Dieser Direkte Versionabruf wird sobald der Support abgelaufen ist stillgelegt und auf die Aktuellste Version verweisen.

----

# 0.0.0.2 - 12.02.2024
## Neuerungen:
- Senderinformationen werden nur dann angezeigt, wenn sie auch existieren.
- Senderbeschreibung steht im Infofenster
- service-worker für offline handling wurde eingebaut.
- Eine Grundstruktur für eine Fehlerkonsole wurde eingebaut
- Der Verweis auf ein Livebild aus der APi führt nun auch zu einer Grafik, hatte ich vorher vergessen
- Das Platzhalterbild wurde dem Livebild entsprechend angepasst.
- Das Senderinfofenster ist nun auch über einen klick auf das Senderbild, und auf den Sendernamen abrufbar
- Mehrere Skripte optimiert, um Fehler zu behandeln und leere Einträge zu vermeiden.
- Die Integration von Font Awesome Icons in verschiedene Teile der Webseite durchgeführt, um das Design zu verbessern und Benutzerfreundlichkeit zu erhöhen.
- Wir sich keine Webseite zutraut und stattdessen unter der Sender-URL einfach was von Facebook, instagramm oder twitter einbaut wird feststellen müssen, dass das von oOPlay erkannt wird. Wenn ihr keine Sender-URL habt, sondern nur ne facebook, twitter oder insta-Page dann tragt die bitte in die extra dafür verfügbaren Felder im station-admin ein. Falls ihr Gründe habt, dass so zu machen, go for it. Aber für mich ist sowas keine Homepage. Entsprechend wird das vom Player auch nicht direkt so benannt. Sorry, da bin ich ein Monk!
 

## Bekannte Bugs:
- Der Service-Worker (der übernimmt, wenn die Internetverbindung abbricht) arbeitet noch nicht ganz wie gewollt. Konkret schmiert der Player ab, wenn man ihn ohne Internetverbindung abruft. Wenn die Verbindung aber im laufenden abbricht, scheint dem Player das sowas von egal zu sein … da muss ich nochmal ran. Aber er wird trotz dessen funktionieren, solange ihr Netz habt.
- Die Tunein-URL könnte bei einigen Sendern angezeigt werden, aber der Sender wird bei Tune-In nicht gefunden. Dafür kann der Player nix, das liegt an einem Kommunikationsproblem zwischen der laut.fm/api und TuneIn. Konkret sind in der laut-fm-Datenbank teilweise veraltete Links zu tunein zu finden. Um das zu fixen, müsst ihr laut oder tunein nerven, das ist nicht meine Baustelle. Aber ich werde das Beobachten und wenn die das nicht fixen werde, ich mir in einem der nächsten Updates zunutze machen, das TuneIn bei besagten Sendern auch den entsprechenden Status-Code übergibt. Dann wird das auch überprüft und der Button nicht geladen ggf., ist dann halt deren schuld.

----

# 0.0.0.1 27.01.2024
Besondere Features:
Responsiv: oOPlay passt sich an verschiedene Bildschirmgrößen an, wobei mindestens eine Auflösung von 580x480px als Anzeigegröße empfohlen wird. Ich empfehle deshalb, ihn zurzeit noch nicht als iFrame-Einbindung zu nutzen, sondern als PopUp-Player. Ab 1000x900 entfaltet der Player seine beste grafische Performance, aber da möchte ich zukünftig noch schauen wie man das besser lösen kann.
Mehr als nur Musik: Im Vergleich zu anderen Playern bietet oOPlay eine Vielzahl von Features und ist stärker mit dem Sender verbunden. Die Titelhistorie, der Sendeplan, grundlegende Infos zum Sender und Links. Ich habe oOPlay jede Funktion verpasst, die ich mir für den PopUp-Player meiner Station gewünscht habe. Im Grunde ist das Ding ein zusammengepresste Version der laut.fm-Abspielseite. Es gibt derzeit nur drei Infos, die ihm im Vergleich zur Abspielseite fehlen, das wären die Anzeige des Senderslogans, die Senderbeschreibung, und die Beschreibungen der Sendungen. Ein weiteres Highlight ist die Integration von Google Cast für einfaches Streamen unerstützte Geräte, insofern euer Browser die Cast-Technologie unterstütz - was zum Beispiel der Firefox nicht tut.
Bedienung:
Wenn ihr einfach die Player-URL aufruft, passiert nicht viel. Damit oOPlay funktioniert, braucht er den Stationsnamen von euch.
Der URL-Syntax ist aber recht einfach. Setzt einfach die Variable lfmstream= und tragt euren Sendernamen ein.
https://oop.ownonline.eu/play.php?lfmstream=eins
 
- Danach lädt die Abspielseite. Autoplay ist aktiviert, sollte der Browser das unterbinden (passiert ab und zu) dann einfach unten auf Play drücken. Wer LPlayer (Noch ein PopUp-Player :) Jetzt in Homepage einbinden 8) kennt wird feststellen, dass das Layout nahezu identisch ist. Das liegt daran, dass LPlayer es gut vormacht - hätte LPlayer ein paar Infos mehr mitgebracht, würde es diesen Player hier nicht geben.
- Unten findet ihr die Wiedergabetaste, eine Laustärkeregelung und den Knop für GoogleCast.
- Oben findet Ihr das Menü für den Sender. Hier könnt ihr auf die Track-History, den Sendeplan, grundlegende Senderinfos und Links der Station auf anderen Wiedergabequellen finden.
- Inder mitte findet ihr selbsterklärend den aktuellen Titel und Artist, begleitet von einem Albumcover und Albumtitel falls vorhanden.
 
Anpassung
- nolfmfeatures=y .;. Wer einzelne oder alle zusätzlichen laut.fm-Informationen nicht sehen will, kann diesen Paramter verwenden, Er soll in Zukunft dafür sorgen, dass Track-History, Sedndeplan, das Senderinfo-Fenster und die alternativen Wiedergabequellen nicht angezeigt werden. Altuell ist diese Funktion aber noch nicht vollständig intigriert. Einiges wird noch geladen, weil es den Paramter aktuell noch ignoriert.
- colors=light .;. Mit diesem Paramter lädt eine helle Version des Players. Diese ist farbtechnisch mit der laut.fm-Abspielseite abgestimmt.
- colors=custom mit diesem Paramter lädt eine farblich leicht angepasste Version des Players. Durch nutzen der Parameter tcolor und bcolor kann die Farbe von Vordergrund und Hintergrundelementen einwenig individualisert werden. Als Farbcodes werden nur Hex-Codes akzeptiert und es kann t und c color können nicht alleine verwendet werden.
Beispiel: https://oop.ownonline.eu/play.php?lfmstream=eins&colors=custom&bcolor=1ed9b4&tcolor=000000  
 
Mindestanforderungen:
Um oOPlay nutzen zu können benötigt Ihr einen Browser, der HTML5-Audio unterstützt.
oOPlay prüft Serverseitig den Browser, der Inhalt anfordert, wird er nicht unterstützt wird eine Fehlermeldung ausgegeben. Folgende BVrowser werden nicht unterstützt:
- Internet Explorer 11 und älter
- Firefox Version 70 und älter
- Chrome Version 79 und älter
- Safari Version 12 und älter
- Opera Version 60 und älter
Nur mal so, diese Versionsnummern hatten die jeweiligen Browser gegen 2020, das klingt jetzt nicht alt, aber für Webbrowser ist das schon zuvorkommend.
 
Weitere Entwicklung:
Folgende Dinge sind in der Zukunft geplant.
Bugfixes:
- BUG > nolfmfeatures arbeitet nicht korrekt
- Der Parameter nolfmfeatures soll alle Laut.fm-Features deaktivieren können
- y deaktiviert Track-History, Sendeplan, Senderinfo-Fenster, Wiedergabealternativen-Fenster
- Neue Features:
- Titelinfo in MediaMetadat-API senden: Die Titelinformationen an die MediaMetadata - Web APIs | MDN 5 übergeben werden.
- nolfmfeatures soll individueller eingesetzt werden: Track-History, Sendeplan, Senderinfo-Fenster, Wiedergabealternativen-Fenster sollen über nolfmfeatures auf Wert i für individuell und dem zusätzlichen Parameter cut gefolgt von ID´s einzeln ausgeblendet werden.
- Besseres Theming: Das Basisdesign des Players soll mehr mit den induviduell übergebbaren Farbkombinationen von colors zusammenarbeiten. Außerdem sollen die Wiedergabeschaltflächen umgestaltet werden. Mit Unicode-Emojis zu arbeiten zeugt jetzt nicht von professionalität
- Integration von upup.js: Ich weiß, vorallem die Gamer hier hassen diesen Begriff, aber es ist leider bei einem Webradio gezwungenermaßen so, dass hier ein Onlinezwang existiert. Da sich bei meinen Tests herausgestellt hat, dass bei einem Verbindungsabbruch, die Laut.fm-JS-API die Arbeit streikt - auch wenn die Verbindung wiederhergestellt wurde - werde ich in Zukunft versuchen TalAter´s UpUp 2 in den Player einzubauen. Das Skript erkennt einen Verbindungsabruch und lädt die Seite neu sobald das möglich ist.
