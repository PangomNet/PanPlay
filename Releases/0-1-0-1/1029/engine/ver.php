<?php 


echo "<div class='container'><div class='row'><div class='col-12'>";
 

echo "<style>
    .about-list .list-group-item-action:hover {
       
        color: #fff !important;
        transition: all 0.2s ease;
    }
    .about-list .text-white { opacity: 0.7; }
    .about-footer a:hover { color: #fff !important; text-decoration: underline !important; }
    .about-extension-credit {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }
    .about-extension-credit img {
        display: inline-block;
        margin: 0;
        max-width: 128px;
        height: auto;
    }
    .about-extension-credit .about-extension-credit-value {
        text-align: right;
        margin-left: auto;
    }
    @media (max-width: 420px) {
        .about-extension-credit {
            display: block;
            text-align: center;
        }
        .about-extension-credit img {
            display: block;
            margin: 0 auto 8px auto;
        }
        .about-extension-credit .about-extension-credit-value {
            text-align: center;
            margin-left: 0;
        }
    }
</style>";

// --- Header: Branding ---
echo "<div class='text-center mb-4'>";
echo "    <span class='pangomfont display-5 mb-1'><b>" . $pro_name . "</b></span>";
echo "    <span class='pangomfont text-white mb-2'><i>" . $pro_version_name . "</i></span>";
// Unterstreichung entfernt, dafür Lead-Klasse für bessere Typografie
echo "    <p class='mb-0 font-weight-normal'>" . $lang['about_brand_phrase'] . "</p>";
echo "</div>";

// --- Prerelease Warning ---
if (isset($is_prerelase) && $is_prerelase) {
    echo "<div class='alert bg-dark text-danger border-0 shadow-sm mb-4 p-3' style='border-left: 4px solid #dc3545 !important;'>";
    echo "    <div class='d-flex align-items-center mb-1'>";
    echo "        <i class='fas fa-flask me-2'></i><b class='text-uppercase small' style='letter-spacing:1px;'>" . $lang['about_prerelease_warning_title'] . "</b>";
    echo "    </div>";
    echo "    <div class='small opacity-75'>" . $lang['about_prerelease_warning_p1'] . " '". $pro_name_cleartext . "' " . $lang['about_prerelease_warning_p2'] . "</div>";
    echo "</div>";
}

// --- Details: List Group ---
echo "<div class='list-group list-group-flush bg-transparent about-list mb-2 '>";

// Row: Version
echo "<div class='list-group-item list-group-item-action bg-transparent d-flex justify-content-between align-items-center py-3 border-0'>";
echo "    <span class='text-white small'><i class='fas fa-info-circle me-2'></i>Version</span>";
echo "    <span class='font-monospace text-white'>" . $pro_version . " <small class='text-white'>[" . $pro_buildversion . "]</small></span>";
echo "</div>";

// Row: Date
echo "<div class='list-group-item list-group-item-action bg-transparent d-flex justify-content-between align-items-center py-3 border-0'>";
echo "    <span class='text-white small'><i class='far fa-calendar-alt me-2'></i>" . $lang['from_who'] . "</span>";
echo "    <span class='text-white small'>" . $pro_releasedate . "</span>";
echo "</div>";

// Row: Hoster / Vendor
echo "<div class='list-group-item list-group-item-action bg-transparent d-flex justify-content-between align-items-center py-3 border-0'>";
echo "    <span class='text-white small'><i class='fas fa-user-shield me-2'></i>" . $lang['about_license_owner_is'] . "</span>";
echo "    <a href='" . $copyowner_url . "' class='text-decoration-none text-light'><b>" . $copyowner . "</b> <br><small class='opacity-50'>(" . $_SERVER['HTTP_HOST'] . ")</small></a>";
echo "</div>";

// Row: License
echo "<div class='list-group-item list-group-item-action bg-transparent d-flex justify-content-between align-items-center py-3 border-0'>";
echo "    <span class='text-white small'><i class='fas fa-balance-scale me-2'></i>Lizenz</span>";
echo "    <a target='_blank' href='" . $pro_license_url . "' class='text-decoration-none text-light'>" . $pro_license . "</a>";
echo "</div>";



// --- Extensions & Credits (Die Box unten im Bild) ---
if (isset($enable_extension_credits) && $enable_extension_credits) {
    echo "<div class='list-group-item bg-transparent d-flex justify-content-between align-items-center py-3 border-0'>";
    echo "<div class='about-extension-credit'>";
    echo $extensions_credits;
    echo "</div>";
    echo "</div>";
}

echo "</div>";

// --- Footer / Legal ---


echo "    <div class='d-flex justify-content-center gap-3 flex-wrap small'>";
if (isset($about_show_documentation_link) && $about_show_documentation_link) {
    echo "<a target='_blank' href='https://play.pangom.net/documentation/?ver=" . $pro_version . "' class='text-white text-decoration-none'>" . $lang['about_documentation_p2'] . "</a>";
    echo "<span class='opacity-25 text-muted'>|</span>";
}
echo "        <a target='_blank' href='" . $privacy_url . "' class='text-white text-decoration-none'>" . $lang['about_legal_p2'] . "</a>";
echo "        <span class='opacity-25 text-white'>|</span>";
echo "        <a target='_blank' href='" . $impress_url . "' class='text-white text-decoration-none'>" . $lang['about_legal_p4'] . "</a>";
echo "        <span class='opacity-25 text-white'>|</span>";
echo "        <a href='" . $pro_eula_link . "' class='text-white text-decoration-none'>" . $lang['about_legal_p6'] . "</a>";
echo "    </div>";
echo "    <p class='small text-center text-white mt-2 mb-3'>© " . $pro_copyright . " <a target='_blank' href='" . $pro_eula_vendor_link . "' class='text-light text-decoration-none'>" . $pro_eula_vendor . "</a>";
echo "<br><span class='text-center' style='font-size: 8pt;'>powered by " . $pp_pro_engine_name . " from <a href='" . $pp_pro_company_url . "'>" . $pp_pro_company . "</a></span></p>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";

?>
