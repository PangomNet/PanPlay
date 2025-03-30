<?php 
$pro_name = '<i class="fas fa-music"></i> Pan<span class="pangomfont text-danger">Play</span>';
$pro_name_noformat = '<i class="fas fa-music"></i> PanPlay';
$pro_name_cleartext = 'PanPlay';
$pro_version = '0.1.0.0';
$pro_buildversion = '1025';
$pro_version_name = 'Cactus';
$pro_license = 'MIT-License';
$pro_license_url = 'https://www.tldrlegal.com/license/mit-license';
$pro_releasedate = '19.12.2024';
$pro_company = 'Pangom.net';
$pro_company_url = 'https://pangom.net/';
$pro_copyright = '2024';


echo "<div class='container'><div class='row'><div class='col-12'>";
 

echo "<h1 class='pangomfont text-center' ><b>" . $pro_name . "</b></h1><h3 class='pangomfont text-center'><i> ". $pro_version_name . "</i></h3><p class='lead text-center'>" . $lang['about_brand_phrase'];

echo "</div><!--<div class='col-4'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/panplay/panplay about imager.png' width='100%' height='auto' alt='PanPlay'></div>--></div></div><hr>";

// in case of prerelease
//echo "<div class='alert bg-dark text-danger'><b>" . $lang['about_prerelease_warning_title'] . " " . $pro_version ."</b><br><!-- <hr>--->" . $lang['about_prerelease_warning_p1'] . " '". $pro_name_cleartext . "' " . $lang['about_prerelease_warning_p2'] . "</div>"; 

echo "Version " . $pro_version . " [Build " . $pro_buildversion . "] <br>" . $lang['from_who'] . " " . $pro_releasedate . " <br><small>" . 
"© " . $pro_copyright . " <a target='_blank' href='" . $pro_company_url . "'>" . $pro_company ."</a> <hr> " . $lang['about_license_owner_is'] . " <a href='" . $copyowner_url . "'>". $copyowner . " (" . $_SERVER['HTTP_HOST'] . ")</a><br><a target='_blank' href='" . $pro_license_url ."'>" . $pro_license . " " . $lang['about_license_datewording'] . " " . $pro_releasedate . ")</a> <hr>";

    // Bedingung zum Anzeigen der Erweiterungsguthaben
    if ($enable_extension_credits) {
        echo $extensions_credits;
        echo "</div></div>";
    }

 
echo "<hr>" . $lang['about_documentation_p1'] . " <a target='_blank' href='https://play.pangom.net/documentation/?ver=" . $pro_version ."'>" . $lang['about_documentation_p2'] . "</a>" . $lang['about_documentation_p3'] . "</small> ";

    echo "<!--<hr>--><small>" . $lang['about_legal_p1'] . " <a target='_blank' href='" . $privacy_url . "'>" . $lang['about_legal_p2'] . "</a> " . $lang['about_legal_p3'] . " <a target='_blank' href='" . $impress_url . "'>" . $lang['about_legal_p4'] . "</a> " . $lang['from'] . " " . $copyowner . "" . $lang['about_legal_p5'] . " " . $lang['about_legal_p6'] . " " . $lang['from'] . " " . $pro_name_cleartext . " " . $lang['about_legal_p7'] . " <a href='https://play.pangom.net/eula?ver=" . $pro_version ."'>". $lang['about_legal_p8'] . "</a>". $lang['about_legal_p9'] . " </small>";
?>
