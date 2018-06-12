
jQuery(document).ready(function($) {

	// Your JavaScript goes here
    $('#sjVideModal').on('hidden.bs.modal', function() {
    const html5Video = document.getElementById("sjVideo");
    if (html5Video != null) {
      html5Video.pause();
      html5Video.currentTime = 0;
    }
  });

});

