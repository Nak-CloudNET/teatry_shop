<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?= $assets ?>js/html2canvas.min.js"></script>
<?php
	$v = "";
	if ($this->input->post('reference_no')) {
		$v .= "&reference_no=" . $this->input->post('reference_no');
	}
	if ($this->input->post('start_date')) {
		$v .= "&start_date=" . $this->input->post('start_date');
	}
	if ($this->input->post('end_date')) {
		$v .= "&end_date=" . $this->input->post('end_date');
	}
	if ($this->input->post('product_id')) {
        $v .= "&product_id=" . $this->input->post('product_id');
    }
?>
<script>
    $(document).ready(function () {		
        oTable = $('#dmpData').dataTable({
            "aaSorting": [[1, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('products/getadjustments'.($warehouse_id ? '/'.$warehouse_id : '')).'/?v=1'.$v ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [
				{"bSortable": false, "mRender": checkbox}, 
				{"mRender": fld}, 
				null, null,{"mRender": currencyFormat},
                null,               
				{"mRender": decode_html},
				{"bSortable": false, "mRender": attachment}, 
				{"bSortable": false}
			],
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {

				var oSettings = oTable.fnSettings();
                nRow.id = aData[0];
                nRow.className = "adjustment_link";
                return nRow;
            },
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                var gtotal = 0;
                for (var i = 0; i < aaData.length; i++) {
                    
                    gtotal += parseFloat(aaData[aiDisplay[i]][4]);
                    
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[4].innerHTML = currencyFormat(parseFloat(gtotal));
               
            }
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('reference_no');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('warehouse');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('created_by');?>]", filter_type: "text", data: []},
            {column_number: 6, filter_default_label: "[<?=lang('note');?>]", filter_type: "text", data: []},
        ], "footer");

        if (localStorage.getItem('remove_qals')) {
            if (localStorage.getItem('qaitems')) {
                localStorage.removeItem('qaitems');
            }
            if (localStorage.getItem('qaref')) {
                localStorage.removeItem('qaref');
            }
            if (localStorage.getItem('qawarehouse')) {
                localStorage.removeItem('qawarehouse');
            }
            if (localStorage.getItem('qanote')) {
                localStorage.removeItem('qanote');
            }
            if (localStorage.getItem('qadate')) {
                localStorage.removeItem('qadate');
            }
            localStorage.removeItem('remove_qals');
        }

        <?php if ($this->session->userdata('remove_qals')) { ?>
            if (localStorage.getItem('qaitems')) {
                localStorage.removeItem('qaitems');
            }
            if (localStorage.getItem('qaref')) {
                localStorage.removeItem('qaref');
            }
            if (localStorage.getItem('qawarehouse')) {
                localStorage.removeItem('qawarehouse');
            }
            if (localStorage.getItem('qanote')) {
                localStorage.removeItem('qanote');
            }
            if (localStorage.getItem('qadate')) {
                localStorage.removeItem('qadate');
            }
        <?php $this->erp->unset_data('remove_qals');}
        ?>
    });
</script>

<?php if ($Owner || $Admin || $GP['products-export']) {
        echo form_open('products/adjustment_actions', 'id="action-form"');
    }
?>
<div class="box">
    <div class="box-header">
		<div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a href="#" class="toggle_up tip" title="<?= lang('hide_form') ?>">
                        <i class="icon fa fa-toggle-up"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="toggle_down tip" title="<?= lang('show_form') ?>">
                        <i class="icon fa fa-toggle-down"></i>
                    </a>
                </li>
            </ul>
        </div>
        <h2 class="blue">
            <i class="fa-fw fa fa-barcode"></i>
            <?= lang('quantity_adjustments'); ?>
            (
                <?php
                    if (count($warehouses) > 1) {
                        echo lang('all_warehouses');
                    } else {
                        foreach ($warehouses as $ware) {
                            echo $ware->name;
                        }
                    }
                ?>
            )
        </h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?= site_url('products/add_adjustment_multiple') ?>">
                                <i class="fa fa-plus-circle"></i> <?= lang('add_adjustment') ?>
                            </a>
                        </li>

                        <?php if ($GP['products-export'] || $Owner || $Admin) { ?>
                        <li>
                            <a href="#" id="excel" data-action="export_excel">
                                <i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="pdf" data-action="export_pdf">
                                <i class="fa fa-file-pdf-o"></i> <?= lang('export_to_pdf') ?>
                            </a>
                        </li>

                        <?php } ?>
                    </ul>
                </li>
                <?php if (!empty($warehouses)) { ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-building-o tip" data-placement="left" title="<?= lang("warehouses") ?>"></i></a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li><a href="<?= site_url('products/quantity_adjustments') ?>"><i class="fa fa-building-o"></i> <?= lang('all_warehouses') ?></a></li>
                            <li class="divider"></li>
                            <?php
                            foreach ($warehouses as $warehouse) {
                                echo '<li><a href="' . site_url('products/quantity_adjustments/' . $warehouse->id) . '"><i class="fa fa-building"></i>' . $warehouse->name . '</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
	<?php if ($Owner || $Admin || $GP['products-export']) {?>
		<div style="display: none;">
			<input type="hidden" name="form_action" value="" id="form_action"/>
			<?=form_submit('performAction', 'performAction', 'id="action-form-submit"')?>
		</div>
		<?=form_close()?>
	<?php }
	?>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?= lang('list_results'); ?></p>
				<div id="form">
                    <?php echo form_open("products/quantity_adjustments"); ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="reference_no"><?= lang("reference_no"); ?></label>
                                <?php echo form_input('reference_no', (isset($_POST['reference_no']) ? $_POST['reference_no'] : ""), 'class="form-control tip" id="reference_no"'); ?>
                            </div>
                        </div>
						<div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="product_id"><?= lang("product"); ?></label>
                                <?php
                                $pr["0"] = lang("all");
                                foreach ($products as $product) {
                                    $pr[$product->id] = $product->name . " | " . $product->code ;
                                }
                                echo form_dropdown('product_id', $pr, (isset($_POST['product_id']) ? $_POST['product_id'] : ""), 'class="form-control" id="product_id" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("product") . '"');
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("start_date", "start_date"); ?>
                                <?php echo form_input('start_date', (isset($_POST['start_date']) ? $_POST['start_date'] : date('d/m/Y')), 'class="form-control date" id="start_date"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("end_date", "end_date"); ?>
                                <?php echo form_input('end_date', (isset($_POST['end_date']) ? $_POST['end_date'] : date('d/m/Y')), 'class="form-control date" id="end_date"'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls"> <?php echo form_submit('submit_report', $this->lang->line("submit"), 'class="btn btn-primary"'); ?> </div>
                    </div>
                    <?php echo form_close(); ?>

                </div>
                <div class="table-responsive">
                    <table id="dmpData" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
							<tr>
								<th style="min-width:30px; width: 30px; text-align: center;">
									<input class="checkbox checkft" type="checkbox" name="check"/>
								</th>
								<th class="col-xs-2"><?= lang("date"); ?></th>
								<th class="col-xs-2"><?= lang("reference_no"); ?></th>
								<th class="col-xs-2"><?= lang("warehouse"); ?></th>
								<th class="col-xs-2"><?= lang("quantity"); ?></th>
								<th class="col-xs-2"><?= lang("created_by"); ?></th>
								<th><?= lang("note"); ?></th>
								<th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
								<th style="min-width:75px; text-align:center;"><?= lang("actions"); ?></th>
							</tr>
                        </thead>
                        <tbody>
							<tr>
								<td colspan="8" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
							</tr>
                        </tbody>
                        <tfoot class="dtFilter">
							<tr class="active">
								<th style="min-width:30px; width: 30px; text-align: center;">
									<input class="checkbox checkft" type="checkbox" name="check"/>
								</th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
								<th style="width:75px; text-align:center;"><?= lang("actions"); ?></th>
							</tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function () {	
		$('#form').hide();
		$('.toggle_down').click(function () {
            $("#form").slideDown();
            return false;
        });
        $('.toggle_up').click(function () {
            $("#form").slideUp();
            return false;
        });
	});
</script>