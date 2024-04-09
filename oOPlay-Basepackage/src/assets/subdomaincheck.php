<?php
// Aktuelle URL überprüfen ooPlay ist als SingleDomain-Anwendung entwickelt worden. Es soll auf der Domain alleine sein. Deshalb ist der Betrieb auf einer Subdomain [[subdomain.server.com]] empfohlen. Server, deren Unterverzeichniss einer Hauptdomain als Subdomain eingerichtet werden können [[server.com/subdomain]] (Standard zum Beispiel bei one.com, erlauben jedoch den Zugriff über die Hauptdomain ins das Verzeichniss für die Besucher. Dies kollidiert evtl. mit der Programmierung. Der Subdomaincheck prüft deshalb, den gegewärtigen HTTP_Host und verhindert so etwas. Um dieses Verhalten abzustellen, verhindern sie das Laden der Subdomain oder tragen sie einfach die Hauptdomain ein, das Skript akzeptiert sie dann als Subdomain (Beispiel Debugging-Eintrag)
$currentUrl = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
 $expectedSubdomain = 'oop.ownonline.eu'; // Release
//$expectedSubdomain = 'localhost'; // Debug

// Überprüfen, ob die Seite über die erwartete Subdomain aufgerufen wurde
if (strpos($currentUrl, $expectedSubdomain) === false) {
    // Wenn nicht, include die falseentrypoint.html
    include('../../src/falseentrypoint.html');
    exit;
}

?>