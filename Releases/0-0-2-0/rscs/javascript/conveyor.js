// Funktion zum Überprüfen der Marquee-Animation und Berechnen der Dauer
function updateMarqueeAnimation() {
  // Container auswählen
  let titelcontainer = document.querySelector("#oolfm_current_song");
  let albumcontainer = document.querySelector("#oolfm_current_song");
  // Text-Container auswählen
  let titeltextContainer = document.querySelector("#currentsong_lbl_holder");
  let albumtextContainer = document.querySelector("#currentalbum_lbl_holder");
  // Textbreite berechnen
  let titeltextWidth = titeltextContainer ? titeltextContainer.clientWidth : 0;
  let albumtextWidth = albumtextContainer ? albumtextContainer.clientWidth : 0;
  // Containerbreite berechnen
  let titelcontainerWidth = titelcontainer.clientWidth;
  let albumcontainerWidth = albumcontainer.clientWidth;
  // Berechne die Zeit, die der Text benötigt, um den Container vollständig zu durchqueren
  let titelduration = (titeltextWidth + titelcontainerWidth) / 50; // Anpassen Sie 50 basierend auf der gewünschten Geschwindigkeit
  let albumduration = (albumtextWidth + albumcontainerWidth) / 50; // Anpassen Sie 50 basierend auf der gewünschten Geschwindigkeit
  // Log der berechneten Dauer
  console.log("Titel-Animation Dauer:", titelduration);
  console.log("Album-Animation Dauer:", albumduration);
  // Überprüfen, ob der Text breiter als der Container ist
  if (titeltextWidth > titelcontainerWidth) {
    console.log("Der Titel-Text ist breiter als der Container. Marquee-Klasse wird hinzugefügt.");
    titeltextContainer.style.animationDuration = titelduration + "s";
    titeltextContainer.classList.add("marquee");
  } else {
    console.log("Der Titel-Text ist nicht breiter als der Container. Marquee-Klasse wird entfernt.");
    titeltextContainer.classList.remove("marquee");
  }
  // Überprüfen, ob das Album-Label vorhanden ist, bevor die Animation angewendet wird
  if (albumtextContainer) {
    // Überprüfen, ob der Text breiter als der Container ist
    if (albumtextWidth > albumcontainerWidth) {
      console.log("Der Album-Text ist breiter als der Container. Marquee-Klasse wird hinzugefügt.");
      albumtextContainer.style.animationDuration = albumduration + "s";
      albumtextContainer.classList.add("marquee");
    } else {
      console.log("Der Album-Text ist nicht breiter als der Container. Marquee-Klasse wird entfernt.");
      albumtextContainer.classList.remove("marquee");
    }
  }
}

// Funktion zum Überprüfen des Inhalts des currentsong_lbl_holder-Elements auf Änderungen
function observeSongChanges() {
  // Wählen Sie das Ziel-Element aus
  var target = document.querySelector("#currentsong_lbl_holder");

  // Optionen für die MutationObserver
  var config = { childList: true, subtree: true };

  // Erstellen Sie eine MutationObserver-Instanz mit einer Callback-Funktion
  var observer = new MutationObserver(function(mutationsList, observer) {
    // Überprüfen Sie jede Mutation im Beobachtungslisten-Array
    for(var mutation of mutationsList) {
      // Überprüfen Sie, ob sich der Text im Ziel-Element geändert hat
      if (mutation.type === 'childList' && mutation.target === target) {
        // Wenn ja, rufen Sie die Funktion zur Aktualisierung der Marquee-Animation auf
        updateMarqueeAnimation();
      }
    }
  });

  // Starten Sie die Überwachung des Ziel-Elements mit den angegebenen Optionen
  observer.observe(target, config);
}

// Rufen Sie die Funktion zur Überwachung von Änderungen des Songtextinhalts auf
observeSongChanges();
