<!DOCTYPE html>
<html>
<head>
  <title>Twilio Client Quickstart</title>
  <link rel="stylesheet" href="{{ url('public/css/site.css') }}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <div id="dialog-confirm" style="display: none;" title="Empty the recycle bin?">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span></p>
</div>
  <div id="controls">
    <div id="info">
      <p class="instructions">Twilio Client</p>
      <div id="client-name"></div>
      <div id="output-selection">
        <label>Ringtone Devices</label>
        <select id="ringtone-devices" multiple></select>
        <label>Speaker Devices</label>
        <select id="speaker-devices" multiple></select><br/>
        <a id="get-devices">Seeing unknown devices?</a>
      </div>
    </div>
    <div id="call-controls">
      <p class="instructions">Make a Call:</p>
      <input id="phone-number" type="text" placeholder="Enter a client name" />
      <button id="button-call">Call</button>
      <button id="button-hangup">Hangup</button>
      <div id="volume-indicators">
        <label>Mic Volume</label>
        <div id="input-volume"></div><br/><br/>
        <label>Speaker Volume</label>
        <div id="output-volume"></div>
      </div>
    </div>
    <div id="log"></div>
  </div>

  <script type="text/javascript" src="//media.twiliocdn.com/sdk/js/client/v1.7/twilio.min.js"></script>  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="{{ url('public/js/quickstart.js') }}"></script>
</body>
</html>
