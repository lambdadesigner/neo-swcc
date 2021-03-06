<?php 
//session_start();
include('includes/header.php');
//print_r($_SESSION);
if(@$_SESSION['StudentID']=='' && @$_SESSION['EmpID'] ==''){	
	 header("Location: index");
}	
$studentId = $_SESSION['StudentID'];
?>			

			<link rel="stylesheet" href="assets/dist/css/barchartstyle.css" />
			<div class="content-wrapper" style="min-height:100%">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						<?php echo $lang["dashboard"];?>
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-md-6">
						  <!-- Attendance Calendar/Chart Starts-->
							<div class="attendance-chart">
							  <div class="box box-danger">
								<?php ?><div class="box-header with-border">
								  <h3 class="box-title">Monthly Recap Report</h3>
								  <div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<div class="btn-group">
									  <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
									  <ul class="dropdown-menu" role="menu">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another action</a></li>
										<li><a href="#">Something else here</a></li>
										<li class="divider"></li>
										<li><a href="#">Separated link</a></li>
									  </ul>
									</div>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								  </div>
								</div><!-- /.box-header -->
								<div class="box-body">
								  <div class="row">
									<div class="col-md-12">
									  <p class="text-center">
										<strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
									  </p>
									  <div class="chart">
										<!-- Sales Chart Canvas -->
										<canvas id="salesChart" height="180"></canvas>
									  </div><!-- /.chart-responsive -->
									</div><!-- /.col -->
								  </div><!-- /.row -->
								</div><!-- ./box-body -->
								<div class="box-footer">
								  <div class="row">
									<div class="col-sm-3 col-xs-6">
									  <div class="description-block border-right">
										<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
										<h5 class="description-header">58.5%</h5>
										<span class="description-text">TOTAL ATTENDANCE</span>
									  </div><!-- /.description-block -->
									</div><!-- /.col -->
									<div class="col-sm-3 col-xs-6">
									  <div class="description-block border-right">
										<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
										<h5 class="description-header">75%</h5>
										<span class="description-text">REQUIRED ATTENDENCE</span>
									  </div><!-- /.description-block -->
									</div><!-- /.col -->
									<div class="col-sm-3 col-xs-6">
									  <div class="description-block border-right">
										<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
										<h5 class="description-header">$10%</h5>
										<span class="description-text">ABSENTIES</span>
									  </div><!-- /.description-block -->
									</div><!-- /.col -->
									<div class="col-sm-3 col-xs-6">
									  <div class="description-block">
										<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
										<h5 class="description-header">16.5%</h5>
										<span class="description-text">REQUIRED</span>
									  </div><!-- /.description-block -->
									</div>
								  </div><!-- /.row -->
								</div><!-- /.box-footer --><?php ?>

			<!-- Calendar Starts -->
				<!-- <link rel='stylesheet prefetch' href='assets/bootstrap/css/bootstrap.min.css'> -->
				<link rel='stylesheet prefetch' href='assets/bootstrap/css/bootstrap-theme.min.css'>
				<link rel="stylesheet" type="text/css" href="assets/dist/css/calendar.css">

					<div class="box-header with-border">
					  <h3 class="box-title">Monthly Attendance Report </h3><i class="fa fa-calendar text-red pull-right"></i> 
					  <!-- <div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<div class="btn-group">
						  <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
						  <ul class="dropdown-menu" role="menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						  </ul>
						</div>
						<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					  </div> -->
					</div><!-- /.box-header -->

					<div class="box-body">
					  <div class="row">
						<div class="col-md-12">
						  <p class="text-center">							
						  </p>
						  <div class="chart">
							<div id="holder" class="row" ></div>							
						  </div>
						  <p class="text-center">							
						  </p>
						</div>
					  </div>
					</div>

					
				<script type="text/tmpl" id="tmpl">
				  {{ 
				  var date = date || new Date(),
				      month = date.getMonth(), 
				      year = date.getFullYear(), 
				      first = new Date(year, month, 1), 
				      last = new Date(year, month + 1, 0),
				      startingDay = first.getDay(), 
				      thedate = new Date(year, month, 1 - startingDay),
				      dayclass = lastmonthcss,
				      today = new Date(),
				      i, j; 
				  if (mode === 'week') {
				    thedate = new Date(date);
				    thedate.setDate(date.getDate() - date.getDay());
				    first = new Date(thedate);
				    last = new Date(thedate);
				    last.setDate(last.getDate()+6);
				  } else if (mode === 'day') {
				    thedate = new Date(date);
				    first = new Date(thedate);
				    last = new Date(thedate);
				    last.setDate(thedate.getDate() + 1);
				  }
				  
				  }}
				  <table class="calendar-table table table-condensed table-tight">
				    <thead>
				      <div>
				      <tr>
				        <td colspan="7" style="text-align: center">
				          <table style="white-space: nowrap; width: 100%">
				            <tr>
				              <td>
				                <span class="btn-group btn-group-lg">
				                  {{ if (mode !== 'day') { }}
				                    {{ if (mode === 'month') { }}<button class="js-cal-option btn btn-link" data-mode="year">{{: months[month] }}</button>{{ } }}
				                    {{ if (mode ==='week') { }}
				                      <button class="btn btn-link disabled">{{: shortMonths[first.getMonth()] }} {{: first.getDate() }} - {{: shortMonths[last.getMonth()] }} {{: last.getDate() }}</button>
				                    {{ } }}
				                    <button class="js-cal-years btn btn-link">{{: year}}</button> 
				                  {{ } else { }}
				                    <button class="btn btn-link disabled">{{: date.toDateString() }}</button> 
				                  {{ } }}
				                </span>
				              </td>
				              <td style="text-align: right;">
				                <span class="btn-group">
				                  <button style="background-color: #E06D5F; color:white" class="js-cal-prev btn ">&lt;</button><!--btn-success-->
				                 
				                </span>
				                <button style="background-color: #E06D5F; color:white" class="js-cal-option btn {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }}" data-date="{{: today.toISOString()}}" data-mode="month">{{: todayname }}</button>
				                <button style="background-color: #E06D5F; color:white" class="js-cal-next btn">&gt;</button>
				              </td>
				              <!--<td style="text-align: right">
				                <span class="btn-group">
				                  <button class="js-cal-option btn btn-default {{: mode==='year'? 'active':'' }}" data-mode="year">Year</button>
				                  <button class="js-cal-option btn btn-default {{: mode==='month'? 'active':'' }}" data-mode="month">Month</button>
				                  <button class="js-cal-option btn btn-default {{: mode==='week'? 'active':'' }}" data-mode="week">Week</button>
				                </span>
				              </td>-->
				            </tr>
				          </table>
				          
				        </td>
				      </tr>
				    </thead>
				    {{ if (mode ==='year') {
				      month = 0;
				    }}
				    <tbody>
				      {{ for (j = 0; j < 3; j++) { }}
				      <tr>
				        {{ for (i = 0; i < 4; i++) { }}
				        <td style="padding:0px;" class="calendar-month month-{{:month}} js-cal-option" data-date="{{: new Date(year, month, 1).toISOString() }}" data-mode="month">
				          {{: months[month] }}
				          {{ month++;}}
				        </td>
				        {{ } }}
				      </tr>
				      {{ } }}
				    </tbody>
				    {{ } }}
				    {{ if (mode ==='month' || mode ==='week') { }}
				    <thead>
				    <div class="oppo">
				      <tr class="c-weeks">
				        {{ for (i = 0; i < 7; i++) { }}
				          <th class="c-name">
				            {{: days[i] }}
				          </th>
				        {{ } }}
				      </tr>
				      </div>
				    </thead>
				    <tbody>
				      {{ for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
				      <tr>
				        {{ for (i = 0; i < 7; i++) { }}
				        {{ if (thedate > last) { dayclass = nextmonthcss; } else if (thedate >= first) { dayclass = thismonthcss; } }}
				        <td class="calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: date.toDateCssClass() === thedate.toDateCssClass() ? 'selected':'' }} {{: daycss[i] }} js-cal-option" data-date="{{: thedate.toISOString() }}">
				          <div class="date">{{: thedate.getDate() }}</div>				          
				          {{ thedate.setDate(thedate.getDate() + 1);}}
				        </td>
				        {{ } }}
				      </tr>
				      {{ } }}
				    </tbody>
				    {{ } }}
				    {{ if (mode ==='day') { }}
				    <tbody>
				      <tr>
				        <td colspan="7">
				          <table class="table table-striped table-condensed table-tight-vert" >
				            <thead>
				              <tr>
				                <th>&nbsp;</th>
				                <th style="text-align: center; width: 100%">{{: days[date.getDay()] }}</th>
				              </tr>
				            </thead>
				            <tbody>
				              <tr>
				                <th class="timetitle" >All Day</th>
				                <td class="{{: date.toDateCssClass() }}">  </td>
				              </tr>
				              <tr>
				                <th class="timetitle" >Before 6 AM</th>
				                <td class="time-0-0"> </td>
				              </tr>
				              {{for (i = 6; i < 22; i++) { }}
				              <tr>
				                <th class="timetitle" >{{: i <= 12 ? i : i - 12 }} {{: i < 12 ? "AM" : "PM"}}</th>
				                <td class="time-{{: i}}-0"> </td>
				              </tr>
				              <tr>
				                <th class="timetitle" >{{: i <= 12 ? i : i - 12 }}:30 {{: i < 12 ? "AM" : "PM"}}</th>
				                <td class="time-{{: i}}-30"> </td>
				              </tr>
				              {{ } }}
				              <tr>
				                <th class="timetitle" >After 10 PM</th>
				                <td class="time-22-0"> </td>
				              </tr>
				            </tbody>
				          </table>
				        </td>
				      </tr>
				    </tbody>
				    {{ } }}
				  </table>
				</script>
				<script src='http://assets.codepen.io/assets/common/stopExecutionOnTimeout.js?t=1'></script>
				<script src='http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
				<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
				<script>
				/*var $currentPopover = null;
				  $(document).on('shown.bs.popover', function (ev) {
				    var $target = $(ev.target);
				    if ($currentPopover && ($currentPopover.get(0) != $target.get(0))) {
				      $currentPopover.popover('toggle');
				    }
				    $currentPopover = $target;
				  }).on('hidden.bs.popover', function (ev) {
				    var $target = $(ev.target);
				    if ($currentPopover && ($currentPopover.get(0) == $target.get(0))) {
				      $currentPopover = null;
				    }
				  });*/


				//quicktmpl is a simple template language I threw together a while ago; it is not remotely secure to xss and probably has plenty of bugs that I haven't considered, but it basically works
				//the design is a function I read in a blog post by John Resig (http://ejohn.org/blog/javascript-micro-templating/) and it is intended to be loosely translateable to a more comprehensive template language like mustache easily
				$.extend({
				    quicktmpl: function (template) {return new Function("obj","var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('"+template.replace(/[\r\t\n]/g," ").split("{{").join("\t").replace(/((^|\}\})[^\t]*)'/g,"$1\r").replace(/\t:(.*?)\}\}/g,"',$1,'").split("\t").join("');").split("}}").join("p.push('").split("\r").join("\\'")+"');}return p.join('');")}
				});

				$.extend(Date.prototype, {
				  //provides a string that is _year_month_day, intended to be widely usable as a css class
				  toDateCssClass:  function () { 
				    return '_' + this.getFullYear() + '_' + (this.getMonth() + 1) + '_' + this.getDate(); 
				  },
				  //this generates a number useful for comparing two dates; 
				  toDateInt: function () { 
				    return ((this.getFullYear()*12) + this.getMonth())*32 + this.getDate(); 
				  },
				  toTimeString: function() {
				    var hours = this.getHours(),
				        minutes = this.getMinutes(),
				        hour = (hours > 12) ? (hours - 12) : hours,
				        ampm = (hours >= 12) ? ' pm' : ' am';
				    if (hours === 0 && minutes===0) { return ''; }
				    if (minutes > 0) {
				      return hour + ':' + minutes + ampm;
				    }
				    return hour + ampm;
				  }
				});


				(function ($) {

				  //t here is a function which gets passed an options object and returns a string of html. I am using quicktmpl to create it based on the template located over in the html block
				  var t = $.quicktmpl($('#tmpl').get(0).innerHTML);
				  
				  function calendar($el, options) {
				    //actions aren't currently in the template, but could be added easily...
				    $el.on('click', '.js-cal-prev', function () {
				      switch(options.mode) {
				      case 'year': options.date.setFullYear(options.date.getFullYear() - 1); break;
				      case 'month': options.date.setMonth(options.date.getMonth() - 1); break;
				      case 'week': options.date.setDate(options.date.getDate() - 7); break;
				      case 'day':  options.date.setDate(options.date.getDate() - 1); break;
				      }
				      draw();
				    }).on('click', '.js-cal-next', function () {
				      switch(options.mode) {
				      case 'year': options.date.setFullYear(options.date.getFullYear() + 1); break;
				      case 'month': options.date.setMonth(options.date.getMonth() + 1); break;
				      case 'week': options.date.setDate(options.date.getDate() + 7); break;
				      case 'day':  options.date.setDate(options.date.getDate() + 1); break;
				      }
				      draw();
				    }).on('click', '.js-cal-option', function () {
				      var $t = $(this), o = $t.data();
				      if (o.date) { o.date = new Date(o.date); }
				      $.extend(options, o);
				      draw();
				    }).on('click', '.js-cal-years', function () {
				      var $t = $(this), 
				          haspop = $t.data('popover'),
				          s = '', 
				          y = options.date.getFullYear() - 2, 
				          l = y + 5;
				      if (haspop) { return true; }
				      for (; y < l; y++) {
				        s += '<button type="button" class="btn btn-default btn-lg btn-block js-cal-option" data-date="' + (new Date(y, 1, 1)).toISOString() + '" data-mode="year">'+y + '</button>';
				      }
				      $t.popover({content: s, html: true, placement: 'auto top'}).popover('toggle');
				      return false;
				    }).on('click', '.event', function () {
				      /*var $t = $(this), 
				          index = +($t.attr('data-index')), 
				          haspop = $t.data('popover'),
				          data, time;
				          
				      if (haspop || isNaN(index)) { return true; }
				      data = options.data[index];
				      time = data.start.toTimeString();
				      if (time && data.end) { time = time + ' - ' + data.end.toTimeString(); }
				      $t.data('popover',true);
				      $t.popover({content: '<p><strong>' + time + '</strong></p>'+data.text, html: true, placement: 'auto left'}).popover('toggle');
				      return false;*/
				    });
				    function dayAddEvent(index, event) {
				      if (!!event.allDay) {
				        monthAddEvent(index, event);
				        return;
				      }
				      var $event = $('<div/>', {'class': 'event', text: event.title, title: event.title, 'data-index': index}),
				          start = event.start,
				          end = event.end || start,
				          time = event.start.toTimeString(),
				          hour = start.getHours(),
				          timeclass = '.time-22-0',
				          startint = start.toDateInt(),
				          dateint = options.date.toDateInt(),
				          endint = end.toDateInt();
				      if (startint > dateint || endint < dateint) { return; }
				      
				      if (!!time) {
				        $event.html('<strong>' + time + '</strong> ' + $event.html());
				      }
				      $event.toggleClass('begin', startint === dateint);
				      $event.toggleClass('end', endint === dateint);
				      if (hour < 6) {
				        timeclass = '.time-0-0';
				      }
				      if (hour < 22) {
				        timeclass = '.time-' + hour + '-' + (start.getMinutes() < 30 ? '0' : '30');
				      }
				      $(timeclass).append($event);
				    }
				    
				    function monthAddEvent(index, event) {
				      var $event = $('<div/>', {'class': 'event', text: event.title, title: event.title, 'data-index': index}),
				          e = new Date(event.start),
				          dateclass = e.toDateCssClass(),
				          day = $('.' + e.toDateCssClass()),
				          empty = $('<div/>', {'class':'clear event', html:'&nbsp;'}), 
				          numbevents = 0, 
				          time = event.start.toTimeString(),
				          endday = event.end && $('.' + event.end.toDateCssClass()).length > 0,
				          checkanyway = new Date(e.getFullYear(), e.getMonth(), e.getDate()+40),
				          existing,
				          i;
				      $event.toggleClass('all-day', !!event.allDay);
				      if (!!time) {
				        $event.html('<strong>' + time + '</strong> ' + $event.html());
				      }
				      if (!event.end) {
				        $event.addClass('begin end');				        
				        $('.' + event.start.toDateCssClass()).append($event);
				        $('.begin').parent('td').find('.date').addClass('absent');
				        return;
				      }
				            
				      while (e <= event.end && (day.length || endday || options.date < checkanyway)) {
				        if(day.length) { 
				          existing = day.find('.event').length;
				          numbevents = Math.max(numbevents, existing);
				          for(i = 0; i < numbevents - existing; i++) {
				            day.append(empty.clone());
				          }
				          day.append(
				            $event.
				            toggleClass('begin', dateclass === event.start.toDateCssClass()).
				            toggleClass('end', dateclass === event.end.toDateCssClass())
				          );
				          $event = $event.clone();
				          $event.html('&nbsp;');
				        }
				        e.setDate(e.getDate() + 1);
				        dateclass = e.toDateCssClass();
				        day = $('.' + dateclass);
				      }
				    }
				    function yearAddEvents(events, year) {
				      var counts = [0,0,0,0,0,0,0,0,0,0,0,0];
				      $.each(events, function (i, v) {
				        if (v.start.getFullYear() === year) {
				            counts[v.start.getMonth()]++;
				        }
				      });
				      $.each(counts, function (i, v) {
				        if (v!==0) {
				            $('.month-'+i).append('<span class="badge badge-info">'+v+'</span>');
				        }
				      });
				    }
				    
				    function draw() {
				      $el.html(t(options));
				      //potential optimization (untested), this object could be keyed into a dictionary on the dateclass string; the object would need to be reset and the first entry would have to be made here
				      $('.' + (new Date()).toDateCssClass()).addClass('today');
				      if (options.data && options.data.length) {
				        if (options.mode === 'year') {
				            yearAddEvents(options.data, options.date.getFullYear());
				        } else if (options.mode === 'month' || options.mode === 'week') {
				            $.each(options.data, monthAddEvent);
				        } else {
				            $.each(options.data, dayAddEvent);
				        }
				      }
				    }
				    
				    draw();    
				  }
				  
				  ;(function (defaults, $, window, document) {
				    $.extend({
				      calendar: function (options) {
				        return $.extend(defaults, options);
				      }
				    }).fn.extend({
				      calendar: function (options) {
				        options = $.extend({}, defaults, options);
				        return $(this).each(function () {
				          var $this = $(this);
				          calendar($this, options);
				        });
				      }
				    });
				  })({
				    days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
				    months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
				    shortMonths: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				    date: (new Date()),
				        daycss: ["c-sunday", "", "", "", "", "", "c-saturday"],
				        todayname: "Today",
				        thismonthcss: "current",
				        lastmonthcss: "outside",
				        nextmonthcss: "outside",
				    mode: "month",
				    data: []
				  }, jQuery, window, document);
				    
				})(jQuery);

				var data = [],
				    date = new Date(),
				    d = date.getDate(),
				    d1 = d,
				    m = date.getMonth(),
				    y = date.getFullYear(),
				    i,
				    end, 
				    j, 
				    c = 1063, 
				    c1 = 3329,
				    h, 
				    m,
				    names = ['All Day Event', 'Long Event', 'Birthday Party', 'Repeating Event', 'Training', 'Meeting', 'Mr. Behnke', 'Date', 'Ms. Tubbs'],
				    //slipsum = ["Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.", "You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic.", "Your bones don't break, mine do. That's clear. Your cells react to bacteria and viruses differently than mine. You don't get sick, I do. That's also clear. But for some reason, you and I react the exact same way to water. We swallow it too fast, we choke. We get some in our lungs, we drown. However unreal it may seem, we are connected, you and I. We're on the same curve, just on opposite ends.", "Well, the way they make shows is, they make one show. That show's called a pilot. Then they show that show to the people who make shows, and on the strength of that one show they decide if they're going to make more shows. Some pilots get picked and become television programs. Some don't, become nothing. She starred in one of the ones that became nothing.", "Yeah, I like animals better than people sometimes... Especially dogs. Dogs are the best. Every time you come home, they act like they haven't seen you in a year. And the good thing about dogs... is they got different dogs for different people. Like pit bulls. The dog of dogs. Pit bull can be the right man's best friend... or the wrong man's worst enemy. You going to give me a dog for a pet, give me a pit bull. Give me... Raoul. Right, Omar? Give me Raoul.", "Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded. That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price.", "You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man.", "You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic.", "Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded. That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price.", "You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man."];
				    slipsum = ["", "", "", "", "", "", "", "", "", ""];

				  /*for(i = 0; i < 25; i++) {
				    j = Math.max(i % 15 - 10, 0);
				    //c and c1 jump around to provide an illusion of random data
				    c = (c * 1063) % 1061; 
				    c1 = (c1 * 3329) % 3331;
				    d = (d1 + c + c1) % 839 - 440;
				    h = i % 36;
				    m = (i % 4) * 15;
				    if (h < 18) { h = 0; m = 0; } else { h = Math.max(h - 24, 0) + 8; }
				    end = !j ? null : new Date(y, m, d + j, h + 2, m);
				    data.push({ title: names[c1 % names.length], start: new Date(y, m, d, h, m), end: end, allDay: !(i % 6), text: slipsum[ slipsum.length ]  });
				  }*/
				  <?php  		
					/*$attend_query = "SELECT * FROM StudentAbsent where StudentID=$studentId";
					$attend_result = sqlsrv_query( $conn, $attend_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
				  
				    while($attend_row = sqlsrv_fetch_array($attend_result)){?>

				  	  //data.push({ title: "Testing", start: new Date(2015, 07, 24, 8, 35), end: new Date(2015, 07, 26, 18, 35), allDay:0/*, text: slipsum[ slipsum.length ]*/  //});

				  	//} ?>

				  	//data.push({ title: "Testing", start: new Date(2015, 07, 24, 8, 35), end: new Date(2015, 07, 26, 18, 35), allDay:0/*, text: slipsum[ slipsum.length ]*/  });

				  	<?php  	
					$attend_query = "SELECT DISTINCT DateAbsent,StudentID,Status FROM StudentAbsent where StudentID='$studentId' AND Status='Absent'";
					$attend_result = sqlsrv_query( $conn, $attend_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
				  
				    while($attend_row = sqlsrv_fetch_array($attend_result)){
				    	$absent_date = date_format($attend_row['DateAbsent'], 'Y-m-d');
				    	$ab_year = explode('-',$absent_date);
				    	$mondecr = $ab_year['1'] - 1;
				    	?>

				  	  data.push({start: new Date(<?php echo $ab_year['0'];?>,<?php echo $mondecr;?>, <?php echo $ab_year['2'];?>) });
				  	  //data.push({ title: "Testing", start: new Date(2015, 07, 24, 8, 35), end: new Date(2015, 07, 26, 18, 35), allDay:0/*, text: slipsum[ slipsum.length ]*/  });

				  	<?php }?>
				  
				  data.sort(function(a,b) { return (+a.start) - (+b.start); });
				  
				//data must be sorted by start date

				//Actually do everything
				$('#holder').calendar({
				  data: data
				});
				//@ sourceURL=pen.js
				</script>

			<!-- Calendar Ends -->

					  </div><!-- /.box -->
					</div><!-- /.col -->
						<!-- Attendance Calendar/Chart Ends -->

							<div class="">
			                  <!-- DIRECT CHAT -->
			                  <div class="box box-warning direct-chat direct-chat-warning">
			                    <div class="box-header with-border">
			                      <h3 class="box-title">Direct Chat</h3>
			                      <div class="box-tools pull-right">
			                         <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span>
			                        <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
			                        <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments chaticon text-yellow" style="font-size:3em !important; margin-top:-5px;"></i></button> 
			                        <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
			                      </div>
			                    </div><!-- /.box-header -->
			                    <div class="box-body">
			                      <!-- Conversations are loaded here -->
			                      <div class="direct-chat-messages wrappers">
			                    <?php
			                    if($_SESSION['chatting_user']!="")
			                    {

			                      	$msg_query = "SELECT * FROM Chat_Messages where ([from]='".$studentId."' and [to]='".$_SESSION['chatting_user']."') OR ([from]='".$_SESSION['chatting_user']."' and [to]='".$studentId."') ORDER BY sent";
			                        $msg_result = sqlsrv_query( $conn, $msg_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	

			                        while($chat_data = sqlsrv_fetch_array($msg_result)){

			                        	if($chat_data['From']!=$studentId)
			                        	{		                        
			                        	 $user1 = "SELECT StudentName_en FROM StudentInfo where StudentID='".$chat_data['From']."'";
			                        	 $user1result = sqlsrv_query( $conn, $user1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));		
			                      	?>			                        
			                        <!-- Message. Default to the left -->
			                        <div class="direct-chat-msg">
			                          <div class="direct-chat-info clearfix">
			                            <span class="direct-chat-name pull-left"><?php while($user1_name = sqlsrv_fetch_array($user1result)){ echo $user1_name['StudentName_en']; } ?></span>
			                            <span class="direct-chat-timestamp pull-right"><?php $vals=strtotime($chat_data['Sent']); echo date("j M Y G:i a",$vals);?></span>
			                          </div><!-- /.direct-chat-info -->
			                          <img class="direct-chat-img img-circle" class="img-cir" src="assets/dist/img/user1-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
			                          <div class="direct-chat-text">
			                            <?php echo $chat_data['Message'];?>
			                          </div><!-- /.direct-chat-text -->
			                        </div><!-- /.direct-chat-msg -->

			                        <?php } else { ?>

			                        <!-- Message to the right -->
			                        <div class="direct-chat-msg right">
			                          <div class="direct-chat-info clearfix">
			                            <span class="direct-chat-name pull-right"><?php echo $_SESSION['StudentName_en'];?></span>
			                            <span class="direct-chat-timestamp pull-left"><?php $vals=strtotime($chat_data['Sent']); echo date("j M Y G:i a",$vals);?></span>
			                          </div><!-- /.direct-chat-info -->
			                          <img class="direct-chat-img img-circle" src="assets/dist/img/user3-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
			                          <div class="direct-chat-text">
			                            <?php echo $chat_data['Message'];?>
			                          </div><!-- /.direct-chat-text -->
			                        </div><!-- /.direct-chat-msg -->

			                        <?php } 
			                    	}
			                    }
			                    else
			                    {
			                    	echo "No Conversation Started";
			                    }
			                    	?>

			                      </div><!--/.direct-chat-messages-->

			                      <!-- Contacts are loaded here -->
			                      <div class="direct-chat-contacts">
			                        <ul class="contacts-list">
			                        <?php
			                        $users_query = "SELECT StudentID,StudentName_en FROM StudentInfo where StudentID!='$studentId'";
			                        $users_result = sqlsrv_query( $conn, $users_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	

			                         while($all_users = sqlsrv_fetch_array($users_result)){
			                        ?>
			                          <li>			                            
			                            <img class="contacts-list-img img-circle" src="assets/dist/img/user7-128x128.jpg" />
			                            <div class="contacts-list-info">
			                                <span class="contacts-list-name" onclick="chat_user(<?php echo $all_users['StudentID'];?>)" data-widget="chat-pane-toggle" style="cursor:pointer">
			                                  <?php echo $all_users['StudentName_en'];?>
			                                  <!-- <small class="contacts-list-date pull-right">2/23/2015</small> -->
			                                </span>
			                                <span class="contacts-list-msg">I will be waiting for...</span>
			                            </div><!-- /.contacts-list-info -->			                            
			                          </li><!-- End Contact Item -->
			                        <?php 
			                    	 }
			                        ?>  
			                        </ul><!-- /.contatcts-list -->
			                      </div><!-- /.direct-chat-pane -->
			                    </div><!-- /.box-body -->
			                    <div class="box-footer">
			                      <form name="chat_msg_submit" method="post">
			                        <div class="input-group">
			                          <input type="text" name="message" id="message" placeholder="Type Message ..." class="form-control"/>
			                          <input type="hidden" name="chatuser_sess" id="chatuser_sess" value="<?php echo $_SESSION['chatting_user'];?>"/>

			                          <span class="input-group-btn">
			                            <input type="submit" name="submit" class="btn btn-warning btn-flat" value="Send" onclick="return chatInsert()" >
			                          </span>
			                        </div>
			                      </form>
			                    </div><!-- /.box-footer-->
			                  </div><!--/.direct-chat -->
			                </div><!-- /.col -->
			                
						</div>
						
						<div class="col-md-6">
							<!-- Marks Chart start -->
							<div class="marks-chart">
								<div class="box box-success">
									<div class="box-header with-border">
									  <h3 class="box-title">Marks</h3><i class="fa fa-bar-chart text-green pull-right"></i>
									  <div class="box-tools pull-right">
										<!-- <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
										<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
									  </div>
									</div>
									<div class="box-body">
										<!-- <canvas id="barChart" height="230"></canvas> -->
										<section id="skills" style="overflow-y:scroll; height:420px;" class="slimScroll">
										 <?php
										 	$marks_query = "SELECT * FROM MarksModule where StudentID=$studentId";
										 	$marks_result = sqlsrv_query( $conn, $marks_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	

										 	while($marks_row = sqlsrv_fetch_array($marks_result)){										 	 
										 ?>
											<div class="zero"><progress value="<?php echo $marks_row['S1_Marks'];?>" data-toggle="tooltip" data-placement="top" title="dsasd" max="<?php echo $marks_row['S1_Weight'];?>" ></progress><span><?php echo $marks_row['S1_ModuleID'];?></span><div class="marks pull-right"><strong><?php echo $marks_row['S1_Marks']; ?></strong> /100 </div></div>
											<div class="one"><progress value="<?php echo $marks_row['S2_Marks'];?>" max="<?php echo $marks_row['S2_Weight'];?>"></progress><span><?php echo $marks_row['S2_ModuleID'];?></span><div class="marks pull-right"><strong><?php echo $marks_row['S2_Marks']; ?></strong> /100 </div></div>
											<div class="two"><progress value="<?php echo $marks_row['S3_Marks'];?>" max="<?php echo $marks_row['S3_Weight'];?>"></progress><span><?php echo $marks_row['S3_ModuleID'];?></span><div class="marks pull-right"><strong><?php echo $marks_row['S3_Marks']; ?></strong> /100 </div></div>
											<div class="four"><progress value="<?php echo $marks_row['S4_Marks'];?>" max="<?php echo $marks_row['S4_Weight'];?>"></progress><span><?php echo $marks_row['S4_ModuleID'];?></span><div class="marks pull-right"><strong><?php echo $marks_row['S4_Marks']; ?></strong> /100 </div></div>
											<div class="three"><progress value="<?php echo $marks_row['S5_Marks'];?>" max="<?php echo $marks_row['S5_Weight'];?>"></progress><span><?php echo $marks_row['S5_ModuleID'];?></span><div class="marks pull-right"><strong><?php echo $marks_row['S5_Marks']; ?></strong> /100 </div></div>
											<div class="four"><progress value="<?php echo $marks_row['S2_Marks'];?>" max="<?php echo $marks_row['S2_Weight'];?>"></progress><span><?php echo $marks_row['S2_ModuleID'];?></span><div class="marks pull-right"><strong><?php echo $marks_row['S2_Marks']; ?></strong> /100 </div></div>
											<div class="three"><progress value="<?php echo $marks_row['S6_Marks'];?>" max="<?php echo $marks_row['S6_Weight'];?>"></progress><span><?php echo $marks_row['S6_ModuleID'];?></span><div class="marks pull-right"><strong><?php echo $marks_row['S6_Marks']; ?></strong> /100 </div></div>
											<div class="four"><progress value="<?php echo $marks_row['S7_Marks'];?>" max="<?php echo $marks_row['S7_Weight'];?>"></progress><span><?php echo $marks_row['S7_ModuleID'];?></span><div class="marks pull-right"><strong><?php echo $marks_row['S7_Marks']; ?></strong> /100 </div></div>
											<div class="five"><progress value="<?php echo $marks_row['S1_Marks'];?>" max="<?php echo $marks_row['S1_Weight'];?>"></progress><span><?php echo $marks_row['S1_ModuleID'];?></span><div class="marks pull-right"><strong><?php echo $marks_row['S1_Marks']; ?></strong> /100 </div></div>
											<div class="six"><progress value="<?php echo $marks_row['S8_Marks'];?>" max="<?php echo $marks_row['S8_Weight'];?>"></progress><span><?php echo $marks_row['S8_ModuleID'];?></span><div class="marks pull-right"><strong><?php echo $marks_row['S8_Marks']; ?></strong> /100 </div></div>											
											<div class="eight"><progress value="<?php echo $marks_row['S2_Marks'];?>" max="<?php echo $marks_row['S2_Weight'];?>"></progress><span><?php echo $marks_row['S2_ModuleID'];?></span><div class="marks pull-right"><strong><?php echo $marks_row['S2_Marks']; ?></strong> /100 </div></div>
											<div class="nine"><progress value="<?php echo $marks_row['S4_Marks'];?>" max="<?php echo $marks_row['S4_Weight'];?>"></progress><span><?php echo $marks_row['S4_ModuleID'];?></span><div class="marks pull-right"><strong><?php echo $marks_row['S4_Marks']; ?></strong> /100 </div></div>
											<div class="ten"><progress value="<?php echo $marks_row['S6_Marks'];?>" max="<?php echo $marks_row['S6_Weight'];?>"></progress><span><?php echo $marks_row['S6_ModuleID'];?></span><div class="marks pull-right"><strong><?php echo $marks_row['S6_Marks']; ?></strong> /100 </div></div>
										 <?php }?>
										</section>
									</div><!-- /.box-body -->
								  </div><!-- /.box -->
							</div>
							<!-- Marks Chart Ends -->							

							<!-- Instructors LIST -->
							<div class="teachers">			                  
							  <?php
									$sql_Instructors = "SELECT * FROM ITD_Instructors";
									$result = sqlsrv_query( $conn, $sql_Instructors ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
									$row_count = sqlsrv_num_rows($result);
								?>
			                  <div class="box box-danger">
			                    <div class="box-header with-border">
			                      <h3 class="box-title">Instructors</h3>
			                      <div class="box-tools pull-right">
			                        <span class="label label-danger"><?php echo $row_count;?> Members</span>
			                        <i class="fa fa-users pull-right text-red"></i>
			                        <!-- <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
			                      </div>
			                    </div><!-- /.box-header -->
								
			                    <div class="box-body no-padding">
			                      <ul class="users-list clearfix">
								  
								  <?php //while($row = sqlsrv_fetch_array($result)){ ?>
			                        <!-- <li>
			                          <img src="assets/dist/img/user1-128x128.jpg" alt="User Image" class="img-circle" width="128" height="128" />
			                          <a class="users-list-name" href="#"><?php echo $row['InstructorName']?></a>
			                          <span class="users-list-date"><?php echo $row['InstructorEmail']?></span>
			                        </li> -->
			                        <li>
			                          <img src="assets/dist/img/user1-128x128.jpg" alt="User Image" class="img-circle" width="128" height="128" />
			                          <a class="users-list-name" href="#">Mohammed</a>
			                          <span class="users-list-date">test@test.com</span>
			                        </li>
			                        <li>
			                          <img src="assets/images/prof-Img/prof-4.jpg" alt="User Image" class="img-circle" width="128" height="128" />
			                          <a class="users-list-name" href="#">Ali</a>
			                          <span class="users-list-date">testing@test.com</span>
			                        </li>
			                        <li>
			                          <img src="assets/images/prof-Img/prof-5.jpg" alt="User Image" class="img-circle" width="128" height="128" />
			                          <a class="users-list-name" href="#">John</a>
			                          <span class="users-list-date">dummy@test.com</span>
			                        </li>
			                        <li>
			                          <img src="assets/images/prof-Img/prof-3.jpg" alt="User Image" class="img-circle" width="128" height="128" />
			                          <a class="users-list-name" href="#">Khaled</a>
			                          <span class="users-list-date">1324@test.com</span>
			                        </li>
			                        <li>
			                          <img src="assets/images/prof-Img/prof-4.jpg" alt="User Image" class="img-circle" width="128" height="128" />
			                          <a class="users-list-name" href="#">Sameer</a>
			                          <span class="users-list-date">being@test.com</span>
			                        </li>
			                        <li>
			                          <img src="assets/images/teachers/1.jpg" alt="User Image" class="img-circle" width="128" style="height:128px" />
			                          <a class="users-list-name" href="#">Khaled</a>
			                          <span class="users-list-date">1324@test.com</span>
			                        </li>
			                        <li>
			                          <img src="assets/images/teachers/2.jpg" alt="User Image" class="img-circle" width="128" style="height:128px" />
			                          <a class="users-list-name" href="#">Sameer</a>
			                          <span class="users-list-date">being@test.com</span>
			                        </li>			                        
			                        <li>
			                          <img src="assets/images/teachers/4.jpg" alt="User Image" class="img-circle" width="128" style="height:128px" />
			                          <a class="users-list-name" href="#">Ibrahim</a>
			                          <span class="users-list-date">being@test.com</span>
			                        </li>
								  <?php //} ?>

			                      </ul><!-- /.users-list -->
			                    </div><!-- /.box-body -->
			                    <div class="box-footer text-center">
			                      <a href="javascript::" class="uppercase">View All Users</a>
			                    </div><!-- /.box-footer -->
			                  </div><!--/.box -->
			                </div><!-- /.col -->
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							 <div class="box box-info">
								<div class="box-header with-border">
								  <h3 class="box-title">Programs</h3>
								  <i class="fa fa-tasks pull-right text-info"></i>
								  <!-- <div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								  </div> -->
								</div><!-- /.box-header -->
								<div class="box-body tasks">
								  <div class="table-responsive">
								  <?php 
										
								  ?>
									<table class="table no-margin">
									  <thead>
										<tr>
										  <th><?php echo $lang["ID"];?></th>
										  <th><?php echo $lang["Program"];?></th>
										  <th><?php echo $lang["Parent"];?></th>
										  <th><?php echo $lang["Hours"];?></th>
										  <th><?php echo $lang["Breaks"];?></th>
										  <th><?php echo $lang["Minutes"];?></th>
										  <th><?php echo $lang["StartDate"];?></th>
										  <th><?php echo $lang["EndDate"];?></th>
										  <th><?php echo $lang["Duration"];?></th>
										  <th><?php echo $lang["Weekdays"];?></th>
										  <th><?php echo $lang["IsPublished"];?></th>
										</tr>
									  </thead>
									  <tbody>
									  <?php 
											$querys =	"SELECT * FROM ITD_Programs where ProgramID !=0";
											$result = sqlsrv_query( $conn, $querys ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											$row_count = sqlsrv_num_rows($result);
												while($row = sqlsrv_fetch_array($result)){?>
										<tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr>
										<tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr>
										<tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr>
										<tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr>
										<tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr>
										<tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr>
										<?php } ?>
									  </tbody>
									</table>
								  </div><!-- /.table-responsive -->
								</div><!-- /.box-body -->
								<div class="box-footer clearfix">
								  <!-- <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
								  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-right">View All Programs</a>
								</div><!-- /.box-footer -->
							  </div><!-- /.box -->
						</div>
					</div>
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> 2.2.0
				</div>
				<strong>Copyright &copy; 2014-2015 <a href="#fakelink"> SWCC Student Dashboard</a>.</strong> All rights reserved.
			</footer>
			
			<!-- Add the sidebar's background. This div must be placed
					 immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div><!-- ./wrapper -->
		
		<!-- jQuery 2.1.4 -->
		<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
		<!-- Bootstrap 3.3.2 JS -->
		<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<!-- SlimScroll -->
		<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<!-- FastClick -->
		<script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
		<!-- Swcc App -->
		<script src="assets/dist/js/app.min.js" type="text/javascript"></script>
		<!-- Swcc for demo purposes -->
		<!-- ChartJS 1.0.1 -->
	<script src="assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

	<!-- AdminLTE for demo purposes -->
    <script src="assets/dist/js/demo.js" type="text/javascript"></script>


    
		<!--<script src="assets/dist/js/demo.js" type="text/javascript"></script>-->
		<script type="text/javascript">
		$(document).on('ready', function(){
			$(".todo-list").todolist({
				onCheck: function (ele) {
					console.log("The element has been checked")
				},
				onUncheck: function (ele) {
					console.log("The element has been unchecked")
				}
			});
			 var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas);

  var salesChartData = {
	labels: ["January", "February", "March", "April", "May", "June", "July"],
	datasets: [
	  {
		label: "Electronics",
		fillColor: "rgb(143, 210, 210)",
		strokeColor: "rgb(210, 214, 222)",
		pointColor: "rgb(210, 214, 222)",
		pointStrokeColor: "#c1c7d1",
		pointHighlightFill: "#fff",
		pointHighlightStroke: "rgb(220,220,220)",
		data: [65, 59, 80, 81, 56, 55, 40]
	  },
	  {
		label: "Digital Goods",
		fillColor: "rgba(60,141,188,0.9)",
		strokeColor: "rgba(60,141,188,0.8)",
		pointColor: "#3b8bba",
		pointStrokeColor: "rgba(60,141,188,1)",
		pointHighlightFill: "#fff",
		pointHighlightStroke: "rgba(60,141,188,1)",
		data: [28, 48, 40, 19, 86, 27, 90]
	  }
	]
  };
  	

  var areaChartData = {
  	//Marks Query
  	<?php  		
		$marks_query = "SELECT * FROM MarksModule where StudentID=$studentId";
		$marks_result = sqlsrv_query( $conn, $marks_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	?>
      //labels: ["Maths", "English", "HR", "Biology", "Social"],
      labels: [<?php while($marks_row = sqlsrv_fetch_array($marks_result)){?>"<?php echo $marks_row['S1_ModuleID']?>","<?php echo $marks_row['S2_ModuleID']?>","<?php echo $marks_row['S2_ModuleID']?>","<?php echo $marks_row['S2_ModuleID']?>","<?php echo $marks_row['S2_ModuleID']?>"<?php } ?>],
      datasets: [
        {
          label: "Electronics",
          fillColor: "rgba(33, 200, 215, 0.5)",
          strokeColor: "rgba(33, 200, 215, .5)",
          pointColor: "rgba(33, 200, 215, .5)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#000",
          pointHighlightStroke: "rgba(33, 200, 215, .5)",
          //data: [ 100,100,100,100,100]
          <?php $marks2_result = sqlsrv_query( $conn, $marks_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET )); ?>
          data: [<?php while($marks2_row = sqlsrv_fetch_array($marks2_result)){?><?php echo $marks2_row['S1_Weight']?>,<?php echo $marks2_row['S1_Weight']?>,<?php echo $marks2_row['S2_Weight']?>,<?php echo $marks2_row['S1_Weight']?>,<?php echo $marks2_row['S2_Weight']?>,<?php } ?>]
        },
        {
          label: "Digital Goods",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#000",
          pointHighlightStroke: "rgba(92,226,163,1)",
          //data: [58, 48, 40, 22, 25]
          <?php $marks3_result = sqlsrv_query( $conn, $marks_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET )); ?>
          data: [<?php while($marks3_row = sqlsrv_fetch_array($marks3_result)){?><?php echo $marks3_row['S1_Marks']?>,<?php echo $marks3_row['S2_Marks']?>,<?php echo $marks3_row['S1_Marks']?>,<?php echo $marks3_row['S2_Marks']?>,<?php echo $marks3_row['S2_Marks']?>,<?php } ?>]
        }
      ]
    };

  /*var salesChartOptions = {
	//Boolean - If we should show the scale at all
	showScale: true,
	//Boolean - Whether grid lines are shown across the chart
	scaleShowGridLines: false,
	//String - Colour of the grid lines
	scaleGridLineColor: "rgba(0,0,0,.05)",
	//Number - Width of the grid lines
	scaleGridLineWidth: 1,
	//Boolean - Whether to show horizontal lines (except X axis)
	scaleShowHorizontalLines: true,
	//Boolean - Whether to show vertical lines (except Y axis)
	scaleShowVerticalLines: true,
	//Boolean - Whether the line is curved between points
	bezierCurve: true,
	//Number - Tension of the bezier curve between points
	bezierCurveTension: 0.3,
	//Boolean - Whether to show a dot for each point
	pointDot: false,
	//Number - Radius of each point dot in pixels
	pointDotRadius: 4,
	//Number - Pixel width of point dot stroke
	pointDotStrokeWidth: 1,
	//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
	pointHitDetectionRadius: 20,
	//Boolean - Whether to show a stroke for datasets
	datasetStroke: true,
	//Number - Pixel width of dataset stroke
	datasetStrokeWidth: 2,
	//Boolean - Whether to fill the dataset with a color
	datasetFill: true,
	//String - A legend template
	legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
	//Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
	maintainAspectRatio: false,
	//Boolean - whether to make the chart responsive to window resizing
	responsive: true
  };

  //Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);*/

  //---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------
 		        
        //-------------
        //- BAR CHART -
        //-------------
        /*var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "rgba(253, 100, 100, 0.7)";
        barChartData.datasets[1].strokeColor = "rgba(253, 100, 100, 0.7)";
        barChartData.datasets[1].pointColor = "rgba(253, 100, 100, 0.7)";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: false
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
*/
		})		
		</script>
		<script>
			$(document).on('ready', function(){
				var attend = $('.marks-chart').height();
				//alert(attend);
				$('.attendance-chart .box').css('height', attend +'px');
				if($(window).height() < 800){
				  // $('.attendance-chart .box-body').css('padding-top', attend / 8  +'px');
				}

				var teach = $('.teachers .box-body').height();
				$('.direct-chat-messages').css('height', teach - 12 +'px');
				$('.direct-chat-contacts').css('height', teach - 12 +'px');
			});
		</script>

		<script type="text/javascript">
		function chat_user($chatId)
		{
			var chat_userId = $chatId;				
		 	$.ajax({
		      url: 'chat_messages.php',		      
		      type: "GET",
		      data:{"chat_Id":chat_userId,"process":"data"},		      		      
		      success: function(data) {
		        $('.direct-chat-messages').html(data);
		      }
		    })
		    document.getElementById('message').value="";
		    document.getElementById('chatuser_sess').value=chat_userId;
		}
		function chatInsert()
		{
			var chtuser = $('#chatuser_sess').val();
			var msg = $('#message').val();
			if(chtuser!="")
			{

				if(msg == "")	
				{
					alert("Please enter your message");
					$('#message').focus();
					return false;
				}
				else
				{
					document.getElementById('message').value="";
					$.ajax({
				      url: 'chat_messages.php',		      
				      type: "GET",
				      data:{"message":msg,"insert":"add"},		      		      
				      success: function(data) {
				        $('.direct-chat-messages').html(data);
				      }
				    })
				    return false;
				}
				return false;
			}
			else
			{
				alert("Please Select Any Conversation");
				return false;
			}
			return true;
		}


		</script>	
		
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="assets/dist/js/barchart.js"></script>
		<script src="assets/dist/js/slimscroll.js"></script>

			<?php 
//session_start();
include('includes/footer.php');
?>


<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.3/jquery.slimscroll.min.js"></script> -->