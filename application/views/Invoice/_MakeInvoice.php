<?=$this->load->view('customer/modal-add-customer')?>
<?=$this->load->view('customer/modal-edit-customer')?>
<?=$this->load->view('inventory/modal/modal-add-inventory')?>

<div id="notification-invoice-add"></div>

<div class="row-fluid">
   	<div class="span4" style="min-height:450px;">
   		<div class="control-group">
   			<label class="control-label" for="ProductCategory">Product Category</label>
   			<div class="controls">
    			<div class="placeholder-category-dropdown"></div>
   			</div>
   		</div>
   		<div id="placeholder-inventory">
			<table id="inventory-grid">
	 			<thead>
					<tr>
		          		<th>Title</th>
		          		<th>UnitPrice</th>
		          		<th>Action</th>
		      		</tr>
		  		</thead>
		  		<tbody>
					<tr>
						<td colspan="3"></td>
					</tr>
				</tbody>
	 		</table>
   		</div>
   	</div> <!-- product container -->

   	<div class="span8" style="min-height:450px;">
		<div class="row-fluid">
			<div class="span8">
				<div class="control-group">
					<label class="control-label" for="Date">Transaction Date</label>
					<input id="datePicker" />
				</div>
			</div>
			<div class="span4">
				<div class="control-group pull-right">
					<label class="control-label" for="InvoiceType">Invoice Type</label>
					<select class="InvoiceType">
						<option value="Regular Sale">Regular Sale</option>
						<option value="Cash Sale">Cash Sale</option>
					</select>
				</div>
			</div>
		</div>

		<div class="pager msg-for-empty-bag block" style="margin-top: 0px;">
			<strong>No product added yet.</strong>
			<div class="pull-right">
				<a class="btn btn-info modal-add-inventory" data-target="#ModalInventoryAdd" data-toggle="modal">
					<i class="icon-plus icon-white"></i>
					Add Product
				</a>
			</div>
		</div>
   		<div class="pager hide bag block" style="margin-top: 0px;">
    		<table class="table table-hover tbl-shoppingBag">
				<thead>
		        	<tr>
		        		<th>SN</th>
		                <th>Product Name</th>
		                <th>Warranty</th>
						<th>Unit Price</th>
		                <th>Quantity</th>
		                <th>Total Price</th>
		                <th>Action</th>
		            </tr>
		        </thead>
				<tbody></tbody>
			</table>
			<div class="pull-right">
				<a class="btn btn-info modal-add-inventory" data-target="#ModalInventoryAdd" data-toggle="modal">
					<i class="icon-plus icon-white"></i>
					Add Product
				</a>
			</div>
		</div>

   		<form action="#" class="form-horizontal invoice-add-form">

   			<div class="row-fluid">

				<div class="span7 block" style="min-height: 180px;padding: 10px;">

					<div class="containerCustomerForRegularSale">
						<div class="control-group">
							<div class="input-append">
								<input type="text" class="input-medium customer-contact" placeholder="Enter customer mobile" />
								<button class="btn btn-check-customer" type="button">Search!</button>
							</div>
						</div>

						<div class="pager msg-for-empty-customer"><strong>No customer added yet.</strong></div>
						<div id="placeholder-customer"></div>
						<a class="btn btn-success" data-target="#ModalCustomerAdd" data-toggle="modal">
							<i class="icon-plus icon-white"></i>
							<span>Add a customer</span>
						</a>
					</div>
					<div class="containerCustomerForCashSale hide">
						<div class="control-group">
					        <label class="control-label" for="CustomerNameForCashSale">Customer Name</label>
					        <div class="controls">
					            <input type="text" name="CustomerNameForCashSale" class="input-large CustomerNameForCashSale" />
					        </div>
					    </div>
						<div class="control-group">
					        <label class="control-label" for="CustomerMobileForCashSale">Mobile Number</label>
					        <div class="controls">
					            <input type="text" name="CustomerMobileForCashSale" class="input-large" />
					        </div>
					    </div>
					</div>
				</div>

				<div class="span5 block" style="height: 180px; padding: 10px;text-align: right;">
					<div class="control-group" style="margin-bottom: 10px;">
				        <label class="control-label" for="ServiceCharge">Service Charge</label>
				        <div class="controls">
				            <input type="number" name="ServiceCharge" class="input-medium currency" id="service-charge" />
				        </div>
				    </div>
				    <div class="control-group" style="margin-bottom: 10px;">
				        <label class="control-label" for="TotalDiscount">Total Discount</label>
				        <div class="controls">
				            <input type="number" name="TotalDiscount" class="input-medium currency" id="total-discount" />
				        </div>
				    </div>
				    <div class="control-group" style="margin-bottom: 10px;">
				        <label class="control-label" for="VAT">VAT</label>
				        <div class="controls">
				            <input type="number" name="VAT" class="input-medium currency" id="vat" />
				        </div>
				    </div>
	    			<div class="control-group" style="margin-bottom: 10px;">
				        <label class="control-label" for="GrandTotal">Grand Total</label>
				        <div class="controls">
				        	<span class="input-medium uneditable-input clear-input" id="grand-total-label"></span>
				        </div>
				    </div>
				</div>
			</div>

		    <div class="modal-footer">
		    	<div class="printNow"></div>
        		<button type="button" class="btn-add-invoice btn btn-success btn-ajax">
            		<i class="icon-shopping-cart icon-large icon-white"></i> Create Invoice
        		</button>
        		<button type="button" class="btn btn-success btn-loading hide"><i class="icon-spinner icon-spin"></i> loading...</button>
        	</div>
	    </form> <!-- invoice form -->
   	</div>
</div>

<script id="template-inventory" type="text/x-handlebars-template">
	<tr>
		<td>{{Title}}</td>
  		<td>{{UnitPrice}} Tk</td>
  		<td>
  			{{#isAvailable ID Status}}
				<button type="button" class="btn btn-mini btn-addToBag" data-product-id={{ID}}>Add</button>
			{{else}}
				<button type="button" class="btn btn-mini btn-addToBag" data-product-id={{ID}} disabled>Add</button>
			{{/isAvailable}}
  		</td>
	</tr>
</script>

<script id="template-customer" type="text/x-handlebars-template">
	{{#if customer}}
		{{#customer}}
			<table class="table table-hover">
				<thead>
	        		<tr>
	                	<th>Name</th>
						<th>Contact</th>
						<th>Action</th>
	            	</tr>
	        	</thead>
				<tbody>
					<tr>
						<td>{{CustomerName}}</<td>
						<td>{{{Contact}}}</td>
						<td>
							<a class="btn btn-link btn-mini customer-edit-modal" data-target="#ModalCustomerEdit" data-id="{{ID}}" data-toggle="modal">Edit</a>
							<a class="btn btn-link red btn-mini btn-discard-customer">Remove</a>
						</td>
					</tr>
					<input type="hidden" name="CustomerID" value="{{ID}}" class="CustomerIDForRegularSale" />
				</tbody>
			</table>
		{{/customer}}
	{{else}}
		<p><strong class="text-error">Invalid customer contact. Please try again or add a new customer.</strong></p>
	{{/if}}
</script>

<script>
	$(function () {
		var addedProductList = [], productList;

		/*
		| -------------------------------------------------------------------
		| RESET-INVOICE-SECTION
		| -------------------------------------------------------------------
		| Reset everything in the invoice section
		|
		*/
		function clearSaleBag() {
			addedProductList = [];
			$('.invoice-add-form').find('input[type=hidden]').remove();
			checkBagStatus();
		}
		$('a[data-toggle="tab"]:last').on('shown', function () {
			resetInvoice();
			$('.printNow').empty();
		});

		function resetInvoice() {
			clearInput();
			$('#placeholder-customer').empty();
			fetchCategoryForInvoice();
			renderInventoryList(1);
			/* empty the product sale bag. but it required to remove all the product list from the DOM if any */
			$('.tbl-shoppingBag tbody').empty();
			clearSaleBag();
		}

		/*
		| -------------------------------------------------------------------
		| PRODUCT-INVENTORY ( LEFT-SIDE )
		| -------------------------------------------------------------------
		| Following blocks of code are responsible only for product inventory.
		|
		| The user can select a product to add to the invoice list for sale.
		|
		*/
		function renderInventoryList(categoryId) {
			var form_data = {
				CategoryID: categoryId
			};
			Handlebars.registerHelper('isAvailable', function(ID, Status, options) {
				if($.inArray(parseInt(ID), addedProductList) === -1 && Status == 'Yes') {
					return options.fn(this);
				}
				else return options.inverse(this);
			});
			$.fetchRemoteData('inventory', 'getInventory', form_data).then(function (data) {
				$.hideSpinner();
                productList = data;
				var template = Handlebars.compile($('#template-inventory').html());
				var dataSource = new kendo.data.DataSource({
				      data: data,
				      pageSize: 10
				});

				var grid = $('#inventory-grid').data('kendoGrid');

				if(grid === undefined) {
					$('#inventory-grid').kendoGrid({
						filterable: false,
						sortable: false,
		     			scrollable: true,
		     			pageable: {
		     				info: true
		     			},
		     			scrollable: false,
		     			rowTemplate: function(data) {
			                return template(data);
			            },
			            dataSource: dataSource
					});
				}
				else {
					grid.setDataSource(dataSource);
					grid.refresh();
				}
			});
		}
		function addProductToBag(product) {
            var i = 0, productRow = [];
            productRow[i++] = '<tr data-product-id="' + product.ID + '">';
            productRow[i++] = '<td class="serial"></td>';
            productRow[i++] = '<td>' + product.Title + '</td>';
            productRow[i++] = '<td>' + product.Warranty + '</td>';
            productRow[i++] = '<td class="unit-price">' + product.UnitPrice + '</td>';
            productRow[i++] = '<td>';
            productRow[i++] = '<select class="input-mini productQty">';
            for(var k = 1; k <= product.Quantity; k++) {
                productRow[i++] = '<option>' + k + '</option>';
            }
            productRow[i++] = '</select>';
            productRow[i++] = '</td>';
            productRow[i++] = '<td class="net-price">' + product.UnitPrice + '</td>';
            productRow[i++] = '<td><button type="button" class="btn btn-mini btn-danger btn-discard-product">Discard</button></td>';
            productRow[i++] = '</tr>';

            productRow[i++] = '<tr data-product-id="' + product.ID + '" data-product-id-serial="' + product.ID + '">';
            productRow[i++] = '<td style="text-align:right;border:none;" colspan="7" class="productSerialFields">';
            productRow[i++] = '<div class="input-prepend"><span class="add-on">Serial Number</span>';
            productRow[i++] = '<input type="text" class="input-medium serialNumberField" placeholder="Enter product serial" />';
            productRow[i++] = '</div></td></tr>';

            $('.tbl-shoppingBag tbody').append(productRow.join(''));

            /* now append these product information to the form */
            $('<input>').attr({type: 'hidden', name: 'ProductID[]', value: product.ID, 'data-product-id': product.ID}).appendTo('.invoice-add-form');
            $('<input>').attr({type: 'hidden', name: 'Quantity[]', value: 1, 'class': 'productQty', 'data-product-id': product.ID}).appendTo('.invoice-add-form');
            $('<input>').attr({type: 'hidden', name: 'SerialNumber[]', 'class': 'form-productSerial', 'data-product-id': product.ID}).appendTo('.invoice-add-form');

            addedProductList.push(parseInt(product.ID));
            updateSerialForAddedProduct();
            updateGrandTotal();
            checkBagStatus();
            $.hideSpinner();
		}
		$(document).on('change', '.category-handler-for-inventory', function () {
			if($(this).val()) {
				renderInventoryList($(this).val());
			}
		});
		$(document).on('click', '.btn-addToBag', function () {
			/* add that particular item to the bag */
			$(this).attr('disabled', true);
            var productId = $(this).data('productId');

            var filteredItem = $.grep(productList, function(product) {
                return productId == product.ID;
            });

			addProductToBag(filteredItem[0]);
		});

		/*
		| -------------------------------------------------------------------
		| CUSTOMER-SECTION
		| -------------------------------------------------------------------
		| Following blocks of code are responsible only for customer section.
		|
		*/
		function renderCustomerDetails(form_data) {
			$('.msg-for-empty-customer').hide();
			$.fetchRemoteData('customer', 'getCustomerByContact', form_data).then(function (data) {
				renderHandlebarsTemplate('#template-customer', '#placeholder-customer', data);
				$.hideSpinner();
			});
		}
		$(document).on('click', '.btn-check-customer', function () {
			/* retrieve customer information if any */
			var form_data = {
				Contact: $('.customer-contact').val()
			};
			renderCustomerDetails(form_data);
		});
		$(document).on('click', '.btn-discard-customer', function () {
			/* remove the selected customer */
			$('#placeholder-customer').empty();
			$('.msg-for-empty-customer').show();
		});
		$(document).on('change', '.InvoiceType', function () {
			var invoiceType = $(this).find(':selected').val();
			if(invoiceType.toLowerCase() === 'regular sale') {
				$('.containerCustomerForCashSale').hide();
				$('.containerCustomerForRegularSale').show();
			}
			else {
				$('.containerCustomerForCashSale').show();
				$('.containerCustomerForRegularSale').hide();
			}
		});
		$(document).on('event/customerAdded', function () {
			if(IIMSApp.newlyCreatedCustomerId !== 0) {
				var form_data = {
					ID: IIMSApp.newlyCreatedCustomerId
				};
				renderCustomerDetails(form_data);
			}
	    });
	    $(document).on('event/customerEdited', function () {
			if(IIMSApp.newlyEditedCustomerId !== 0) {
				var form_data = {
					ID: IIMSApp.newlyEditedCustomerId
				};
				renderCustomerDetails(form_data);
			}
	    });
	    $('#ModalCustomerAdd').on('shown', function () {
			clearInput();
		});

		/*
		| -------------------------------------------------------------------
		| INVOICE-SECTION
		| -------------------------------------------------------------------
		| Following blocks of code are responsible only for invoice section.
		|
		| User can change product quantity, discard the added product, add
		| discount charge etc.
		|
		*/
		function updateSerialForAddedProduct() {
			$('.serial').each(function (index) {
				$(this) .text(index + 1);
			});
		}
		function getServiceCharge() {
			var serviceCharge = parseFloat($('#service-charge').val());
			if(!isNaN(serviceCharge)) return serviceCharge;
			return 0;
		}
		function getTotalDiscount() {
			var totalDiscount = parseFloat($('#total-discount').val());
			if(!isNaN(totalDiscount)) return totalDiscount;
			return 0;
		}
		function getVAT() {
			var vat = parseFloat($('#vat').val());
			if(!isNaN(vat)) return vat;
			return 0;
		}
		function updateGrandTotal() {
			var totalProductPrice = 0;
			var variablePrice = getServiceCharge() + getVAT() - getTotalDiscount();
			var netPriceCollection = $('.net-price');
			netPriceCollection.each(function () {
				totalProductPrice += parseFloat($(this).text());
			});
			$('#grand-total-label').text(variablePrice + totalProductPrice);
		}
		function updateProductSerialInputField(qty, container) {
			var productId = $(container).data('productId');
			$('.tbl-shoppingBag').find('tr').filter(function () {
				return productId == $(this).data('productIdSerial');
			}).remove();

			var k = 0;
			var productSerialInputField = [];
			for (var i = 0; i < qty; i++) {
				productSerialInputField[k++] = '<tr data-product-id="' + productId + '" data-product-id-serial="' + productId + '">';
			    productSerialInputField[k++] = '<td style="text-align:right;border:none;" colspan="7" class="productSerialFields">';
			    productSerialInputField[k++] = '<div class="input-prepend"><span class="add-on">Serial Number</span>';
			    productSerialInputField[k++] = '<input type="text" class="input-medium serialNumberField" placeholder="Enter product serial" />';
			    productSerialInputField[k++] = '</div></td></tr>';
			}

			$(container).after(productSerialInputField.join(''));
		}
		function checkBagStatus() {
			if($('.tbl-shoppingBag tbody tr').length) {
				$('.bag').show();
				$('.msg-for-empty-bag').hide();
			}
			else {
				$('.bag').hide();
				$('.msg-for-empty-bag').show();
			}
		}
		$(document).on('change', '.productQty', function () {
			/* update the hidden form */
			var productId = $(this).parents('tr').data('productId');
			var qty = $(this).val();
			$('.invoice-add-form').find('.productQty').filter(function () {
				return productId == $(this).data('productId');
			}).val(qty);
			/* product quantity is changed. hence update the total amount */
			var qty = parseInt($(this).val());
			var unitPrice = parseFloat($(this).parent().siblings('td.unit-price').text());
			$(this).parent().siblings('td.net-price').text(qty * unitPrice);
			updateGrandTotal();
			updateProductSerialInputField(qty, $(this).parents('tr'));
		});
		$('#service-charge').on('keyup', function () {
			updateGrandTotal();
		});
		$('#total-discount').on('keyup', function () {
			updateGrandTotal();
		});
		$('#vat').on('keyup', function () {
			updateGrandTotal();
		});
		$(document).on('click', '.btn-discard-product', function () {
			/* discard the item from shopping bag */
			/* first enable the corresponding add to bag button so the product can be added again */
			var button = $(this);
			var productId = button.parents('tr').data('productId');
			var totalAddToBagBtn = $('.btn-addToBag');
			totalAddToBagBtn = $.grep(totalAddToBagBtn, function(btn) {
				return productId == $(btn).data('productId');
			});
			$(totalAddToBagBtn).removeAttr('disabled');
			/* now remove the product from DOM */
			$('.tbl-shoppingBag tbody').find('tr').filter(function () {
				return productId == $(this).data('productId');
			}).remove();
			/* as well as the hidden inputs */
			$('.invoice-add-form').find('input[type=hidden]').filter(function () {
				return productId == $(this).data('productId');
			}).remove();
			/* and also from global product list array */
			var index = addedProductList.indexOf(productId);
			addedProductList.splice(index, 1);
			updateGrandTotal();
			checkBagStatus();
		});
		$(document).on('click', '.modal-add-inventory', function () {
			/* user can add product during the invoice creation. so first reset everything in the inventory add modal */
			resetAddInventory();
		});
		$(document).on('event/inventoryAdded', function () {
			/* the product may be uploaded. add that product to the invoice bag */
			var productId = IIMSApp.newlyCreatedProductId, form_data = { ID: productId };
			$.fetchRemoteData('inventory', 'getInventoryById', form_data).then(function (data) {
				addProductToBag(data.inventory[0]);
			});
	    });
		$(document).on('click', '.btn-add-invoice', function () {
			var invoiceType = $('.InvoiceType').find(':selected').val(),
			datePickerObj = $('#datePicker').data('kendoDatePicker'),
			invoiceDate = kendo.toString(datePickerObj.value(), "dd MMMM, yyyy"),
			regularSale = true;

			$('.invoice-add-form').find('input[type=hidden].InvoiceDateInput').remove();
			$('.invoice-add-form').find('input[type=hidden].GrandTotalInput').remove();
			$('.invoice-add-form').find('input[type=hidden].InvoiceTypeInput').remove();
			$('.invoice-add-form').find('input[type=hidden].DummyInput').remove();

			$('<input>').attr({'class': 'InvoiceDateInput', type: 'hidden', name: 'Date', value: invoiceDate}).appendTo('.invoice-add-form');
			$('<input>').attr({'class': 'GrandTotalInput', type: 'hidden', name: 'GrandTotal', value: $('#grand-total-label').text()}).appendTo('.invoice-add-form');
			$('<input>').attr({'class': 'InvoiceTypeInput', type: 'hidden', name: 'InvoiceType', value: invoiceType}).appendTo('.invoice-add-form');

			if(invoiceType.toLowerCase() === 'regular sale') {
				if($('.CustomerIDForRegularSale').length) {
					$('<input>').attr({type: 'hidden', name: 'Customer', value: 'dummy', 'class': 'DummyInput'}).appendTo('.invoice-add-form');
				}
			}
			else {
				regularSale = false;
				var CustomerNameForCashSale = $.trim($('.CustomerNameForCashSale').val());
				$('<input>').attr({type: 'hidden', name: 'Customer', value: CustomerNameForCashSale, 'class': 'DummyInput'}).appendTo('.invoice-add-form');
			}

			$('.serialNumberField').each(function () {
				var $this = $(this);
				var productId = $this.parents('tr').data('productIdSerial');
				var serial = $this.val();

				$('.form-productSerial').each(function () {
					var formProductSerial = $(this),
					currentValue = formProductSerial.val(),
					separator = '';
					if(productId == formProductSerial.data('productId')) {
						if(currentValue !== '' && currentValue !== undefined) {
							separator = ', ';
						}
						formProductSerial.val(currentValue + separator + serial);
					}
				});
			});

			$.buttonIndicator('on');
            $('<input>').attr({
                type: "hidden",
                name: "<?=$this->security->get_csrf_token_name()?>",
                value: "<?=$this->security->get_csrf_hash();?>"
            }).appendTo('.invoice-add-form');
			$.postRemoteData('invoice', 'add', $('.invoice-add-form').serialize()).then(function (data) {
				if(data.status === 'success') {
					$('.printNow').empty().append('<a title="<?=site_url('printer/index').'/'?>' + data.newlyCreatedInvoiceId + '" class="btn-print">Print Now!</a>');
					$.initPrint();
					$.blink('.printNow');
					if(regularSale) {
						$(document).trigger('event/regularInvoiceAdded');
					}
					else $(document).trigger('event/cashInvoiceAdded');
					resetInvoice();
				}
				showNotification(data, '#notification-invoice-add');
				$.buttonIndicator('off');
			});
		});
	});
</script>