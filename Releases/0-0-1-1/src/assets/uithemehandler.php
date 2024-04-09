<?php
// Überprüfen, ob der "theme"-Parameter vorhanden ist
if (isset($_GET['theme'])) {
    $theme = $_GET['theme'];

    // Überprüfen, ob es sich um die Variante "variante1" handelt
    if ($theme === 'win2000') {
        include 'src/css/themes/win2000.php';
    }
    // Überprüfen, ob es sich um die Variante "variante2" handelt
    elseif ($theme === 'light') {
        include 'src/css/themes/light.php';
    }
    // Überprüfen, ob es sich um die Variante "variante3" handelt
    elseif ($theme === 'moredark') {
        include 'src/css/themes/moredark.php';
    }
     // Überprüfen, ob es sich um die Variante "custom für eigene farbgestaltung handelt
     elseif ($theme === 'custom') {
        include 'src/css/themes/custom-thme-handler.php';
    }
    // Wenn keine der Varianten übereinstimmt
    else {
        $theme_err = "Das gewünschte Theme (" . $theme . ") ist kein definiertes oOPlay-Theme. Rufe die oOPlay-Webseite auf und informiere dich, wie du dein Lieblingstheme aufrufen kannst. Der fehlhafte Befehl hindert den Player nicht daran zu starten, wir laden das Standardtheme.";
        // Standardthema laden
        include 'src/css/themes/default.php';
        echo "<script>alert('$theme_err');</script>";
    }
}
// Wenn kein "theme"-Parameter übergeben wurde
else {
    // Standardthema laden
    include 'src/css/themes/default.php';
}
?>