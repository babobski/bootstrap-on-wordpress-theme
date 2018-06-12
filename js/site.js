
jQuery(document).ready(function($) {

	// Your JavaScript goes here
    $('#sjVideo').on('hidden.bs.modal', function() {
    const html5Video = document.getElementById("htmlVideo");
    if (html5Video != null) {
      html5Video.pause();
      html5Video.currentTime = 0;
    }
  });

});

