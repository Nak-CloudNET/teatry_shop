$(document).ready(function (e) {
	var $customer = $('#customer');
	$customer.change(function (e) {
        localStorage.setItem('customer', $(this).val());
        //$('#slcustomer_id').val($(this).val());
    });
	
    if (customer = localStorage.getItem('customer')) {
		
        $customer.val(customer).select2({
            minimumInputLength: 1,
            data: [],
            initSelection: function (element, callback) {
                $.ajax({
                    type: "get", async: false,
                    url: site.base_url+"customers/getCustomer/" + $(element).val(),
                    dataType: "json",
                    success: function (data) {
                        callback(data[0]);
                    }
                });
            },
            ajax: {
                url: site.base_url + "customers/suggestions",
                dataType: 'json',
                quietMillis: 15,
                data: function (term, page) {
                    return {
                        term: term,
                        limit: 10
                    };
                },
                results: function (data, page) {
                    if (data.results != null) {
                        return {results: data.results};
                    } else {
                        return {results: [{id: '', text: 'No Match Found'}]};
                    }
                }
            }
        });
		
    } 
	
});
/* ---------------------- 
 * On Edit 
 * ---------------------- */

if (localStorage.getItem('usitems')) {
	loadItems();
}

/* ---------------------- 
 * Delete Row Method 
 * ---------------------- */

$(document).on('click', '.usdel', function () {
	var row = $(this).closest('tr');
	var item_id = row.attr('data-item-id');
	delete usitems[item_id];
	localStorage.setItem('usitems', JSON.stringify(usitems));
	row.remove();
	loadItems();
});

/* ----------------------
 * Change Qty use
 * ------------------- */
var old_row_qty = 0;
$(document).on("focus", '.qty_use', function () {
	old_row_qty = $(this).val();
	
}).on("change", '.qty_use', function () {
	var m = 2;
	var row = $(this).closest('tr');
	if (!is_numeric($(this).val())) {
		$(this).val(old_row_qty);
		bootbox.alert(lang.unexpected_value);
		return;
	}
	var bal_project	= 0;
	var qty_project = row.find('.qty_project').val();
	var qty_old     = row.find('.qty_old').val();
	var have_plan   = row.find('.have_plan').val();
	var qty_unit	= row.find('#unit').find('option:selected').attr('qty');
	var new_qty 	= parseFloat($(this).val()),
	item_id 		= row.attr('data-item-id');
	
	if(have_plan > 0){
		bal_project = (parseFloat(qty_project) + parseFloat(qty_old)) - ( (new_qty?parseFloat(new_qty):0) * (qty_unit?parseFloat(qty_unit):1) );
		console.log(qty_project +'=='+ qty_old +'=='+ new_qty +'=='+ qty_unit );
	}
	
	usitems[item_id].project_qty = bal_project;
	usitems[item_id].row.qty_use = new_qty;
	localStorage.setItem('usitems', JSON.stringify(usitems));
	loadItems();
});

$(document).on("change", '.unit', function () {
	var row 		= $(this).closest('tr');
	var units	 	= $(this).val(),
	item_id 		= row.attr('data-item-id');
	var bal_project	= 0;
	var qty_project = row.find('.qty_project').val();
	var qty_old     = row.find('.qty_old').val();
	var new_qty     = row.find('.qty_use').val();
	var qty_unit	= row.find('#unit').find('option:selected').attr('qty');

	if(qty_project > 0){
		bal_project = (parseFloat(qty_project) + parseFloat(qty_old)) - ( (new_qty?parseFloat(new_qty):0) * (qty_unit?parseFloat(qty_unit):1) );
	}
	console.log(qty_project +'=='+ qty_old +'=='+ new_qty +'=='+ qty_unit);
	usitems[item_id].row.unit 	 = units;
	usitems[item_id].project_qty = bal_project;
	localStorage.setItem('usitems', JSON.stringify(usitems));
	loadItems();
});

/* -----------------------
 * Add Using Stock
 * ---------------------*/
$(document).on('click', '#btn_using', function () {
	var plan_id = $('#plan').val();
	var qty_use = new Array();
	$('.qty_use').each(function(i){
		var tr       = $(this).parent().parent();
		var unit_qty = tr.find('.unit option:selected').attr('qty');
		var qty_used = $(this).val();
		qty_use[i] = (unit_qty?unit_qty:1) * qty_used;
	});

	var old_qty = new Array();
	$('.qty_old').each(function(i){
		old_qty[i] = $(this).val();
	});
	
	var have_big = new Array();
	$('.qty_project').each(function(i){
		if(qty_use[i] > ( parseFloat($(this).val()) + parseFloat(old_qty[i]) ) ){
			have_big[i] = 1;
		}else{
			have_big[i] = 0;
		}
		
	});

	if (plan_id) {
		if(jQuery.inArray(1, have_big) !== -1){
			bootbox.prompt({
				title: "Please insert password", 
				inputType: 'password',
				callback: function (result) {
					$.ajax({
						type: 'get',
						url: site.base_url+"products/checkPasswords/",
						dataType: "json",
						data: {
							password: result
						},
						success: function (data) {
							if(jQuery.inArray(1, data) !== -1){
								$('#btn_submit').trigger('click');
							}else{
								return false;
							}
						}
					});
				}
				
			}); 
		} else {
			$('#btn_submit').trigger('click');
		}
	} else {
		$('#btn_submit').trigger('click');
	}
}); 

var delete_pro_id = "";
$(document).on('click', '.btn_delete', function () {
   delete_pro_id += ($(this).attr("id")+"_");
   $('#store_del_pro_id').val(delete_pro_id);
});

/* -------------------------- 
 * Keep Warehouse when reload
 * ----------------------- */

$('#from_location').change(function (e) {
	localStorage.setItem('from_location', $(this).val());
});

if (from_location = localStorage.getItem('from_location')) {
	$('#from_location').val(from_location);
}

$('#authorize_id').change(function (e) {
	localStorage.setItem('authorize_id', $(this).val());
});

if (authorize_id = localStorage.getItem('authorize_id')) {
	$('#authorize_id').val(authorize_id);
}   

$('#employee_id').change(function (e) {
	localStorage.setItem('employee_id', $(this).val());
});

if (employee_id = localStorage.getItem('employee_id')) {
	$('#employee_id').val(employee_id);
} 

$('#shop').change(function (e) {
	localStorage.setItem('shop', $(this).val());
});

if (shop = localStorage.getItem('shop')) {
	$('#shop').val(shop);
}  

$('#account').change(function (e) {
	localStorage.setItem('account', $(this).val());
});

if (account = localStorage.getItem('account')) {
	$('#account').val(account);
} 

$('#plan').change(function (e) {
	localStorage.setItem('plan', $(this).val());
});

if (plan = localStorage.getItem('plan')) {
	$('#plan').val(plan);
}  

$(document).on("change", '.description', function () {
	var row 		= $(this).closest('tr');
	var descript 	= $(this).val(),
	item_id 		= row.attr('data-item-id');
	usitems[item_id].row.description = descript;
	localStorage.setItem('usitems', JSON.stringify(usitems));
	loadItems();
});    

/* ---------------------- 
 * Clear LocalStorage 
 * ---------------------- */

$('#reset').click(function (e) {
	bootbox.confirm(lang.r_u_sure, function (result) {
		if (result) {
			if (localStorage.getItem('usitems')) {
				localStorage.removeItem('usitems');
			}
			if (localStorage.getItem('from_location')) {
				localStorage.removeItem('from_location');
			}
			if (localStorage.getItem('authorize_id')) {
				localStorage.removeItem('authorize_id');
			}
			if (localStorage.getItem('employee_id')) {
				localStorage.removeItem('employee_id');
			}
			if (localStorage.getItem('shop')) {
				localStorage.removeItem('shop');
			}
			if (localStorage.getItem('account')) {
				localStorage.removeItem('account');
			}
			$('#modal-loading').show();
			location.reload();
		}
	});
});

function loadItems() {
    if (localStorage.getItem('usitems')) {
		//============ Return From View ==============//
        count 	= 1;
		//=================== End ====================//
        $("#UsData tbody").empty();
        usitems = JSON.parse(localStorage.getItem('usitems'));
		var no_ = 1;
		$('#from_location').select2("readonly", true);
		item_description = '';
		item_reason      = '';
		item_qty_use     = 0;
		item_qty_by_unit     = '';
        $.each(usitems, function () {
            var item = this;
            var item_id = site.settings.item_addition == 1 ? item.item_id : item.id;
            usitems[item_id] 	= item;
			var product_id 		= item.row.id, 
				item_code 		= item.row.code, 
				item_name 		= item.row.name, 
				item_label 		= item.label, 
				qoh 			= item.row.qoh, 
				unit_name 		= item.row.unit_name, 
				item_cost 		= item.row.cost, 
				item_unit 		= item.row.unit,  
				qty_plan 		= item.row.project_qty,  
				qty_old 		= item.row.qty_old,  
				item_proj		= item.project_qty,
				have_plan		= item.row.have_plan,
				stock_item_id 	= item.stock_item;
			item_qty_use = formatPurDecimal(item.row.qty_use);

			var opt = $("<select id=\"unit\" name=\"unit\[\]\" style=\"padding-top: 2px !important;\" class=\"form-control unit\" />");
			
            if(item.option_unit !== false) {
                $.each(item.option_unit, function () {
				  if(item.row.unit == this.unit_variant){
					$("<option />", {value: this.unit_variant, text: this.unit_variant, qty: this.qty_unit, selected: 'selected'}).appendTo(opt);
				  }else{
					$("<option />", {value: this.unit_variant, text: this.unit_variant, qty: this.qty_unit}).appendTo(opt);  
				  }
				});
            } else {
                $("<option />", {value: 0, text: 'n/a'}).appendTo(opt);
                opt = opt.hide();
            }
			
			if(item.row.description){
				item_description = item.row.description;
			} else {
				item_description = '';
			}
			
			if(item.reason){
				item_reason = item.reason;
			}
			
			var row_no = (new Date).getTime();
			
			var newTr = $('<tr id="row_' + row_no + '" class="row_' + item_id + '" data-item-id="' + item_id + '"></tr>');
			
			
			tr_html = '<td><input type="hidden" value="'+ product_id +'" name="product_id[]"/><input type="hidden" value="'+ item_code +'" name="item_code[]"/><input type="hidden" value="'+ item_name +'" name="name[]"/><input type="hidden" value="'+ item_cost +'" name="cost[]"/> <input type="hidden" value="'+ stock_item_id +'" name="stock_item_id[]"/>'+ item_label +'</td>';
						
			tr_html += '<td><input type="text" value="'+ item_description +'" class="form-control" name="description[]"/></td>';
			
			tr_html += '<td class="text-center">'+ formatQuantity2(qoh) +'</td>';
			
			tr_html += '<td><input type="text" value="'+ item_qty_use +'" class="form-control qty_use" name="qty_use[]" style="text-align:center !important;"/><input type="hidden" value="'+ qty_plan +'" class="qty_project" name="qty_project[]" /><input type="hidden" value="'+ qty_old +'" class="qty_old" name="qty_old[]" /><input type="hidden" value="'+ have_plan +'" class="have_plan" name="have_plan[]" /><input type="hidden" value="'+qoh+'" name="qoh[]" /></td>';
			
			tr_html += '<td>'+(opt.get(0).outerHTML)+'</td>';
			
			tr_html += '<td class="bal_pro">'+ formatQuantity2(item_proj) +'</td>';
			
			tr_html += '<td class="text-center"><i class="fa fa-times tip usdel btn_delete" id="' + product_id + '" title="Remove" style="cursor:pointer;"></i></td>';
			count += 1;
			newTr.html(tr_html);
            newTr.appendTo("#UsData");
			
        });
    }
}

/* -----------------------------
 * Add Using Stock Iten Function
 * @param {json} item
 * @returns {Boolean}
 ---------------------------- */
 
function add_using_stock_item(item) {
    if (count == 1) {
        usitems = {};
        if ($('#account').val()) {
            $('#from_location').select2("readonly", true);
			$('#account').select2("readonly", true);
        } else {
            bootbox.alert(lang.select_account);
            item = null;
            return;
        }
    }
	
    if (item == null) {
        return;
    }

	var item_id = site.settings.item_addition == 1 ? item.item_id : item.id;

    if (usitems[item_id]) {
        usitems[item_id].row.qty = parseFloat(usitems[item_id].row.qty) + 1;
    } else {
        usitems[item_id] = item;
	}
    
    localStorage.setItem('usitems', JSON.stringify(usitems));
    loadItems();
    return true;

}


