<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simply Authentic | CMS Website</title>
    <link href="<?=base_url()?>assets/webadmin/css/bootstrap.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/webadmin/css/font-awesome.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/webadmin/css/custom-styles.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/webadmin/images/favicon.png" rel="icon" />
    <link href="<?=base_url()?>assets/webadmin/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/webadmin/css/tag.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/webadmin/css/bootstrap-datetimepicker.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/selectize/selectize.default.css" rel="stylesheet" />
	<link href="<?php echo base_url()?>assets/datepicker/css/datepicker.css" rel="stylesheet" />
	<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />-->

<!-- GRID HERE -->

</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=base_url()?>webadmin"><img src='<?=base_url()?>uploads/logow.png' height='' style='width:95px;margin-top:-10px;'></a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" style='text-transform:letter'>
                        <i class="fa fa-user fa-fw"></i> <?php echo ucwords($datasession["idUser"]);?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?=base_url()?>cms/auth/out"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
		<?php
			$now = @$this->uri->segment(3);
			$activeartikel = "";
			$activesetting = "";
			$activemember = "";
			$activeuser = "";
			$activeorder = "";
			$activestore = "";
			$activesoundroom = "";
			$activepodcast = "";
			$activenewcampaign = "";
            $activedistrict = "";
            $activesection = "";
			if($now=="kategori" || $now=="kategori-new" ||  $now=="artikel" || $now=="artikel-new" ||  $now=="kontributor" || $now=="kontributor-new" ){
				$activeartikel = "active";
			}
			if($now=="slideiag" || $now=="slideiag-new" || $now=="point" || $now=="point-new" || $now=="ticket" || $now=="ticket-new" || $now=="redeempoint" || $now=="redeempoint-new" ||  $now=="eo" || $now=="eo-new" ||  $now=="website" 
                ||  $now=="darbotz" || $now=="darbotz-new"  || $now=="darbotz-product"
				// || $now=="slidestore-new"  || $now=="slidestore"
				// || $now=="store-new"  || $now=="store"
				// || $now=="storeproduct-new"  || $now=="storeproduct"
			){
				$activesetting = "active";
			}
			if($now=="tracking" || $now=="member" || $now=="redeemmember" || $now=="historypoint" || $now=="posterchallenge" || $now=="posterchallenge-new" || $now=="designcompetition" || $now=="designcompetition-new"  || $now=="write" || $now=="write-new" || $now=="newcampaign" || $now=="newcampaign-new" ){
				$activemember = "active";
			}
			if($now=="user" || $now=="user-new" || $now=="usersp" || $now=="usersp-new" ){
				$activeuser = "active";
			}
			if($now=="order" || $now=="wanotif" || $now=="ordershow"){
				$activeorder = "active";
			}
			if($now=="store" || $now=="store-new"  || $now=="store"
                ||  $now=="darbotz" || $now=="storeproduct-new"  || $now=="storeproduct"
                || $now=="slidestore-new"  || $now=="slidestore"
                // ||  $now=="darbotz" || $now=="darbotz-new"  || $now=="darbotz-product"
            ){
				$activestore = "active";
			}
			if($now=="soundroom" || $now=="soundroom-new" || $now=="video" || $now=="video-new" || $now=="soundroom-2019" || $now=="soundroom-2022" || $now=="soundroom-2023"){
				$activesoundroom = "active";
			}
			if($now=="slidepodcast" || $now=="slidepodcast-new" || $now=="podcast" || $now=="podcast-new" ){
				$activepodcast = "active";
			}
            if($now=="slidedistrictcampaign" || $now=="slidedistrictcampaign-new" || $now=="districtcampaign" || $now=="districtcampaign-new" ){
				$activedistrict = "active";
			}

            if($now=="section" || $now=="section-new" ){
				$activesection = "active";
			}


		?>
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<?php if($datasession["group"]=="1"){?>
					<li><a href="<?=$url?>slide"><i class="fa fa-image fa-fw"></i> Home Slide</a></li>
					<?php }?>
                    <li class='<?php echo $activeartikel;?>'>
                        <a href="#"><i class="fa fa-bullhorn"></i> Artikel<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?=$url?>kontributor"><i class="fa fa-users fa-fw"></i> Kontributor</a></li>
                            <li><a href="<?=$url?>kategori"><i class="fa fa-bars fa-fw"></i> Kategori</a></li>
							<?php
								foreach($headkategori as $key=>$value){
									echo "<li><a href='".$url."artikel?k=$key'><i class='fa fa-bars fa-fw'></i> $value</a></li>";
								}
							?>
                        </ul>
                    </li>
                    <!--<li class=''><a href="<?=$url?>contact"><i class="fa fa-users"></i> Kontak</a></li> -->
                    <li class='<?php echo $activemember;?>'>
                        <a href="#"><i class="fa fa-users"></i> Member Area<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<?php if($datasession["group"]=="1"){?>
                            <li><a href="<?=$url?>member"><i class="fa fa-users"></i> Member - Aktif</a></li>
                            <li><a href="<?=$url?>member?n=1"><i class="fa fa-users"></i> Member - Non Aktif</a></li>
                            <li><a href="<?=$url?>redeemmember"><i class="fa fa-briefcase"></i> Redeem Member</a></li>
                            <li><a href="<?=$url?>historypoint"><i class="fa fa-briefcase"></i> History Point</a></li>
							<li><a href="<?=$url?>posterchallenge"><i class="fa fa-photo"></i> Poster Challenge</a></li>
							<li><a href="<?=$url?>designcompetition"><i class="fa fa-photo"></i> Design Competition</a></li>
							<li><a href="<?=$url?>newcampaign"><i class="fa fa-photo"></i> New Campaign</a></li>
							<li><a href="<?=$url?>tracking"><i class="fa fa-photo"></i> Tracking Point</a></li>
							<?php }?>
							<li><a href="<?=$url?>write"><i class="fa fa-edit"></i> Write Article</a></li>
                        </ul>
                    </li>
                    <li class='<?php echo $activesoundroom;?>'>
                        <a href="#"><i class="fa fa-play"></i> Soundroom<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li><a href="<?=$url?>soundroom-2023"><i class="fa fa-play"></i> Soundroom 2023</a></li>
							<li><a href="<?=$url?>soundroom-2022"><i class="fa fa-play"></i> Soundroom 2022</a></li>
							<li><a href="<?=$url?>soundroom-2019"><i class="fa fa-play"></i> Soundroom 2019</a></li>
							<li><a href="<?=$url?>video"><i class="fa fa-photo"></i> Video</a></li>
                        </ul>
                    </li>
					<?php if($datasession["group"]=="1"){?>
                    <li class='<?php echo $activeorder;?>'>
                        <a href="#"><i class="fa fa-dollar"></i> Order<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li><a href="<?=$url?>order"><i class="fa fa-dollar"></i> Order - Aktif</a></li>
							<li><a href="<?=$url?>order?n=1"><i class="fa fa-dollar"></i> Order - Non Aktif</a></li>
							<li><a href="<?=$url?>wanotif"><i class="fa fa-whatsapp"></i> Hosting WA</a></li>
                        </ul>
                    </li>
                    <li class='<?php echo $activestore;?>'>
                        <a href="#"><i class="fa fa-tag"></i> Store<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li><a href="<?=$url?>store"><i class="fa fa-tag"></i> List</a></li>
							<li><a href="<?=$url?>storeproduct"><i class="fa fa-tag"></i> Product</a></li>
							<li><a href="<?=$url?>slidestore"><i class="fa fa-image"></i> Slide</a></li>
                            <!-- <li><a href="<?=$url?>darbotz"><i class="fa fa-tag"></i> Darbotz Product</a></li> -->
                        </ul>
                    </li>
                    <li class='<?php echo $activesetting;?>'>
                        <a href="#"><i class="fa fa-gear"></i> Setting<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li><a href="<?=$url?>eo"><i class="fa fa-users"></i> EO</a></li>
							<li><a href="<?=$url?>ticket"><i class="fa fa-ticket"></i> Ticket Box - Aktif</a></li>
							<li><a href="<?=$url?>ticket?n=1"><i class="fa fa-ticket"></i> Ticket Box - Non Aktif</a></li>
							<li><a href="<?=$url?>redeempoint"><i class="fa fa-briefcase"></i> Redeem Point</a></li>
                            <li><a href="<?=$url?>point"><i class="fa fa-heart fa-fw"></i> Jenis Point</a></li>
                            <li><a href="<?=$url?>darbotz"><i class="fa fa-tag"></i> Darbotz Product</a></li>
                            <li><a href="<?=$url?>slideiag"><i class="fa fa-tag"></i> Slide IniAsliGue</a></li>
                            <!-- <li><a href="<?=$url?>slidestore"><i class="fa fa-tag"></i> Slide Store</a></li>
                            <li><a href="<?=$url?>store"><i class="fa fa-tag"></i> Store</a></li> -->
                            <li><a href="<?=$url?>website"><i class="fa fa-globe fa-fw"></i> Website</a></li>
                        </ul>
                    </li>
                    <li class='<?php echo $activepodcast;?>'>
                        <a href="#"><i class="fa fa-bullhorn"></i> Podcast<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?=$url?>slidepodcast"><i class="fa fa-tag"></i> Slide Podcast</a></li>
                            <li><a href="<?=$url?>podcast"><i class="fa fa-tag"></i> Podcast</a></li>

                        </ul>
                    </li>

                    <li class='<?php echo $activedistrict;?>'>
                        <a href="#"><i class="fa fa-bullhorn"></i> Campaign Page<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <!-- <li><a href="<?=$url?>slidedistrictcampaign"><i class="fa fa-tag"></i> Slide</a></li>    -->
                            <li><a href="<?=$url?>section"><i class="fa fa-tag"></i> Campaign Page Setting</a></li>
                            <li><a href="<?=$url?>districtcampaign"><i class="fa fa-tag"></i> Campaign Video List</a></li>
                        </ul>
                    </li>

					<?php }?>
                    <!--<li>
                        <a href="<?=$url?>contact"><i class="fa fa-envelope"></i> List Contact</a>
					</li>-->
					<?php
						if($datasession["isSuperAdmin"]=="1"){
					?>
                    <li class='<?php echo $activeuser;?>'>
                        <a href="#"><i class="fa fa-lock"></i> User<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?=$url?>user"><i class="fa fa-bars fa-fw"></i> Website</a></li>
                            <li><a href="<?=$url?>usersp"><i class="fa fa-bars fa-fw"></i> Sales Promotion</a></li>
                        </ul>
                    </li>
					<?php }?>
					<!--<li><a href="https://panel.capiwha.com/show_user_qr.php?userapikey=N1RKSEo%3D&refresh=1&width=30%25" target='_blank'><i class="fa fa-whatsapp fa-fw"></i> Phone WA</a></li>-->

                </ul>

            </div>

        </nav>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
