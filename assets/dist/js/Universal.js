
/*$('select').each(function(){
	var $this = $(this), numberOfOptions = $(this).children('option').length;
  
	$this.addClass('select-hidden'); 
	$this.wrap('<div class="select"></div>');
	$this.after('<div class="select-styled"></div>');

	var $styledSelect = $this.next('div.select-styled');
	$styledSelect.text($this.children('option').eq(0).text());
  
	var $list = $('<ul />', {
		'class': 'select-options'
	}).insertAfter($styledSelect);
  
	for (var i = 0; i < numberOfOptions; i++) {
		$('<li />', {
			text: $this.children('option').eq(i).text(),
			rel: $this.children('option').eq(i).val()
		}).appendTo($list);
	}
  
	var $listItems = $list.children('li');
  
	$styledSelect.click(function(e) {
		e.stopPropagation();
		$('div.select-styled.active').each(function(){
			$(this).removeClass('active').next('ul.select-options').hide();
		});
		$(this).toggleClass('active').next('ul.select-options').toggle();
	});
  
	$listItems.click(function(e) {
		e.stopPropagation();
		$styledSelect.text($(this).text()).removeClass('active');
		$this.val($(this).attr('rel'));
		$list.hide();
		//console.log($this.val());
	});
  
	$(document).click(function() {
		$styledSelect.removeClass('active');
		$list.hide();
	});

});*/


// // SlimScroll
// $(document).ready(function(){
//   $(".slimScroll").slimScroll({
//     width:"800px",
//     height:"400px",
//     alwaysVisible:true,
//     railVisible:true,
//     wheelStep:10
//   });
// });
//   $('body').slimScroll({
//     width:"100vw",
//     height:"100vh",
//     alwaysVisible:true,
//     railVisible:true,
//     wheelStep:10
//   });

$(window).load(function() {
  $('.slimScroll')
    .slimscroll({ height: '420px' })
    // .text(text);

  $('.inputpickertext').on('focus click',function(){
		// alert('dasd')
		$('.datepicker').addClass('inputpicker');
	})
});


// Check Box
// All this jquery is just used for presentation. Not required at all for the radio buttons to work.
$( document ).ready(function(){
//   Hide the border by commenting out the variable below
    var $on = 'section';
    $($on).css({
      'background':'none',
      'border':'none',
      'box-shadow':'none'
    });
}); 



// Search in  Data Tables
$(document).ready(function(){
	$('.dataTables_wrapper input').attr("placeholder", "Type here to search");
})

// Passing Url 
function addParameter(url, param, value) 
{
    var val = new RegExp('(\\?|\\&)' + param + '=.*?(?=(&|$))'),
        parts = url.toString().split('#'),
        url = parts[0],
        hash = parts[1]
        qstring = /\?.+$/,
        newURL = url;
    // Check if the parameter exists
    if (val.test(url))
    {
        // if it does, replace it, using the captured group
        // to determine & or ? at the beginning
        newURL = url.replace(val, '$1' + param + '=' + value);
    }
    else if (qstring.test(url))
    {
        // otherwise, if there is a query string at all
        // add the param to the end of it
        newURL = url + '&' + param + '=' + value;
    }
    else
    {
        // if there's no query string, add one
        newURL = url + '?' + param + '=' + value;
    }
    if (hash)
    {
        newURL += '#' + hash;
    }
    return newURL;
}

function loadUrl()
{
	var range = $("#languag").val();
	var url1 = top.location.href;
	var param1 = "lang";
	var value1 = range;
	var stripped_url1 = addParameter(url1,param1,value1);
		top.location.href = stripped_url1;
}
