// require.config({
// 	"baseUrl": "wp-content/themes/--usuniete--blog/js",
// 	"paths": {
// 		"jquery": "vendor/jquery/jquery",
// 		"slick-carousel": "vendor/slick-carousel/slick/slick"
// 	}
// });



$('.slider__wrapper').slick({
  centerMode: true,
  slidesToShow: 1,
  variableWidth: true,
  nextArrow: '<div><i class="fa fa-long-arrow-right" aria-hidden="true"></i></div>',
  prevArrow: '<div><i class="fa fa-long-arrow-left" aria-hidden="true"></i></div>'
});

jQuery(function($) {
  $.fn.almComplete = function(alm) {
    // Video controls

  };
});

$(document).ready(function() {


  var categoryDropdownBtn = $('.page-header__wrapper__left__title__dropdown');
  var categoryDropdownMenu = $('.page-header__wrapper__left__title__dropdown__category-menu');
  var categoryDropdownMenuItem = $('.page-header__wrapper__left__title__dropdown__category-menu > a');
  var pageHeader = $('.page-header');
  var headerLeft = $('.page-header__wrapper__left');
  var headerTitle = $('.page-header__wrapper__left__title');
  var searchBtn = $('.page-header__wrapper__right__search-btn');
  var searchForm = $('.page-header__wrapper__search');
  var currentCat = $('#curCat').contents().text();
  var hamburger = $('.hamburger');
  var mobileNav = $('.mobile-nav');
  var mobileSearchBtn = $('#mobile-search');
  var postNext = $('.single-content__wrapper__post-content-loop__nextprev-nav__next');
  var postPrev = $('.single-content__wrapper__post-content-loop__nextprev-nav__prev');
  var toTop = $('.back-to-top');

  // Ustawienie pozycji #primary
  $('#primary-nav').css('left', $('#curCat').width() + $('.page-header__wrapper__left__title > h1 > a').width() + 190);

  // Category dropdown menu
  categoryDropdownBtn.mouseenter(function() {
    pageHeader.stop();
    pageHeader.removeClass('overflow-hidden-header');
    if (!$('.dark-overlay').hasClass('dark-overlay--search')) {
      pageHeader.animate({
        height: categoryDropdownMenu.height() + 70
      }).css('overflow', 'scroll');
      categoryDropdownMenu.css('opacity', '1');
      // categoryDropdownMenu.fadeIn();
      $(this).toggleClass('active').stop();
    } else {
      return false;
    }
  });
  categoryDropdownBtn.mouseleave(function() {
    pageHeader.stop();
    pageHeader.addClass('overflow-hidden-header');
    if (!$('.dark-overlay').hasClass('dark-overlay--search')) {
      pageHeader.animate({
        height: '80px'
      }).css('overflow', 'hidden');
      categoryDropdownMenu.css('opacity', '0');
      // categoryDropdownMenu.fadeOut();
      $(this).toggleClass('active').stop();
    } else {
      return false;
    }

  });

  // Search form
  searchBtn.on('click', function(event) {
    event.preventDefault();
    if ($(this).hasClass('page-header__wrapper__right__search-btn--close')) {
      pageHeader.animate({
        height: '80px'
      });
      searchForm.animate({
        opacity: '0'
      });
    } else {
      pageHeader.animate({
        height: '160px'
      });
      searchForm.animate({
        opacity: '1'
      });
    }
    headerLeft.toggleClass('page-header__wrapper__left--search');
    $(this).toggleClass('page-header__wrapper__right__search-btn--close');
  });

  //Mobile searchBtn
  mobileSearchBtn.on('click', function() {
    $('.dark-overlay').addClass('dark-overlay--search');
    searchForm.animate({
      opacity: '1'
    });
    pageHeader.animate({
      height: '160px'
    });
    mobileNav.removeClass('mobile-nav--active');
  });

  hamburger.on('click', function() {
    // $('header').toggleClass("scrolled");
    pageHeader.toggleClass('overflow-hidden-header');
    if ($('.dark-overlay').hasClass('dark-overlay--search')) {
      $('.dark-overlay').removeClass('dark-overlay--search');
      mobileNav.removeClass('mobile-nav--active');
      $('body, html').toggleClass('overflow-hidden');
      $(this).removeClass('is-active');
      pageHeader.animate({
        height: '80px'
      });
      searchForm.animate({
        opacity: '0'
      });
      categoryDropdownMenu.css('display', 'block');
    } else {
      $(this).toggleClass('is-active');
      mobileNav.toggleClass('mobile-nav--active');
      $('body, html').toggleClass('overflow-hidden');
      $('.page-header__wrapper a').on("click", function() {
        mobileNav.removeClass('mobile-nav--active');
        hamburger.removeClass('is-active');
      });
      // categoryDropdownMenu.css('display', 'none');
    }
  });

  // Set active menu item on load
  var currentCatTrimmed = $.trim(currentCat);
  console.log(currentCatTrimmed);
  $('#category-nav > ul > li').find(':contains(' + currentCatTrimmed + ')').css('display', 'none');


  // next prev articles nav
  if ($('.slick-slide').length > 1) {
    $(document).scroll(function() {
      var y = $(this).scrollTop();
      var bottomScroll = $(document).height() - $(window).height() - $(window).scrollTop();
      if (y >= 700 && bottomScroll >= 50) {
        postNext.css('right', '50px');
        postPrev.css('left', '50px');
      } else {
        postNext.css('right', '-50px');
        postPrev.css('left', '-50px');
      }
    });
  } else {
    $(document).scroll(function() {
      var y = $(this).scrollTop();
      var bottomScroll = $(document).height() - $(window).height() - $(window).scrollTop();
      if (y >= 30 && bottomScroll >= 50) {
        postNext.css('right', '50px');
        postPrev.css('left', '50px');
      } else {
        postNext.css('right', '-50px');
        postPrev.css('left', '-50px');
      }
    });
  }

  // Back to top
  toTop.on('click', function(e) {
    e.preventDefault();
    $('html,body').animate({
      scrollTop: 0
    }, 700);
  });

  // Hide Header on on scroll down
  var didScroll;
  var lastScrollTop = 0;
  var delta = 5;
  var navbarHeight = $('.single-content__header').outerHeight();

  $(window).scroll(function(event) {
    didScroll = true;
  });
  setInterval(function() {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }
  }, 150);

  var scrollEnabled = true;

  function hasScrolled() {
    var st = $(this).scrollTop();

    // Make sure they scroll more than delta
    if (Math.abs(lastScrollTop - st) <= delta)
      return;

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight) {
      // Scroll Down
      $('.single-content__header').removeClass('nav-up').addClass('nav-down');
    } else {
      // Scroll Up
      if (st + $(window).height() < $(document).height()) {
        $('.single-content__header').removeClass('nav-down').addClass('nav-up');
      }
    }

    lastScrollTop = st;
  }

});
