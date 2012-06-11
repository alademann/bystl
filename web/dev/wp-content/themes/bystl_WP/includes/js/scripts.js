function ddPanelSections() {
	
	//adds the ids of each section menu
	var i = 1;
	$('#ddpanel-menu > ul > li').each(function() {
		
		//if its the first one adds the current class
		if(i === 1) { $(this).addClass('current'); }
		
		//adds the id
		$(this).attr('id', 'ddsec_'+i);
		
		i++;
		
	});
	
	//adds the id of each section item,
	var i = 1;
	$('#ddpanel-sections > li').each(function() {
		
		if(i===1) { $(this).addClass('current'); }
		
		$(this).attr('id', 'ddsec2_'+i);
		
		i++;
		
	});
	
	//when the users clicks a section
	$('#ddpanel-menu > ul > li').click(function() {
		
		//gets the class and the id of the clicked item
		var thisClass = $(this).attr('class');
		var thisId = $(this).attr('id').split('_');
		var thisId = thisId[1];
		
		//if the item is NOT current
		if(thisClass != 'current') {
			
			//changes the button states
			$('#ddpanel-menu ul li.current').removeClass('current');
			$('#ddpanel-menu ul li#ddsec_'+thisId).addClass('current');
			
			//hides the current section
			$('#ddpanel-sections > li.current').hide().removeClass('current');
			
			//shows the clicked one
			$('#ddpanel-sections > li#ddsec2_'+thisId).show().addClass('current');
			ddPanelChangeInfo();
			
		}
		
	});
	
}

function ddPanelTabs() {
	
	//adds classes to all tabs
	$('.ddpanel-tabs').each(function() { var i = 1; $(this).children('li').each(function() {
		
		//adds the class to the tab
		$(this).addClass('ddtab_'+i);
		
		i++;
		
	}); });
	
	//adds classes to all atbbed
	$('.ddpanel-tabbed').each(function() { var i = 1; $(this).children('li').each(function() {
		
		//adds the class
		$(this).addClass('ddtabbed_'+i);
		
		i++;
		
	}); });
	
	//adds the current class to the first tab and tabbed
	$('#ddpanel-sections > li').each(function() { $(this).children('.ddpanel-tabs').children('li:first').addClass('current'); });
	$('#ddpanel-sections > li').each(function() { $(this).children('.ddpanel-tabbed').children('li:first').addClass('current'); });
	
	ddPanelChangeInfo();
	
	//when user clicks a tab
	$('#ddpanel-sections > li > ul.ddpanel-tabs > li').click(function() {
		
		//get the current clicked item
		var thisClass = $(this).attr('class').split(' ');
		
		//if its not current
		if(thisClass[1] != 'current') {
			
			var thisClass = thisClass[0].split('_');
			var thisClass = thisClass[1];
			
			//changes the current state of the tab
			$('#ddpanel-sections > li.current > ul.ddpanel-tabs > li.current').removeClass('current');
			$('#ddpanel-sections > li.current > ul.ddpanel-tabs > li.ddtab_'+thisClass).addClass('current');
			
			//changes the tabbed area
			$('#ddpanel-sections > li.current > ul.ddpanel-tabbed > li.current').removeClass('current').hide();
			$('#ddpanel-sections > li.current > ul.ddpanel-tabbed > li.ddtabbed_'+thisClass).addClass('current').show();
			
			ddPanelChangeInfo();
			
		}
		
	});
	
}

function ddPanelHelp() {
	
	$('.ddpanel-block > .help').click(function() {
		
		dontClose = 1;
		
		//main vars
		var mainClick = $(this);
		var mainCont = $(this).parent();
		var helpText = mainCont.children('.help-text').html();
			
		var thisClass = mainCont.children('.help').attr('class').split(' ');
		
		//adds the active class to it
		$(this).addClass('active');
		
		//check if theres any current help box open
		if($('.help-box').length >= 1) {
			
			//if there one opened lets close it first
			
			//lets check if the current one is already open
			if(thisClass[1] != 'active') {
			
				//if there one opened lets close it first
				$('.help-box').slideUp(250, function() {
					
					$(this).remove();
					$('.ddpanel-block > .active').removeClass('active');
					mainCont.children('.help').addClass('active');
				
					//lets create the help box right after the current block
					mainCont.after('<div class="help-box"><span>'+helpText+'</span><span class="arrow"></span></div>');
					
					//animates the box
					$('.help-box').slideDown(250, function() { dontClose = 0 });
					
				});
				
			} else {
				
				$('.help-box').slideUp(250, function() { $('.ddpanel-block > .active').removeClass('active'); $(this).remove(); });
				
			}
			
		} else {
			
			//lets create the help box right after the current block
			mainCont.after('<div class="help-box"><span>'+helpText+'</span><span class="arrow"></span></div>');
			
			//animates the box
			$('.help-box').slideDown(250, function() { dontClose = 0 });
			
		}
		
	});
	
	//erases any current help boxes when the user clicks anywhere
	$(window).click(function() {
		
		if(dontClose === 0) {
			
			$('.help-box').slideUp(200, function() { $(this).remove(); $('.ddpanel-block > .active').removeClass('active'); });
			
		}
		
	});
	
}

function ddPanelSelect() {
	
	dontCloseSelect = 0;
	
	//let's start by removing the borders and updating the current item
	$('.ddpanel-select').each(function() {
		
		//main vars
		var mainCont = $(this).parent();
		var initialItem = mainCont.children('input').val();
		
		if(initialItem == '') { var initialItem = $(this).children('ul').children('li:first').text(); }
		
		//removes the last border
		$(this).children('ul').children('li:last').css({ border: 'none' })
		
		//updates the current item
		$(this).children('.current-select').text(initialItem);
		
	});
	
	//when the users click to open the dropdown
	$('.ddpanel-select > .ddPanel-button, .ddpanel-select > .current-select').click(function() {
		
		//main vars
		var mainCont = $(this).parent().parent();
		var selCont = $(this).parent();
		var thisClass = selCont.children('.ddPanel-button').attr('class').split(' ');
		
		//if its not active
		if(thisClass[1] != 'active') {
			
			//updates the zindex of our container
			mainCont.css({ 'z-index': 80 });
			
			dontCloseSelect = 1;
			
			//adds the active class
			selCont.children('.ddPanel-button').addClass('active');
			
			//slides down our ul
			selCont.children('ul').slideDown(200, function() { dontCloseSelect = 0; });
			
		} else {
			
			//removes the active class
			selCont.children('.ddPanel-button').removeClass('active');
			
			//slides up our ul
			selCont.children('ul').slideUp(200, function() { mainCont.css({ 'z-index': 10 }); });
			
		}
		
	});
	
	//when users clicks the item
	$('.ddpanel-select > ul > li').click(function() {
		
		//main vars
		var mainCont = $(this).parent().parent().parent();
		var selCont = $(this).parent().parent();
		var ulCont = $(this).parent();
		var thisItem = $(this).text();
		
		//updates the hidden input and the current item
		mainCont.children('input').val(thisItem);
		selCont.children('.current-select').text(thisItem);
		
		ddPanelFontFramework();
		
		var tempClass = mainCont.attr('class').split(' ');
		if(tempClass[2] == 'ddpanel-font-google') { googleSelect(mainCont); }
		
	});
	
	$(document).click(function() {
		
		if(dontCloseSelect === 0) {
		
			//slides up the container
			$('.ddpanel-select > ul').each(function() {
				
				if($(this).css('display') == 'block') {
					
					$('.ddpanel-select > ul').slideUp(200, function() { $(this).parent().parent().css({ 'z-index': 10 }); });
					
				}
				
			});
			//$('.ddpanel-select > ul').slideUp(200, function() { $(this).parent().parent().css({ 'z-index': 10 }); });
			$('.ddpanel-select > .active').removeClass('active');
			
		}
		
	});
	
}

function ddPanelRibbon() {
	
	//adds the basic ribbon
	$('.ddpanel-block').each(function() {
		
		//get the id
		var thisId = $(this).attr('id');
		
		//id the cookie is set to true
		if($.cookie(thisId) == 'true') {
			
			$(this).append('<span class="ddHigh ribbon"></span>');
			
		} else {
			
			$(this).append('<span class="ddHigh flip"></span>');
			
		}
		
	});
	
	//when users click the ribbon
	$('.ddHigh').click(function() {
		
		//get its class
		var thisClass = $(this).attr('class').split(' ');
		
		if(thisClass[1] == 'ribbon') {
		
			//changes the flip into ribbon
			$(this).removeClass('ribbon').addClass('flip');
			
			//gets the id of the container
			var thisId = $(this).parent().attr('id');
			
			//sets the cookie
			$.cookie(thisId, null);
			
		} else {
		
			//changes the flip into ribbon
			$(this).removeClass('flip').addClass('ribbon');
			
			//gets the id of the container
			var thisId = $(this).parent().attr('id');
			
			//sets the cookie
			$.cookie(thisId, true, { expires: 60 });
			
		}
		
	});
	
}




$.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = $.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

function ddPanelCheckNumber(el) {
	
	var thisVal = el.val();
	
	if(isInt(thisVal)) {  } else { alert('Please use only numbers in this field.'); el.val(''); }
	
}

 function isInt(x) {
   var y=parseInt(x);
   if (isNaN(y)) return false;
   return x==y && x.toString()==y.toString();
 }
 
 function ddPanelConfirmReset() {
	 
	 dontCloseReset = 0;
	 
	 $('#ddpanel-reset').click(function() {
		 
		 dontCloseReset = 1;
		 
		 //open the reset box
		 $('#ddpanel-reset-confirm').slideDown(200, function() { dontCloseReset = 0; });
		 
		 return false;
		 
	 });
	 
	 $(document).click(function() {
		 
		if(dontCloseReset === 0) {
		
			$('#ddpanel-reset-confirm').slideUp(200);
			
		}
		 
	 });
	 
 }
 
 function ddPanelChangeInfo() {
	 
	 //get the info of the current tab.
	 var thisInfo = $('#ddpanel-sections > li.current > .ddpanel-tabbed > li.current > .tab-info');
	 
	 if(thisInfo.length > 0) {
		 
		 $('#ddpanel-content-header > span').remove();
		 $('#ddpanel-content-header').append('<span>'+thisInfo.text()+'</span>');
		 
	 } else {
		 
		 $('#ddpanel-content-header > span').remove();
		 
	 }
	 
 }
 
 function ddPanelFontFramework() {
	 
	 //main vars
	 var mainCont = $('.ddpanel-fonts');
	 var selCont = mainCont.children('div:first');
	 var cufonCont = mainCont.children('.ddpanel-font-cufon');
	 var googleCont = mainCont.children('.ddpanel-font-google');
	 var fontFamilyCont = mainCont.children('.ddpanel-font-family');
	 var customFontFamilyCont = mainCont.children('.ddpanel-font-family-custom')
	 
	 cufonCont.hide();
	 googleCont.hide();
	 fontFamilyCont.hide();
	customFontFamilyCont.hide();
	 
	 //finds the one currently selected
	 var selected = selCont.children('input').val();
	 
	 if(selected == 'Cufon') {
		 
		 //cufon selected
		 cufonCont.show();
		 
	 } else if (selected == 'Google Fonts') {
		 
		 //google selected
		 googleCont.show();
		 
	 } else if(selected == 'Font-Family') {
		 
		 fontFamilyCont.show();
		 
		 //lets check whether or nor the user has chosen custom
		 var selValue = fontFamilyCont.children('input').val();
		 if(selValue == 'Custom') { customFontFamilyCont.show(); } else { customFontFamilyCont.hide(); }
		 
	 } else { 
	 
	 	//do nothing
	 
	 }
	 
 }
 
 function googleSelect(thisCont) {
	 
	 //gets the font family of the selected item
	 var curFont = thisCont.children('input').val();
	 
	 //changes the font family of the displayed item
	 thisCont.children('div').children('.current-select').css({ 'font-family': '"'+curFont+'", Arial, sans-serif' });
	 
 }
 
 function ddPanelGoogleSelectInit() {
	 
	 var mainCont = $('.ddpanel-google-select').parent();
	 
	 //gets the font family of the selected item
	 var curFont = mainCont.children('input').val();
	 
	 //changes the font family of the displayed item
	 mainCont.children('div').children('.current-select').css({ 'font-family': '"'+curFont+'", Arial, sans-serif' });
	 
	 
 }
 
 function googleFontInput(el) {
	 
	 var fontName = el.val();
	 var goodName = fontName.split(' ').join('+');
	 
	 //updates the css and the field styling
	 $('#googleFont').attr('href', 'http://fonts.googleapis.com/css?family='+goodName);
	 el.css({ 'font-family': fontName+' ,Arial' });
	 
 }