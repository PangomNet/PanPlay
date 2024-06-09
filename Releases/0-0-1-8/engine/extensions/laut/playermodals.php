<?php
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';
// Prüfen, ob die nolfmfeatures-Variable auf 'y' gesetzt ist
$nolfmfeatures = isset($_GET['nolfmfeatures']) ? $_GET['nolfmfeatures'] : '';
$lfmstream = isset($_GET['lfmstream']) ? $_GET['lfmstream'] : '';

// Wenn nolfmfeatures nicht auf 'y' gesetzt ist und lfmstream nicht leer ist, wird der Code ausgegeben
if ($nolfmfeatures !== 'y' && !empty($lfmstream)):
 

    
endif;






// Hier können Sie PHP-Code einfügen, der benötigt wird, um Variablen zu initialisieren oder andere Logik auszuführen

$playwithmodal_content = <<<HTML
<!---------------------------- PLAYWITH MODAL -------------------->
<div class="modal fade" id="playwith_modal" tabindex="-1" aria-labelledby="playwith_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{$ext_lang["playwith_modal_title"]}</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <p>{$ext_lang["playwith_modal_topdesc"]}</p>
        <div class="alert alert-info d-flex align-items-center" role="alert">
          <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
          </svg>
          <div>
          {$ext_lang["playwith_modal_gcast_topdesc1"]} $lfmstream {$ext_lang["playwith_modal_gcast_topdesc2"]}
          </div>
        </div>
        <oop_div id="oolfm_tunein_url">
          <div id="api_lfm_tunein_link">Loading...</div>
          <script type="text/html" id="tunein_link_template" charset="utf-8">
            <% if (this.third_parties.tunein && this.third_parties.tunein.url) { %>
              <%= "<a class='btn btn-block text-white' style='width: 100%; background-color: #1c203c;' target='_blank' href='" + this.third_parties.tunein.url + "'> TuneIn*</a><br><br>" %>
            <% } %>
          </script>
          <script type="text/javascript" charset="utf-8">
            laut.fm.station('$lfmstream').info({container:'api_lfm_tunein_link', template:'tunein_link_template'}, true);
          </script>
        </oop_div>
        <oop_div id="oolfm_radiode_url">
          <div id="api_lfm_radiode_link">Loading...</div>
          <script type="text/html" id="radiode_link_template" charset="utf-8">
            <% if (this.third_parties.radiode && this.third_parties.radiode.url) { %>
              <%= "<a class='btn btn-success btn-block' style='width: 100%;' target='_blank' href='" + this.third_parties.radiode.url + "'>radio.de*</a><br><br>" %>
            <% } %>
          </script>
          <script type="text/javascript" charset="utf-8">
            laut.fm.station('$lfmstream').info({container:'api_lfm_radiode_link', template:'radiode_link_template'}, true);
          </script>
        </oop_div>
        <oop_div id="oolfm_phonostar_url">
          <div id="api_lfm_phonostar_link">Loading...</div>
          <script type="text/html" id="phonostar_link_template" charset="utf-8">
            <% if (this.third_parties.phonostar && this.third_parties.phonostar.url) { %>
              <%= "<a class='btn btn-danger btn-block' style='width: 100%;' target='_blank' href='" + this.third_parties.phonostar.url + "'>phonostar*</a><br><br>" %>
            <% } %>
          </script>
          <script type="text/javascript" charset="utf-8">
            laut.fm.station('$lfmstream').info({container:'api_lfm_phonostar_link', template:'phonostar_link_template'}, true);
          </script>
        </oop_div>
        <a class="btn btn-block" style="width: 100%; background-color: #1ed9b4;" target="_blank" href="https://laut.fm/$lfmstream">laut.fm*</a><br><br>
        <div class="btn-group">
          <a href="https://stream.laut.fm/$lfmstream" class="btn btn-danger">{$ext_lang["directstreamtobrowserdropdown"]}</a>
          <a class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas "></i>
            <span class="visually-hidden">Toggle Dropdown</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="https://stream.laut.fm/$lfmstream.m3u">{$ext_lang["directstreamtobrowserdropdown_option1"]}</a></li>
            <li><a class="dropdown-item" href="https://stream.laut.fm/$lfmstream.pls">{$ext_lang["directstreamtobrowserdropdown_option2"]}</a></li>
          </ul>
        </div>
        <br><br>
        <p class=""><small>{$ext_lang["playwith_modal_bottomnote"]}<br>{$ext_lang["playwith_modal_cast_bottomnote1"]} <a target="_blank" href="../../../docs/chromecast.html#requirements">{$ext_lang["playwith_modal_cast_bottomnote_linktitle"]}</a></small></p>
      </div>
    </div>
  </div>
</div>
HTML;


$stationinfomodal_code = <<<HTML
<div class="modal fade" id="stationinfo_modal" tabindex="-1" aria-labelledby="stationinfo_modal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutModaltitleLabel"><i class="fa-solid fa-radio"></i> $lfmstream</h5>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
            
            <div id="stationlogoholder" class="text-center">

</div>
<br>
<div id="api_lfm_format">Loading...</div>
<script type="text/html" id="format_template" charset="utf-8">
<%= "<figure class='text-center'>
  <blockquote class='blockquote'>
    <b>" + this.format + "</b></blockquote>
</figure>" %>
</script>
<script type="text/javascript" charset="utf-8">
laut.fm.station('$lfmstream')
.info({container:'api_lfm_format', template:'format_template'}, true);
</script>


                <div id="oolfm_lafm_url"><p class='lead'>
                    <div class='' id="api_lfm_description">Loading...</div>
                    <script type="text/html" id="description_template" charset="utf-8">
                        <%= "" + this.description +"<br>" %>
                    </script>
                
                <script type="text/javascript" charset="utf-8">
                    laut.fm.station('$lfmstream')
                    .info({container:'api_lfm_description', template:'description_template'}, true);
                </script>
                </div>
                <br>
                <style>
                   #oolfm_station_url, #oolfm_station_x_url, #api_lfm_website_link, #oolfm_station_fb_url, #oolfm_station_insta_url, #api_lfm_twitter_link, #api_lfm_facebook_link, #api_lfm_instagram_link {
                    display: inline-block;
}
                </style>
                <div id="oolfm_station_url">
                    <?php if (!empty($lfmstream)): ?>
                        <div id="api_lfm_website_link">Loading...</div>
                        <script type="text/html" id="website_link_template" charset="utf-8">
                            <% if (this.third_parties.website && this.third_parties.website.url) { %>
                                <% var domain = this.third_parties.website.url.split('/')[2]; %>
                                <% if (domain.includes('twitter.com') || domain.includes('x.com')) { %>
                                    <%= "<a target='_blank' href='" + this.third_parties.website.url + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/x/x-blackwhite.png' width='48px' height='auto' alt='" + this.third_parties.website.url + "'></a>" +"<a target='_blank' href='https://laut.fm/$lfmstream'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/laut orb/laut-tealgreen.png' width='48px' height='auto' alt='https://laut.fm/$lfmstream'></a>" %>
                                <% } else if (domain.includes('facebook.com') || domain.includes('fb.me')) { %>
                                    <%= "<a target='_blank' href='" + this.third_parties.website.url + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/facebook/fb-color.png' width='48px' height='auto' alt='" + this.third_parties.website.url + "'></a>" +"<a target='_blank' href='https://laut.fm/$lfmstream'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/laut orb/laut-tealgreen.png' width='48px' height='auto' alt='https://laut.fm/$lfmstream'></a>" %>
                                <% } else if (domain.includes('instagram.com')) { %>
                                    <%= "<a target='_blank' href='" + this.third_parties.website.url + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/instagramm/ig-color.png' width='48px' height='auto' alt='" + this.third_parties.website.url + "'></a>" +"<a target='_blank' href='https://laut.fm/$lfmstream'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/laut orb/laut-tealgreen.png' width='48px' height='auto' alt='https://laut.fm/$lfmstream'></a>" %>
                                    <% } else if (domain.includes('laut.fm')) { %>
                                    <%= "<a target='_blank' href='" + this.third_parties.website.url + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/laut orb/laut-tealgreen.png' width='48px' height='auto' alt='" + this.third_parties.website.url + "'></a>" %>
                                <% } else { %>
                                    <%= "<a target='_blank' href='" + this.third_parties.website.url + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/homepage_link/link-tealwhite.png' width='48px' height='auto' alt='" + this.third_parties.website.url + "'></a>" +"<a target='_blank' href='https://laut.fm/$lfmstream'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/laut orb/laut-tealgreen.png' width='48px' height='auto' alt='https://laut.fm/$lfmstream'></a>" %>
                                <% } %>
                            <% } %>
                        </script>
                        <script type="text/javascript" charset="utf-8">
                            laut.fm.station('$lfmstream')
                            .info({container:'api_lfm_website_link', template:'website_link_template'}, true);
                        </script>
                    <?php endif; ?>
                </div>
                <div id="oolfm_station_x_url">
    <?php if (!empty($lfmstream)): ?>
        <div id="api_lfm_twitter_link">Loading...</div>
        <script type="text/html" id="twitter_link_template" charset="utf-8">
            <% if (this.third_parties.twitter && this.third_parties.twitter.url) { %>
                <% let twitterUrl = addHttpsIfNeeded(this.third_parties.twitter.url, 'twitter.com'); %>
                <%= "<a target='_blank' href='" + twitterUrl + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/x/x-blackwhite.png' width='48px' height='auto' alt='Twitter'></a>" %>
            <% } %>
        </script>
        <script type="text/javascript" charset="utf-8">
            laut.fm.station('$lfmstream')
                .info({container:'api_lfm_twitter_link', template:'twitter_link_template'}, true);
        </script>
    <?php endif; ?>
</div>

<div id="oolfm_station_fb_url">
    <?php if (!empty($lfmstream)): ?>
        <div id="api_lfm_facebook_link">Loading...</div>
        <script type="text/html" id="facebook_link_template" charset="utf-8">
            <% if (this.third_parties.facebook && this.third_parties.facebook.page) { %>
                <% let facebookUrl = addHttpsIfNeeded(this.third_parties.facebook.page, 'facebook.com'); %>
                <%= "<a target='_blank' href='" + facebookUrl + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/facebook/fb-color.png' width='48px' height='auto' alt='Facebook'></a>" %>
            <% } %>
        </script>
        <script type="text/javascript" charset="utf-8">
            laut.fm.station('$lfmstream')
                .info({container:'api_lfm_facebook_link', template:'facebook_link_template'}, true);
        </script>
    <?php endif; ?>
</div>

<div id="oolfm_station_insta_url">
    <?php if (!empty($lfmstream)): ?>
        <div id="api_lfm_instagram_link">Loading...</div>
        <script type="text/html" id="instagram_link_template" charset="utf-8">
            <% if (this.third_parties.instagram && this.third_parties.instagram.name) { %>
                <% let instagramUrl = addHttpsIfNeeded(this.third_parties.instagram.name, 'instagram.com'); %>
                <%= "<a target='_blank' href='" + instagramUrl + "'><img style ='margin: 0.2em;' class='rounded' src='rscs/imglibs/social/instagramm/ig-color.png' width='48px' height='auto' alt='Instagram'></a>" %>
            <% } %>
        </script>
        <script type="text/javascript" charset="utf-8">
            laut.fm.station('$lfmstream')
                .info({container:'api_lfm_instagram_link', template:'instagram_link_template'}, true);
        </script>
    <?php endif; ?>
</div>

<script type="text/javascript">
    function addHttpsIfNeeded(url, domain) {
        // Überprüfen, ob die URL bereits mit http:// oder https:// beginnt
        if (!url.startsWith('http://') && !url.startsWith('https://')) {
            // Wenn nicht, füge https:// hinzu
            url = 'https://' + url;
        }
        
        // Überprüfen, ob die Domain in der URL vorhanden ist
        if (!url.includes(domain + '/')) {
            // Wenn nicht, füge die Domain hinzu
            url = url.startsWith('https://') ? url.replace('://', '://' + domain + '/') : url;
        }
        
        return url;
    }
</script>
            </div>
        </div>
    </div>
</div>
HTML;

$lastplayed_modal_code = <<<HTML
<!-- Lastplayed Modal -->
<div class="modal fade" id="lastplayed_modal" tabindex="-1" aria-labelledby="lastplayed_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-history"></i> {$ext_lang["trackhistory_modal_title"]}</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <oop_div id="oolfm_lastplayed">
          <div id="api_lfm_last_x_songs_spezial">Loading...</div>
          <script type="text/html" id="last_x_songs_spezial_template" charset="utf-8">
            <% for (var i = 0; i < 30; i++) {
              if (this[i] && (this[i].type == "song" || this[i].type == "news")) { %>
                <% if (i === 0) { %>
                  <div class="mt-4 p-5 text-white rounded" style="background: #48527f;"><p> {$ext_lang["current_song"]}</p><h4><i class="fas fa-music"></i> <%= this[i].artist.name %> - <%= this[i].title %></h4></div><br><u>{$ext_lang["last_songs"]}</u><br>
                <% } else { %>
                  <p><i class="fas fa-music"></i> <%= this[i].artist.name %> - <%= this[i].title %><br /></p>
                <% } %>
              <% } } %>
          </script>
          <script type="text/javascript" charset="utf-8">
            laut.fm.station('$lfmstream').last_songs({container:'api_lfm_last_x_songs_spezial', template:'last_x_songs_spezial_template'}, true);
          </script>
        </oop_div>
      </div>
    </div>
  </div>
</div>
HTML;

$sendeplan_modal_code = <<<HTML
<!---------------------------- SENDEPLAN MODAL -------------------->

<div class="modal fade" id="sendeplan_modal" tabindex="-1" aria-labelledby="sendeplan_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{$ext_lang["sendeplan_modal_title"]}</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <oop_div id="oolfm_sendeplan">


        
            <ul class="nav nav-pills" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="btn btn-outline-success" id="monday-tab" data-bs-toggle="pill" href="#monday" role="tab" aria-controls="monday" aria-selected="true">{$ext_lang["mo_s"]}</button>
                </li>&nbsp;
                <li class="nav-item" role="presentation">
                    <button class="btn btn-outline-success" id="tuesday-tab" data-bs-toggle="pill" href="#tuesday" role="tab" aria-controls="tuesday" aria-selected="false">{$ext_lang["di_s"]}</button>
                </li>&nbsp;
                <li class="nav-item" role="presentation">
                    <button class="btn btn-outline-success" id="wednesday-tab" data-bs-toggle="pill" href="#wednesday" role="tab" aria-controls="wednesday" aria-selected="false">{$ext_lang["mi_s"]}</button>
                </li>&nbsp;
                <li class="nav-item" role="presentation">
                    <button class="btn btn-outline-success" id="thursday-tab" data-bs-toggle="pill" href="#thursday" role="tab" aria-controls="thursday" aria-selected="false">{$ext_lang["do_s"]}</button>
                </li>&nbsp;
                <li class="nav-item" role="presentation">
                    <button class="btn btn-outline-success" id="friday-tab" data-bs-toggle="pill" href="#friday" role="tab" aria-controls="friday" aria-selected="false">{$ext_lang["fr_s"]}</button>
                </li>&nbsp;
                <li class="nav-item" role="presentation">
                    <button class="btn btn-outline-success" id="saturday-tab" data-bs-toggle="pill" href="#saturday" role="tab" aria-controls="saturday" aria-selected="false">{$ext_lang["sa_s"]}</button>
                </li>&nbsp;
                <li class="nav-item" role="presentation">
                    <button class="btn btn-outline-success" id="sunday-tab" data-bs-toggle="pill" href="#sunday" role="tab" aria-controls="sunday" aria-selected="false">{$ext_lang["so_s"]}</button>
                </li>
            </ul>
          
     <hr>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="monday" role="tabpanel" aria-labelledby="monday-tab">
                    <h3 id="mon-h">{$ext_lang["mo"]}</h3>
                    <div id="api_lfm_schedule_mon">Loading...</div>
                </div>
                <div class="tab-pane fade" id="tuesday" role="tabpanel" aria-labelledby="tuesday-tab">
                <h3 id="tue-h">{$ext_lang["di"]}</h3>
                    <div id="api_lfm_schedule_tue">Loading...</div>
                </div>
                <div class="tab-pane fade" id="wednesday" role="tabpanel" aria-labelledby="wednesday-tab">
                <h3 id="wed-h">{$ext_lang["mi"]}</h3>
                    <div id="api_lfm_schedule_wed">Loading...</div>
                </div>
                <div class="tab-pane fade" id="thursday" role="tabpanel" aria-labelledby="thursday-tab">
                <h3 id="thu-h">{$ext_lang["do"]}</h3>
                    <div id="api_lfm_schedule_thu">Loading...</div>
                </div>
                <div class="tab-pane fade" id="friday" role="tabpanel" aria-labelledby="friday-tab">
                <h3 id="fri-h">{$ext_lang["fr"]}</h3>
                    <div id="api_lfm_schedule_fri">Loading...</div>
                </div>
                <div class="tab-pane fade" id="saturday" role="tabpanel" aria-labelledby="saturday-tab">
                <h3 id="sat-h">{$ext_lang["sa"]}</h3>
                    <div id="api_lfm_schedule_sat">Loading...</div>
                </div>
                <div class="tab-pane fade" id="sunday" role="tabpanel" aria-labelledby="sunday-tab">
                <h3 id="sun-h">{$ext_lang["so"]}</h3>
                    <div id="api_lfm_schedule_sun">Loading...</div>
                </div>
            </div>
            <script>
// Aktuellen Wochentag erhalten (0 = Sonntag, 1 = Montag, usw.)
const today = new Date().getDay();

// ID des Tabs für den aktuellen Wochentag
const tabId = '#' + ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'][today] + '-tab';
const tabContentId = '#' + ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'][today];

// Den aktuellen Wochentag aktivieren
const currentTab = document.querySelector(tabId);
currentTab.classList.add('show', 'active');

// Den zugehörigen Inhalt anzeigen und "(Heute)" hinzufügen, wenn es der aktuelle Tag ist
document.querySelector(tabContentId).classList.add('show', 'active');
const heading = document.querySelector(tabContentId).querySelector('h3');
heading.textContent += ' ({$ext_lang["today"]})';
</script>
      

          <br>
          <script type="text/javascript" charset="utf-8">
            var show_schedule = function(schedule){
              var no_entry = '{$ext_lang["nospecialshow"]}';
              var days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
              var days_buffer = {mon: [], tue: [], wed: [], thu: [], fri: [], sat: [], sun: []}; 
              Array.prototype.slice.call(schedule).forEach(function(schedule_entry) {
                var start_time = schedule_entry.hour;
                if (start_time < 10) { start_time = "0" + start_time; }
                start_time = start_time + ":00 Uhr";
                days_buffer[schedule_entry.day].push("<span style=\"display: flex; padding-bottom:8px;\">" + start_time + " - " + schedule_entry.name + "</span>");
              });
              Array.prototype.slice.call(days).forEach(function(schedule_days) {
                if (document.getElementById("api_lfm_schedule_" + schedule_days) !== null) {
                  if (days_buffer[schedule_days].length >= 1) {
                    document.getElementById("api_lfm_schedule_" + schedule_days).innerHTML = days_buffer[schedule_days].join("");
                  } else {
                    document.getElementById("api_lfm_schedule_" + schedule_days).innerHTML = no_entry;
                  }
                }
              }); 
            };
            laut.fm.station("{$lfmstream}").schedule(show_schedule);
          </script>
        </oop_div>
        <a href="https://laut.fm/{$lfmstream}" target="_blank" >{$ext_lang["sendeplan_laut"]} </a>
      </div>
    </div>
  </div>
</div>
HTML;




if ($stationinfo !== false) {
  echo $stationinfomodal_code;
}
if ($sendeplan !== false) {
  echo $sendeplan_modal_code;
}
if ($trackhistory !== false) {
  echo $lastplayed_modal_code;
}
if ($playwith !== false) {
  echo $playwithmodal_content;
}






?>