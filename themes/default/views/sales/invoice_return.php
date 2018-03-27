<!DOCTYPE html>
<html>

	<head>
		<title>Invoice</title>
		<meta charset="utf-8">
		<link href="<?php echo $assets ?>styles/helpers/bootstrap.min-inv.css" rel="stylesheet">
		<script type="text/javascript" src="<?= $assets ?>js/jquery-2.0.3.min.js"></script>
		<style>
			table {
				border-collapse: collapse;
				width:100%;
				font-size:11px;
			}

			table, th, td {
				border: 1px solid black;
				border:1px solid #000000;
			}
			table, td.td{
				border:none !important;
			}
			.table thead tr.tr {
				background-color:#E9EBEC;
				border:1px solid #000000;
				border-collapse: collapse;
			}
			.foot-left{
				padding:5px;
			}
			.foot-right{
				padding:5px;
				width:99%;
			}
			.list{
				font-size:10px;
			}
			.frt{
				font-weight:bold;
			}
			.moneyshow{
				text-align:center;
				padding:0px;
				border-bottom:dotted 1px black;
			}
			ul.list-right{
				list-style-type: none;
				padding-left:0;
				line-height:2;
				width:100%;
			}
			.hidden{
				display:none;
			}
			@media print{
				.bottom-print{display:none;}
			} 
			.box1 {
				border: 1px solid #000000;
				height: 95px;
				padding: 20px;
				width: 50%;
				font-size:11px;
			}
			.box2{
				border: 1px solid #000000;
				height:95px;
				width:45%;
				padding: 20px;
				font-size:11px;
			}
			.box3{
				height: 95px;
				width: 5%;
			}
			.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
				border:1px solid #000000;
				line-height: 1.42857;
				padding: 5px;
				vertical-align: top;
			}
			th{
				text-align:center;
			}
			
		
		</style>
	</head>
	<body>
		<div class="container bottom-print">
			<div class="text-center" style="padding:10px;"> 
				<button class="btn btn-xs btn-default no-print pull-left" onclick="window.print()"><i class="fa fa-print"></i>&nbsp;<?= lang("print"); ?></button>
			</div>
		</div>
		<div class="container">
			<h2 class="text-center"><b>ប័ណ្ណបង្វិលទំនិញ</b></h2>
			<br>
			<div class="col-xs-12">
				<div class="box1 col-xs-3">
					<div style="font-size: 12px;">
						<div>
							<span><b>អតិថិជន​ / Customer</b></span><span>: <?=$customer->company;?></span>
						</div>
						<div>
							<span><b>អាស័យដ្ឋាន / Address</b></span><span>: <?=$customer->address;?></span>
						</div>
						<div>
							<span><b>លេខទូរស័ព្ទ / Phone No</b></span><span>: <?=$customer->phone;?></span>
						</div>
					</div>
				</div>
				<div class="box3 col-xs-6"></div>
				<div class="box2 col-xs-3">
					<div style="font-size: 12px;">
						<div>
							<span><b>ថ្ងៃខែ​ឆ្នាំ / Date</b></span><span>: <?=$this->erp->hrsd($inv->date);?></span>
						</div>
						<div>
							<span><b>លេខ​វិ​ក័​យ​ប័ត្រ / Invoice no</b></span><span style="font-weight:bold;">: <?=$inv->reference_no?></span>
						</div>
					</div>	
				</div>
			</div>
		</div>
		<div class="container">
			<div class="col-xs-12">
				<table class="table table-bordered table-hover table-striped" id="table-bordered" style="width: 100%;" >
					<br>
							<tr style="font-size: 12px;border-top: 1px solid #ddd;">
								<th style="width:0px;">ល.រ</br>Nº</th>
								<th style="width:0px;">លេខកូដទំនិញ<br>Product code</th>
								<th>បរិយាយ<br>Description</th>
								<th>ខ្នាត<br>Unit</th>
								<th>ចំនួន<br>Qty</th>
								<th>តំលៃ<br>Unit Price</th>
								<th>សរុប<br>Amount</th>
							</tr>
							<?php 
							$row_tr=0;
							$i = 1;
							$stotal = 0;
							$unit = "";
							
							$qty = 0;
								foreach($rows as $row){
									if($row->option_id == 0 || $row->option_id==""){
										$unit = $row->uname;
										$qty = $row->quantity;
									}else{
										$unit = $row->variant;
										$qty = $row->quantity;
									}
							?>
								<tr class="blank" style="font-size: 13px;border-bottom: 1px solid #ddd;">
									<td><center><?= $i;?></center></td>
									<td><?=$row->product_code?></td>
									<td><?=$row->product_name?></td>
									<td><center><?=$unit?></center></td>
									<td style="text-align:center;"><?= $this->erp->formatQuantity($row->quantity); ?></td>
									<td style="text-align:center;">
										<?php if($row->unit_price == 0){echo "Free";}else{echo '$'.$this->erp->formatMoney($row->unit_price);} ?>
									</td>
									<td style="text-align:center;">
									<?php if($row->unit_price == 0){echo "Free";}else{ echo $row->subtotal!=0?'$ - '.$this->erp->formatMoney($row->subtotal):$t; ?>&nbsp<?php echo $sym;}?> </td>		
								</tr>
								<?php
								$i++;
								$row_tr++;	
								$stotal +=$qty*$row->unit_price;
								}
								
								for($k = $row_tr;$k<19;$k++){
								?>
								<tr style="font-size: 13px;border 1px solid #ddd;" class="blank">
									<td><center><?=$i?><center></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							<?php 
							$i++;
								}
								?>
						<tr style="font-size: 12px;">
							<td colspan="6"style="text-align:right; font-weight:bold;"><?= lang("total_amount"); ?>
								 (<?= $default_currency->code; ?>)
							</td>
							<td style="text-align:right; font-weight:bold;"><?= '$ - '.$this->erp->formatMoney($inv->grand_total); ?></td>
						</tr>
						<tr style="font-size: 13px;" class="footer" >
							<td colspan="7">
								<div style="margin-top:60px;font-size:11px;width:100%">
									<div style="float:left;width:50%">
										<p style="text-align:center">.......................................</p>
										<p style="text-align:center">អ្នកប្រគល់ / Deliver</p>
									</div>
									<div style="float:left;width:50%">
										<p style="text-align:center">.......................................</p>
										<p style="text-align:center">អ្នកទទួល / RECEIVER</p>
									</div>
								</div>
							</td>
						</tr>
				</table>
			</div>
		</div>
	</body>
</html>
<script>
	$("document").ready(function(e){
		window.print();
	}); 
</script>