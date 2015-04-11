<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang=en>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="description" content="IIMS is a simple easy-to-use, online inventory and invoice management system that also help you manage your customers, employees, products." />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title><?=$title?></title>

        <link rel="icon" type="image/png" href="<?=base_url('content/img/favicon.png')?>" />

        <link rel="stylesheet" href="<?=base_url('content/css/all.min.css')?>" />

        <!--[if IE 7]>
		<link rel="stylesheet" href="<?=base_url('content/css/font-awesome-ie7.min.css')?>">
		<![endif]-->

        <!--[if lt IE 9]>
        <script src="<?=base_url('content/js/libs/html5.js')?>"></script>
        <![endif]-->

        <script src="<?=base_url('content/js/libs/jquery-2.1.0.min.js')?>"></script>
    </head>
    <body>
    	<div id="container-spinner" class="hide">
			<div id="spinner"></div>
			<div class="pager">Loading Content ...</div>
		</div>
    	<div class="navbar navbar-fixed-top">
			<div class="navbar-inner" style="padding-left: 10px;padding-right: 10px;">
            	<div class="container-fluid">
                	<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    	<span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                	</a>
                    <a class="brand" href="<?=site_url('welcome')?>">
                        Inventory &amp; Invoice Management System
                        <span class="label label-success">beta</span>
                    </a>
					<div class="btn-group pull-right right">
                    	<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                        	<i class="icon-user"></i> <?=$this->session->userdata('auth_name')?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
							<li><a href="<?=site_url('user/profile').'/'.$this->session->userdata('username')?>"><i class="icon-pencil"></i> Profile</a></li>
							<li><a href="<?=site_url('user/notification')?>"><i class="icon-bell-alt"></i> Notification</a></li>
							<li class="divider"></li>
							<li><a href="<?=site_url('welcome/logout')?>"><i class="icon-off"></i> Sign Out</a></li>
                       </ul>
					</div>
                    <div class="nav-collapse">
						<ul class="nav">
							<li class="<?=active_url_class('dashboard')?>"><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
							<li class="<?=active_url_class('user')?>"><a href="<?=site_url('user')?>">User</a></li>
                            <li class="<?=active_url_class('customer')?>"><a href="<?=site_url('customer')?>">Customer</a></li>
                            <li class="<?=active_url_class('inventory')?>"><a href="<?=site_url('inventory')?>">Inventory</a></li>
							<li class="<?=active_url_class('invoice')?>"><a href="<?=site_url('invoice')?>">Invoice</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
        	</div>
        </div>

		<div class="container">
			<div class="row-fluid">
				<div class="span12">
                    <?=$this->load->view('partials/breadcrumb')?>
                    <?=$content?>
				</div>
			</div><hr />
			<p class="pull-right">
            	Copyright &copy;
           		<?=(2013 == date('Y')) ? 2013 : "2013 &#8211; " . date('Y')?>
                <a href="http://shibbir.net/" target="blank">Shibbir Ahmed</a>. All rights reserved.
			</p>
        </div>
        <script src="<?=base_url('content/js/all.min.js')?>"></script>
    </body>
</html>