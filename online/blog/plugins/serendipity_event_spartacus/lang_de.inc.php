<?php # $Id: lang_de.inc.php 1381 2006-08-15 10:14:56Z elf2000 $

        @define('PLUGIN_EVENT_SPARTACUS_NAME', 'Spartacus');
        @define('PLUGIN_EVENT_SPARTACUS_DESC', '[S]erendipity [P]lugin [A]ccess [R]epository [T]ool [A]nd [C]ustomization/[U]nification [S]ystem - Installiert Plugins direkt aus dem Netz.');
        @define('PLUGIN_EVENT_SPARTACUS_FETCH', 'Hier klicken um ein neues %s aus dem Netz zu installieren.');
        @define('PLUGIN_EVENT_SPARTACUS_FETCHERROR', 'Die URL %s konnte nicht ge�ffnet werden. M�glicherweise existieren Server- oder Netzwerkprobleme.');
        @define('PLUGIN_EVENT_SPARTACUS_FETCHING', 'Versuche URL %s zu �ffnen...');
        @define('PLUGIN_EVENT_SPARTACUS_FETCHED_BYTES_URL', '%s bytes von obiger URL geladen. Speichere Inhalt als %s...');
        @define('PLUGIN_EVENT_SPARTACUS_FETCHED_BYTES_CACHE', '%s bytes von bereits bestehender Datei geladen. Speichere Inhalt als %s...');
        @define('PLUGIN_EVENT_SPARTACUS_FETCHED_DONE', 'Daten erfolgreich geladen.');
        @define('PLUGIN_EVENT_SPARTACUS_MIRROR_XML', 'Datei/Mirror Speicherort (XML-Metadaten)');
        @define('PLUGIN_EVENT_SPARTACUS_MIRROR_FILES', 'Datei/Mirror Speicherort (Downloads)');
        @define('PLUGIN_EVENT_SPARTACUS_MIRROR_DESC', 'W�hlen Sie den Download-Server. �ndern Sie diesen Wert nur, wenn Sie wissen, was Sie tun und ein Server nicht mehr reagiert. Diese Option ist haupts�chlich f�r zuk�nftige Server reserviert.');

        @define('PLUGIN_EVENT_SPARTACUS_CHOWN', 'Eigent�mer der heruntergeladenen Dateien');
        @define('PLUGIN_EVENT_SPARTACUS_CHOWN_DESC', 'Hier kann der FTP/Shell-Benutzer (z.B. "nobody") angegeben werden, der f�r von Spartacus heruntergeladene Dateien verwendet wird. Falls leer wird keien �nderung des Eigent�mers vorgenommen.');
        @define('PLUGIN_EVENT_SPARTACUS_CHMOD', 'Zugriffsrechte der heruntergeladenen Dateien');
        @define('PLUGIN_EVENT_SPARTACUS_CHMOD_DESC', 'Hier kann der Oktagonale Dateimodus (z.B: "0777") f�r von Spartacus heruntergeladene Dateien angegeben werden. Falls dieser Wert leergelassen wird, verwendet Serendipity die Standardmaske des Systems. Nicht alle Server unterst�tzen eine �nderung dieser Dateirechte. Stellen Sie unbedingt sicher, dass die von Ihnen gew�hlten Rechte das Lesen und Schreiben des Webserver-Benutzers weiterhin erlauben - sonst k�nnte Serendipity/Spartacus keine bestehenden Dateien �berschreiben.');
        @define('PLUGIN_EVENT_SPARTACUS_CHMOD_DIR', 'Zugriffsrechte der heruntergeladenen Verzeichnisse');
        @define('PLUGIN_EVENT_SPARTACUS_CHMOD_DIR_DESC', 'Hier kann der Oktagonale Dateimodus (z.B: "0777") f�r von Spartacus heruntergeladene Verzeichnisse angegeben werden. Falls dieser Wert leergelassen wird, verwendet Serendipity die Standardmaske des Systems. Nicht alle Server unterst�tzen eine �nderung dieser Verzeichnisrechte. Stellen Sie unbedingt sicher, dass die von Ihnen gew�hlten Rechte das Lesen und Schreiben des Webserver-Benutzers weiterhin erlauben - sonst k�nnte Serendipity/Spartacus keine bestehenden Dateien �berschreiben.');
        @define('PLUGIN_EVENT_SPARTACUS_CHECK_SIDEBAR', 'Neue Versionen von Seitenleisten-Plugins');
        @define('PLUGIN_EVENT_SPARTACUS_CHECK_EVENT', 'Neue Versionen von Ereignis-Plugins');
        @define('PLUGIN_EVENT_SPARTACUS_CHECK_HINT', 'Hinweis: Sie k�nnen mehrere Plugins auf einmal installieren, wenn Sie den Link zum jeweiligen Plugin mit der mittleren Maustaste anklicken, so dass Ihr Browser diesen Link in einem neuen Fenster/Tab �ffnet. Bitte beachten Sie, dass das automatische Aktualisieren aller plugins zu Netwerkproblemen und defekten Dateien f�hren k�nnte. Daher ist diese Funktionalit�t absichtlich derzeit nicht implementiert.');
