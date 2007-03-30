<?php # $Id: lang_de.inc.php 1457 2006-10-26 09:41:10Z garvinhicking $

        @define('PLUGIN_EVENT_SPAMBLOCK_TITLE', 'Spamschutz');
        @define('PLUGIN_EVENT_SPAMBLOCK_DESC', 'Mehrere Möglichkeiten, um Kommentarspam einzudämmen');
        @define('PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY', 'Spamschutz: Ungültiger Kommentar!');
        @define('PLUGIN_EVENT_SPAMBLOCK_ERROR_IP', 'Spamschutz: Ein weiterer Kommentar kann innerhalb so kurzer Zeit nicht übermittelt werden.');
        @define('PLUGIN_EVENT_SPAMBLOCK_ERROR_KILLSWITCH', 'Dieses Blog ist im "Notfall Kommentar"-Modus. Bitte kommen Sie später wieder.');
        @define('PLUGIN_EVENT_SPAMBLOCK_BODYCLONE', 'Keine doppelten Kommentare erlauben');
        @define('PLUGIN_EVENT_SPAMBLOCK_BODYCLONE_DESC', 'Verbietet Benutzern einen Kommentar zu übermitteln, der gleichlautend bereits besteht.');
        @define('PLUGIN_EVENT_SPAMBLOCK_KILLSWITCH', 'Notfall-Blockade von Kommentaren');
        @define('PLUGIN_EVENT_SPAMBLOCK_KILLSWITCH_DESC', 'Übergangsweise Kommentare zu allen Einträgen verbieten. Nützlich, wenn das Blog unter andauerndem Spam-Beschuss leidet.');
        @define('PLUGIN_EVENT_SPAMBLOCK_IPFLOOD', 'IP-Block Intervall');
        @define('PLUGIN_EVENT_SPAMBLOCK_IPFLOOD_DESC', 'Schränkt die Anzahl an Kommentare pro IP ein, indem nur alle X Minuten ein Kommentar erlaubt wird. Hilfreich, um Spamfluten derselben IP abzuwehren.');
        @define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS', 'Captchas aktivieren');
        @define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_DESC', 'Erfordert die Eingabe eines zufälligen Buchstabenfolge vom Benutzer, damit ein Kommentar angenommen wird. Diese Eingabe kann von Spambots nicht getätigt werden und verhindert so automatische Kommentare. Jedoch können behinderte oder blinde Personen mit der Darstellung solcher Eingabegrafiken Probleme haben.');
        @define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_USERDESC', 'Um maschinelle und automatische Übertragung von Spamkommentaren zu verhindern, bitte die Zeichenfolge im dargestellten Bild in der Eingabemaske eintragen. Nur wenn die Zeichenfolge richtig eingegeben wurde, kann der Kommentar angenommen werden. Bitte beachten Sie, dass Ihr Browser Cookies unterstützen muss um dieses Verfahren anzuwenden. ');
        @define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_USERDESC2', 'Bitte die dargestellte Zeichenfolge in die Eingabemaske eintragen!');
        @define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_USERDESC3', 'Hier die Zeichenfolge der Spamschutz-Grafik eintragen: ');
        @define('PLUGIN_EVENT_SPAMBLOCK_ERROR_CAPTCHAS', 'Sie haben nicht die richtige Spamschutz-Zeichenfolge eingetragen, die in der Grafik dargestellt wurde. Bitte sehen Sie sich dieses Bild erneut an und tragen Sie die korrekte Zeichenfolge ein.');
        @define('PLUGIN_EVENT_SPAMBLOCK_ERROR_NOTTF', 'Captchas können auf Ihrem Server nicht dargestellt werden. Sie benötigen GDLib und die freetype Bibliotheken, sowie die richtigen .TTF Dateien.');

        @define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_TTL', 'Captchas nach wie vielen Tagen erzwingen');
        @define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_TTL_DESC', 'Captchas können abhängig vom Alter des Artikels eingeblendet werden. Tragen Sie das Minimalalter eines Artikels in Tagen ein, ab dem Captchas erforderlich werden sollen. Falls auf 0 gesetzt, sind Captchas immer erforderlich.');
        @define('PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATION', 'Kommentarmoderation nach wievielen Tagen erzwingen');
        @define('PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATION_DESC', 'Alle Kommentare zu einem Artikel können abhängig vom Alter des Artikels automatisch moderiert werden. Tragen Sie hier das Minimalalter eines Artikels in Tagen ein, ab dem jeder Kommentar erst nach Ihrer Moderation dargestellt wird. 0 bedeutet, dass keine automatische Moderation erzeugt wird.');
        @define('PLUGIN_EVENT_SPAMBLOCK_LINKS_MODERATE', 'Erforderliche Anzahl an Links für Moderation');
        @define('PLUGIN_EVENT_SPAMBLOCK_LINKS_MODERATE_DESC', 'Wenn in einem Kommentar eine bestimmte Anzahl an Links vorhanden ist, kann der Kommentar automatisch moderiert werden. Falls auf 0 gesetzt, wird diese Linkprüfung nicht vorgenommen.');
        @define('PLUGIN_EVENT_SPAMBLOCK_LINKS_REJECT', 'Erforderliche Anzahl an Links für Abweisung');
        @define('PLUGIN_EVENT_SPAMBLOCK_LINKS_REJECT_DESC', 'Wenn in einem Kommentar eine bestimmte Anzahl an Links vorhanden ist, kann der Kommentar automatisch abgelehnt werden. Falls auf 0 gesetzt, wird diese Linkprüfung nicht vorgenommen.');

        @define('PLUGIN_EVENT_SPAMBLOCK_NOTICE_MODERATION', 'Aufgrund einiger Bedingungen wird der Kommentar moderiert und erst nach Bestätigung des Blog-Eigentümers dargestellt.');
        @define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHA_COLOR', 'Hintergrundfarbe des Captchas');
        @define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHA_COLOR_DESC', 'RGB Werte eingeben: 0,255,255');

        @define('PLUGIN_EVENT_SPAMBLOCK_LOGFILE', 'Speicherplatz für das Logfile');
        @define('PLUGIN_EVENT_SPAMBLOCK_LOGFILE_DESC', 'Einige Informationen über die Abweisung/Moderation von Kommentaren kann in ein Logfile geschrieben werden. Wenn diese Option auf einen leeren Wert gesetzt wird, findet keine Protokollierung statt.');

        @define('PLUGIN_EVENT_SPAMBLOCK_REASON_KILLSWITCH', 'Notfall-Blockade');
        @define('PLUGIN_EVENT_SPAMBLOCK_REASON_BODYCLONE', 'Doppelter Kommentar');
        @define('PLUGIN_EVENT_SPAMBLOCK_REASON_IPFLOOD', 'IP-Block');
        @define('PLUGIN_EVENT_SPAMBLOCK_REASON_CAPTCHAS', 'Captcha ungültig (Eingegeben: %s, Erwartet: %s)');
        @define('PLUGIN_EVENT_SPAMBLOCK_REASON_FORCEMODERATION', 'Moderation nach X Tagen');
        @define('PLUGIN_EVENT_SPAMBLOCK_REASON_LINKS_REJECT', 'Zu viele Links');
        @define('PLUGIN_EVENT_SPAMBLOCK_REASON_LINKS_MODERATE', 'Zu viele Links');
        @define('PLUGIN_EVENT_SPAMBLOCK_HIDE_EMAIL', 'E-Mail-Adressen bei Kommentatoren verstecken');
        @define('PLUGIN_EVENT_SPAMBLOCK_HIDE_EMAIL_DESC', 'Zeigt in den Kommentaren keine E-Mail Adressen der jeweiligen Kommentatoren an');
        @define('PLUGIN_EVENT_SPAMBLOCK_HIDE_EMAIL_NOTICE', 'Die angegebene E-Mail-Adresse wird nicht dargestellt, sondern nur für eventuelle Benachrichtigungen verwendet.');

        @define('PLUGIN_EVENT_SPAMBLOCK_LOGTYPE', 'Protokollierung von fehlgeschlagenen Kommentaren');
        @define('PLUGIN_EVENT_SPAMBLOCK_LOGTYPE_DESC', 'Die Protokollierung von fehlgeschlagenen Kommentaren und deren Gründen kann auf mehrere Arten durchgeführt werden.');
        @define('PLUGIN_EVENT_SPAMBLOCK_LOGTYPE_FILE', 'Einfache Datei (siehe Option "Logfile")');
        @define('PLUGIN_EVENT_SPAMBLOCK_LOGTYPE_DB', 'Datenbank');
        @define('PLUGIN_EVENT_SPAMBLOCK_LOGTYPE_NONE', 'Keine Protokollierung');

        @define('PLUGIN_EVENT_SPAMBLOCK_API_COMMENTS', 'Behandlung von per API übermittelten Kommentaren');
        @define('PLUGIN_EVENT_SPAMBLOCK_API_COMMENTS_DESC', 'Diese Einstellung bestimmt, wie per API abgegebene Kommentare (Trackbacks, wfw:commentApi) behandelt werden. Falls diese Einstellung auf "moderieren" gestellt ist, müssen alle solche Kommentare immer bestätigt werden. Falls auf "abweisen" gestellt, werden solche Kommentare global nicht erlaubt. Bei der Einstellung "keine" werden solche Kommentare wie andere behandelt.');
        @define('PLUGIN_EVENT_SPAMBLOCK_API_MODERATE', 'moderieren');
        @define('PLUGIN_EVENT_SPAMBLOCK_API_REJECT', 'abweisen');
        @define('PLUGIN_EVENT_SPAMBLOCK_REASON_API', 'Keine API-erstellten Kommentare (u.a. Trackbacks) erlaubt');

        @define('PLUGIN_EVENT_SPAMBLOCK_FILTER_ACTIVATE', 'Wortfilter aktivieren');
        @define('PLUGIN_EVENT_SPAMBLOCK_FILTER_ACTIVATE_DESC', 'Durchsucht Kommentare nach speziellen Zeichenketten und markiert diese als Spam.');

        @define('PLUGIN_EVENT_SPAMBLOCK_FILTER_URLS', 'Wortfilter für URLs');
        @define('PLUGIN_EVENT_SPAMBLOCK_FILTER_URLS_DESC', 'Reguläre Ausdrücke erlaubt, Zeichenkennten durch Semikolon (;) trennen.');
        @define('PLUGIN_EVENT_SPAMBLOCK_FILTER_AUTHORS', 'Wortfilter für Autorennamen');
        @define('PLUGIN_EVENT_SPAMBLOCK_FILTER_AUTHORS_DESC', 'Reguläre Ausdrücke erlaubt, Zeichenkennten durch Semikolon (;) trennen.');

        @define('PLUGIN_EVENT_SPAMBLOCK_REASON_CHECKMAIL', 'Ungültige E-Mail-Adresse!');
        @define('PLUGIN_EVENT_SPAMBLOCK_CHECKMAIL', 'Auf ungültige E-Mail-Adressen prüfen?');
        @define('PLUGIN_EVENT_SPAMBLOCK_REQUIRED_FIELDS', 'Pflichtfelder');
        @define('PLUGIN_EVENT_SPAMBLOCK_REQUIRED_FIELDS_DESC', 'Geben Sie die Liste von Pflichtfeldern bei der Abgabe eines Kommentars ein. Mehrere Felder können mit "," getrennt werden. Verfügbare Felder sind: name, email, url, replyTo, comment');
        @define('PLUGIN_EVENT_SPAMBLOCK_REASON_REQUIRED_FIELD', 'Sie haben das Feld "%s" nicht ausgefüllt!');

        @define('PLUGIN_EVENT_SPAMBLOCK_CONFIG', 'Anti-Spam-Maßnahmen konfigurieren');
        @define('PLUGIN_EVENT_SPAMBLOCK_ADD_AUTHOR', 'Diesen Autor via Spamschutz blockieren');
        @define('PLUGIN_EVENT_SPAMBLOCK_ADD_URL', 'Diese URL via Spamschutz blockieren');
        @define('PLUGIN_EVENT_SPAMBLOCK_REMOVE_AUTHOR', 'Blockade dieses Autors via Spamschutz aufheben');
        @define('PLUGIN_EVENT_SPAMBLOCK_REMOVE_URL', 'Blockade dieser URL via Spamschutz aufheben');

        @define('PLUGIN_EVENT_SPAMBLOCK_BLOGG_SPAMLIST', 'URL-Filterung anhand der blogg.de Blacklist aktivieren');
        @define('PLUGIN_EVENT_SPAMBLOCK_REASON_TITLE', 'Artikeltitel ist derselbe wie der Kommentar!');
        @define('PLUGIN_EVENT_SPAMBLOCK_FILTER_TITLE', 'Kommentare abweisen, die als Text nur den Artikeltitel enthalten');

@define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_SCRAMBLE', 'Stärkere Captchas');
@define('PLUGIN_EVENT_SPAMBLOCK_HIDE', 'Spamblock für Autoren deaktivieren');
@define('PLUGIN_EVENT_SPAMBLOCK_HIDE_DESC', 'Autoren der aktivierten Benutzergruppen können Kommentare ohne Spamprüfung schreiben.');

@define('PLUGIN_EVENT_SPAMBLOCK_AKISMET', 'Akismet API Key');
@define('PLUGIN_EVENT_SPAMBLOCK_AKISMET_DESC', 'Akismet.com ist ein zentraler Anti-Spam und Blacklisting-Dienst. Er kann eingehende Kommentare analysieren und mit einer Liste abgleichen um so SPAM zu entdecken. Akismet wurde für WordPress entwickelt, kann aber auch von anderen Blog-Anwendungen genutzt werden. Sie benötigen jedoch einen API Schlüssel von http://www.akismet.com, indem Sie sich dort registrieren. Falls Sie diesen Wert leer lassen, wird Akismet nicht verwendet.');
@define('PLUGIN_EVENT_SPAMBLOCK_AKISMET_FILTER', 'Behandlung von Akismet-Spam');
@define('PLUGIN_EVENT_SPAMBLOCK_REASON_AKISMET_SPAMLIST', 'Von Akismet.com gefiltert.');
@define('PLUGIN_EVENT_SPAMBLOCK_FILTER_WORDS', 'Wortfilter für Inhalt');

@define('PLUGIN_EVENT_SPAMBLOCK_TRACKBACKURL', 'Trackback-URLS prüfen');
@define('PLUGIN_EVENT_SPAMBLOCK_TRACKBACKURL_DESC', 'Einen Trackback nur dann zulassen, wenn Ihre URL auch auf der Zielseite genannt wird.');
@define('PLUGIN_EVENT_SPAMBLOCK_REASON_TRACKBACKURL', 'Trackback-URL ungültig.');
@define('PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATION_TREAT', 'Was soll mit auto-moderierten Kommentaren passieren?');
@define('PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATIONT_TREAT', 'Was soll mit auto-moderierten Trackbacks passieren?');
@define('PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATIONT', 'Trackbackmoderation nach wievielen Tagen erzwingen');
@define('PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATIONT_DESC', 'Alle Trackbacks zu einem Artikel können abhängig vom Alter des Artikels automatisch moderiert werden. Tragen Sie hier das Minimalalter eines Artikels in Tagen ein, ab dem jedes Trackback erst nach Ihrer Moderation dargestellt wird. 0 bedeutet, dass keine automatische Moderation erzeugt wird.');

@define('PLUGIN_EVENT_SPAMBLOCK_CSRF', 'CSRF-Schutz aktivieren?');
@define('PLUGIN_EVENT_SPAMBLOCK_CSRF_DESC', 'Falls aktiviert, wird ein spezieller Hash-Wert sicherstellen, dass nur Benutzer Kommentare hinterlassen dürfen , die eine gültige Session-ID haben. Dies wird Spam etwas eindämmen und es unmöglich machen, dass Sie ungewollt Kommentare via CSRF-Angriffen hinterlassen, aber es wird auch dazu führen dass nur Benutzer mit aktivierten Cookies kommentieren können.');
@define('PLUGIN_EVENT_SPAMBLOCK_CSRF_REASON', 'Ihr Kommentar enthielt keinen gültigen Session-Hash. Kommentare auf diesem Blog können nur mit aktivierten Cookies hinterlassen werden!');