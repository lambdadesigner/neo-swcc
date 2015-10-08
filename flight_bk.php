<?php
include("includes/header.php");
$StudentID  =  $_SESSION['StudentID'];



?>
	<!-- Page level CSS -->
		<!--<link href="assets/dist/css/signature-pad.css" rel="stylesheet">-->
		<!--<link href="assets/dist/css/jquery.signaturepad.css" rel="stylesheet">-->
		<script src="js/signature.js"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/common/wizard.css">
		<link rel="stylesheet" type="text/css" href="assets/dist/css/services.css">
		
		<style>
		canvas
		{
			border: 1px solid #000;
		}
		</style>

		<div class="content-wrapper">

			<div class="container-fluid">

				<!-- Page Heading -->
				<div class="row">
					<div class="content-header">
						<h1 class="page-header">
							Flight Discounts <small>Statistics Overview</small>
						</h1>
					</div>
				</div>				
				<!-- /.row 
				<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-info alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<i class="fa fa-info-circle"></i>  <strong>Some Alert</strong> Try out <a href="#" class="alert-link">University</a> for additional features!
						</div>
					</div>
				</div>-->

				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default medical-leave">
							<div class="panel-heading">
								<h3 class=""> <i class="fa fa-users"></i>  Flight Discount Letter </h3>
								
							</div>
							<div class="panel-body">
								<div class="container">
									<div class="stepwizard">
										<div class="stepwizard-row setup-panel">
											<div class="stepwizard-step">
												<a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
												<p>Step 1</p>
											</div>
											<div class="stepwizard-step">
												<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
												<p>Step 2</p>
											</div>
											<div class="stepwizard-step">
												<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
												<p>Step 3</p>
											</div>
										</div>
									</div>
									<?php 
										$sql = "SELECT NationalID,DoB,StudentName_en,StudentID,FirstNameA,SecondNameA,ThrdNameA FROM StudentInfo WHERE StudentID = $StudentID";
										$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
										while($row = sqlsrv_fetch_array($result)){?>
											
										
									<form role="form" action="flightpdf.php" method="post" enctype="multipart/form-data">
										<div class="row setup-content" id="step-1">
											<div class="col-xs-12">
												<div class="col-md-12">
													<!-- <h3> Step 1</h3> -->
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label class="control-label">National ID </label>
																<input maxlength="100" type="text" required="required"  name="NationalID" class="form-control" placeholder="Enter National ID" value="<?php echo $row['NationalID'];?>"  />
															</div>
															<div class="col-md-6">
																<label class="control-label">Year</label><br />
																<select class="btn-md full-width" name="year">
																	<option> 2012</option>
																	<option> 2013</option>
																	<option> 2014</option>
																	<option> 2015</option>
																</select>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label class="control-label">Issue Date</label>
																<input maxlength="100" type="text" required="required" id="datepicker12" name="IssueDate" class="form-control" placeholder="Enter Issue Date" />
															</div>
															<div class="col-md-6">
																<label class="control-label">Issue Place</label>
																<input maxlength="100" type="text" required="required" name="IssuePlace" class="form-control" placeholder="Enter Place" />	
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label class="control-label">Birth Date</label>
																<input maxlength="100" type="text" required="required" id="datepicker11" name="DoB" class="form-control" placeholder="Enter Birth Date" value="<?php echo $row['DoB'];?>" />
															</div>
															<div class="col-md-6">
																<label class="control-label">Student ID</label>
																<input maxlength="100" type="text" required="required" name="StudentID" class="form-control" placeholder="Enter Student ID" value="<?php echo $row['StudentID']?>" />	
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label class="control-label">Name</label>
																<input maxlength="100" type="text"  id="name" class="form-control" name="name" placeholder="Enter Name" value="<?php echo $row['StudentName_en'];?>" />
															</div>
															<div class="col-md-6">
																<label class="control-label">Date</label>
																<input maxlength="100" type="text" id="datepicker10" name="date" required="required" class="form-control" placeholder="Enter Date" value="" />	
															</div>
															<div class="col-md-6 pull-right">
																<label class="control-label">Signature</label>
																
																<!-- <input type="file" name="uploadedfile" id="fileToUpload">	 -->
																<div id="canvas">
																	Canvas is not supported.
																</div>

																<script>
																	signatureCapture();
																</script>
																<input type="hidden" name="sig_image" id="sig_image"/>																
																<button type="button" onclick="signatureSave()">Save Signature</button>
																<button type="button" onclick="signatureClear()">Clear Signature</button>
																		
															</div>
														</div>
													</div>
													<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
												</div>
											</div>
										</div>
										<div class="row setup-content" id="step-2">
											<div class="col-xs-12">
												<div class="col-md-12">
													<!-- <h3> Step 2</h3> -->
													<div class="">
														<br>
														<p>
															Gentlemen Arabia sales office in the city/jubali by reference to our records it became clear that the above-mentioned one of the regular students at the training center in jubail for the academic year: should it not prove the data to the beneficiary’s health code data described  above then I bear full responsibility and legal consequences of this. So it has been ratified this recognition for the issurance of discount ticket and obtaining the amount owned by the beneficiary in cash. And on this was signed.
														</p>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-4">
																<?php echo $row['FirstNameA'];?>
															</div>
															<div class="col-md-4">
																<?php echo $row['SecondNameA'];?>
															</div>
															<div class="col-md-4">
																<?php echo $row['ThrdNameA'];?>
															</div>
														</div>
													</div>
													<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
												</div>
											</div>
										</div>
										<div class="row setup-content" id="step-3">
											<div class="col-xs-12">
												<div class="col-md-12">
													<h3> General Terms</h3>
													<div class="row">
														<div class="panel-body">
															<p>
																 The origin of the model depends only on the site and be certified by the Director in charge and put your seal issue of the certificate. You must present your original family card when buying a ticket Attach a copy of the civil status/family card with the certificate. Salch model for period of two months from that date and only one person. This model is limited to students/female students who reach the age of twelve and even twenty-ninth AH only. Pay for the ticket in cash or by credit card accredited by Saudi Arbian Airlines. Signature depends on the form of the deans of student affairs/students to colleges and universities  and directors of schools and centers,institutes or on behalf of the authority them. Student beneficiary of the reduction does not function in any government or civil or military face.This reduction does not apply to trained personnel who receive training in the centers and institutes and government civil and military colleges.
															</p><br />
																<strong> I have read the above conditions</strong><br /><br />

																<strong>	Beneficiary Name</strong> : <span id="namediv"></span><br/>

																	<strong>Signature</strong>               : <!-- <span id="signdiv"></span> --><img id="saveSignature" alt="please Save Your Signature"/><br />
														</div>
														<div class="col-md-3 pull-left">
															<button class="btn btn-success btn-lg pull-left">Menu</button>
														</div>
														<div class="col-md-3 pull-right">
														<input type="submit" value="Finish" name="submit" class="btn btn-success btn-lg pull-right">
															<!--<button class="btn btn-success btn-lg pull-right" type="submit">Finish </button>
															<a href="actionpdf.php" class="btn btn-success btn-lg pull-right">Finish</a>-->
															
														</div>
													</div>
													
												</div>
											</div>
										</div>
										
									</form>
										<?php }?>
									</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.row -->

			</div>
			<!-- /.container-fluid -->
		
		</div>
		<!-- /#page-wrapper -->
	<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> 2.2.0
				</div>
				<strong>Copyright &copy; 2014-2015 <a href="#SWCC">SWCC Dashboard</a>.</strong> All rights reserved.
			</footer>
            
	<!-- jQuery 2.1.4 -->
	<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- Swcc App 
	<script src="assets/dist/js/app.min.js" type="text/javascript"></script>-->

	<script type="text/javascript">
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
	</script>
	<!-- Bootstrap Core JavaScript -->
	<!-- Script for Radio Button -->
	<script type="text/javascript">
		$('#radioBtn a').on('click', function(){
			var sel = $(this).data('title');
			var tog = $(this).data('toggle');
			$('#'+tog).prop('value', sel);
			
			$('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
			$('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
		})
	</script>

	<!-- Increase or Decrease -->
	<script type="text/javascript">
	$(document).on('click', '.number-spinner button', function () {    
	var btn = $(this),
		oldValue = btn.closest('.number-spinner').find('input').val().trim(),
		newVal = 0;
	
	if (btn.attr('data-dir') == 'up') {
		newVal = parseInt(oldValue) + 1;
	} else {
		if (oldValue > 1) {
			newVal = parseInt(oldValue) - 1;
		} else {
			newVal = 1;
		}
	}
	btn.closest('.number-spinner').find('input').val(newVal);
});
	</script>	
  	<script src="assets/dist/js/app.js"></script>
	
	<!-- For Date Checkin n Checkout -->
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>	
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  	
	<script type="text/javascript">
	$(function() {
        $( "#datepicker10" ).datepicker({       
        	dateFormat : 'yy-mm-dd',
            changeMonth : true,
            changeYear : true,
            maxDate : 'd'
        });
    });
	/*
	$(function() {
        $( "#datepicker11" ).datepicker({
            dateFormat : 'yy-mm-dd',
            changeMonth : true,
            changeYear : true,
            yearRange: '-50y:c+nn',
            maxDate: '-1d'
        });
    });*/
    $(function() {
        $( "#datepicker12" ).datepicker({   
        	dateFormat : 'yy-mm-dd',    
            changeMonth : true,
            changeYear : true,
            yearRange: '-15y:+5y'       
        });
    });
	</script>

	<!-- Wizard Form JS  -->
<script type="text/javascript">
	$(document).ready(function () {

		var navListItems = $('div.setup-panel div a'),
				allWells = $('.setup-content'),
				allNextBtn = $('.nextBtn');

		allWells.hide();

		navListItems.click(function (e) {
			e.preventDefault();
			var $target = $($(this).attr('href')),
					$item = $(this);

			if (!$item.hasClass('disabled')) {
				navListItems.removeClass('btn-primary').addClass('btn-primary');
				$item.addClass('btn-primary');
				allWells.hide();
				$target.show();
				$target.find('input:eq(0)').focus();
			}
		});

		allNextBtn.click(function(){
			var curStep = $(this).closest(".setup-content"),
				curStepBtn = curStep.attr("id"),
				nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
				curInputs = curStep.find("input[type='text'],input[type='url']"),
				isValid = true;

			$(".form-group").removeClass("has-error");
			for(var i=0; i<curInputs.length; i++){
				if (!curInputs[i].validity.valid){
					isValid = false;
					$(curInputs[i]).closest(".form-group").addClass("has-error");
				}
			}

			if (isValid)
				nextStepWizard.removeAttr('disabled').trigger('click');
		});

		$('div.setup-panel div a.btn-primary').trigger('click');
	});

	
		//alert('assssss');
		var nameval = $("#name").val();
		$('#namediv').append(nameval);
	
	$( "#signature" ).blur(function() {
		var signval = $( "#signature" ).val();
		$('#signdiv').append(signval);
	});

    
	
</script>

<script type="text/javascript">
function signatureSaving() {

	var canvas = document.getElementById("newSignature");
	var dataURL = canvas.toDataURL("image/png");
	document.getElementById("saveSignature").src = dataURL;	
	var nationalID = $('#NationalID').val();	
	var issuedat = $('#datepicker12').val();	
	var birthdat = $('#datepicker11').val();	
	var curdate = $('#datepicker10').val();	
	var place = $('#IssuePlace').val();	
	var stuId = $('#StudentID').val();	
	var stuname = $('#name').val();	
	var year = $('#year option:selected').text();

	
	var form = document.createElement("form");
	form.setAttribute("action", "js/flightpdf.php");
	form.setAttribute("enctype", "multipart/form-data");
	form.setAttribute("method", "POST");
	form.setAttribute("target", "_self");
	form.innerHTML = '<input type="text" name="image" value="' + dataURL + '"/>'
	+'<input type="text" name="nationalID" value="' + nationalID + '"/>'
	+'<input type="text" name="issuedat" value="' + issuedat + '"/>'
	+'<input type="text" name="birthdat" value="' + birthdat + '"/>'
	+'<input type="text" name="curdate" value="' + curdate + '"/>'
	+'<input type="text" name="place" value="' + place + '"/>'
	+'<input type="text" name="stuId" value="' + stuId + '"/>'
	+'<input type="text" name="stuname" value="' + stuname + '"/>'
	+'<input type="text" name="year" value="' + year + '"/>';
	form.submit();
}
</script>

</body>

</html>

