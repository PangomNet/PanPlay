<?php
echo "<!---- CENTRAL ERROR LOG! ----->";
echo "<script>";
echo "// Funktion, die den errorHandler beim Laden der Seite auslöst";
echo "// window.addEventListener('load', function() {";
echo "//    errorHandler('" .$lang['centralerrorlog_error_occured'] ."');";
echo "// });";
echo "self.addEventListener('fetch', function(event) {";
echo "    event.respondWith(";
echo "        fetch(event.request)";
echo "        .catch(function() {";
echo "            const url = new URL(event.request.url);";
echo "            errorHandler('" .$lang['centralerrorlog_neterror_occured'] ."' + url.href);";
echo "        })";
echo "    );";
echo "});";
echo "function errorHandler(message) {";
echo "    // Holen Sie sich die vorhandene Textarea";
echo "    var textarea = document.getElementById('errorTextarea');";
echo "    // Aktuelle Zeit für Zeitstempel";
echo "    var now = new Date();";
echo "    var timestamp = now.toLocaleString();";
echo "    // Überprüfen, ob die Textarea leer ist";
echo "    var isEmpty = textarea.value.trim() === '';";
echo "    // Fügen Sie die neue Fehlermeldung oben hinzu";
echo "    textarea.value = '[' + timestamp + '] ' + message + '\n' + textarea.value;";
echo "    // Überprüfen, ob das Modal bereits angezeigt wird";
echo "    var modal = document.getElementById('shownewerror');";
echo "    var isModalVisible = modal.classList.contains('show');";
echo "    // Wenn die Textarea leer ist, sichtbare den Navlink und zeige das Modal an";
echo "    if (isEmpty) {";
echo "        var navlink = document.getElementById('openerrorlog_nav');";
echo "        navlink.style.display = 'block';";
echo "        // Wenn das Modal nicht bereits angezeigt wird, zeigen Sie es an";
echo "        if (!isModalVisible) {";
echo "            var myModal = new bootstrap.Modal(modal);";
echo "            myModal.show();";
echo "        }";
echo "    }";
echo "}";
echo "</script>";
?>