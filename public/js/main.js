(function( $ ) {
  $(document).on('click', '.select-section', function(ev) {
    ev.preventDefault();
    $('.search_type_content').addClass('show-up');
    $('body').append('<div class="select-overlay"></div>');
  });
  $(document).on('click', '.select-overlay', function(ev) {
    ev.preventDefault();
    $(this).remove();
    $('.search_type_content').removeClass('show-up');
  });
  $(document).on('click', '.search_type_content.show-up a', function(ev) {
    ev.preventDefault();
    var text = $(this).text();
    $('.select-section').text('Selected: ' + text);
    $('.select-overlay').remove();
    $('.search_type_content').removeClass('show-up');
  });
  $(document).on('click', '#LOGIN-MENU', function(){
    $('.navbar-toggle').trigger('click');
  });
  if ($('.mmainnav').length > 0) {
    $container = $('ul.nav.navbar-nav.nav-pills.nav-menu ');
    var i = 0;
    $('.mmainnav').each(function(){
      i++;
      var href = $(this).attr('href');
      var text = $(this).text();
      var onclick = $(this).attr('onclick');
      var link = $('<a></a>');
      link.text(text);
      link.attr('href', href);
      if (i === 4 || i === 6) {
        $container.append('<li class="mobile-link separator"></li>');
      }
      var item = $('<li class="mobile-link"></li>').append(link);
      if ( onclick !== undefined ) { link.attr('onclick', onclick); }
      $container.append(item);
    });
  }
  if ($('.show-top').length > 0 && $('#guest-menu').length === 0) {
    $('nav .search_bar').before('<div class="sidemenu visible-xs" />');
    $('body').addClass('menu-only');
    $('.show-top').each(function(){
      var href = $(this).attr('href');
      var icon = $(this).find('i').clone();
      var onclick = $(this).attr('onclick');
      var link = $('<a></a>');
      link.attr('href', href);
      link.append(icon);
      if ( onclick !== undefined ) { link.attr('onclick', onclick); }
      $('.sidemenu').append(link)
    });
    $('.sidemenu').append($('.navbar-toggle'));
  }
}( jQuery ));
$(document).on('touchstart', '.navbar-toggle', function() {
  $('body').append('<div class="overlay"></div>');
});
$(document).on('touchstart', '.overlay', function() {
  $('.overlay').remove();
  $('#mainmenu').removeClass('in');
  $('#sign_in').attr('style', '');
});
