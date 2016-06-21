
// for form label
$(document).ready(function() {

  $('.inGroup input, .cntMsg, .cntDrop').blur(function() {

    // check if the input has any value (if we've typed into it)
    if ($(this).val())
      $(this).addClass('used');
    else
      $(this).removeClass('used');
  });
  
});


// for 1 statick input field == usedLvl , usedLvladd || used , usedInadd
$(document).ready(function() {

  $('.usedInadd').focus(function() {

    // check if the input has any value (if we've typed into it)
    if ($(this).val()) {
      $(this).addClass('used');
	  $(".usedLvladd").addClass('usedLvl');
	}
    else {
      $(this).removeClass('used');
	  $(".usedLvladd").removeClass('usedLvl');
	}
  });
  
});






