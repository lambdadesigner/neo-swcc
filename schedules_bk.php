<?php
include("includes/header.php");
//$sql = "select * from Schdule INNER JOIN Module ON Schdule.ModuleID=Module.ModuleID";
$sql ="select DISTINCT Date,ModuleName,StartTime,EndTime from Schdule INNER JOIN Module ON Schdule.ModuleID=Module.ModuleID";
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

?>
<!--FullCalendar-->
      <link href="assets/plugins/fullcalendar1/fullcalendar.css" rel='stylesheet' />
      <script src='assets/plugins/fullcalendar1/moment.min.js'></script>      
      <script src="assets/plugins/fullcalendar1/jquery-1.9.1.min.js"></script>
      <script src="assets/plugins/fullcalendar1/fullcalendar.min.js"></script>      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) --> 
        <section class="content-header">
          <h1>
            Schedules
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Calendar</li>
          </ol>
        </section>
		<?php
		/*
		 while($row = sqlsrv_fetch_array($result)){
			 $Date = date_format($row['Date'], 'Y-m-d');
			 $StartTime=date_format($row['StartTime'],"H:i:s");
			 $starttime = explode(':',$StartTime);
			 $start = $starttime[0].','.$starttime[1];
			 $EndTime=date_format($row['EndTime'],"H:i:s");
			 $endtime = explode(':',$EndTime);
			 echo $end = $endtime[0].','.$endtime[1];	
			 exit;	
			 } */?>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-body no-padding">
                  <!-- THE CALENDAR -->
                  <div id='calendar'></div>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	 
      <script type="text/javascript">
	 
			
	
  
        $(document).ready(function()
        {
          var date = new Date();
          var d = date.getDate();
          var m = date.getMonth();
          var y = date.getFullYear();
                
          var calendar = $('#calendar').fullCalendar(
          {        
            header:
            {
              left: 'prev,next today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay'
            },
            
			
            defaultView: 'month',
            
            selectable: true,
            selectHelper: true,
            
        select: function(start, end, allDay)
            {          
              var title = prompt('Event Title:');
			  
			if (title)
              {
                calendar.fullCalendar('renderEvent',
                  {
                    title: title,
                    start: start,
                    end: end,
                    allDay: allDay
                  },
                  true // make the event "stick"
                );
              }
              calendar.fullCalendar('unselect');
            },
			
            editable: true,

            eventLimit: true,
			
            events: [
			
		 	<?php
		//$sql = "select * from Schdule INNER JOIN Module ON Schdule.ModuleID=Module.ModuleID";
		$sql = "select  ModuleName,Date,StartTime,EndTime from Schdule INNER JOIN Module ON Schdule.ModuleID=Module.ModuleID";
		$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
		 while($row = sqlsrv_fetch_array($result)){
			 $Date = date_format($row['Date'], 'Y-m-d');
			 $StartTime=date_format($row['StartTime'],"H:i:s");
			 $starttime = explode(':',$StartTime);
			 $start = $starttime[0].','.$starttime[1];
			 $EndTime=date_format($row['EndTime'],"H:i:s");
			 $endtime = explode(':',$EndTime);
			 $end = $endtime[0].','.$endtime[1];
			 ?>		
              {
			    title:'<?php echo $row['ModuleName'];?>',
                start: '<?php echo $Date?>',
				end:'<?php echo $Date?>'
              },
		 <?php  }?>
              
            ]
			
          });
          
        });
		
		
		
		
      </script>
	  <script src="assets/dist/js/app.min.js" type="text/javascript"></script>
	
      <style type="text/css">
      #calendar
      {        
        margin: 0 auto;
        padding:10px 5px 0px 5px;
      }
    </style>
	<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> 2.2.0
				</div>
				<strong>Copyright &copy; 2014-2015 <a href="#SWCC">SWCC Dashboard</a>.</strong> All rights reserved.
			</footer>
  </body>
</html>
