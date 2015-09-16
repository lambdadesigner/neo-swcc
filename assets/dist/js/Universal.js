
$('select').each(function(){
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

});


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