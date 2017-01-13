/**
 *  santamarca 1.0.0
 *
 *  Dependencies
 *  - jQuery
 *
 */

(function(a){function d(b){var c=b||window.event,d=[].slice.call(arguments,1),e=0,f=!0,g=0,h=0;return b=a.event.fix(c),b.type="mousewheel",c.wheelDelta&&(e=c.wheelDelta/120),c.detail&&(e=-c.detail/3),h=e,c.axis!==undefined&&c.axis===c.HORIZONTAL_AXIS&&(h=0,g=-1*e),c.wheelDeltaY!==undefined&&(h=c.wheelDeltaY/120),c.wheelDeltaX!==undefined&&(g=-1*c.wheelDeltaX/120),d.unshift(b,e,g,h),(a.event.dispatch||a.event.handle).apply(this,d)}var b=["DOMMouseScroll","mousewheel"];if(a.event.fixHooks)for(var c=b.length;c;)a.event.fixHooks[b[--c]]=a.event.mouseHooks;a.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=b.length;a;)this.addEventListener(b[--a],d,!1);else this.onmousewheel=d},teardown:function(){if(this.removeEventListener)for(var a=b.length;a;)this.removeEventListener(b[--a],d,!1);else this.onmousewheel=null}},a.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})})(jQuery);


(function($) {
  
  var santamarca = {
    
    init: function() {

      santamarca.homeInit();
      // Force double loading in case images are stored in cache
      $(window).load(function(){
        santamarca.homeInit();
      });
      
      santamarca.curriculumResize();
      $(window).resize(function(){
        santamarca.curriculumResize();
      });
      
      santamarca.lightboxInit();

      santamarca.navInit();

      santamarca.servicesInit();

      santamarca.contactFormInit();

    },
    
    curriculumResize: function() {
      
      var sectionHeight = $('#curriculum').height();
      var newWidth = parseInt( (sectionHeight * $('#curriculum-image').attr('data-width')) / $('#curriculum-image').attr('data-height'), 10);
      $('#curriculum-image').width(newWidth);
      
    },

    navInit: function() {

      santamarca.navResize();
      $(window).resize(function(){
        santamarca.navResize();
      });

      santamarca.getSectionsLeft();
      $(window).load(function(){
        santamarca.getSectionsLeft();
      });
      $(window).resize(function(){
        santamarca.getSectionsLeft();
      });

      $('#nav-placer, #nav-services, #nav-steps').click(function(e){
        e.preventDefault();
        
        if ($('.horizontalContent').scrollLeft() > 0) {
          
          var thisElement = this;
          
          $('.horizontalContent').stop().animate({
            scrollLeft: 10
          }, 200, function() {
            window.setTimeout(function(){
              santamarca.navSpecialClick(thisElement);
            }, 100);
          });
        } else {
          santamarca.navSpecialClick(this);
        }

      });

      $('header a').not('#nav-placer, #nav-services, #nav-steps').click(function(e){
        e.preventDefault();

        santamarca.scrollToSection($(this).attr('href'));
      })
    },

    navResize: function() {
      
      if ($('#contact-info').height() > 26)
      {
        $('#contact-info').addClass('fixed');
      }
      
    },
    
    navSpecialClick: function(element) {
      
      if ($('.home-float:visible')) {
        $('.home-float').fadeOut(200);
      }

      var section = $(element).attr('id').split('-')[1];

      $('header li').removeClass('current');
      $(element).parent().addClass('current');

      $('#home-' + section).stop().fadeIn(200);

      $('.background, .separator').unbind('click');
      $('.background, .separator').click(function(e){
        e.preventDefault();
        $('.home-float').stop().fadeOut(200);
      });
      
    },

    homeInit: function() {

      // Init background
      var backgroundImage = $('#home .background img');
      santamarca.backgroundHome.height = backgroundImage.height();
      santamarca.backgroundHome.width = backgroundImage.width();
      santamarca.backgroundResize(backgroundImage);
      santamarca.heroPlace();

      santamarca.sectionsWrapperResize();

      $(window).resize(function() {
        santamarca.backgroundResize(backgroundImage);
        santamarca.heroPlace();
        santamarca.sectionsWrapperResize();
      });

      $(".horizontalContent").mousewheel(function(event, delta) {
        event.preventDefault();

        this.scrollLeft -= (delta * 40);
      });

      $('.horizontalContent').scroll(function(){

        $('.home-float').stop().fadeOut(100);

        for (i = 0; i < santamarca.sectionsArray.length; i++)
        {
          if (this.scrollLeft >= santamarca.sectionsLeft[santamarca.sectionsArray[i]] - 800)
          {
            if (!$('#nav-' + santamarca.sectionsArray[i]).parent().hasClass('current')) {
              $('header li').removeClass('current');
              $('#nav-' + santamarca.sectionsArray[i]).parent().addClass('current');
            }
          }
        }

        homeLeft = ($('#home').width() - santamarca.calculateParallax($('#home').width(), 4, this.scrollLeft));
        $('#home').css({'left': homeLeft});

      });

    },

    backgroundHome: {
      height: 0,
      width: 0,
      ratio: 1
    },

    backgroundResize: function(backgroundImage) {
      var b = backgroundImage.parent().width() / santamarca.backgroundHome.width;
      var c = Math.round(santamarca.backgroundHome.height * b);
      var d = backgroundImage.parent().height() / santamarca.backgroundHome.height;
      var e = Math.round(santamarca.backgroundHome.width * d);
      if (e > backgroundImage.parent().width()) {
          santamarca.backgroundHome.ratio = d;
          backgroundImage.width(e);
          backgroundImage.height(backgroundImage.parent().height());
          backgroundImage.css('left', Math.round((e - backgroundImage.parent().width()) / 2) * -1);
          backgroundImage.css('top', 0)
      } else {
          santamarca.backgroundHome.ratio = b;
          backgroundImage.height(c);
          backgroundImage.width(backgroundImage.parent().width());
          backgroundImage.css('left', 0);
          backgroundImage.css('top', Math.round((c - backgroundImage.parent().height()) / 2) * -1)
      }
    },

    sectionsWrapperResize: function() {
      
      $('#placer').width($(window).width());
      
      santamarca.curriculumResize();
      
      var sum = 0;
      $('.section').each( function(){ sum += $(this).outerWidth(true); });
      $('#sections-wrapper').width(sum);
    },

    heroPlace: function() {

      $('#hero').css('margin-bottom', -1 * ($('#hero img').height() / 2));
    },

    servicesInit: function() {

      $('#services-chart li').mouseover(function(){
        var id = $(this).attr('id').split('-')[1];

        $('#services-chart li').removeClass('current');
        $(this).addClass('current');

        $('#services-text li').hide();
        $('#services-text-' + id).show();
      });
    },

    sectionsLeft: {},
    sectionsArray: [],

    getSectionsLeft: function() {
      santamarca.sectionsArray = [];
      for (var key in santamarca.sectionsLeft) {
        santamarca.sectionsArray.push(key);
      }
      console.log(santamarca.sectionsArray);
      for (var i = 0; i < $('.section').length; i++) {
        santamarca.sectionsLeft[$('.section').eq(i).attr('id')] = $('.section').eq(i).position().left + $('.horizontalContent').scrollLeft();
      };
      
    },

    scrollToSection: function(section) {
      
      if (section == '#experience'){
        $('.horizontalContent').animate({scrollLeft: santamarca.sectionsLeft[section.split('#')[1]] + 122}, 200);
      } else {
        $('.horizontalContent').animate({scrollLeft: santamarca.sectionsLeft[section.split('#')[1]] - 40}, 200);
      }

    },

    calculateParallax: function (tileheight, speedratio, scrollposition) {

      return ((tileheight) - (Math.floor(scrollposition / speedratio) % (tileheight+1)));

    },

    lightboxInit: function() {

      // Projects
      $('#projects .clickable').click(function(e){
        e.preventDefault();

        santamarca.lightboxShow($(this).parent());
      });

      // Project's lightbox
      $('#lightbox').click(function(e){
        santamarca.lightboxHide();
      }).children().click(function(e){
        e.stopPropagation();
      });

      $('#lightbox-prev').click(function(e){
        e.preventDefault();

        if (santamarca.lightboxData.current == 0) {
          santamarca.lightboxData.current = santamarca.lightboxData.images.length - 1;
        } else {
          santamarca.lightboxData.current--;
        }

        $('#lightbox-image img').remove();

        var newImage = '<img src="/content/projects/' + santamarca.lightboxData.images[santamarca.lightboxData.current] + '.jpg" />';
        $('#lightbox-image').append(newImage);
      });

      $('#lightbox-next').click(function(e){
        e.preventDefault();

        if (santamarca.lightboxData.current == santamarca.lightboxData.images.length - 1) {
          santamarca.lightboxData.current = 0;
        } else {
          santamarca.lightboxData.current++;
        }

        $('#lightbox-image img').remove();

        var newImage = '<img src="/content/projects/' + santamarca.lightboxData.images[santamarca.lightboxData.current] + '.jpg" />';
        $('#lightbox-image').append(newImage);
      });
    },

    lightboxData: {
      current: 0,
      images: null
    },

    lightboxShow: function(project) {
      santamarca.lightboxData.current = 0;
      santamarca.lightboxData.images = project.attr('data-images').split(',');

      var newImage = '<img src="/content/projects/' + santamarca.lightboxData.images[0] + '.jpg" />';

      $('#lightbox-image').append(newImage);
      $('#lightbox h5').html(project.find('h5').html());
      $('#lightbox p').html(project.find('p').attr('data-full'));

      $('#lightbox').fadeIn(200);
    },

    lightboxHide: function() {
      $('#lightbox').fadeOut(200);

      $('#lightbox-image img').remove();

      santamarca.lightboxData.images = null;
    },

    contactFormInit: function() {
      
      $('#contact-form').submit(function(e){
        e.preventDefault();

        $.ajax({
          type: 'POST',
          url: '/ajax/contacto/',
          data: $('#contact-form').serialize()
        }).done(function(data){
          alert('¡Se ha enviado tu mensaje!');
        }).error(function(data){
          if (data.status == 400) {
            alert('Faltaron datos por llenar.');
          } else if (data.status == 500) {
            alert('Hubo un error, por favor inténtalo más tarde.');
          } else {
            alert('Error desconocido.');
          }
        });
      });

    }

  };

    window.santamarca = santamarca;

    $(document).ready(function() {

      santamarca.init();

    });

})(jQuery);
