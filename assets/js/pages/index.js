function scrollToElementAfterClick(target){
    if(target.length){
      $("html, body").stop().animate({ scrollTop : target.offset().top}, 500);
    }
  }

  