<?php



// Überprüfen, ob der "theme"-Parameter vorhanden ist
if (isset($_GET['theme'])) {
    $theme = $_GET['theme'];

    // Überprüfen, ob es sich um die Variante "variante1" handelt
    if ($theme === 'win9x') {
        include 'theme/win9x/theme.php';
        echo "<link rel='stylesheet' href='engine/style/theme/win9x/styles.css'>"; // LEGEACY-SERVICE ROW 
    }
    // Überprüfen, ob es sich um die Variante "variante1" handelt
    elseif ($theme === 'bs-cosmo') {
        include 'theme/bs-cosmo/theme.php';
        echo "<link rel='stylesheet' href='engine/style/theme/bs-cosmo/styles.css'>"; // LEGEACY-SERVICE ROW 
     }
    // Überprüfen, ob es sich um die Variante "variante2" handelt
    elseif ($theme === 'light') {
        include 'theme/light.php';
        echo "<link rel='stylesheet' href='engine/style/styles.css'>"; // LEGEACY-SERVICE ROW 
    }
    // Überprüfen, ob es sich um die Variante "variante3" handelt
    elseif ($theme === 'glass') {
        include 'theme/glass.php';
        echo "<link rel='stylesheet' href='engine/style/styles.css'>"; // LEGEACY-SERVICE ROW 
    }
    // Überprüfen, ob es sich um die Variante "variante3" handelt
    elseif ($theme === 'aero') {
        include 'theme/aero.php';
        echo "<link rel='stylesheet' href='engine/style/styles.css'>"; // LEGEACY-SERVICE ROW 
    }

        // Überprüfen, ob es sich um die Variante "variante3" handelt
        elseif ($theme === 'laut') {
            include 'theme/laut.php';
            echo "<link rel='stylesheet' href='engine/style/styles.css'>"; // LEGEACY-SERVICE ROW 
        }
        // Überprüfen, ob es sich um die Variante "variante3" handelt
        elseif ($theme === 'hc-dark') {
            include 'theme/hc-dark.php';
            echo "<link rel='stylesheet' href='engine/style/styles.css'>"; // LEGEACY-SERVICE ROW 
        }
     // Überprüfen, ob es sich um die Variante "custom für eigene farbgestaltung handelt
     elseif ($theme === 'custom') {
        include 'theme/custom-theme-handler.php';
        echo "<link rel='stylesheet' href='engine/style/styles.css'>"; // LEGEACY-SERVICE ROW 
    }
    // Wenn keine der Varianten übereinstimmt
    else {
        $theme_err = "The desired theme (" . $theme . ") is not a defined PanPlay theme. Go to the PanPlay website and find out how to call your favorite theme. The wrong command does not prevent the player from starting, we load the default theme.";
        // Standardthema laden
        include 'theme/bs-cosmo/theme.php';
        echo "<link rel='stylesheet' href='engine/style/theme/bs-cosmo/styles.css'>"; // LEGEACY-SERVICE ROW 
        echo "<script>alert('$theme_err');</script>";
    }
}
// Wenn kein "theme"-Parameter übergeben wurde
else {
    // Standardthema laden
    include 'theme/default/theme.php';
        echo "<link rel='stylesheet' href='engine/style/theme/default/styles.css'>"; // LEGEACY-SERVICE ROW 
}
?>