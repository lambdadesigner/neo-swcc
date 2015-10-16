<?php
/*include('../../../includes/database.php');

$instAttendq = "SELECT DISTINCT OriginalInstructor,ClassDate FROM AttendanceDelegation where OriginalInstructor='u101541' AND ClassDate >= '20150101' AND ClassDate <=  '20151231' ORDER BY ClassDate ASC"; 
$instAttendq_result1 = sqlsrv_query( $conn, $instAttendq ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

$instAttendq1_result1 = sqlsrv_query( $conn, $instAttendq ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$row_countq1 = sqlsrv_num_rows($instAttendq_result1); */

?>


<!-- Attendance Chart Script -->
var chart = AmCharts.makeChart("chartdiv", {
  "type": "serial",
  "theme": "light",
  "dataDateFormat": "YYYY-MM-DD",
  "precision": 2,
  "valueAxes": [{
    "id": "v1",
    "title": "Absents",
    "startEffect" : "elastic",
    "position": "left",
    "autoGridCount": true,
    "labelFunction": function(value) {
      return "" + Math.round(value) + "Days";
    }
  }, {
    "id": "v2",
    "title": "Market Days",
    "gridAlpha": 0,
    "position": "right",
    "autoGridCount": false
  }],
  "graphs": [ {
    "id": "g3",
    "valueAxis": "v1",
    "lineColor": "#1083ae",
    "fillColors": "#9ddaeb",
    "fillAlphas": 1,
    "type": "column",
    "startEffect" : "elastic",
    "title": "Actual Sales",
    "valueField": "sales2",
    "clustered": false,
    "columnWidth": 0.8,
    <!-- "legendValueText": "$[[value]]M", -->
    "balloonText": "[[title]]<br/><b style='font-size: 130%'>$[[value]]M</b>"
  }, {
    "id": "g4",
    "valueAxis": "v1",
    "lineColor": "#285986",
    "fillColors": "#52bedb",
    "fillAlphas": 2,
    "startEffect" : "elastic",
    "type": "column",
    "title": "Target Sales",
    "valueField": "sales1",
    "clustered": false,
    "columnWidth": 0.8,
   <!--  "legendValueText": "$[[value]]M", -->
    "balloonText": "[[title]]<br/><b style='font-size: 130%'>$[[value]]M</b>"
  }],
  "chartCursor": {
    "pan": true,
    "valueLineEnabled": true,
    "valueLineBalloonEnabled": true,
    "cursorAlpha": 0,
    "valueLineAlpha": 1
  },
  "categoryField": "date",
  "categoryAxis": {
    "parseDates": true,
    "dashLength": 2,
    "minorGridEnabled": true
  },
  "balloon": {
    "borderThickness": 1,
    "shadowAlpha": 0
  },
  "export": {
   "enabled": true
  },
  "dataProvider": [

  <?php /*while($fsw = sqlsrv_fetch_array($instAttendq_result1)) {?>

  {
    "date": "<?php echo date_format($fsw['ClassDate'],"Y-m-d");?>",
    "market1": 71,
    "market2": 75,
    "sales1": 5,
    "sales2": 8
  },
  <?php }*/ ?>

  {
    "date": "2013-01-16",
    "market1": 71,
    "market2": 75,
    "sales1": 5,
    "sales2": 8
  }, {
    "date": "2013-01-17",
    "market1": 74,
    "market2": 78,
    "sales1": 4,
    "sales2": 6
  }, {
    "date": "2013-01-18",
    "market1": 78,
    "market2": 88,
    "sales1": 5,
    "sales2": 2
  }, {
    "date": "2013-01-19",
    "market1": 85,
    "market2": 89,
    "sales1": 8,
    "sales2": 9
  }, {
    "date": "2013-01-20",
    "market1": 82,
    "market2": 89,
    "sales1": 9,
    "sales2": 6
  }, {
    "date": "2013-01-21",
    "market1": 83,
    "market2": 85,
    "sales1": 3,
    "sales2": 5
  }, {
    "date": "2013-01-22",
    "market1": 88,
    "market2": 92,
    "sales1": 5,
    "sales2": 7
  }, {
    "date": "2013-01-23",
    "market1": 85,
    "market2": 90,
    "sales1": 7,
    "sales2": 6
  }, {
    "date": "2013-01-24",
    "market1": 85,
    "market2": 91,
    "sales1": 9,
    "sales2": 5
  }, {
    "date": "2013-01-25",
    "market1": 80,
    "market2": 84,
    "sales1": 5,
    "sales2": 8
  }, {
    "date": "2013-01-26",
    "market1": 87,
    "market2": 92,
    "sales1": 4,
    "sales2": 8
  }, {
    "date": "2013-01-27",
    "market1": 84,
    "market2": 87,
    "sales1": 3,
    "sales2": 4
  }, {
    "date": "2013-01-28",
    "market1": 83,
    "market2": 88,
    "sales1": 5,
    "sales2": 7
  }, {
    "date": "2013-01-29",
    "market1": 84,
    "market2": 87,
    "sales1": 5,
    "sales2": 8
  }, {
    "date": "2013-01-30",
    "market1": 81,
    "market2": 85,
    "sales1": 4,
    "sales2": 7
  }

  ]
});
