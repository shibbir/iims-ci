var spinner;

function showNotification(data, notificationPlaceholder, preserveInput) {
	var notificationClass = 'alert alert-' + data.status;

	var notification = '<div class="' + notificationClass + '">';
	notification += '<span>' + data.message + '</span>';
	notification += '</div>';

	$(notificationPlaceholder).html(notification).fadeIn(200).delay(2500).fadeOut(300);

	if(data.status !== 'error' && !preserveInput) {
		clearInput();
	}
}

$.postRemoteData = function(controller, action, form_data) {
	return $.ajax({
		url: IIMSApp.base_url + controller + '/' + action,
		type: 'POST',
		data: form_data,
		dataType: 'json'
	}).promise();
};

$.fetchRemoteData = function(controller, action, form_data) {
	$.showSpinner();
	return $.ajax({
		url: IIMSApp.base_url + controller + '/' + action,
		type: 'GET',
		data: form_data,
		dataType: 'json'
	}).promise();
};

$.deleteRemoteData = function(controller, action, form_data) {
	var dfd = $.Deferred();
	if($.isDelete()) {
		return $.ajax({
			url: IIMSApp.base_url + controller + '/' + action,
			type: 'POST',
			data: form_data,
			dataType: 'json'
		}).promise();
	}
	return dfd.promise();
};

function ajaxDataReceive(controller, action, target) {
	$.ajax({
		url: IIMSApp.base_url + controller + '/' + action,
		type: 'GET',
		success: function (data) {
			var plotData = [];
			data = $.parseJSON(data);
			$.each(data, function(key, value) {
				plotData.push([key, value]);
			});
			highCharts_Pie(target, plotData);
		}
	});
}

function initInvoiceCountByYear(year) {
	$(document).trigger('event/ajax-start');
	$.ajax({
		url: IIMSApp.base_url + 'invoice/getInvoiceCountByYear',
		type: 'GET',
		dataType: 'json',
		data: { Year: year },
		success: function (data) {
			highchartsInvoiceByYear(year, data, 'invoice-chart');
			$(document).trigger('event/ajax-end');
		}
	});
}

function highCharts_Pie(target, plotData) {
	Highcharts.getOptions().colors = $.map(Highcharts.getOptions().colors, function(color) {
	    return {
	        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
	        stops: [
	            [0, color],
	            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')]
	        ]
	    };
	});

	var chart;
    chart = new Highcharts.Chart({
        chart: {
            renderTo: target,
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: ''
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
        	percentageDecimals: 1
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    formatter: function() {
                        return '<b>'+ this.point.name +'</b>: '+ this.y +' pics';
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Total Item',
            data: plotData
        }]
    });
}

function highchartsInvoiceByYear(year, data, target) {
	var chart;
    $(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: target,
                type: 'column',
                margin: [ 50, 50, 100, 80]
            },
            title: {
                text: 'Total invoice made in ' + year
            },
            xAxis: {
                categories: [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'november', 'December'
                ],
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Number of Invoices'
                }
            },
            credits: {
	            enabled: false
	        },
            legend: {
                enabled: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>' + this.x  + '</b><br />' + 'Total invoice(s) made: ' + this.y;
                }
            },
            series: [{
                name: 'Population',
                data: [
                       data.january, data.february, data.march, data.april, data.may, data.june,
                       data.july, data.august, data.september, data.october, data.november, data.december
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    x: -3,
                    y: 10,
                    formatter: function() {
                        return this.y;
                    },
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
}

function clearInput() {
	$('form').find('input[type=text], input[type=password], input[type=number], input[type=email], textarea').val('');
	$('span.clear-input').text('');
}

$.isDelete = function() {
	if(confirm('Are you sure you want to remove this record?')) {
        return true;
    }
	return false;
};

$.initPrint = function() {
	$('.btn-print').printPage({
		attr: "title",
	  	message:"Please wait while the document is loaded"
	});
};

$.buttonIndicator = function (Switch) {
	if(Switch === 'on') {
		$('.btn-ajax').hide();
		$('.btn-loading').show();
	}
	else {
		$('.btn-ajax').show();
		$('.btn-loading').hide();
	}
};

$.showSpinner = function() {
	var options = {
		lines: 13, 				// The number of lines to draw
	  	length: 7, 				// The length of each line
	  	width: 3, 				// The line thickness
	  	radius: 10, 			// The radius of the inner circle
	  	corners: 1, 			// Corner roundness (0..1)
	  	rotate: 0, 				// The rotation offset
	  	color: '#FFFFFF', 		// #rgb or #rrggbb
	  	speed: 1, 				// Rounds per second
	  	trail: 60, 				// Afterglow percentage
	  	shadow: true, 			// Whether to render a shadow
	  	hwaccel: true, 			// Whether to use hardware acceleration
	  	className: 'spinner',	// The CSS class to assign to the spinner
	  	zIndex: 2e9, 			// The z-index (defaults to 2000000000)
	  	top: '45', 				// Top position relative to parent in px
	  	left: 'auto' 			// Left position relative to parent in px
	};
	$('#container-spinner').show();
	var target = document.getElementById('spinner');
	spinner = new Spinner(options).spin(target);
	$('.navbar, .container').css('opacity', '0.10');
};

$.hideSpinner = function() {
	spinner.stop();
	$('#container-spinner').hide();
	$('.navbar, .container').css('opacity', '1');
};

$.blink = function(selector) {
    $(selector).fadeOut('slow', function() {
        $(this).fadeIn('slow', function() {
            $.blink(this);
        });
    });
};

function renderHandlebarsTemplate(template, placeholder, data) {
	var source   = $(template).html();
	template = Handlebars.compile(source);
	$(placeholder).html(template(data));
	$(document).trigger('event/templateRendered');
}

function renderPrecompiledHandlebarsTemplate(template, placeholder, data) {
	var compiledTemplate = Handlebars.templates[template];
	$(placeholder).html(compiledTemplate(data));
}

$.makeObject = function(grid, itemId) {
	var selectedItem = $(grid).filter(function () {
		return itemId === $(this).data('id');
	});

	var itemObject = {
		ID: itemId
	};
	selectedItem.children('td').each(function () {
	    if($(this).data('field')) {
	        itemObject[$(this).data('field')] = $(this).html();
	    }
	});

	return itemObject;
};

$.kendoGrid = function (grid, template, controller, action) {
    var handlebarsTemplate = Handlebars.compile($(template).html());

    var dataSource = new kendo.data.DataSource({
        transport: {
            read: {
                url: IIMSApp.base_url + controller + "/" + action,
                dataType: "json"
            }
        },
        pageSize: 15
    });

    var kendoGrid = $(grid).data("kendoGrid");

    if (kendoGrid === undefined || kendoGrid === null) {
        $(grid).kendoGrid({
            filterable: false,
            sortable: false,
            pageable: {
                info: true,
                input: true
            },
            scrollable: false,
            rowTemplate: function (data) {
                return handlebarsTemplate(data);
            },
            dataSource: dataSource,
            dataBound: function(e) {
            	$.initPrint();
            }
        });
    } else {
        kendoGrid.setDataSource(dataSource);
        kendoGrid.refresh();
    }
};

$.renderInventoryGrid = function (categoryId) {
    $.kendoGrid("#inventoryGrid", "#template-inventory", "Inventory", "GetInventory");
};
$.renderCustomerGrid = function () {
    $.kendoGrid("#customerGrid", "#template-customer", "Customer", "GetCustomers");
};
$.renderRegularInvoiceGrid = function () {
    $.kendoGrid("#invoiceGrid", "#template-invoice", "Invoice", "GetInvoices");
};
$.renderCashInvoiceGrid = function () {
	$.kendoGrid("#invoicesByCashSaleGrid", "#template-invoicesByCashSale", "Invoice", "GetInvoicesByCashSale");
};