<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<?php if($this->session->flashdata('success_msg') != ''):?>
	<div class="alert alert-success">
	    <?=$this->session->flashdata('success_msg')?>
	</div>
<?php endif;?>

<?php if ($this->session->flashdata('info_msg') != ''):?>
	<div class="alert alert-info">
	    <?=$this->session->flashdata('info_msg')?>
	</div>
<?php endif;?>