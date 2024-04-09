<!---- CENTRAL ERROR LOG! ----->
<script>
// Funktion, die den errorHandler beim Laden der Seite auslöst
// window.addEventListener('load', function() {
//    errorHandler('Beispiel Fehlermeldung beim Laden der Seite.');
// });


self.addEventListener('fetch', function(event) {
    event.respondWith(
        fetch(event.request)
        .catch(function() {
            const url = new URL(event.request.url);
            errorHandler('Netzwerkfehler beim Laden von ' + url.href);
        })
    );
});


    function errorHandler(message) {
    // Holen Sie sich die vorhandene Textarea
    var textarea = document.getElementById('errorTextarea');
    
    // Aktuelle Zeit für Zeitstempel
    var now = new Date();
    var timestamp = now.toLocaleString();

    // Überprüfen, ob die Textarea leer ist
    var isEmpty = textarea.value.trim() === '';

    // Fügen Sie die neue Fehlermeldung oben hinzu
    textarea.value = '[' + timestamp + '] ' + message + '\n' + textarea.value;

    // Überprüfen, ob das Modal bereits angezeigt wird
    var modal = document.getElementById('shownewerror');
    var isModalVisible = modal.classList.contains('show');

    // Wenn die Textarea leer ist, sichtbare den Navlink und zeige das Modal an
    if (isEmpty) {
        var navlink = document.getElementById('openerrorlog_nav');
        navlink.style.display = 'block';
        
        // Wenn das Modal nicht bereits angezeigt wird, zeigen Sie es an
        if (!isModalVisible) {
            var myModal = new bootstrap.Modal(modal);
            myModal.show();
        }
    }
}
</script>


<!--- errorolog modla ----->
<div class="modal fade" id="openerrorlog" tabindex="-1" aria-labelledby="openerrorlog" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-exclamation-triangle" style="color: red;"></i> Fehlerkonsole</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">❌</button>
      </div>
      <div class="modal-body">
          <div class="alert alert-danger" role="alert">
  Wenn Sie auf dieses Fenster Zugriff haben, sind kritische Fehler (höchstwahrscheinlich Verbindungsfehler) aufgetreten. Diese Fehler könnten den weiteren Betrieb von 'oOPlay' entweder nur gering oder sehr maßgeblich stören und zum absturz führen. Bitte seien Sie aufmerksam. Wenn Sie sich mit den Entwicklertools Ihres Gerätes auskennen, empfehlen wir Ihnen, auch dort nach zusätzlichen Fehlern zu suchen. Die Fehler können eventuell behebbar sein.
</div>
           <textarea disabled class="text-white bg-danger" id="errorTextarea" style="overflow: auto;" width="100%" rows="10" cols="60">
               
           </textarea>
      </div>
    </div>
  </div>
</div>
<!--- newerror modla ----->
<div class="modal fade" id="shownewerror" tabindex="-1" aria-labelledby=" errlog_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-exclamation-triangle" style="color: red;"></i>UPS!</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">❌</button>
      </div>
      <div class="modal-body">
          <div class="alert alert-danger" role="alert">
  Es sind Fehler aufgetreten! Es kommt eventuelle zu einem Verbindungsverlust! Bitte prüfen Sie die <a class="alert-link" data-bs-toggle="modal" data-bs-target="#openerrorlog" data-bs-dismiss="modal" href="#"><i class="fa fa-exclamation-triangle" style="color: red;"></i> Fehlerkonsole</a>!
      </div>
    </div>
  </div>
</div>
</div>