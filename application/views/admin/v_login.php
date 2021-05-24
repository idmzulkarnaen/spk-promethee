<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Admin</title>

<link href="<?php echo base_url('assets/admin/css/bootstrap.min.css');?>" rel="stylesheet">
<link href="<?php echo base_url('assets/admin/css/datepicker3.css');?>" rel="stylesheet">
<link href="<?php echo base_url('assets/admin/css/styles.css');?>" rel="stylesheet">

<script src="<?php echo base_url('assets');?>/js/lumino.glyphs.js"></script>
<!--[if lt IE 9]>
<script src="<?php echo base_url('assets/admin/js/html5shiv.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/respond.min.js');?>"></script>
<![endif]-->

</head>

<body>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading text-center">LOGIN <span style="color: #AB47BC">ADMIN</span></div>
				<div class="panel-body">
					<?php 
				    $peringatan = $this->session->flashdata('peringatan');
				    if($peringatan!=""){
				      echo $peringatan;
				    }
				    ?>
					<form role="form" method="post" action="<?php echo base_url('admin/c_auth/loginproses');?>" id="formlogin">
						<fieldset>
							<div class="form-group has-feedback">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="">
								<span class="text-warning" id="text-warning1" ></span>
							</div>
							<div class="form-group has-feedback">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
								<span class="text-warning" id="text-warning2" ></span>
							</div>
							<div class="text-center">
								<hr>
								<input type="submit" name="submit" value="Login" class="btn btn-primary"/>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	<script src="<?php echo base_url('assets/admin/js/jquery-1.11.1.min.js');?>"></script>
	<script src="<?php echo base_url('assets/admin/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/admin/js/chart.min.js');?>"></script>
	<script src="<?php echo base_url('assets/admin/js/chart-data.js');?>"></script>
	<script src="<?php echo base_url('assets/admin/js/easypiechart.js');?>"></script>
	<script src="<?php echo base_url('assets/admin/js/easypiechart-data.js');?>"></script>
	<script src="<?php echo base_url('assets/admin/js/bootstrap-datepicker.js');?>"></script>
	<script>
		$(document).ready(function(){
			$('#formlogin').submit(function(){
            var valid=true;
            var no = 1;     
            $(this).find('.form-control').each(function(){
                if (!$(this).val()){
                    get_error_text(this);
                    valid = false;
                    $('html,body').animate({scrollTop: 0},"slow");
                } 
                if ($(this).hasClass('no-valid')){
                    valid = false;
                    $('html,body').animate({scrollTop: 0},"slow");
                }
                no++;
            });
            if(valid){
                return true;
            }else{
                return false;
            }
			});

		});
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})

		function apply_feedback_error(textbox){
	        $(textbox).addClass('no-valid'); //menambah class no valid
	        $(textbox).parent().find('.text-warning').show();
	        $(textbox).closest('div').removeClass('has-success');
	        $(textbox).closest('div').addClass('has-warning');
	    }
		function get_error_text(textbox){
	        $(textbox).parent().find('.text-warning').text("");
	        $(textbox).parent().find('.text-warning').text("Harus diisi !");
	        return apply_feedback_error(textbox);
	    }
	</script>	
</body>

</html>
