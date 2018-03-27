<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?= $inv->do_reference_no ?></title>
	<link href="<?php echo $assets ?>styles/theme.css" rel="stylesheet">
	<link href="<?php echo $assets ?>styles/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="<?= $assets ?>js/jquery-2.0.3.min.js"></script>
	<style type="text/css">
		.container p {
			font-size: 14px !important;
		}

		thead tr {
			background-color: #333;
		}

		thead tr th {
			text-align: center !important;
			color: #FFF;
		}

		.table, .table tr td, .table tr th {
			border: 1px solid #000 !important;
		}

		@media print {
			.container {
				width: 95% !important;
				margin: 0 auto !important;
				padding: 0 !important;
			}

			.referno {
				padding-left: 60px !important;
			}

			.abc {
				margin-left: -25px !important;
			}
		}

	</style>

</head>
<body>
	<div class="container">
		<div class="text-center" style="padding:10px;"> 
			<button class="btn btn-xs btn-default no-print pull-left" onclick="window.print()"><i class="fa fa-print"></i>&nbsp;<?= lang("print"); ?></button>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<center>
					<?php if ($Settings->system_management == 'project') { ?>
						<!--<img src="<?= base_url() ?>assets/uploads/logos/<?= $Settings->logo2; ?>" style="margin-top: 20px" />-->
						<h3><strong style="float:left">TTR II</strong><strong>ប័ណ្ណបញ្ចូនទំនិញ</strong></h3>
					<?php } else { ?>
							<!--<img src="<?= base_url() ?>assets/uploads/logos/<?= $biller->logo; ?>" style="margin-top: 20px" />-->
							<h3>
								<strong style="float:left">TTR II</strong>
								<strong>ប័ណ្ណបញ្ចូនទំនិញ</strong>
							</h3>
					<?php } ?>
				</center>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-xs-12">	
				<center style="padding-left:58px">
					<h4><u><strong><?= strtoupper(lang('delivery_order')) ?></strong></u></h4>
				</center>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<div class="row abc">
					<div class="col-sm-3 col-xs-3">
						<p><strong><?= lang('to') ?></strong></p>
						<p><?= lang('address') ?></p>
						<p><?= lang('tel_no') ?></p>
					</div>
					<div class="col-sm-9 col-xs-9">
						<p><strong>: <?= $customer->name ?></strong></p>
						<p>: <?= $customer->address ?></p>
						<p>: <?= $customer->phone ?></p>
					</div>
				</div>
			</div>
			<!-- <div class="col-sm-1 col-xs-1"></div> -->
			<div class="col-sm-6 col-xs-6">
				<div class="row referno" style="padding-left: 100px;">
					<div class="col-sm-3 col-xs-3" style="padding-right: 0; padding-left: 0">
						<p><?= lang('do_no') ?></p>
						<p><strong><?= lang('refer_no') ?></strong></p>
						<p><strong><?= lang('PO') ?></strong></p>
						<p><?= lang('date') ?></p>
						<p><?= lang('phone') ?></p>
					</div>
					<div class="col-sm-9 col-xs-9">
						<p>: <?= $inv->do_reference_no ?></p>
						<p><strong>: <?= $inv->sale_reference_no ?></strong></p>
						<p><strong>: <?= ($po->po ? $po->po : '') ?></strong></p>
						<p>: <?= $this->erp->hrsd($inv->date) ?></p>
						<p>: <?= $biller->phone ?></p>
					</div>
				</div>
			</div>
		</div>

		<table class="table table-bordered table-hover" border="1">
			<thead>
				<tr>
					<th><?= lang('no') ?></th>
					<!--<th><?= lang('brand') ?></th>-->
					<th><?= lang('description') ?></th>
					<!--<th><?= lang('model') ?></th>-->
					<th><?= lang('unit') ?></th>
					<th><?= lang('qty') ?></th>
					<th><?= lang('remark') ?></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$no = 1;
				$row = 1;
			?>
			<?php foreach($inv_items as $inv_item) { ?>
				<tr>
					<td style="border-top:none !important;border-bottom:none !important; text-align: center;"><?= $no ?></td>
					<!--<td style="border-top:none !important;border-bottom:none !important; text-align: center;"><?= $inv_item->brand ?></td>-->
					<td style="border-top:none !important;border-bottom:none !important;"><?= $inv_item->description ?></td>
					<!--<td style="border-top:none !important;border-bottom:none !important;"></td>-->
					<?php if ($inv_item->option_id >= 1) { ?>
						<td style="border-top:none !important;border-bottom:none !important; text-align: center;"><?= $inv_item->variant ?></td>
						<td style="border-top:none !important;border-bottom:none !important; text-align: center;"><?= $this->erp->formatQuantity($inv_item->qty) ?></td>
					<?php } else { ?>
						<td style="border-top:none !important;border-bottom:none !important; text-align: center;"><?= $inv_item->unit ?></td>
						<td style="border-top:none !important;border-bottom:none !important; text-align: center;"><?= $this->erp->formatQuantity($inv_item->qty) ?></td>
					<?php } ?>
					<td style="border-top:none !important;border-bottom:none !important;"></td>
				</tr>
			<?php
				$no++;
				$row++;
			 }
				if ($row < 10) {
					$k = 10 - $row;
					for ($j=1; $j <= $k; $j++) {
						echo
							'<tr>
								<td height="34px" style="border-top:none !important;border-bottom:none !important;"></td>
								<td style="border-top:none !important;border-bottom:none !important;"></td>
								<td style="border-top:none !important;border-bottom:none !important;"></td>
								<td style="border-top:none !important;border-bottom:none !important;"></td>
								<td style="border-top:none !important;border-bottom:none !important;"></td>
							</tr>';
					}
					
				}
			?>
			<tr style="font-size: 13px;">
				<td colspan="5" style="border: 1px solid #000000;">
					<div style="margin-top:60px;font-size:11px;width:100%">
						<div style="float:left;width:25%">
							<p style="text-align:center">.......................................</p>
							<p style="text-align:center">អ្នកទិញ / BUYER</p>
						</div>
						<div style="float:left;width:25%">
							<p style="text-align:center">.......................................</p>
							<p style="text-align:center">អ្នកទទួល / RECEIVER</p>
						</div>
						<div style="float:left;width:25%">
							<p style="text-align:center">.......................................</p>
							<p style="text-align:center">អ្នកដឹក / TRANSPORTER</p>
						</div>
						<div style="float:right;width:25%">
							<p style="text-align:center">.......................................</p>
							<p style="text-align:center">អ្នកលក់ / SELLER</p>
						</div>
					</div>
				</td>
			</tr>
			</tbody>
			
		</table>

		<!--<div class="row" style="margin-bottom: 50px !important;">
			<div class="col-sm-3 col-xs-3">
				<p><strong>រៀបចំ​ដោយ / <?= lang('prepared_by') ?></strong></p>
			</div>
			<div class="col-sm-3 col-xs-3">
				<p><strong>បានអនុម័តដោយ / <?= lang('approved_by') ?></strong></p>
			</div>
			<div class="col-sm-3 col-xs-3">
				<p><strong>ចែកចាយដោយ / <?= lang('deliveried_by') ?></strong></p>
			</div>
			<div class="col-sm-3 col-xs-3">
				<p><strong>អ្នកទទួល / <?= lang('received_by') ?></strong></p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3 col-xs-3">
				<p><strong><?= lang('name') ?>:</strong> .......................</p>
				<br />
				<p><?= lang('date') ?>: .........................</p>
			</div>
			<div class="col-sm-3 col-xs-3">
				<p><strong><?= lang('name') ?>:</strong> .......................</p>
				<br />
				<p><?= lang('date') ?>: .........................</p>
			</div>
			<div class="col-sm-3 col-xs-3">
				<p><strong><?= lang('name') ?>:</strong> .......................</p>
				<br />
				<p><?= lang('date') ?>: .........................</p>
			</div>
			<div class="col-sm-3 col-xs-3">
				<p><strong><?= lang('name') ?>:</strong> .......................</p>
				<br />
				<p><?= lang('date') ?>: .........................</p>
			</div>
		</div>-->

	</div>
	
</body>
</html>
