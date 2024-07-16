(function($) {
  "use strict";
  /* =================================
  ===       slider        ====
  =================================== */

  function homemain() {
  var homemain = new Swiper('.homemain', {
    direction: 'horizontal',
    loop: true,
    autoplay: true,
    autoplay: {
    delay: 3000,
    },
    speed:500,
    slidesPerView: 1,
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
  // // Pagination Bullets
  // pagination: {
  // el: ".swiper-pagination",
  // },

  });              
}
homemain();

  function homefeatured() {
  var recentareaSlider = new Swiper('.recentarea-slider', {
    direction: 'vertical',
    loop: true,
    slidesPerView: 4,
    spaceBetween: 30,
    autoplay: true,
    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
    },
    breakpoints: {
    // when window width is <= 320px
        768: {
          allowTouchMove: 0,
        },
      }
    });
  }
  homefeatured();

  /* =================================
  ===       Crousel        ====
  =================================== */
  function postcrousel() {
    const postcrousel = new Swiper('.postcrousel', {
      direction: 'horizontal',
      loop: true,
      autoplay:{
        delay: 3000,
    },
      slidesPerView: 1,
      // Navigation arrows
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      pagination: {
        el: ".crousel-swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 4,
          spaceBetween: 30,
        },
      }
    });              
  }
  postcrousel();

  var scrollToTopBtn = document.querySelector(".bs_upscr");
  var rootElement = document.documentElement;
  
  function handleScroll() {
    // Do something on scroll
    var scrollTotal = rootElement.scrollHeight - rootElement.clientHeight;
    if (rootElement.scrollTop / scrollTotal > 0.05) {
      // Show button
      scrollToTopBtn.classList.add("showBtn");
    } else {
      // Hide button
      scrollToTopBtn.classList.remove("showBtn");
    }
  }
  
  function scrollToTop() {
    // Scroll to top logic
    rootElement.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }
  scrollToTopBtn.addEventListener("click", scrollToTop);
  document.addEventListener("scroll", handleScroll);
  

  /* =================================
  ===         STICKY HEADER       ====
  =================================== */
  $('.sticky-header').sticky({ topSpacing: 0 });

  /* =================================
  ===         WIDGETS SLIDERS       ====
  =================================== */

  // colmnthree crousel
  $('.design-slider-widget').each(function(index) {
  
    $(this).find('.colmnthree').addClass('colmnthree-'+index);
    const sld_dure = $(this).find('.sld-dure').val(); 
    function colmnthree() { 
      const colmnthree = new Swiper('.colmnthree-'+index, {
        direction: 'horizontal',
        slidesPerView: 1,
        loop: true,
        autoplay: {
          delay: sld_dure,
        }, 
        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
        }, 
        speed:500,
        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        }, 
        // And if we need scrollbar
        scrollbar: {
          el: '.swiper-scrollbar',
        },
        breakpoints: {
          640: {
            slidesPerView: 1,
            spaceBetween: 0,
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 30,
          },
        }
      });  
    }
    colmnthree();
  });

  // end colmnthree crousel

  // post slider crousel
  $('.slider-post-widget').each(function(index) {
  
    $(this).find('.wigethomemain').addClass('wigethomemain-'+index);
    const sld_dure = $(this).find('.sld-dure').val(); 
    function wigetHomemain() { 
      const wigetHomemain = new Swiper('.wigethomemain-'+index, {
        direction: 'horizontal',
        slidesPerView: 1,
        loop: true,
        autoplay: {
          delay: sld_dure,
        }, 
        speed:500,
        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
        }, 
        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        }, 
        // And if we need scrollbar
        scrollbar: {
          el: '.swiper-scrollbar',
        },
      });
    }
    wigetHomemain();
    
  });
  // end post slider crousel
  // featured_cat_slider crousel
  $('.bs-slider-widget').each(function(index) {
  
    $(this).find('.featured_cat_slider').addClass('featured_cat_slider-'+index);
    const sld_dure = $(this).find('.sld-dure').val(); 
    const sldSlide = $(this).find('.sld-slide').val(); 
    function featuredCatSlider() { 
      const featuredCatSlider = new Swiper('.featured_cat_slider-'+index, {
        direction: 'horizontal',
        slidesPerView: 1,
        loop: true,
        autoplay: {
          delay: sld_dure,
        }, 
        speed:500,
        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
        }, 
        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        }, 
        // And if we need scrollbar
        scrollbar: {
          el: '.swiper-scrollbar',
        },
        breakpoints: {
          640: {
            slidesPerView: 1,
            spaceBetween: 0,
          },
          768: {
            slidesPerView: 1,
            spaceBetween: 20,
          },
          1024: {
            slidesPerView: sldSlide,
            spaceBetween: 30,
          },
        }
      }); 
    }
    featuredCatSlider();
  }); 
  // end no_gutter crousel
  /* =================================
  ===         NEWS TICKER SLIDER       ====
  =================================== */
  function newsticker() {
    var swiper = new Swiper(".mg-latest-news-slider", {
      direction: "vertical",
      slidesPerView: 1,
        loop: true,
        autoplay: {
          delay: 3000,
        }, 
        speed:1000,
    });
  
    $('.mg-latest-news-slider').hover(function() {
      swiper.autoplay.stop();
    }, function() {
      swiper.autoplay.start();
    });
  }
  newsticker();
  /* =================================
  ===         Sidebar Sticky     ====
  =================================== */
  // Sticksy.initializeAll('.bs-sticky', {topSpacing: 0}, { listen: true });
  
  var elements = document.getElementsByClassName('bs-sticky');

  for (var i = 0; i < elements.length; i++) {
    new hcSticky(elements[i], {
      stickTo: elements[i].parentNode,
      top: 0,
      bottomEnd: 0,
    });
  }

})(jQuery);

document.addEventListener('keydown', (event) => {
  if (event.key === 'Tab') {
    var focusedElement = document.activeElement;
    var parentElement = document.getElementById('navbar-wp');
    var ulParent = parentElement.querySelector("ul.navbar-nav");
    var lastChild = ulParent.lastElementChild.firstElementChild;

    // Check if the focused element is the last child
    if (focusedElement === lastChild) {
      // Prevent the default tab behavior
      event.preventDefault();

      // Perform your actions here
      const returnFocus = document.querySelector('button#nav-btn');
      returnFocus.click();
      returnFocus.focus();
    }
  }
});