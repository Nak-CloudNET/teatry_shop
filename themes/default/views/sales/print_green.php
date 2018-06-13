
<?php 
	//$this->erp->print_arrays($rows);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="<?php echo $assets ?>styles/helpers/bootstrap.min-inv.css" rel="stylesheet">
	<script type="text/javascript" src="<?= $assets ?>js/jquery-2.0.3.min.js"></script>
	
    <title><?php echo $this->lang->line("invoice") . " " . $inv->reference_no; ?></title>
    <style type="text/css">
         body {
			margin-top:0;
			margin-right:10px;
			margin-left:10px;
			margin-bottom:10px;
            
            background: #FFF;
			font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
			font-size:9pt;
        }	
		p{
			line-height: 10px; 
		}
		.list{
				font-size:10px;
			}
		.moneyshow{
			text-align:center;
			padding:0px;
			border-bottom:dotted 1px black;
			font-size:14px;
			
		}
		.bold{font-weight:bold;border-bottom:dotted 2px black !important;}
			ul.list-right{
				list-style-type: none;
				padding-left:5px;
				line-height:2;
				width:100%;
			}
		table{
			border-collapse: collapse;
			
		}
		.frt{
				font-weight:bold;
				font-size:14px;
			}
		td{
			text-align:center;	
			border-bottom:1px solid black;
			line-height: 20px;
			border-right:solid 1px black;
			border-left:solid 1px black;
			height:29px;
			font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
		}	
		.title{
			padding-top:20px;
		}
		.note p{
			line-height:1.7;
		}
		table {
			//font-family: 'Khmer OS'; 
			font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
			color: #000000;
			font-size: 13px;
		}
		.inv-right {
			margin-right: 35px;
			font-family: Khmer OS;
		}
		.inv-left{
			width: 60%;
			font-family: Khmer OS;
		}
		.inv-lef p {
			padding-top:0;
			line-height:0;
		}
		.img-b {
			width:100px;
			text-align:center;
		}
		.w-50 {
			font-family: Arial;
			width:80%;
			display: inline-block;
			
			border-bottom:1px;			
		}
		.lh-25{
			line-height: 22px;
		}
		
		
		@media print {
			.pbreak {page-break-after: always;}
			
		}
		
		.box1 {
			border: 1px solid #000000;
			height: 95px;
			padding: 10px;
			width: 52%;
			font-size:11px;
			line-height : 20px;
		}
		.box2{
			border: 1px solid #000000;
			height:95px;
			width:42%;
			padding: 10px;
			font-size:11px;
			line-height : 20px;
		}
		.box3{
			height: 95px;
			width: 6%;
		}
		
		
    </style>
</head>

<body>
<?php
$bill_to=$customer->name ? $customer->name : $customer->company;
$customer_address=$customer->address;
$tel=$customer->phone;
$inv_no=$inv->reference_no;
$iss_date=$this->erp->hrsd($inv->date);
$address = $biller->address;
$biller_company = $biller->company;
$logo = $biller->logo;
$customer_name = $customer->company;
$saleman = $user->username;
//$this->erp->print_arrays($customer);
$head1='<div class="title">

<div style="margin-top:20px;width:30%;float:left;text-align:center;">
	 <img src="'. base_url() . 'assets/uploads/logos/'.$logo.'" alt="company_logo" width="180"/> 
</div>
<div style="float:left;">
	<div style="width:345px;margin:0 auto;">
		<div style="text-align:center;font-weight:bold;font-size:20px;margin-top: 0;">'.$biller_company.'</div>
		<div style="font-size:16px;font-family:Khmer OS MUOL;text-align:center;font-weight:bold;">ផ្កត់ផ្គង់និងចែកចាយបន្លែគ្រប់ប្រភេទ</div>
		<div style="text-align:center;">'.$address.'</div>
	</div>
	<div style="text-align:center;">
		<p style="font-size:16px;font-family:Khmer OS MUOL;font-weight:bold;">វិក័យប័ត្រ</p>
		<p style="font-size:16px;font-family:Khmer OS MUOL;font-weight:bold;">Invoice</p>
	</div>
</div>
	<div style="float: left" class="inv-left">
		<p>
			<span style="font-size:13px;font-family:Khmer OS"><b>ឈ្មោះអតិថិជន :  </b></span>
			<span style="font-size:13px;font-family:Khmer OS"><b>'.$customer_name.' </b></span>
		</p>
		<p>
			<span style="font-size:13px;font-family:Khmer OS"><b>លេខទូរស័ព្ទ :  </b></span>
			<span style="font-size:13px;font-family:Khmer OS"><b>'.$tel.' </b></span>
		</p>
			<div style="margin-top:-15px;float:left;font-size:13px;font-family:Khmer OS"><b><p style="line-height:20px;">អាស័យដ្ផាន : </p></b></div>
			<div style="margin-top:-15px;float:left;width:300px;font-size:13px;font-family:Khmer OS"><b><p style="line-height:20px;">'.$customer_address.'</p></b></div>
		
		
	</div>
	<div style="float: right" class="inv-right">
		<p>
			<span style="font-size:13px;font-family:Khmer OS"><b>លេខវិក័យប័ត្រ :  </b></span>
			<span style="font-size:13px;font-family:Khmer OS"><b>'.$inv_no.' </b></span>
		</p>
		<p>
			<span style="font-size:13px;font-family:Khmer OS"><b>កាលបរិច្ឆេទ :  </b></span>
			<span style="font-size:13px;font-family:Khmer OS"><b>'.$iss_date.' </b></span>
		</p>
		<p>
			<span style="font-size:13px;font-family:Khmer OS"><b>អ្នកលក់ :  </b></span>
			<span style="font-size:13px;font-family:Khmer OS"><b>'.$saleman.' </b></span>
		</p>
		
	</div>
	<div class="clearfix"></div>
			
	</div>' ;
	
	$head='
			<h2 class="text-center"><b style="float:left">TTR II</b><b>វិក័យប័ត្រ /  Invoice</b></h2>
			
			<div class="col-xs-12" style="margin-bottom:15px;">
				<div class="box1 col-xs-5" style ="border:1px solid black;">
					<div style="font-size: 12px;">
						<div>
							<span><b>ក្រុមហ៊ុន / Company</b></span><span>: ' . $customer->company . '</span>
						</div>
						<div>
							<span><b>អតិថិជន​ / Customer</b></span><span>: ' . $customer->name . '</span>
						</div>
						<div>
							<span><b>អាស័យដ្ឋាន / Address</b></span><span>: ' . $customer->address . '</span>
						</div>
						<div>
							<span><b>លេខទូរស័ព្ទ / Phone No</b></span><span>: '. $customer->phone .'</span>
						</div>
					</div>
				</div>
				<div class="box3 col-xs-2"></div>
				<div class="box2 col-xs-5" style ="border:1px solid black;>
					<div style="font-size: 12px;">
						<div>
							<span><b>ថ្ងៃខែ​ឆ្នាំ / Date</b></span><span>: '. $this->erp->hrsd($inv->date) .'</span>
						</div>
						<div>
							<span><b>លេខ​វិ​ក័​យ​ប័ត្រ / Invoice no</b></span><span style="font-weight:bold;">: '. $inv->reference_no .'</span>
						</div>
						<div>
							<span><b>PO</b></span><span style="font-weight:bold;">: '. $inv->po .'</span>
						</div>
						
						
					</div>	
				</div>
			</div>';
	
$table='<div class="col-xs-12"><table width="100%">
				<tr style="border-top:solid 1px black; 
					border-bottom:solid 1px black;">
					<td width="5%"><b>ល.រ</b><br/>
					<td  width="40%"><b>បរិយាយ</b><br/><b>Description</b>
					<td  width="10%"><b>ខ្នាត</b><br/><b>Unit</b>
					<td  width="10%"><b>ចំនួន</b><br/><b>Qty</b>
					<td  width="10%"><b>តំលៃ</b><br/><b>Unit Price</b>
					<td  width="13%"><b>បញ្ជុះតម្លៃ</b><br/><b>Discount</b>
					<td  width="12%"><b>តំលៃសរុប</b><br/><b>Amount</b>
				</tr>
			';
			

					$total = 0;
					$i=1;
					// get blank rows
					
					$c=1;
					foreach($rows as $row){
						$total_page = ceil($c/14);
						$c++;
					}
					$max_items = $total_page * 14;
					$total_item = sizeof($rows);
					$blank_rows = $max_items - $total_item;
					
					foreach ($rows as $row):
					
					$n_page=ceil($i/14);
					$free = lang('free');
					$product_name = $row->product_name;
					//$this->erp->print_arrays($product_name);
					//$product_name = word_limiter(strip_tags($product_name), 5);
					$discount = $row->discount > 0 ? '('.$row->discount .')'.' '.$row->item_discount :'0.000';
					$unit = $row->unit;
					
					$qty=$row->subtotal!=0?$this->erp->formatMoney($row->unit_price):$free;
					$amount=$row->subtotal!=0?$this->erp->formatMoney($row->subtotal):$free;
					
					
					if($i==14 || $i==28 || $i==42 || $i==56 || $i==70){
						if(mb_strlen($product_name, "UTF-8") > 45){
							$arr = explode("/", $product_name);
							$tablebody[$n_page].='<tr border-bottom:solid 1px black;">
							<td>'.$i.'</td>
							<td style="text-align:left;text-align:left;font-size:13px;padding-left:5px;line-height:1.3">
								<div style="position:relative;">
									<div style="position:absolute;top:-17px;">'.$arr[0].'</div>
									<div style="position:absolute;top:-2px;">'.$arr[1].'</div>
								</div>
							</td>
							<td style="text-align:center;">'.$unit.'</td>
							<td>'.$this->erp->formatDecimal($row->quantity).'</td>
							<td style="font-weight:bold;">'.$qty.'</td>
							
							<td style="font-weight:bold;">'.$discount.'</td>
							<td>$'.$amount.'</td>
							</tr>';
							
						}else{
							
							$tablebody[$n_page].='<tr border-bottom:solid 1px black;">
							<td>'.$i.'</td>
							<td style="text-align:left;font-size:13px;padding-left:5px;">'.$product_name.'</td>
							<td style="text-align:center;">'.$unit.'</td>
							<td>'.$this->erp->formatDecimal($row->quantity).'</td>
							<td>$'.$qty.'</td>
							<td style="font-weight:bold;">'.$discount.'</td>
							<td>$'.$amount.'</td>
							</tr>';
						}
						
						
					}else{
						
						if(mb_strlen($product_name, "UTF-8") > 45){
							//$this->erp->print_arrays(mb_strlen($product_name, "UTF-8"));
							$arr = explode("/", $product_name);
							$tablebody[$n_page].='<tr>
							<td>'.$i.'</td>
							<td style="text-align:left;text-align:left;font-size:13px;padding-left:5px;line-height:1.3">
								<div style="position:relative;">
									<div style="position:absolute;top:-17px;">'.$arr[0].'</div>
									<div style="position:absolute;top:-2px;">'.$arr[1].'</div>
								</div>
							</td>
							<td style="text-align:center;">'.$unit.'</td>
							<td>'.$this->erp->formatDecimal($row->quantity).'</td>
							<td>$'.$qty.'</td>
							<td style="font-weight:bold;">'.$discount.'</td>
							<td>$'.$amount.'</td>
							</tr>';
							
						}else{
							
							$tablebody[$n_page].='<tr>
							<td>'.$i.'</td>
							<td style="text-align:left;font-size:13px;padding-left:5px;">'.$product_name.'</td>
							<td style="text-align:center;">'.$unit.'</td>
							<td>'.$this->erp->formatDecimal($row->quantity).'</td>
							<td>$'.$qty.'</td>
							<td style="font-weight:bold;">'.$discount.'</td>
							<td>$'.$amount.'</td>
							</tr>';
						}
						
					}
					
					$total += $row->subtotal;
					
					$i++;
                    endforeach;
					
					// make blank row 
					$num_row=$i;
					
					$none_row=$n_page*14;
					for($num_row;$num_row<=$none_row;$num_row++){
						if($num_row==$none_row){
							$tablebody[$n_page].='<tr style="border-bottom:solid 1px black;height:28px;">
							<td>'.$num_row.'</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							</tr>';
							
						}else{	
							$tablebody[$n_page].='<tr style="height:29px;">
							<td>'.$num_row.'</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							</tr>';
						}						
					}
					
					$total=$this->erp->formatMoney($inv->total);	
					$discount=$this->erp->formatMoney($inv->total_discount);
					$deposit=$this->erp->formatMoney($inv->total - $inv->paid);
					$paid = $inv->paid ? $this->erp->formatMoney($inv->paid): 0;
					$sub_total=$this->erp->formatMoney($inv->grand_total);
					$customer_balance = $inv->old_invoice_balance?$inv->old_invoice_balance:0;
					$grand_total = $inv->grand_total - $inv->paid + $customer_balance;
		
$tablebtmnone='	<tr>
					<td colspan="3" style="border:0 !important;height:25px !important;" ></td>
					<td colspan="2" style="text-align:left;border:solid 1px black;height:25px !important;"><b>ទឹកប្រាក់សរុប</b></td>
					<td style="border:solid 1px black;text-align:right;height:25px !important;"><b style="font-size:12pt;font-family:Arial;">&nbsp;</b></td>
				</tr>
				<tr>
					<td colspan="3" style="border:0 !important;height:25px !important;"></td>
					<td colspan="2" style="text-align:left;border:solid 1px black;height:25px !important;"><b>បញ្ចុះតំលៃ</b> </td>
					<td style="border:solid 1px black;text-align:right;height:25px !important;"><b style="font-size:12pt;font-family:Arial;"> &nbsp;</b></td>
				</tr>
				<tr>
					<td colspan="3" style="border:0 !important;height:25px !important;"></td>
					<td colspan="2" style="text-align:left;border:solid 1px black;height:25px !important;"><b>ប្រាក់កក់</b> </td>
					<td style="border:solid 1px black;text-align:right;height:25px !important;"><b style="font-size:12pt;font-family:Arial;"> &nbsp;</b></td>
				</tr>
				<tr>
					<td colspan="3" style="border:0 !important;height:25px !important;"></td>
					<td colspan="2" style="text-align:left;border:solid 1px black;height:25px !important;"><b>សរុប </b></td>
					<td style="border:solid 1px black;text-align:right;height:25px !important;"><b style="font-size:12pt;font-family:Arial;">&nbsp;</b></td>
				</tr>
			'	;
			
$tableend='</table></div>';

$btm = '<div class="col-xs-12">
			<div style="height:70px;border:1px solid black;">
				<div style ="padding-left:5px; padding-top:5px;font-size:14px;font-weight:bold;">Note:</div>
				<div style ="padding-left:5px;" class = "note">'.$inv->note.'</div>
			</div>
		<div>
	<table style="width:100%;">
		<tr>
		<td style="width:60%;text-align:left; padding:10px;">
		<div class="foot-left">
			<h4>Additional Remark</h4>
			<ul class="list">
				<li>ទំនិញទិញហើយមិនអាចប្តូរយកប្រាក់វិញបានឡើយ.</li>
				<li>អ្នកទិញត្រូវរាប់និងពិនិត្យទំនិញឲ្យបានត្រឺមត្រូវ មុនចុះហត្ថលេខាទទួល.</li>
				<li>ចំពោះទំនិញដែលបានកម្មង់គឺមិនអាចសងចូលវិញបានទេ.</li>
				<li>តំលៃទំនិញទាំងអស់នេះមិនរាប់បញ្ជូលជាមួយ ប្រាក់ពន្ធបន្ថែម VAT 10%​ នោះទេ.</li>
				<li>សូមបញ្ជាក់ថាហាងយើងខ្ញុំផ្ដល់សេវាបញ្ជូនទំនិញត្រឹមជាន់ផ្ទាល់ដីតែប៉ុណ្ណោះ រាល់ការទាមទារក្រៅពីនេះយើងខ្ញុំមិនទទួលខុសត្រូវឡើយ.</li>
			</ul>
		</div>
		</td>
		<td style="width:40%;text-align:left;">
			<div class="foot-right" style="width: 100%;">
				<ul class="list-right">
					<li>
						<span class="frt">ការដឹកជញ្ជូន /  Shipping :</span>
						<span class="moneyshow"> '. $this->erp->formatMoney($inv->shipping) .' $</span>
					</li>
					
					<li>
						<span class="frt">សរុប / Total :</span>
						<span class="moneyshow"> '. $this->erp->formatMoney($inv->total) .' $</span>
					</li>
					
					<li>
						<span class="frt">បញ្ចុះតម្លៃ /  Discount :</span>
						<span class="moneyshow"> '. $this->erp->formatMoney($inv->order_discount) .'$</span>
					</li>
					<li>
						<span class="frt">ប្រាក់កក់​ / Deposited:</span>
						<span class="moneyshow">  '. $this->erp->formatMoney($inv->paid) .' $</span>
					</li>
					<li>
						<span class="frt">ប្រាក់នៅខ្វះ  /  Balance :</span>
						<span class="moneyshow bold"> '. $this->erp->formatMoney($inv->grand_total-$inv->paid) .' $</span>
					</li>
					<li>
						<span class="frt">Amount In Word : </span>
						<span class="moneyshow">
							'. $this->erp->convert_number_to_words($inv->grand_total-$inv->paid) .'
						</span>
					</li>
				</ul>
			</div>
		</td>
		</tr>
		
	</table>
	
	<table style="width:100%;">
		<tr>
			<td>
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
		
	</table>
	
</div></div><div style="text-align:right;margin-right:20px;">'.'page '.$n_page. ' of '.$n_page.'</div>';

$signature = '<div class="col-xs-12">
			<div style="height:70px;border:1px solid black;">
				<div style ="padding-left:5px; padding-top:5px;font-size:14px;font-weight:bold;">Note:</div>
				<div style ="padding-left:5px;" class = "note">'.$inv->note.'</div>
			</div>
			<table style="width:100%;">
				<tr>
				<td style="width:70%;text-align:left; padding:10px;">
				<div class="foot-left">
					<h4>Additional Remark</h4>
					<ul class="list" style="">
						<li>ទំនិញទិញហើយមិនអាចប្តូរយកប្រាក់វិញបានឡើយ.</li>
						<li>អ្នកទិញត្រូវរាប់និងពិនិត្យទំនិញឲ្យបានត្រឺមត្រូវ មុនចុះហត្ថលេខាទទួល.</li>
						<li>ចំពោះទំនិញដែលបានកម្មង់គឺមិនអាចសងចូលវិញបានទេ.</li>
						<li>តំលៃទំនិញទាំងអស់នេះមិនរាប់បញ្ជូលជាមួយ ប្រាក់ពន្ធបន្ថែម VAT 10%​ នោះទេ.</li>
						<li>សូមបញ្ជាក់ថាហាងយើងខ្ញុំផ្ដល់សេវាបញ្ជូនទំនិញត្រឹមជាន់ផ្ទាល់ដីតែប៉ុណ្ណោះ រាល់ការទាមទារក្រៅពីនេះយើងខ្ញុំមិនទទួលខុសត្រូវឡើយ.</li>
					</ul>
				</div>
				</td>
				<td style="width:30%;text-align:center;">
					<p>CONTINUE</p>
				</td>
				</tr>
				
			</table>
			
			<table style="width:100%;">
				<tr>
					<td>
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
				
			</table>
			
		</div></div><div style="text-align:right;margin-right:20px;">'.'page 1'.' of '.$n_page.'</div>';


			
?>

<?php if($blank_rows <= 0) { ?>
	<?php			
		for($j=1;$j<=$n_page;$j++){
			if($j==$n_page){
				
				echo '<div>'.$head.'</div><div>'.$table.''.$tablebody[$j];
				echo $tableend.'</div>'.$btm;
			}
			else{
				echo '<div>'.$head.'</div><div>'.$table.''.$tablebody[$j].''.$signature;
				echo $tableend.'</div><div style="width:100%;height:1px;"class="pbreak clearfix"></div>';
			}
		}
	?>
<?php }else{ ?>
	<?php
		
		for($j=1;$j<=$n_page;$j++){
			if($j==$n_page){
				
				echo '<div><button class="printing"><i class="fa fa-print"></i>Print</button>'.$head.'</div><div>'.$table.''.$tablebody[$j];
				echo $tableend.'</div>'.$btm.'<div style="width:100%;height:1px;" class="pbreak clearfix"></div>';
			}
			else{
				
				echo '<div>'.$head.'</div><div>'.$table.''.$tablebody[$j];
				echo $tableend .''.$signature .'</div><div style="width:100%;height:1px;"class="pbreak clearfix"></div>';
			}
		}
	?>
<?php } ?>

</body>

</html>


<script>
	
	$("document").ready(function(e){
		//window.print();
		$( ".printing" ).click(function() {
		  $(this).hide();
		  window.print();
		});
		
	});
</script>
