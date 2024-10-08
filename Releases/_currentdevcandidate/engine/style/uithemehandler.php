<?php
// Überprüfen, ob der "theme"-Parameter vorhanden ist
if (isset($_GET['theme'])) {
    $theme = $_GET['theme'];

    // Überprüfen, ob es sich um die Variante "variante1" handelt
    if ($theme === 'win2000') {
        include 'theme/win2000.php';
    }
    // Überprüfen, ob es sich um die Variante "variante2" handelt
    elseif ($theme === 'light') {
        include 'theme/light.php';
    }
    // Überprüfen, ob es sich um die Variante "variante3" handelt
    elseif ($theme === 'glass') {
        include 'theme/glass.php';
    }
     // Überprüfen, ob es sich um die Variante "custom für eigene farbgestaltung handelt
     elseif ($theme === 'custom') {
        include 'theme/custom-thme-handler.php';
    }
    // Wenn keine der Varianten übereinstimmt
    else {
        $theme_err = "Das gewünschte Theme (" . $theme . ") ist kein definiertes PanPlay-Theme. Rufe die PanPlay-Webseite auf und informiere dich, wie du dein Lieblingstheme aufrufen kannst. Der fehlhafte Befehl hindert den Player nicht daran zu starten, wir laden das Standardtheme.";
        // Standardthema laden
        include 'theme/default.php';
        echo "<script>alert('$theme_err');</script>";
    }
}
// Wenn kein "theme"-Parameter übergeben wurde
else {
    // Standardthema laden
    include 'theme/default.php';
}
?>