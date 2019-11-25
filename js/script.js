var $messages = $('.messages-content'),
  d, h, m,
  i = 0;

//get last message id $(this).attr('data-id')
var last_id = $('.message:last').attr('data-id');
console.log(last_id);

//on load check for new messages    
$(window).load(function () {
  $messages.mCustomScrollbar();
  setTimeout(function () {
    fakeMessage();
  }, 100);
});

//scroll to bottom
function updateScrollbar() {
  $messages.mCustomScrollbar("update").mCustomScrollbar('scrollTo', 'bottom', {
    scrollInertia: 10,
    timeout: 0
  });
}


//add time stamp for every minuite
function setDate() {
  d = new Date()
  if (m != d.getMinutes()) {
    m = d.getMinutes();
    $('<div class="timestamp">' + d.getHours() + ':' + m + '</div>').appendTo($('.message:last'));
  }
}

function insertMessage() {

  //get value from input
  msg = $('.message-input').val();
  user = $('.user').val();

  // return false if no text
  if ($.trim(msg) == '') {
    return false;
  }

  //add message to list
  $('<div class="message message-personal" data-id="' + (last_id++) + '">' + msg + '</div>').appendTo($('.mCSB_container')).addClass('new');

  //set time after message
  setDate();

  //save to database
  new_message(msg, user);

  //make input field blank
  $('.message-input').val(null);

  //scroll to bottom
  updateScrollbar();

  // check for new message and append
  setTimeout(function () {
    fakeMessage();
  }, 1000 + (Math.random() * 20) * 100);

}


//on submit call the main insert function
$('.message-submit').click(function () {
  insertMessage();
});


//on press enter button call the main insert function
$(window).on('keydown', function (e) {
  if (e.which == 13) {
    insertMessage();
    return false;
  }
})


//fake messages
var Fake = [
  'Hi there, I\'m Fabio and you?',
  'Nice to meet you',
  'How are you?',
  'Not too bad, thanks',
  'What do you do?',
  'That\'s awesome',
  'Codepen is a nice place to stay',
  'I think you\'re a nice person',
  'Why do you think that?',
  'Can you explain?',
  'Anyway I\'ve gotta go now',
  'It was a pleasure chat with you',
  'Time to make a new codepen',
  'Bye',
  ':)'
]


//fake message rendering
function fakeMessage() {

  //check if the input submited blank or filled
  if ($('.message-input').val() != '') {
    return false;
  }

  //add typing animation
  $('<div class="message loading new"><figure class="avatar"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80.jpg" /></figure><span></span></div>').appendTo($('.mCSB_container'));
  updateScrollbar();

  //remove typing animation and append the new message
  setTimeout(function () {
    //remove message loading
    $('.message.loading').remove();

    //add the new message to list
    $('<div class="message new" data-id="' + (last_id++) +'"><figure class="avatar"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80.jpg" /></figure>' + Fake[i] + '</div>').appendTo($('.mCSB_container')).addClass('new');

    //add time stamp
    setDate();

    //scroll to bottom
    updateScrollbar();
    i++;
  }, 1000 + (Math.random() * 20) * 100);

}


function new_message(content, user) {
  $.ajax({
    url: "chat.php",
    method: "POST",
    data: {
      form: 'new',
      user: user,
      content: content
    },
    dataType: "text",
    success: function(data) {
      // $('.messages-content').html(data);
    }
  });
}