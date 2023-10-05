$('.dropdown').hover(function () {
    var isHovered = $(this).is(':hover')
    if (isHovered) {
      $(this).children('.dropdown-menu').stop().slideDown(300)
    } else {
      $(this).children('.dropdown-menu').stop().slideUp(300)
    }
  })

  $('.First-Slide').owlCarousel({
    loop: false,
    margin: 10,
    nav: false,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 1
      }
    }
  })


