<div id="placeholder-todo"></div>

<script id="template-todo" type="text/x-handlebars-template">
	{{#if todo}}
		{{#todo}}
			<div>
				<p><span class="label label-important">Mobile</span> {{Mobile}}</p>
				<p><span class="label label-important">Phone</span> {{Phone}}</p>
				<p><span class="label label-info">Email</span> {{Email}}</p>
			</div>
		{{/todo}}
	{{else}}
		<div class="pager text-error"><strong>Your todo list is empty.</strong></div>
		<a data-target="#ModalToDoAdd" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-plus icon-white icon-large"></i> Add Item</a>
	{{/if}}
</script>

<script>
	function renderToDoList() {
		$.fetchRemoteData('user', 'getToDoList').then(function (data) {
			renderHandlebarsTemplate('#template-todo', '#placeholder-todo', data);
			$.hideSpinner();
		});
	}
	$(function() {
		renderToDoList();
	});
</script>