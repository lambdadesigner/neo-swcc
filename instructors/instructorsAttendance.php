<?php
error_reporting(0);
include('../includes/database.php');
//$instAttend = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate BETWEEN '".$startD."0101' AND  '".$EndD."1231'"; 
		$startD = date("Y");
		$EndD = date("Y");
		$_GET['Inuser'] = 'u101541';
		$instAttend = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate >= '".$startD."0101' AND ClassDate <=  '".$EndD."1231'"; 
	$instAttend_result = sqlsrv_query( $conn, $instAttend ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$row_countss = sqlsrv_num_rows($instAttend_result);	 		
	if($row_countss > 0)
	{
?>

<script type="text/javascript">
	// create some data
	var seedData = [	
	<?php
		while($instAttend_data = sqlsrv_fetch_array($instAttend_result)){
		$Imonth = explode('-',date_format($instAttend_data['ClassDate'],'Y-m-d')); 		

	  if($Imonth[1]=="01"){
		$instAttend1 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate BETWEEN '".$startD."0101' AND  '".$EndD."0131'";   
	  	//$instAttend1 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate >= '".$startD."0101' AND ClassDate <=  '".$EndD."0131'"; 
	 	$instAttend_result1 = sqlsrv_query( $conn, $instAttend1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 	$row_count1 = sqlsrv_num_rows($instAttend_result1);	 		
	 ?>
	 {
	    "label": "January",
	    "value": Math.round(<?php echo $row_count1;?>)
	 },
	 <?php } else{?>
	{
	   "label": "January",
	   "value": Math.round(0)
	},
	<?php } if($Imonth[1]=="02"){
		$instAttend2 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate BETWEEN '".$startD."0201' AND  '".$EndD."0229'"; 
	 	//$instAttend2 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate >= '".$startD."0201' AND ClassDate <=  '".$EndD."0229'"; 
	 	$instAttend_result2 = sqlsrv_query( $conn, $instAttend2 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 	$row_count2 = sqlsrv_num_rows($instAttend_result2);	?> 
	 {
	    "label": "February",
	    "value": Math.round(<?php echo $row_count2;?>)
	 },
	<?php } else{?> 
	{
	   "label": "February",
	   "value": Math.round(0)
	},
	<?php } if($Imonth[1]=="03"){
		$instAttend3 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate BETWEEN '".$startD."0301' AND  '".$EndD."0331'"; 
		//$instAttend3 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate >= '".$startD."0301' AND ClassDate <=  '".$EndD."0331'"; 
		$instAttend_result3 = sqlsrv_query( $conn, $instAttend3 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
		$row_count3 = sqlsrv_num_rows($instAttend_result3);?> 
	{
	   "label": "March",
	   "value": Math.round(<?php echo $row_count3;?>)
	},
	<?php } else{?> 
	{
	   "label": "March",
	   "value": Math.round(0)
	},
	 <?php } if($Imonth[1]=="04"){
		$instAttend4 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate BETWEEN '".$startD."0401' AND  '".$EndD."0430'";  
	 	//$instAttend4 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate >= '".$startD."0401' AND ClassDate <=  '".$EndD."0430'"; 
	 	$instAttend_result4 = sqlsrv_query( $conn, $instAttend4 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 	$row_count4 = sqlsrv_num_rows($instAttend_result4);?>  
	 {
	    "label": "April",
	    "value": Math.round(<?php echo $row_count4;?>)
	 }, 
	<?php } else{?> 
	{
	   "label": "April",
	   "value": Math.round(0)
	},
	 <?php } if($Imonth[1]=="05"){
		$instAttend5 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate BETWEEN '".$startD."0501' AND  '".$EndD."0531'";  
	 	//$instAttend5 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate >= '".$startD."0501' AND ClassDate <=  '".$EndD."0531'"; 
	 	$instAttend_result5 = sqlsrv_query( $conn, $instAttend5 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 	$row_count5 = sqlsrv_num_rows($instAttend_result5);?> 
	 {
	    "label": "May",
	    "value": Math.round(<?php echo $row_count5;?>)
	 }, 
	 <?php } else{?> 
	{
	   "label": "May",
	   "value": Math.round(0)
	},
	 <?php } if($Imonth[1]=="06"){
		$instAttend6 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate BETWEEN '".$startD."0601' AND  '".$EndD."0630'";   
	 	//$instAttend6 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate >= '".$startD."0601' AND ClassDate <=  '".$EndD."0630'"; 
	 	$instAttend_result6 = sqlsrv_query( $conn, $instAttend6 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 	$row_count6 = sqlsrv_num_rows($instAttend_result6);?> 
	 {
	    "label": "June",
	    "value": Math.round(<?php echo $row_count6;?>)
	 }, 
	<?php } else{?> 
	{
	   "label": "June",
	   "value": Math.round(0)
	}, 
	 <?php } if($Imonth[1]=="07"){
		$instAttend7 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate BETWEEN '".$startD."0701' AND  '".$EndD."0731'";  
	 	//$instAttend7 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate >= '".$startD."0701' AND ClassDate <=  '".$EndD."0731'"; 
	 	$instAttend_result7 = sqlsrv_query( $conn, $instAttend7 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 	$row_count7 = sqlsrv_num_rows($instAttend_result7);?> 
	 {
	    "label": "July",
	    "value": Math.round(<?php echo $row_count7;?>)
	 }, 
	 <?php } else{?> 
	{
	   "label": "July",
	   "value": Math.round(0)
	}, 
	 <?php } if($Imonth[1]=="08"){
		$instAttend8 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate BETWEEN '".$startD."0801' AND  '".$EndD."0831'";   
	 	$instAttend8 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate >= '".$startD."0801' AND ClassDate <=  '".$EndD."0831'"; 
	 	$instAttend_result8 = sqlsrv_query( $conn, $instAttend8 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 	$row_count8 = sqlsrv_num_rows($instAttend_result8);?> 
	 {
	    "label": "August",
	    "value": Math.round(<?php echo $row_count8;?>)
	 }, 
	 <?php } else{?> 
	{
	   "label": "August",
	   "value": Math.round(0)
	}, 
	 <?php } if($Imonth[1]=="09"){
		$instAttend9 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate BETWEEN '".$startD."0901' AND  '".$EndD."0930'";   
	 	//$instAttend9 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate >= '".$startD."0901' AND ClassDate <=  '".$EndD."0930'"; 
	 	$instAttend_result9 = sqlsrv_query( $conn, $instAttend9 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 	$row_count9 = sqlsrv_num_rows($instAttend_result9);?> 
	 {
	    "label": "September",
	    "value": Math.round(<?php echo $row_count9;?>)
	 }, 
	 <?php } else{?> 
	{
	   "label": "September",
	   "value": Math.round(0)
	}, 
	 <?php } if($Imonth[1]=="10"){
		$instAttend10 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate BETWEEN '".$startD."1001' AND  '".$EndD."10531'";   
	 	//$instAttend10 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate >= '".$startD."1001' AND ClassDate <=  '".$EndD."1031'"; 
	 	$instAttend_result10 = sqlsrv_query( $conn, $instAttend10 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 	$row_count10 = sqlsrv_num_rows($instAttend_result10);?> 
	 {
	    "label": "October",
	    "value": Math.round(<?php echo $row_count10;?>)
	 }, 
	 <?php } else{?> 
	{
	   "label": "October",
	   "value": Math.round(0)
	}, 
	 <?php } if($Imonth[1]=="11"){
		$instAttend11 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate BETWEEN '".$startD."1101' AND  '".$EndD."1130'";    
	 	//$instAttend11 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate >= '".$startD."1101' AND ClassDate <=  '".$EndD."1130'"; 
	 	$instAttend_result11 = sqlsrv_query( $conn, $instAttend11 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 	$row_count11 = sqlsrv_num_rows($instAttend_result11);?> 
	 {
	    "label": "November",
	    "value": Math.round(<?php echo $row_count11;?>)
	 }, 
	 <?php } else{?> 
	{
	   "label": "November",
	   "value": Math.round(0)
	}, 
	 <?php } if($Imonth[1]=="12"){
		$instAttend12 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate BETWEEN '".$startD."1201' AND  '".$EndD."1231'";    
	 	//$instAttend12 = "SELECT * FROM AttendanceDelegation where OriginalInstructor='".$_GET['Inuser']."' AND ClassDate >= '".$startD."1201' AND ClassDate <=  '".$EndD."1231'"; 
	 	$instAttend_result12 = sqlsrv_query( $conn, $instAttend12 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 	$row_count12 = sqlsrv_num_rows($instAttend_result12);?> 
	 {
	    "label": "December",
	    "value": Math.round(<?php echo $row_count12;?>)
	 },
	 <?php } else{?> 
	{
	   "label": "December",
	   "value": Math.round(0)
	},
	<?php } 
	goto a;
	
	}
	a:

	
	?>


	];

	// create tooltip
	var tooltip = d3.select('#chart')
	   .append('div')
	   .attr('class','dtooltip');

	tooltip.append('div')
	   .attr('class','label');

	tooltip.append('div')
	   .attr('class','count');

	tooltip.append('div')
	   .attr('class','percent');

	// setup size of chart
	var width = 850,
	   height = 400,
	   radius = Math.min(width, height) / 2;

	// setup colours
	var colour = d3.scale.ordinal().range(["#e24b77","#fcb41d","#3db880","#3a90c0","#4c77ba","#9460c9","#e85949","#779b24","#ffaebc","#aa79c7","#ea4d41","#5fccca"]);

	// setup size of arcs
	var arc = d3.svg.arc()
	   .innerRadius(radius - 150)
	   .outerRadius(radius - 50);

	var pie = d3.layout.pie()
	   .value(function(d) {
	      return d["value"];
	   })
	   .sort(null);

	var svg = d3.select("#donut-chart")
	   .attr("width", width)
	   .attr("height", height)
	   .append("g")
	   .attr("transform", "translate(" + radius + "," + radius + ")");

	var g = svg.selectAll(".arc")
	   .data(pie(seedData))
	   .enter().append("g")
	   .attr("class", "arc");

	g.append("path")
	   .attr("d", arc)
	   .attr("fill", function(d, i) {
	      return colour(i);
	   })
	   .transition()
	   .ease("exp")
	   .duration(2000)
	   .attrTween("d", function(d) {
	      var i = d3.interpolate({
	         startAngle: 1.1+Math.PI, 
	         endAngle: 1.1+Math.PI
	      }, d);
	      return function(t) { 
	         return arc(i(t)); }
	      ;
	   });

	g.on('mouseover', function(d) {
	   var total = d3.sum(seedData.map(function(d) {
	      return d.value;
	   }));
	   var percent = Math.round(1000 * d.data.value / total) / 10;
	   tooltip.select('.label').html(d.data.label);
	   tooltip.select('.count').html(d.data.value);
	   tooltip.select('.percent').html(percent + '%'); 
	   tooltip.style('display', 'block');
	});

	g.on('mouseout', function(d) {
	   tooltip.style('display', 'none');
	});

	g.on('mousemove', function(d) {
	   console.log(radius);
	 tooltip.style('top', (d3.event.pageY)/1.5 + 'px')
	    .style('left', (d3.event.offsetX) + 'px');
	});

	// setup a legend
	var legendRectSize = 18;
	var legendSpacing = 4;

	var legend = svg.selectAll('.legend')
	   .data(colour.domain())
	   .enter()
	   .append('g')
	   .attr("class","legend")
	   .attr('transform', function(d, i) {
	      var height = legendRectSize + legendSpacing;
	      var offset = height * colour.domain().length / 2;
	      var horz = radius + 25;
	      var vert = i * height - offset;
	      return 'translate(' + horz + ',' + vert + ')';
	   });
	legend.append('rect')
	  .attr('width', legendRectSize)
	  .attr('height', legendRectSize)
	  .style('fill', colour)
	  .style('stroke', colour);

	legend.append('text')
	  .attr('x', legendRectSize + legendSpacing)
	  .attr('y', legendRectSize - legendSpacing)
	  .text(function(d,i) { return seedData[i].label + ' (' + seedData[i].value +')'; });
	</script>
<?php } else { 
	echo "Empty";
} ?>
		