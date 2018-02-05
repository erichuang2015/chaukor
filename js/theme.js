// code to enable side navigation
jQuery(document).ready(function () {
  jQuery('.carousel').carousel();

  // Custom 
  var stickyToggle = function(sticky, stickyWrapper, scrollElement) {
    var stickyHeight = sticky.outerHeight();
    var stickyTop = stickyWrapper.offset().top;
    if (scrollElement.scrollTop() >= stickyTop){
      stickyWrapper.height(stickyHeight);
      sticky.addClass("is-sticky");
    }
    else{
      sticky.removeClass("is-sticky");
      stickyWrapper.height('auto');
    }
  };
  
  // Find all data-toggle="sticky-onscroll" elements
  jQuery('[data-toggle="sticky-onscroll"]').each(function() {
    var sticky = jQuery(this);
    var stickyWrapper = jQuery('<div>').addClass('sticky-wrapper'); // insert hidden element to maintain actual top offset on page
    sticky.before(stickyWrapper);
    sticky.addClass('sticky');
    
    // Scroll & resize events
    jQuery(window).on('scroll.sticky-onscroll resize.sticky-onscroll', function() {
      stickyToggle(sticky, stickyWrapper, jQuery(this));
    });
    
    // On page load
    stickyToggle(sticky, stickyWrapper, jQuery(window));
  });


}
);

