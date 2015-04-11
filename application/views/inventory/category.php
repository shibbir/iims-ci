<?=$this->load->view('inventory/modal/modal-add-category')?>

<div id="notification-category-delete"></div>

<a class="btn btn-success" data-target="#ModalCategoryAdd" data-toggle="modal" style="margin-bottom: 10px;">
	<i class="icon-add icon-white"></i>
	Add Category
</a>

<div id="placeholder-categoryBlock"></div>

<script id="template-categoryBlock" type="text/x-handlebars-template">
	{{#if categories}}
		<div id="container-categoryBlock">
			{{#categories}}
				<div class="block well categoryBlock" data-id="{{ID}}">
					<h3>{{CategoryName}}</h3>
					<p>
						{{#if Description}}
							{{{Description}}}
						{{else}}
							<strong>No description available.</strong>
						{{/if}}
					</p>
					<hr />
					<footer class="pull-right">
						{{#isUncategorized ID}}
							<a class="btn btn-info btn-mini disabled">
								<i class="icon-edit icon-white"></i>
									Edit
								</a>
							<a class="btn btn-danger btn-mini disabled">
								<i class="icon-trash icon-white"></i>
								<span>Delete</span>
							</a>
							{{else}}
								<a class="btn btn-info btn-mini modal-edit-category" data-target="#ModalCategoryEdit" data-toggle="modal">
									<i class="icon-edit icon-white"></i>
									Edit
								</a>
								<a class="btn btn-danger btn-mini btn-delete-category delete" data-id="{{ID}}">
									<i class="icon-trash icon-white"></i>
									<span>Delete</span>
								</a>
						{{/isUncategorized}}
					</footer>
				</div>
			{{/categories}}
		</div>
	{{else}}
		<div class="block pager text-error"><strong>Sorry, no category found!</strong></div>
	{{/if}}
</script>

<script>
	function fetchCategory() {
		$.fetchRemoteData('category', 'getCategories').then(function (data) {
			renderCategoryBlock(data);
			renderCategoryDropDown(data);
			$.hideSpinner();
		});
	}

	function renderCategoryBlock(data) {
		Handlebars.registerHelper('isUncategorized', function(CatgoryID, options) {
			if(CatgoryID == 1) {
				return options.fn(this);
			}
			return options.inverse(this);
		});
		renderHandlebarsTemplate('#template-categoryBlock', '#placeholder-categoryBlock', data);
	}

	$(function () {
		fetchCategory();

		$(document).on('click', '.btn-delete-category', function () {
			var form_data = {
				ID: $(this).data('id'),
				csrf_token: "<?=$this->security->get_csrf_hash();?>"
			};
			$.deleteRemoteData('category', 'delete', form_data).then(function (data) {
				if(data.status === 'success') {
					fetchCategory();
				}
				showNotification(data, '#notification-category-delete');
			});
		});
	});
</script>