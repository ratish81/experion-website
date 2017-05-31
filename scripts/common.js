/*Doucment resize Function*/
$(window).resize(function () {
  fixedFooter();
})
/*Docuemnt load function*/
$(window).load(function () {
  fixedFooter()
  $('.loader').fadeOut();  
})
/*Ready Funtion*/
$(function () {
	$(".main-linkd").find("li").click(function(){
		if($(window).width() < 1023)
		{
			if($(this).find(".plus-img").attr("showimg") == "show-img")
			{
				$(this).find(".plus-img").hide();
				$(this).find(".plus-img").removeAttr("showimg");
				$(this).find(".minus-img").show();
				$(this).find(".minus-img").attr("showimg","show-img");
				$(this).find(".sub-dropdown").show();
			}
			else if($(this).find(".minus-img").attr("showimg") == "show-img")
			{
				$(this).find(".minus-img").hide();
				$(this).find(".minus-img").removeAttr("showimg");
				$(this).find(".plus-img").show();
				$(this).find(".plus-img").attr("showimg","show-img");
				$(this).find(".sub-dropdown").hide();
			}
		}
	})
	
	$(".sub-dropdown").find("li").click(function(){
		if($(window).width() < 1023)
		{
			$(".main-linkd").hide();
			$(".menu-icon").trigger("click");
			
		}
    })	
	
	    $(".read-more").click(function(){
			if($(this).parent().find(".chanllenges-points").attr("show") == "true")
			{
				$(this).parent().find(".chanllenges-points").show();
				$(this).parent().find(".chanllenges-points").attr("show","false");
			}
			else
			{
				$(this).parent().find(".chanllenges-points").hide();
				$(this).parent().find(".chanllenges-points").attr("show","true");
			}
		})
		
		$("#middle_east").click(function(){
			$(".address-block").find("p").html("Level 14, Boulevard Plaza Tower One, <br>Emaar Boulevard, <br>Downtown,Dubai, <br>P O Box 334155, <br>Dubai, United Arab Emirates")
			
			$(".contact-block").find("p").html("Contact Person : Ratish Nair, <br>Phone no : + 971 4 455 8733, + 971 4 455 8556, <br>Email : info@experionmea.com")
			$(".region-title").find("p").html("Middle East & Africa")
		})
		
		$("#america").click(function(){
			$(".address-block").find("p").html("1000 Willowleaf Way, <br>Potomac MD 20854")
			
			$(".contact-block").find("p").html("Contact Person: Harish Chidambaran, <br>Phone no : +1 650 248 9874")
			$(".region-title").find("p").html("Americas")
		})
		
		$("#india").click(function(){
			$(".address-block").find("p").html("A8, Second Floor, <br>Stephanos Tower, <br>Cochin SEZ, Seaport Airport Road, <br>Kakkanad, Ernakulam, <br>Kerala, INDIA")
			
			$(".contact-block").find("p").html("Contact Person: Santosh Kumar, <br>+91 484 3192362, <br>+91 9820067479")
			$(".region-title").find("p").html("India")
		})
		
		$("#europe").click(function(){
			$(".address-block").find("p").html("Kopernikus str 46 b, <br>22147 Hamburg")
			
			$(".contact-block").find("p").html("Contact Person: Capt. Michael Neuhaus, <br>+49 176 8196 5644, <br>+49 40 3286 1707")
			$(".region-title").find("p").html("Europe")
		})
		
		$("#asia_pacific").click(function(){
			$(".address-block").find("p").html("143 Cecil Street#03-01 GB Building, <br>Singapore 069542")
			
			$(".contact-block").find("p").html("Contact Person: Capt. Vikas Nayar, <br>+65 62210112, <br>+65 82882224")
			$(".region-title").find("p").html("Asia Pacific")
		})



		
		
  fixedFooter()
    /*Back to top Function start*/
  $('body').append('<div class="scrollTop"><a href="javascript:void(0)"></a></div>');
//  $('body').append('<div id="empDtlError" class="overlay-box"><div class="seisson-message error"><span></span> Overlay id is not defined </div></div>');
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('.scrollTop').fadeIn();
    } else {
      $('.scrollTop').fadeOut();
    }
  });
	$(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
      $('.header').addClass('sticky');
	  $(".sub-dropdown").find("ul").css("margin-top","25px");
    } else {
      $('.header').removeClass('sticky');
	  $(".sub-dropdown").find("ul").css("margin-top","50px");
    }
  });
  $(document).on('click', '.scrollTop a', function () {
    $('body,html').animate({scrollTop: 0}, 800);
  });
  /*Back to top Function End*/
 
  /*Header footer loading*/
  /*accordion start*/
  $('.accordion dl dt').click(function () {
    var trigger = $(this);
    var target = trigger.next('dd');
    if (target.css('display') == 'none')
    {
      $('.accordion dl').removeClass('active')
      $('.accordion dl dd').slideUp();
      target.slideDown();
      trigger.parents('dl').addClass('active');
    }
    else
    {
      $('.accordion dl').removeClass('active')
      $('.accordion dl dd').slideUp();
    }
  });
  /*accordion start*/
	
	/*Slider bg*/
	$( ".bxslider li" ).each(function() {
		var attr = $(this).attr('data-image-src');
	
		if (typeof attr !== typeof undefined && attr !== false) {
				$(this).css('background-image', 'url('+attr+')');
		}
	});
	/*Slider bg end*/
	
	/*Animate label form*/
		$('.animate-label .input-group').click(function(){
		 if ($(this).find('select').size() > 0) {
        // $(this).find('label').addClass('active');
         
        // var id = $(this).find('select').attr('id');
        // console.log(id);
          
         
        }  else {
                $(this).find('input').focus();
                $(this).find('label').addClass('active');
          
        }     
        if ($(this).find('.custom-select-options,.custom-selct-bg').size() > 0) {
				$(this).find('.custom-select-options,.custom-selct-bg').fadeIn();
		}
       
	});
	$('.animate-label .input-group input,.animate-label .input-group textarea').blur(function(){
		if (this.value.length > 0) {
			return false;
		}
		else
		{
			$(this).prev('label').removeClass('active');
		}
		});
  
    $('.input-group').on('focus', 'input, select, textarea', function () {
        $(this).prev('label').addClass('active');
    });
	
  $('.input-group textarea, .input-group input,.input-group select').each(function () {
        if (this.value.length > 0) {
            var div = $(this).prev('label').addClass('active');
        }
    });
		$('.input-group').click(function(){
			$(this).find('input').focus();
			$(this).find('label').addClass('active');
    });
	/*Animate label form*/
	
	
	
});


function fixedFooter()
{
  $('body').css('min-height', $(window).height());
}


/*Overlay function*/
var animationIn, target, animationOut;
function overlayBox(popupID)
{
  target = $('#' + popupID)
  animationIn = target.attr('data-animation-in');
  animationOut = target.attr('data-animation-out');
  if (typeof (animationIn) == 'undefined' || animationIn === '(an empty string)' || animationIn === null || animationIn === '')
  {    
    animationIn = 'zoomIn';
  }
  if (typeof (animationOut) == 'undefined' || animationOut === '(an empty string)' || animationOut === null || animationOut === '')
  {
    animationOut = 'zoomOut';
  }
  $('body').append('<div class="overlay-bg"></div>')
  target.find('.overlay-header').append('<div class="closeBtn">X</div>');
  target.css('visibility', 'visible').find('.overlay-box').addClass('animated').addClass(animationIn);
  $(document).on('click', '.closeBtn', function () {
    $('.overlay').find('.overlay-box').removeClass('animated').removeClass(animationIn).addClass('animated ' + animationOut);
    $('body .overlay-bg').fadeOut(1000, function () {
      $(this).remove();
      $('.overlay').css('visibility', 'hidden').find('.overlay-box').removeClass('animated').removeClass(animationIn).removeClass(animationOut);
    });
  });
}

/*Overlay function end*/

(function() {
  "use strict";

  var toggles = document.querySelectorAll(".menu-icon");

  for (var i = toggles.length - 1; i >= 0; i--) {
    var toggle = toggles[i];
    toggleHandler(toggle);
  };

  function toggleHandler(toggle) {
    toggle.addEventListener( "click", function(e) {
      e.preventDefault();
      (this.classList.contains("active") === true) ? this.classList.remove("active") : this.classList.add("active");
			
    });
  }
	$('.mobil-icon-toggle').click(function(){
		if($(this).hasClass('active'))
		{
			$('.main-linkd').addClass('open-navigation');
		}
		else
		{
			$('.main-linkd').removeClass('open-navigation');
		}
	})
})();