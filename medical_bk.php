<?php
include("includes/header.php");

?>
	<!-- Page level CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/common/wizard.css">
		<div class="content-wrapper">

			<div class="container-fluid">

				<!-- Page Heading -->
				<div class="row">
					<div class="content-header">
						<h1 class="page-header">
							Medical Leave
						</h1>
					</div>
				</div>
				<!-- /.row -->

				<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-info alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<i class="fa fa-info-circle"></i>  <strong>Some Alert</strong> Try out <a href="#" class="alert-link">University</a> for additional features!
						</div>
					</div>
				</div>
				<!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default medical-leave">
							<div class="panel-heading">
								<h3 class=""> <i class="fa fa-users"></i>  Medical Leave </h3>
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
									<form role="form" action="medicalpdf.php" method="post">
										<div class="row setup-content" id="step-1">
											<div class="col-xs-12">
												<div class="col-md-12">
													<h3> Step 1</h3>
													<div class="form-group">
														<label class="control-label">First Name</label>
														<input  maxlength="100" type="text" name="Firstname" required="required" class="form-control" placeholder="Enter First Name"  />
													</div>
													<div class="form-group">
														<label class="control-label">Last Name</label>
														<input maxlength="100" type="text" required="required" name="lastname" class="form-control" placeholder="Enter Last Name" />
													</div>
													<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
												</div>
											</div>
										</div>
										<div class="row setup-content" id="step-2">
											<div class="col-xs-12">
												<div class="col-md-12">
													<h3> Step 2</h3>
													<div class="form-group">
														<label class="control-label">Company Name</label>
														<input maxlength="200" type="text" required="required" name="companyname" class="form-control" placeholder="Enter Company Name" />
													</div>
													<div class="form-group">
														<label class="control-label">Company Address</label>
														<input maxlength="200" type="text" required="required" name="companyaddress" class="form-control" placeholder="Enter Company Address"  />
													</div>
													<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
												</div>
											</div>
										</div>
										<div class="row setup-content" id="step-3">
											<div class="col-xs-12">
												<div class="col-md-12">
													<h3> Step 3</h3>
													<button class="btn btn-success btn-lg pull-right" type="submit">Finish!</button>
												</div>
											</div>
										</div>
									</form>
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

	<!-- jQuery -->
	<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- Swcc App -->
	<script src="assets/dist/js/app.min.js" type="text/javascript"></script>


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
	

	<!-- For Date Checkin n Checkout -->
	<script src="assets/plugins/transports/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/plugins/transports/bootstrap-datepicker.css" />
	<script>
		var nowTemp = new Date();
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

		var checkin = $('#dp1').datepicker({
			beforeShowDay: function (date) {
				return date.valueOf() >= now.valueOf();
			},
			autoclose: true
		}).on('changeDate', function (ev) {
			if (ev.date.valueOf() > checkout.datepicker("getDate").valueOf() || !checkout.datepicker("getDate").valueOf()) {
				var newDate = new Date(ev.date);
				newDate.setDate(newDate.getDate() + 1);
				checkout.datepicker("update", newDate);
			}
			$('#dp2')[0].focus();
		});

		var checkout = $('#dp2').datepicker({
			beforeShowDay: function (date) {
				if (!checkin.datepicker("getDate").valueOf()) {
					return date.valueOf() >= new Date().valueOf();
				} else {
					return date.valueOf() > checkin.datepicker("getDate").valueOf();
				}
			},
			autoclose: true
		}).on('changeDate', function (ev) {});
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
				navListItems.removeClass('btn-primary').addClass('btn-default');
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
</script>
</body>

</html>

