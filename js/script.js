const scrollLogo = function() {
	$(window).scroll(function(){
	const hero = $('.hero');
	const header = $('header');

	    if ($(this).scrollTop() > hero.offset().top) { 
	        header.addClass('hidden');
	    } else if($(this).scrollTop() === hero.offset().top) {
	    	header.removeClass('hidden');
	    }
	});
}
scrollLogo();

// GSAP animation
gsap.registerPlugin(ScrollTrigger);

gsap.to(".hero-slogan", {
  scrollTrigger: ".hero",
  once: true,
  y: 0,
  opacity: 1,
}).delay(0.5);

gsap.to(".hero-scroll-downs", 1, {
  scrollTrigger: ".hero",
  once: true,
  y: 0,
  opacity: 1
}).delay(1);

gsap.to(".section__pledge h1", 1, {
  scrollTrigger: {
  	trigger: ".section__pledge",
  	scrub: true,
  	start: "top 70%"
  },
  x: 0,
  opacity: 1,
});

const sections = gsap.utils.toArray("section");
if (sections.length) {
	sections.forEach(section => {
	  gsap.to(section, {
	    scrollTrigger: {
	      trigger: section,
	      once: true,
	      start: "top 50%",
	      // markers: true,
	      onEnter: () => {
	      	$(section).find('.animate').addClass('fadeIn');
	      	setTimeout(function(){
	      		$(section).find('.animate-2').addClass('fadeIn');
	      	}, 300);
	      }
	    }
	  })
	});
}

// Resize
$(window).resize(function() {
	ScrollTrigger.refresh();
});