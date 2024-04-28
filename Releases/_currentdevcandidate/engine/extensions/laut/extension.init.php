<?php
        echo "<meta property='og:title' content='🎶" . $lfmstream . " - oOPlay' /> <meta property='og:type' content='audio.livestream' /> <meta property='og:url' content='" . $_SERVER['HTTP_HOST'] . "' /> <meta property='og:description' 
        content='Höre das laut.fm-Radio " . $lfmstream ." in oOPlayer! Mit Titelinformationen, Sendeplan, u.v.m.' />";
        require('engine/extensions/laut/lautapi.php');
?>