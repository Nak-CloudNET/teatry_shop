<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoice&nbsp;<?= $invs->reference_no ?></title>
	<link href="<?php echo $assets ?>styles/theme.css" rel="stylesheet">
	<link href="<?php echo $assets ?>styles/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $assets ?>styles/custome.css" rel="stylesheet">
</head>
<style>
	.container {
		width: 29.7cm;
		margin: 20px auto;
	}
	@media print {
		.customer_label {
			padding-left: 0 !important;
		}
		.td_saler{
			padding-left:-20px !important;
		}
		.box1 {
			border: 1px solid #000000;
			height: 95px;
			padding : 5px;
			width: 80%;
			font-size:11px;
		}
	}
	.thead th {
		border : 1px solid black !important;
		height: 30px !important;
		text-align: center !important;
	}
	hr { 
		display: block;
		margin-top: 0.5em;
		margin-bottom: 0.5em;
		margin-left: auto;
		margin-right: auto;
		border : 1px solid black !important;
	}
	.height_tbody td {
		border : 1px solid black !important;
		height: 25px !important;
		text-align: center !important;		
	}
	#footer{
		margin-top: 7px !important;
	}
	.box1 {
		border: 1px solid #000000;
		height: 95px;
		padding : 5px;
		width: 80%;
		font-size:11px;
	}
	.box2{
		border: 1px solid #000000;
		height:95px;
		width:100%;
		padding: 5px;
		font-size:11px;
	}
	.box3{
		height: 95px;
		width: 5%;
	}
</style>
<body>
	<div class="container" style="width: 821px;margin: 0 auto;">
		<div class="col-sm-12 col-xs-12">
			<button type="button" class="btn btn-xs btn-default no-print pull-right" style="margin-right:15px; margin-top: 10px" onclick="window.print();">
        		<i class="fa fa-print"></i> <?= lang('print'); ?>
    		</button>
		</div>
		<div class="col-xs-12">
			<div class="row">
				<div class="col-sm-12 col-xs-12 inv">
					<center>
						<h2><strong>TTR II</strong></h2>
						<!-- <h3 style="margin-top:5px !important;"><strong>Tel : <?= $biller->phone; ?></strong></h3> -->
						<hr>
						<h4><strong style="margin-left: 35px !important;">ប័ណ្ណស្នើរសុំទូទាត់</strong></h4>
					</center>
				</div>
			</div>
			<div class="row" style="padding-top:10px !important;">
				<div class="col-sm-7 col-xs-7">
					<div class="box1">
						<table style="font-size: 13px;line-height:22px !important;">
							<tr>
								<td style="width: 10%;">ជំរាប ជូន </td>
								<td style="width: 3%;">:</td>
								<td style="width: 50%;"><?= $customer->company; ?></td>
							</tr>
							<tr>
								<td style="width: 10%;">ឈ្មោះអតិថិជន</td>
								<td style="width: 3%;">:</td>
								<td style="width: 50%;"><?= $customer->name; ?></td>
							</tr>
							<tr>
								<td style="width: 10%;">ទូរស័ព្ទ</td>
								<td style="width: 3%;">:</td>
								<td style="width: 50%;"><?= $customer->phone; ?></td>
							</tr>
							<tr>
								<td style="width: 10%;">អាស័យដ្ឋាន</td>
								<td style="width: 3%;">:</td>
								<td style="width: 50%;"><?= $customer->address; ?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="col-sm-5 col-xs-5 pull-right">
					<div class="box2">
						<table style="font-size: 13px;line-height:25px !important;">
							<tr>
								<td style="width: 30%;">Printed Date</td>
								<td style="width: 5%;text-align:right !important;">:</td>
								<td style="width:50%;padding-left:10px !important;"><?= date('d-m-Y H:i'); ?></td>
							</tr>
							<tr>
								<td class="td_saler" style="width: 30%;">អ្នកលក់</td>
								<td style="width: 5%;text-align:right !important;">:</td>
								<td style="width: 50%;padding-left:10px !important;"><?= $saleman_by->username; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-xs-12" style="margin-top: 10px;">
					<table style="margin-top: 10px;">
						<thead style="font-size: 15px;">
							<tr class="thead">
								<th style="width:5%;">ល.រ</th>
								<th style="width: 116px;">ថ្ងៃ ខែ ឆ្នំា</th>
								<th style="width:25%;">លេខវិក័យប័ត្រ</th>
								<th style="width:17%;">PO Number</th>
								<th style="width:18%;">សរុបទឹកប្រាក់</th>
								<th style="width:20%;">ផ្សេងៗ</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$r = 1;
								$i = 1;
								$total_balance = 0;
								foreach($invs as $inv){
								?>
									<tr class="height_tbody">
										<td style="vertical-align: middle; text-align: center; height: 10px !important;"><?= $r; ?></td>
										<td style="vertical-align: middle; text-align: center; height: 10px !important;"><?= date('d-m-Y', strtotime($inv->date)); ?></td>
										<td style="vertical-align: middle; text-align: center; height: 10px !important;"><?= $inv->reference_no; ?></td>
										<td style="vertical-align: middle; text-align: center !important; height: 10px !important;"><?= $inv->po; ?></td>
										<td style="vertical-align: middle; text-align: right !important; height: 10px !important;padding-right:5px !important;"><?= $this->erp->formatMoney($inv->balance); ?></td>
										<td style="vertical-align: middle; text-align: center;height: 10px !important;"></td>
									</tr>
								<?php 
									$total_balance += $inv->balance;
									$r++;
									$i++;
								} 
								?>
								
								<?php if($inv_returns > 0) { 
									foreach($inv_returns as $inv_return){
								?>
									<tr class="height_tbody">
										<td style="vertical-align: middle; text-align: center; height: 10px !important;"><?= $r; ?></td>
										<td style="vertical-align: middle; text-align: center; height: 10px !important;"><?= date('d-m-Y', strtotime($inv_return->date)); ?></td>
										<td style="vertical-align: middle; text-align: center; height: 10px !important;"><?= $inv_return->reference_no; ?></td>
										<td style="vertical-align: middle; text-align: center !important; height: 10px !important;"></td>
										<td style="vertical-align: middle; text-align: right !important; height: 10px !important;padding-right:5px !important;"><?= $this->erp->formatMoney($inv_return->returned_grand_total  * (-1)); ?></td>
										<td style="vertical-align: middle; text-align: center;height: 10px !important;"></td>
									</tr>								
								<?php
									$total_balance -= $inv_return->returned_grand_total;
									$r++;
									$i++;
									}
								}
								?>
								
							<?php 
								if($i <= 7){
								$n = 7 - $i;
								for($a = 1; $a < $n; $a++){ ?>
									<tr class="height_tbody">
										<td style="vertical-align: middle; text-align: center">&nbsp;</td>
										<td style="vertical-align: middle; text-align: center"></td>
										<td style="vertical-align: middle; text-align: center"></td>
										<td style="vertical-align: middle; text-align: right !important; height: 10px !important;padding-right:5px !important;"></td>
										<td style="vertical-align: middle; text-align: right !important; height: 10px !important;padding-right:5px !important;"></td>
										<td style="vertical-align: middle; text-align: center"></td>
									</tr>
							<?php	
									}
								}
							?>
							<tr class="height_tbody" style="font-weight:bold !important;">
								<td style="vertical-align: middle; text-align: center"></td>
								<td style="vertical-align: middle; text-align: center"></td>
								<td style="vertical-align: middle; text-align: center"></td>
								<td style="vertical-align: middle; text-align: right !important; height: 10px !important;padding-right:5px !important;">Total</td>
								<td style="vertical-align: middle; text-align: right !important; height: 10px !important;padding-right:5px !important;"><?= $this->erp->formatMoney($total_balance); ?></td>
								<td style="vertical-align: middle; text-align: center;"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		<div id="footer" class="row" style="margin-top: 7px;">
			<p><span style="padding-left:15px !important; margin-top: 4px !important;"><strong>សម្គាល់</strong></span> <span style="padding-left:10px !important;">-   ទំនាក់ទំនងតាមរយៈ</span></p>
			<p><span style="padding-left: 20px ! important;">&nbsp;</span> <span style="padding-left:55px !important;">-   រាល់ការទូទាត់ប្រាក់ត្រូវមានប័ណ្ណទទួលបា្រក់</span></p>
			<div class="col-sm-4 col-xs-4">
				<center>
					<p style="font-size: 15px;"><strong>គណនេយ្យ</strong></p>
					<br/><br/><br/>
					<hr style="margin:0; border:1px solid #000; width: 40%">
				</center>
			</div>
			<div class="col-sm-4 col-xs-4">
				
			</div>
			<div class="col-sm-4 col-xs-4">
				<center>
					<p style="font-size: 15px;"><strong>អ្នកទិញ (buyer)</strong></p>
					<br/><br/><br/>
					<hr style="margin:0; border:1px solid #000; width: 40%">
				</center>
			</div>
		</div>

		<div style="width: 821px;margin: 20px">
			<a class="btn btn-warning no-print" href="<?= site_url('sales/customer_balance'); ?>" style="border-radius: 0">
	        	<i class="fa fa-hand-o-left" aria-hidden="true"></i>&nbsp;<?= lang("back"); ?>
	     	</a>
		</div>
	</div>

</body>
</html>