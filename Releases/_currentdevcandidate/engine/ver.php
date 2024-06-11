<?php 
$pro_name = 'oOPlay';
$pro_version = '0.0.1.9';
$pro_version_name = 'Iris';
$pro_license = 'MIT-License';
$pro_license_url = 'https://www.tldrlegal.com/license/mit-license';
$pro_releasedate = '16.06.2024';
$pro_company = 'ownonline/Patrick Schneider';
$pro_company_url = 'https://ownonline.eu/';
$pro_copyright = '2024';


echo "<div class='container'><div class='row'><div class='col-8'>";
 

echo "<h3 ><b>" . $pro_name . "</b> <i> ". $pro_version_name . "</i></h3><p class='lead'>" . $lang['about_brand_phrase'];

echo "</div><div class='col-4'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/oop_orbs/oop-l-color.png' width='100%' height='auto' alt='oOPlay'></div></div></div>";

echo "Version <kbd>" . $pro_version . "</kbd> " . $lang['from_who'] . " " . $pro_releasedate . " <br><small>" . 
"Copyright " . $pro_copyright . " by <a target='_blank' href='" . $pro_company_url . "'>" . $pro_company ."</a> <br> " . $lang['about_license_owner_is'] . "<kbd><a href='" . $copyowner_url . "'>". $copyowner . " (" . $_SERVER['HTTP_HOST'] . ")</a></kbd><br><a target='_blank' href='" . $pro_license_url ."'>" . $pro_license . " " . $lang['about_license_datewording'] . " " . $pro_releasedate . ")</a> <hr>";

    // Bedingung zum Anzeigen der Erweiterungsguthaben
    if ($enable_extension_credits) {
        echo $extensions_credits;
        echo "</div></div>";
    }


 echo "<br><br><div class='alert bg-danger'>" . $lang['about_prerelease_warning_title'] . " " . $pro_version ."<hr>" . $lang['about_prerelease_warning_p1'] . " '". $pro_name. "' " . $lang['about_prerelease_warning_p2'] . "</div>"; 
 
 
echo "<br>" . $lang['about_documentation_p1'] . " <a target='_blank' href='https://oop.ownonline.eu/?ver=" . $pro_version ."'>" . $lang['about_documentation_p2'] . "</a>" . $lang['about_documentation_p3'] . "</small>";

    echo "<hr><small>" . $lang['about_legal_p1'] . " <a target='_blank' href='" . $privacy_url . "'>" . $lang['about_legal_p2'] . "</a> " . $lang['about_legal_p3'] . " <a target='_blank' href='" . $impress_url . "'>" . $lang['about_legal_p4'] . "</a> " . $lang['from'] . " " . $copyowner . "" . $lang['about_legal_p5'] . " " . $lang['about_legal_p6'] . " " . $lang['from'] . " " . $pro_name . " " . $lang['about_legal_p7'] . " <a href='https://oop.ownonline.eu/eula/?ver=" . $pro_version ."'>". $lang['about_legal_p8'] . "</a>". $lang['about_legal_p9'] . " </small>";
?>
