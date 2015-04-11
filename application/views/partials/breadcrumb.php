<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<?php $n = $this->uri->total_segments();?>

<style>
	.breadcrumb {
		margin-bottom: 10px;
	}
</style>

<?php if($this->uri->segment(1) !== 'dashboard'): ?>
	<ul class="breadcrumb">
        <li><a href="<?=site_url('dashboard')?>">Home</a> <span class="divider">/</span></li>
        <?php
        for($i=1; $i<=$n; $i++):
            if($i == $n):?>
                <li class="active">
                    <?=ucwords($this->uri->segment($i))?>
                </li>
            <?php else:?>
                <li>
                    <a href="<?=site_url(((($i-1) > 0) ? $this->uri->segment($i-1).'/' : '') . $this->uri->segment($i))?>">
                        <?=ucwords($this->uri->segment($i))?>
                    </a>
                    <span class="divider">/</span>
                </li>
            <?php endif;
        endfor;?>
	</ul>
<?php endif;?>