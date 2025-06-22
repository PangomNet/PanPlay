"use strict";
(() => {
  // src/connectors/laut.fm.ts
  Connector.playerSelector = "#oolfm_current_song";
  Connector.artistSelector = "#currentsong_scrobbler_interpret_lbl";
  Connector.trackSelector = "#currentsong_scrobbler_titel_lbl";
  Connector.pauseButtonSelector = ".oop_player";
  function removeEnclosingQuotes(track) {
    return track.trim().slice(1, -1);
  }
  var filter = MetadataFilter.createFilter({ track: removeEnclosingQuotes });
  Connector.applyFilter(filter);
})();
