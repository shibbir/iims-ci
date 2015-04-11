<ul class="nav nav-tabs">
	<li class="active"><a href="#user-profile" data-toggle="tab">My Profile</a></li>
	<?php if($this->uri->segment(3) === $this->session->userdata('username')): ?>
    	<li><a data-target="#user-edit" class="user-edit" data-toggle="tab">Edit Profile</a></li>
    	<li><a data-target="#user-password" data-toggle="tab">Change Password</a></li>
    <?php endif;?>
</ul>

<div class="tab-content">
	<div id="user-profile" class="tab-pane fade active in">
		<div id="placeholder-user"></div>
	</div>
	<div id="user-edit" class="tab-pane fade form-container">
		<?=$this->load->view('user/modal-edit-user')?>
	</div>
	<div id="user-password" class="tab-pane fade form-container">
		<?=$this->load->view('user/modal-edit-user-password')?>
	</div>
</div>

<script id="template-user" type="text/x-handlebars-template">
	{{#if user}}
		{{#user}}
			<div class="block">
				<div class="row-fluid">
		   			<div class="span5">
		   				<h3>{{Name}}</h3>
						<p><span class="bold">Username:</span> {{UserName}}</p>
		       			<p><span class="bold">Contact:</span> {{Contact}}<p>
						<p><span class="bold">Address:</span> {{{Address}}}<p>
		   			</div>
		   			<div class="span5">
						<h3>Additional Information</h3>
		       			<p>Created By - <a href="<?=site_url('user/profile').'/{{CreatorUserName}}'?>">{{CreatorName}}</a></p>
						<p>Last Modified - {{ModifiedDate}}</p>
		   			</div>
	    		</div>
			</div>
		{{/user}}
	{{else}}
		<div class="block pager text-error"><strong>Sorry, no information found! Try reloading the page.</strong></div>
	{{/if}}
</script>

<script>
	function renderUser() {
		var form_data = {
			UserName: '<?=$this->uri->segment(3)?>'
		};
		$.fetchRemoteData('user', 'getUserByUsername', form_data).then(function (data) {
			renderHandlebarsTemplate('#template-user', '#placeholder-user', data);
			$.hideSpinner();
		});
	}
	$(function () {
		renderUser();
		$(document).on('event/userEdited', function () {
			renderUser();
		});
		$('a[data-toggle="tab"]:last').on('shown', function () {
			clearInput();
		});
	});
</script>