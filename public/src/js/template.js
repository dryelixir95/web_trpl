(function($) {
  'use strict';
  $(function() {
    var body = $('body');
    var sidebar = $('.sidebar');

    function addActiveClass(element) {
      var current = window.location.pathname;  // Dapatkan path lengkap dari URL
      var currentPath = current.split('/').slice(0, 3).join('/');  // Ambil hingga /admin/menu/beranda
      var elementPath = new URL(element.attr('href'), window.location.origin).pathname;  // Dapatkan path dari href elemen

      // Jika path elemen sesuai dengan path saat ini
      if (elementPath === currentPath) {
       // Hanya tambahkan kelas active jika elemen tidak memiliki class dropdown
        if (!element.closest('.nav-item').hasClass('dropdown')) {
          element.closest('.nav-item').addClass('active');
        }
        // Hapus kelas d-none dari submenu yang terkait
        element.closest('.dropdown').find('.submenu').removeClass('d-none');
      }
    }

    // Panggil fungsi untuk elemen yang dimuat melalui AJAX
    $(document).ajaxComplete(function() {
      $('.nav li a', sidebar).each(function() {
        var $this = $(this);
        addActiveClass($this);
      });
    });

    // Close other submenu in sidebar on opening any
    sidebar.on('show.bs.collapse', '.collapse', function() {
      sidebar.find('.collapse.show').collapse('hide');
    });

    // Additional code for other functionalities
    $('[data-toggle="minimize"]').on("click", function() {
      if ((body.hasClass('sidebar-toggle-display')) || (body.hasClass('sidebar-absolute'))) {
        body.toggleClass('sidebar-hidden');
      } else {
        body.toggleClass('sidebar-icon-only');
      }
    });

    $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');

    $('[data-toggle="horizontal-menu-toggle"]').on("click", function() {
      $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
    });

    var navItemClicked = $('.horizontal-menu .page-navigation >.nav-item');
    navItemClicked.on("click", function(event) {
      if(window.matchMedia('(max-width: 991px)').matches) {
        if(!($(this).hasClass('show-submenu'))) {
          navItemClicked.removeClass('show-submenu');
        }
        $(this).toggleClass('show-submenu');
      }        
    });

    $(window).scroll(function() {
      if(window.matchMedia('(min-width: 992px)').matches) {
        var header = $('.horizontal-menu');
        if ($(window).scrollTop() >= 70) {
          $(header).addClass('fixed-on-scroll');
        } else {
          $(header).removeClass('fixed-on-scroll');
        }
      }
    });
  });

  $('#navbar-search-icon').click(function() {
    $("#navbar-search-input").focus();
  });

})(jQuery);
