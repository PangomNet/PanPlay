<?php 
$pro_name = 'oOPlay';
$pro_version = '0.0.1.5';
$pro_version_name = 'Eucalyptus';
$pro_license = 'MIT-Lizenz';
$pro_license_url = 'https://www.tldrlegal.com/license/mit-license';
$pro_releasedate = '25.05.2024';
$pro_company = 'ownonline/Patrick Schneider';
$pro_company_url = 'https:/ownonline.eu/';
$pro_copyright = '2024';
$copyowner = 'ownOnline';
$copyowner_url = 'https:/ownonline.eu/';
$privacy_url = 'https://ownonline.eu/datenschutz';
$impress_url = 'https://ownonline.eu/impressum';
$enable_extension_credits = true;


 

echo "<p class='lead'>'". $pro_name . "' - Der Webradio-Spieler mit laut.fm™-Integration!</p> Release <kbd>" . $pro_version . "</kbd> <i>" . $pro_version_name . "</i> vom " . $pro_releasedate . " <br><br><small>" . 
"Copyright " . $pro_copyright . " by <a target='_blank' href='" . $pro_company_url . "'>" . $pro_company ."</a> <br> Lizensiert an " . "<kbd>" . $copyowner . " (" . $_SERVER['HTTP_HOST'] . ")</kbd><br><a target='_blank' href='" . $pro_license_url ."'>" . $pro_license . " (in ihrer Fassung vom " . $pro_releasedate . ")</a>";
echo "<hr>";
echo $extensions_credits;
echo "</div></div>";


  echo "<br><br><div class='alert bg-danger'>⚠ Unstabiler Prerelaese " . $pro_version ."<hr>Diese Version von '". $pro_name. "' ist eine Vorabveröffentlichung, welche einzig und alleine zur Verfolgung des Entwicklungsfortschrittes gedacht ist. Ein Produktiveinsatz ist nicht empfohlen.</div>"; 
 
 
echo "<br>Weitere Informationen zu 'oOPlay' finden Sie auf der <a target='_blank' href='https://oop.ownonline.eu/?ver=" . $pro_version ."'>Dokumentationsseite.</a></small>";

    echo "<hr><small>Es gelten die <a target='_blank' href='" . $privacy_url . "'>Datenschutzbestimmungen</a> und die rechtlichen Angaben im <a target='_blank' href='" . $impress_url . "'>Impressum</a> von " . $copyowner . ". Ferner gelten die Nutzungsbedingungen zu 'oOPlay', diese finden Sie <a href='https://oop.ownonline.eu/?ver=" . $pro_version ."'>hier</a>. </small>";
?>
