<?php
	$menu = $this->uri->segment(2);

$idadmin = $this->session->userdata("idadmin");
if($idadmin==""){
  redirect("admin/c_auth");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BKPH - Dashboard</title>

<link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/admin/css/datepicker3.css" rel="stylesheet">

<link rel="stylesheet" href="<?php echo base_url('assets/admin/lib/select2/select2.min.css');?>">

<!--Icons-->
<script src="<?php echo base_url();?>assets/admin/js/lumino.glyphs.js"></script>
<link href="<?php echo base_url();?>assets/admin/css/styles.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/admin/css/tsf-wizard.bundle.min.css" rel="stylesheet" />

<script src="<?php echo base_url();?>assets/admin/js/jquery-1.11.1.min.js"></script>
    
<script src="<?php echo base_url();?>assets/admin/js/bootstrap-datepicker.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand"><span>BKPH</span>  STMIK AMIKOM Purwokerto</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $this->session->userdata('namaadmin');?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							
							<li><a href="<?php echo base_url('admin/c_auth/setting');?>"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
							<li><a href="<?php echo base_url('admin/c_auth/logout');?>" onclick="return confirm('Kamu yakin banget mau logout ? 😥');"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form>
			
		</form>
		<ul class="nav menu">
			<li <?php if ($menu == "c_home") { echo 'class="active"'; }?> ><a href="<?php echo base_url("admin/c_home");?>"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<li <?php if ($menu == "c_rekrutmen") { echo 'class="active"'; }?>><a href="<?php echo base_url("admin/c_rekrutmen");?>"><svg class="glyph stroked desktop"><use xlink:href="#stroked-desktop"/></svg>Rekrutmen</a></li>
			<li <?php if ($menu == "c_pelamar") { echo 'class="active"'; }?>><a href="<?php echo base_url("admin/c_pelamar");?>"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>Pelamar</a></li>
			<li <?php if ($menu == "c_kriteria") { echo 'class="active"'; }?>><a href="<?php echo base_url("admin/c_kriteria");?>"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Kriteria</a></li>
			<li <?php if ($menu == "c_penilaian") { echo 'class="active"'; }?>><a href="<?php echo base_url("admin/c_penilaian");?>"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Penilaian</a></li>
			<li <?php if ($menu == "c_proses_hitung") { echo 'class="active"'; }?> ><a href="<?php echo base_url("admin/c_proses_hitung");?>"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>Laporan</a></li>
			<li role="presentation" class="divider"></li>
		</ul>
		
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Sistem Pendukung Keputusan</li>
			</ol>
		</div><!--/.row-->
			<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?php echo $judul; ?></h1>
			</div>
		</div><!--/.row-->
			<?php $this->load->view($konten); ?>
		
	</div>	<!--/.main-->

	
	<script src="<?php echo base_url();?>assets/admin/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/admin/js/chart.min.js"></script>
	<script src="<?php echo base_url();?>assets/admin/js/chart-data.js"></script>
	<script src="<?php echo base_url();?>assets/admin/js/bootstrap-table.js"></script>
	<script src="<?php echo base_url();?>assets/admin/js/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url();?>assets/admin/js/easypiechart.js"></script>
	<script src="<?php echo base_url();?>assets/admin/js/easypiechart-data.js"></script>
	<script src="<?php echo base_url();?>assets/admin/js/bootstrap-datepicker.js"></script>
	<script>
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
	</script>	
	<script>
	  $( function() {
	    $( "#datepicker" ).datepicker({
         format: 'yyyy-mm-dd'
     	});
	  } );
  	</script>
  	
</body>

</html>
