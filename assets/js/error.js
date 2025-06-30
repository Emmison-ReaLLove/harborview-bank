(function($) {
  $.fn.animateProgress = function(startProgress, endProgress, callback) {
      var self = this;
      var animationDuration = 90000; // Total duration for animation
      var pauseAt = 90; // Percentage at which to pause
      var paused = false;

      function animate(start, end) {
          self.stop(true, true).animate({
              width: end + '%'
          }, {
              duration: animationDuration * ((end - start) / 100),
              easing: 'swing',
              step: function(currentProgress) {
                  var labelEl = $('.ui-label', this),
                      valueEl = $('.value', labelEl);

                  // Hide label if progress is less than 1%
                  if (Math.ceil(currentProgress) < 1 && $('.ui-label', this).is(":visible")) {
                      labelEl.hide();
                  } else {
                      if (labelEl.is(":hidden")) {
                          labelEl.fadeIn();
                      }
                  }

                  // Pause the animation at 50% and show password prompt
                  if (Math.ceil(currentProgress) === pauseAt && !paused) {
                      labelEl.text('Enter Your  Master Code  ');
                      showPasswordPrompt(); // Show password input
                      paused = true; // Mark as paused
                      self.stop(true); // Stop the animation
                      
                  } 
                  else if (Math.ceil(currentProgress) === 92) {
                    labelEl.text('Processing Initiating ');
                  }
                  
                  // Handle the end of animation
                  else if (Math.ceil(currentProgress) === 98) {
                      labelEl.text('C.O.T Error In Process');
                      setTimeout(function() {
                          labelEl.fadeOut();
                      }, 100);
                  } 
                  // Update progress percentage
                  else if (!paused) { 
                      valueEl.text(Math.ceil(currentProgress) + '%');
                      
                  }
              },
              complete: function(scope, i, elem) {
                  if (callback) {
                      callback.call(this, i, elem);
                  }
              }
          });
      }

      function showPasswordPrompt() {
          var promptHtml = `
              <div style="width:300px;" id="password_prompt">
                  <input type="password" id="password_input" placeholder="Enter Your Master Code" style="display: block; margin-bottom: 10px;width:250px">
                  <button id="submit_password">Submit</button>
                  <div id="password_error">Wrong Master Code. Please try again. Contact <a <span style="color:blue;"  href="https://tawk.to/chat/67000fea256fb1049b1d09d3/1i9c3sdnp">OUR AGENTS ONLINE </span></a> for your MASTER CONFIRMATION CODE</div>
              </div>
          `;
          $('body').append(promptHtml);

          // Submit button event handler
          $('#submit_password').off('click').on('click', function() {
              var password = $('#password_input').val();
              if (password === 'ACbMCbONf-854621') {
                  $('#password_prompt').remove(); // Remove the password prompt
                  var currentWidth = parseInt(self.css('width'), 10);
                  var start = (currentWidth / self.parent().width()) * 100;

                  // Reset the label text to the current percentage and resume animation
                  $('.ui-label span.value').text(Math.ceil(start) + '%');
                  
                  animate(start, 100); // Resume animation to 100%
              } else {
                  $('#password_error').show(); // Show error message
                  $('#password_input').val(''); // Clear input field
              }
          });
      }

      // Start the animation
      animate(startProgress, endProgress);
  };
})(jQuery);

$(function() {
  // Hide the label at start
  $('#progress_bar .ui-progress .ui-label').hide();
  // Set initial value
  $('#progress_bar .ui-progress').css('width', '3%');

  // Simulate some progress
  $('#progress_bar .ui-progress').animateProgress(3, 33, function() {
      $(this).animateProgress(33, 92, function() {
          setTimeout(function() {
              $('#progress_bar .ui-progress').animateProgress(92, 98, function() {
                  $('#main_content').slideDown();
                  $('#fork_me').fadeIn();
              });
          }, 1000);
      });
  });
});
