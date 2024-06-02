<?php 
$pro_name = 'oOPlay';
$pro_version = '0.0.1.7';
$pro_version_name = 'Gardenia';
$pro_license = 'MIT-Lizenz';
$pro_license_url = 'https://www.tldrlegal.com/license/mit-license';
$pro_releasedate = '31.05.2024';
$pro_company = 'ownonline/Patrick Schneider';
$pro_company_url = 'https://ownonline.eu/';
$pro_copyright = '2024';


echo "<div class='container'><div class='row'><div class='col-8'>";
 

echo "<h3 ><b>" . $pro_name . "</b> <i> ". $pro_version_name . "</i></h3><p class='lead'> <b><u>Der</u></b> HTML5-Audioplayer!</p>";

echo "</div><div class='col-4'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/oop_orbs/oop-l-color.png' width='100%' height='auto' alt='oOPlay'></div></div></div>";

echo "Version <kbd>" . $pro_version . "</kbd> vom " . $pro_releasedate . " <br><small>" . 
"Copyright " . $pro_copyright . " by <a target='_blank' href='" . $pro_company_url . "'>" . $pro_company ."</a> <br> Lizensiert an " . "<kbd><a href='" . $copyowner_url . "'>". $copyowner . " (" . $_SERVER['HTTP_HOST'] . ")</a></kbd><br><a target='_blank' href='" . $pro_license_url ."'>" . $pro_license . " (in ihrer Fassung vom " . $pro_releasedate . ")</a> <hr>";

    // Bedingung zum Anzeigen der Erweiterungsguthaben
    if ($enable_extension_credits) {
        echo $extensions_credits;
        echo "</div></div>";
    }


 echo "<br><br><div class='alert bg-danger'>⚠ Unstabiler Prerelaese " . $pro_version ."<hr>Diese Version von '". $pro_name. "' ist eine Vorabveröffentlichung, welche einzig und alleine zur Verfolgung des Entwicklungsfortschrittes gedacht ist. Ein Produktiveinsatz ist nicht empfohlen.</div>"; 
 
 
echo "<br>Weitere Informationen zu 'oOPlay' finden Sie auf der <a target='_blank' href='https://oop.ownonline.eu/?ver=" . $pro_version ."'>Dokumentationsseite.</a></small>";

    echo "<hr><small>Es gelten die <a target='_blank' href='" . $privacy_url . "'>Datenschutzbestimmungen</a> und die rechtlichen Angaben im <a target='_blank' href='" . $impress_url . "'>Impressum</a> von " . $copyowner . ". Ferner gelten die Nutzungsbedingungen zu 'oOPlay', diese finden Sie <a href='https://oop.ownonline.eu/eula/?ver=" . $pro_version ."'>hier</a>. </small>";
?>
