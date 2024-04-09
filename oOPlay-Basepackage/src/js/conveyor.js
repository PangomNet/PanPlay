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

window.addEventListener('resize', updateMarqueeAnimation);

// Event-Listener hinzufügen, um die Funktion bei Bedarf auszulösen
document.addEventListener("DOMContentLoaded", function() {
  // Initialer Aufruf der Funktion beim Laden der Seite
  updateMarqueeAnimation();

  // MutationObserver erstellen, um Änderungen im Label zu überwachen
  let observer = new MutationObserver(updateMarqueeAnimation);
  let targetNode = document.getElementById('currentsong_lbl_holder');
  
  // Konfiguration des Observers
  let config = { childList: true, subtree: true };
  
  // Observer starten und das Zielknoten als Ziel angeben
  observer.observe(targetNode, config);
});
