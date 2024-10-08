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
  <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{$ext_lang["playwith_modal_title"]}</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
        <p>{$ext_lang["playwith_modal_topdesc"]}</p>
        <div class="alert bg-dark text-white d-flex align-items-center" role="alert">
          <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
          </svg>
          <div>
          {$ext_lang["playwith_modal_gcast_topdesc1"]} $lfmstream {$ext_lang["playwith_modal_gcast_topdesc2"]}
          </div>
        </div>

        <div class="container">
        <div class="row row-cols-lg-4">
          <div class="col">
          <a id="lfmlink_lautfm" class="btn btn-block" style="width: 100%; color: white !important; background-color: #373b4c;" target="_blank" href="https://laut.fm/$lfmstream">
          
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="63.862px" height="27.9531px" viewBox="0 0 432.862 136.81" enable-background="new 0 0 432.862 136.81"
	 xml:space="preserve">
<path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M62.496,0c34.416,0,62.496,28.008,62.496,62.352
	c0,34.416-28.08,62.425-62.496,62.425S0,96.768,0,62.352C0,28.008,28.08,0,62.496,0L62.496,0z M62.496,20.52
	c16.416,0,35.64,11.521,35.64,40.032c0,7.56,0,12.672-2.664,19.872h8.352l8.352-4.896c0.792-7.271,0.792-14.903,0-22.896
	l-8.424-4.393c0-3.023-8.712-33.551-41.256-33.551c-32.472,0-41.256,30.527-41.256,33.551l-8.424,4.393
	c-0.792,7.992-0.72,15.624,0,22.896l8.352,4.896h8.424c-2.736-7.2-2.736-12.312-2.736-19.872C26.856,32.04,46.08,20.52,62.496,20.52
	L62.496,20.52z M62.496,26.424c-16.992,0-30.96,13.896-30.96,30.888v6.48c0,4.535,1.152,9.936,3.096,15.336
	c2.736,7.487,7.848,15.84,14.4,24.695c1.224,1.584,2.808,2.593,4.752,3.024h17.208c2.232-0.359,4.032-1.656,4.752-3.024
	c6.048-8.135,11.304-16.416,14.76-24.912c1.944-5.327,3.024-10.655,3.024-15.119v-6.48C93.528,40.319,79.56,26.424,62.496,26.424
	L62.496,26.424L62.496,26.424z M62.496,33.336c-13.896,0-25.2,11.16-25.2,24.768v5.112c0,4.176,1.152,9.145,3.096,14.04
	c2.52,7.128,6.552,14.472,12.744,22.176c0.648,1.152,1.8,1.584,3.312,1.584h12.024c1.512-0.071,2.592-0.504,3.168-1.512
	c5.976-7.848,10.152-15.48,13.32-23.04c1.8-4.607,2.808-9.288,2.808-13.248v-5.112C87.768,44.496,76.392,33.336,62.496,33.336
	L62.496,33.336z"/>
<g>
	<path fill="#FFFFFF" d="M163.469,22.458v80.634H142.75V22.458H163.469z"/>
	<path fill="#FFFFFF" d="M188.67,62.601h-18.876v-4.433c0-5.112,0.589-9.056,1.768-11.828s3.544-5.222,7.098-7.347
		c3.553-2.124,8.168-3.188,13.846-3.188c6.806,0,11.936,1.204,15.39,3.61c3.453,2.408,5.528,5.363,6.226,8.865
		c0.697,3.504,1.046,10.717,1.046,21.641v33.17h-19.573v-5.89c-1.229,2.362-2.814,4.133-4.756,5.313
		c-1.943,1.181-4.259,1.771-6.948,1.771c-3.52,0-6.749-0.988-9.687-2.963c-2.939-1.976-4.408-6.301-4.408-12.975v-5.429
		c0-4.947,0.779-8.317,2.341-10.11c1.561-1.793,5.429-3.885,11.604-6.275c6.606-2.59,10.143-4.333,10.608-5.229
		c0.465-0.896,0.697-2.722,0.697-5.479c0-3.453-0.258-5.702-0.772-6.749c-0.515-1.045-1.369-1.568-2.564-1.568
		c-1.362,0-2.209,0.44-2.54,1.32c-0.332,0.88-0.498,3.162-0.498,6.848V62.601z M195.045,71.665
		c-3.221,2.358-5.089,4.333-5.603,5.927c-0.516,1.594-0.772,3.885-0.772,6.873c0,3.42,0.224,5.628,0.673,6.624
		c0.447,0.996,1.336,1.494,2.664,1.494c1.262,0,2.083-0.39,2.465-1.171c0.382-0.779,0.573-2.83,0.573-6.15V71.665z"/>
	<path fill="#FFFFFF" d="M268.158,37.001v66.091h-20.47l0.349-5.491c-1.395,2.229-3.112,3.9-5.155,5.015
		c-2.041,1.114-4.391,1.672-7.047,1.672c-3.021,0-5.528-0.531-7.521-1.594s-3.462-2.473-4.407-4.233
		c-0.947-1.76-1.537-3.594-1.769-5.503c-0.232-1.909-0.349-5.703-0.349-11.381V37.001h20.121v44.974
		c0,5.147,0.157,8.201,0.473,9.164c0.315,0.964,1.171,1.444,2.565,1.444c1.494,0,2.382-0.498,2.665-1.494
		c0.281-0.996,0.423-4.2,0.423-9.612V37.001H268.158z"/>
	<path fill="#FFFFFF" d="M296.597,28.186v10.409h5.429v10.459h-5.429v35.361c0,4.351,0.225,6.773,0.672,7.271
		c0.449,0.498,2.316,0.747,5.604,0.747v10.658h-8.118c-4.582,0-7.853-0.19-9.812-0.572c-1.96-0.382-3.686-1.262-5.18-2.641
		c-1.494-1.377-2.424-2.954-2.789-4.73c-0.366-1.776-0.548-5.952-0.548-12.526V49.054h-4.333V38.595h4.333V28.186H296.597z"/>
	<path fill="#FFFFFF" d="M322.894,86.656v16.436h-15.19V86.656H322.894z"/>
	<path fill="#FFFFFF" d="M353.972,22.458v10.21c-4.151,0-6.599,0.191-7.347,0.572c-0.746,0.383-1.12,1.47-1.12,3.263v2.092h8.467
		v10.459h-4.781v54.038h-20.121V49.054h-4.134V38.595h4.134c0-4.35,0.149-7.254,0.448-8.716c0.299-1.461,1.037-2.764,2.217-3.91
		c1.178-1.145,2.83-2.017,4.955-2.614c2.124-0.598,5.429-0.896,9.911-0.896H353.972z"/>
	<path fill="#FFFFFF" d="M377.679,37.001l-0.349,6.288c1.561-2.494,3.419-4.365,5.578-5.612c2.158-1.247,4.614-1.871,7.371-1.871
		c5.379,0,9.612,2.495,12.7,7.483c1.693-2.494,3.603-4.365,5.728-5.612c2.124-1.247,4.482-1.871,7.072-1.871
		c3.419,0,6.25,0.83,8.492,2.49c2.24,1.661,3.677,3.694,4.308,6.101c0.63,2.408,0.946,6.318,0.946,11.729v46.966h-19.523V60.011
		c0-5.645-0.191-9.14-0.572-10.483c-0.383-1.346-1.271-2.018-2.665-2.018c-1.428,0-2.35,0.665-2.765,1.992
		c-0.415,1.328-0.622,4.831-0.622,10.509v43.081h-19.523V61.106c0-6.475-0.158-10.359-0.474-11.654s-1.188-1.942-2.614-1.942
		c-0.896,0-1.661,0.341-2.291,1.021c-0.631,0.681-0.979,1.511-1.046,2.49c-0.067,0.979-0.1,3.062-0.1,6.25v45.82h-19.523V37.001
		H377.679z"/>
</g>
</svg>
          
          *</a><br><br>
          </div>
          <div class="col" id="lfmlink_tunein" ><br><br></div>
         <div class="col" id="lfmlink_radiode"><br><br></div>
          <div class="col" id="lfmlink_phonostar"><br><br></div>
        </div>
        </div>

        <div class="container">
        <div class="row row-cols-md-3">
          <div class="col">
          <a id="lfmlink_source" class="btn btn-danger btn-block" style="width: 100%;" target="_blank" href="https://stream.laut.fm/$lfmstream">{$ext_lang["directstreamtobrowserdropdown"]}</a><br><br>
          </div>
          <div class="col">
          <a id="lfmlink_source_m3u" class="btn btn-danger btn-block" style="width: 100%;" target="_blank" href="https://stream.laut.fm/$lfmstream.m3u">{$ext_lang["directstreamtobrowserdropdown_option1"]}</a><br><br>
          </div>
          <div class="col">
          <a id="lfmlink_source_pls" class="btn btn-danger btn-block" style="width: 100%;" target="_blank" href="https://stream.laut.fm/$lfmstream.pls">{$ext_lang["directstreamtobrowserdropdown_option2"]}</a><br><br>
          </div>

        </div>
        </div>

        <p style="font-size: 12px;" class="">{$ext_lang["playwith_modal_bottomnote"]}<br>{$ext_lang["playwith_modal_cast_bottomnote1"]} <a target="_blank" href="../../../docs/chromecast.html#requirements">{$ext_lang["playwith_modal_cast_bottomnote_linktitle"]}</a></p>
      </div>
    </div>
  </div>
</div>
HTML;


$stationinfomodal_code = <<<HTML
<div class="modal fade" id="stationinfo_modal" tabindex="-1" aria-labelledby="stationinfo_modal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutModaltitleLabel"><i class="fa-solid fa-radio"></i> $lfmstream</h5>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
            
            <div id="stationlogoholder" class="text-center">

</div>
<br>
<div id="api_lfm_format" style="text-align: center;"></div>
<div class='' id="api_lfm_description" style="text-align: center;"></div><br>
<div id="api_lfm_djs" style="text-align: center;"></div>
<div id="api_lfm_genres" style="text-align: center;"></div>
<div id="api_lfm_top_artists" style="text-align: center;"></div>
<div id="api_lfm_location" style="text-align: center;"></div>
<br>
<style>
#oolfm_station_url, #oolfm_station_x_url, #api_lfm_website_link, #oolfm_station_fb_url, #oolfm_station_insta_url, #api_lfm_twitter_link, #api_lfm_facebook_link, #api_lfm_instagram_link {
  display: inline-block;
}
</style>
<div style="text-align: center;" >
<div id="oolfm_station_url" style="text-align: center;">
<div id="api_lfm_website_link" style="text-align: center;"></div>
</div>
<div id="oolfm_station_x_url" style="text-align: center;">
<div id="api_lfm_twitter_link" style="text-align: center;"></div>
</div>

<div id="oolfm_station_fb_url" style="text-align: center;">
<div id="api_lfm_facebook_link" style="text-align: center;"></div>
</div>

<div id="oolfm_station_insta_url" style="text-align: center;">
<div id="api_lfm_instagram_link" style="text-align: center; "></div>
</div>
</div>

            </div>
        </div>
    </div>
</div>
HTML;

$lastplayed_modal_code = <<<HTML
<!-- Lastplayed Modal -->
<div class="modal fade" id="lastplayed_modal" tabindex="-1" aria-labelledby="lastplayed_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-history"></i> {$ext_lang["trackhistory_modal_title"]}</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-header">
      <div class="list-group" style="width: 100%">
        <div id="currentsong_lastplayed_modal_lbl_holder"> </div>
      </div>
      </div>
      <div class="modal-body">
        <oop_div id="oolfm_lastplayed">

        <div class="list-group"  style="width: 100%">
          <div id="api_lfm_last_x_songs_spezial"></div>
          </div>
        </oop_div>
      </div>
      <div class="modal-footer">
      <a class="btn link-underline link-underline-opacity-0" href="#" data-bs-toggle="modal" data-bs-target="#currentsong_modal" data-bs-dismiss="modal" target="_blank" >{$ext_lang["current_song_modallink"]}</a> |
      <!--<a href="#" data-bs-toggle="modal" data-bs-target="#currentplaylist_modal" data-bs-dismiss="modal" target="_blank" >Current Show</a> -->
      <a class="btn link-underline link-underline-opacity-0" href="#" data-bs-toggle="modal" data-bs-target="#sendeplan_modal" data-bs-dismiss="modal" target="_blank" >{$ext_lang["sendeplan_modal_title"]}</a>
      </div>
    </div>
  </div>
</div>
HTML;

$sendeplan_modal_code = <<<HTML
<!---------------------------- SENDEPLAN MODAL -------------------->

<div class="modal fade" id="sendeplan_modal" tabindex="-1" aria-labelledby="sendeplan_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{$ext_lang["sendeplan_modal_title"]}</h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-header">
      <ul class="nav nav-pills" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="monday-tab" data-bs-toggle="pill" href="#monday" role="tab" aria-controls="monday" aria-selected="true">{$ext_lang["mo_s"]}</button>
                </li>&nbsp;
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tuesday-tab" data-bs-toggle="pill" href="#tuesday" role="tab" aria-controls="tuesday" aria-selected="false">{$ext_lang["di_s"]}</button>
                </li>&nbsp;
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="wednesday-tab" data-bs-toggle="pill" href="#wednesday" role="tab" aria-controls="wednesday" aria-selected="false">{$ext_lang["mi_s"]}</button>
                </li>&nbsp;
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="thursday-tab" data-bs-toggle="pill" href="#thursday" role="tab" aria-controls="thursday" aria-selected="false">{$ext_lang["do_s"]}</button>
                </li>&nbsp;
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="friday-tab" data-bs-toggle="pill" href="#friday" role="tab" aria-controls="friday" aria-selected="false">{$ext_lang["fr_s"]}</button>
                </li>&nbsp;
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="saturday-tab" data-bs-toggle="pill" href="#saturday" role="tab" aria-controls="saturday" aria-selected="false">{$ext_lang["sa_s"]}</button>
                </li>&nbsp;
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sunday-tab" data-bs-toggle="pill" href="#sunday" role="tab" aria-controls="sunday" aria-selected="false">{$ext_lang["so_s"]}</button>
                </li>
            </ul>
      </div>

      <div class="modal-body">
     

        <oop_div id="oolfm_sendeplan">


  
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="monday" role="tabpanel" aria-labelledby="monday-tab">
                    <h5 id="mon-h">{$ext_lang["mo"]}</h5>
                    <div id="api_lfm_schedule_mon_cont"><div class="list-group" id="api_lfm_schedule_mon"></div></div>
                </div>
                <div class="tab-pane fade" id="tuesday" role="tabpanel" aria-labelledby="tuesday-tab">
                <h5 id="tue-h">{$ext_lang["di"]}</h5>
                    <div id="api_lfm_schedule_tue_cont"><div class="list-group" id="api_lfm_schedule_tue"></div></div>
                </div>
                <div class="tab-pane fade" id="wednesday" role="tabpanel" aria-labelledby="wednesday-tab">
                <h5 id="wed-h">{$ext_lang["mi"]}</h5>
                    <div id="api_lfm_schedule_wed_cont"><div class="list-group" id="api_lfm_schedule_wed"></div></div>
                </div>
                <div class="tab-pane fade" id="thursday" role="tabpanel" aria-labelledby="thursday-tab">
                <h5 id="thu-h">{$ext_lang["do"]}</h5>
                    <div id="api_lfm_schedule_thu_cont"><div class="list-group" id="api_lfm_schedule_thu"></div></div>
                </div>
                <div class="tab-pane fade" id="friday" role="tabpanel" aria-labelledby="friday-tab">
                <h5 id="fri-h">{$ext_lang["fr"]}</h5>
                    <div id="api_lfm_schedule_fri_cont"><div class="list-group" id="api_lfm_schedule_fri"></div></div>
                </div>
                <div class="tab-pane fade" id="saturday" role="tabpanel" aria-labelledby="saturday-tab">
                <h5 id="sat-h">{$ext_lang["sa"]}</h5>
                    <div id="api_lfm_schedule_sat_cont"><div class="list-group" id="api_lfm_schedule_sat"></div></div>
                </div>
                <div class="tab-pane fade" id="sunday" role="tabpanel" aria-labelledby="sunday-tab">
                <h5 id="sun-h">{$ext_lang["so"]}</h5>
                    <div id="api_lfm_schedule_sun_cont"><div class="list-group" id="api_lfm_schedule_sun"></div></div>
                </div>
            </div>

        </oop_div>
        
      </div>
      <div class="modal-footer">
      <a class="btn link-underline link-underline-opacity-0" href="#" data-bs-toggle="modal" data-bs-target="#lastplayed_modal" data-bs-dismiss="modal" target="_blank" >{$ext_lang["trackhistory_navbar_title"]}</a> |
      <!--<a href="#" data-bs-toggle="modal" data-bs-target="#currentplaylist_modal" data-bs-dismiss="modal" target="_blank" >Current Show</a>-->
      <a class="btn link-underline link-underline-opacity-0" href="#" data-bs-toggle="modal" data-bs-target="#currentsong_modal" data-bs-dismiss="modal" target="_blank" >{$ext_lang["current_song_modallink"]}</a> | 
      <a class="btn link-underline link-underline-opacity-0"  href="https://laut.fm/{$lfmstream}" target="_blank" ><i class="fas fa-external-link-square-alt"></i> {$ext_lang["sendeplan_laut"]} </a>
      
      </div>
    </div>
  </div>
</div>
HTML;


// $currentplaylist_modal_code = <<<HTML;
// ----------------------------- SENDEPLAN MODAL -------------------->

//<div class="modal fade" id="currentplaylist_modal" tabindex="-1" aria-labelledby="currentplaylist_modal" aria-hidden="true">
//  <div class="modal-dialog modal-fullscreen-md-down modal-dialog-centered modal-dialog-scrollable">
//    <div class="modal-content">
//      <div class="modal-header">
//        <h5 class="modal-title" id="currentplaylist_modal_title_lbl"></h5>
//        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
//      </div>
//      <div class="modal-header">
//Placeholder
 //     </div>
//
 //     <div class="modal-body">
 //    
 // Work in Progress
       
        
 //     </div>
  //    <div class="modal-footer">
  //    <a href="#" data-bs-toggle="modal" data-bs-target="#currentsong_modal" data-bs-dismiss="modal" target="_blank" >Current Song</a>
 //     <a href="#" data-bs-toggle="modal" data-bs-target="#lastplayed_modal" data-bs-dismiss="modal" target="_blank" >Trackhistory</a>
 //     <a href="#" data-bs-toggle="modal" data-bs-target="#sendeplan_modal" data-bs-dismiss="modal" target="_blank" >Schedule</a>
 //     </div>
  //  </div>
  //</div>
//</div>
//HTML; 

$currentsong_modal_code = <<<HTML
<!---------------------------- CURRENTSONG MODAL -------------------->

<div class="modal fade" id="currentsong_modal" tabindex="-1" aria-labelledby="currentsong_modal" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-md-down modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="currentsongModalLabel"><span id="currentsong_modal_title"></span></h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      
     

      <div class="modal-body"  style="padding: 0px;">
     
     <div class="container" style="padding-top: 10px; padding-bottom: 10px;">
     <div id="current_song_modal_songcovercontainer" class="float-end" style="padding: 0px;">
      </div>
      <h2><span id="currentsong_modal_titel_lbl"></span></h2>
      <h4><span id="currentsong_modal_interpret_lbl"></span></h4>
      <span id="currentsong_modal_album_lbl"></span>
      <span id="currentsong_modal_length_lbl"></span>
      <!-- <span id="currentsong_modal_genre_lbl">currentsong_modal_genre_lbl</span>
      <span id="currentsong_modal_releasyear_lbl">currentsong_modal_releasyear_lbl</span>
      <span id="currentsong_modal_artist_url_lbl">currentsong_modal_artist_url_lbl</span>
      <span id="currentsong_modal_artistat_applemusic_lbl">currentsong_modal_artistat_allmusic_lbl</span>
      <span id="currentsong_modal_artistat_amazon_lbl">currentsong_modal_artistat_amazon_lbl</span>
      <span id="currentsong_modal_artistat_spotify_lbl">currentsong_modal_artistat_spotify_lbl</span>
      <span id="currentsong_modal_artistat_applemusic_lbl">currentsong_modal_artistat_applemusic_lbl</span> -->
    </div>
      </div>
      <div class="modal-footer">
      <a class="btn link-underline link-underline-opacity-0" href="#" data-bs-toggle="modal" data-bs-target="#lastplayed_modal" data-bs-dismiss="modal" target="_blank" >{$ext_lang["trackhistory_navbar_title"]}</a> |
      <!--<a href="#" data-bs-toggle="modal" data-bs-target="#currentplaylist_modal" data-bs-dismiss="modal" target="_blank" >Current Show</a>-->
      <a class="btn link-underline link-underline-opacity-0" href="#" data-bs-toggle="modal" data-bs-target="#sendeplan_modal" data-bs-dismiss="modal" target="_blank" >{$ext_lang["sendeplan_modal_title"]}</a>
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
//echo $currentplaylist_modal_code;
echo $currentsong_modal_code;







?>