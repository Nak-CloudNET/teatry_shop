<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->lang->line("quotes") . " " . $inv->reference_no; ?></title>
    <link href="<?php echo $assets ?>styles/theme.css" rel="stylesheet">
   <style type="text/css">
   
		@media print{
			.authorized{margin:0px auto !important}
		}
		
		.table-fill td{
			padding:5px;
			border:1px solid #000000;
		}
		.border-none{border-top:none !important;border-bottom:none !important;}
	</style> 
</head>

<body>
	<div class="box">
		<div class="container bottom-print">
			<div class="text-center" style="padding:10px;"> 
				<button class="btn btn-xs btn-default no-print pull-left" onclick="window.print()"><i class="fa fa-print"></i>&nbsp;<?= lang("print"); ?></button>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 " style="margin-top:20px">
					<div class="col-xs-4 text-center">
						<img style="width:120px" src="<?= base_url() . 'assets/uploads/logos/' . $biller->logo; ?>"alt="<?= $biller->company != '-' ? $biller->company : $biller->name; ?>">
					</div>
					<div class="col-xs-8  text-letf">
						<h3 style="text-transform: uppercase;">tea try 2 color center</h3>
						<span>
							<?php
								if($biller->address){echo $biller->address."<br>";}
								if($biller->phone){echo lang("tel") . " : ".$biller->phone;}
								if($biller->email){echo "&nbsp &nbsp".lang("email")." : ". $biller->email;}
							?>     
						</span>
					</div>
				</div>
				<div class="col-xs-12">
					<hr style="border-top: 1px solid #000000;margin-top:10px">
				</div>
				<div class="col-xs-12 text-center" style="margin-top:-20px;margin-bottom: 10px;">
					<h3 style="text-transform: uppercase;" style=""><?= lang("quote"); ?></h3>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 ">
					<table class="table-fill" style="width:100%">
						<tr>
							<td style="width:90px"><strong>Issue_to :</strong></td>
							<td style="width:380px"><?= $customer->company; ?></td>
							<td style="width:110px"><strong><?= lang("date");?> :</strong></td>
							<td><?= $this->erp->hrsd($inv->date); ?></td>
						</tr>
						
						<tr>
							<td><strong>Attn :</strong></td>
							<td><?= $customer->name; ?></td>
							<td><strong><?= lang("quote_no");?> :</strong></td>
							<td><?= $inv->reference_no; ?></td>
						</tr>
						<tr>
							<td><strong>Contact :</strong></td>
							<td><?= $customer->phone; ?></td>
							<td><strong><?= lang("sales_person");?> :</strong></td>
							<td><?= $inv->username; ?></td>
						</tr>
						<tr>
							<td><strong><?= lang("address");?> :</strong></td>
							<td><?= $customer->address; ?></td>
							<td><strong><?= lang("po");?> :</strong></td>
							<td><?= $inv->po; ?></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 ">
					<table class="table-fill" style="width:100%;margin-top:15px">
						<tr class="text-center" style="font-weight:bold;">
							<td style="width:5%;"><?= lang("no");?></td>
							<td style="width:60%;"><?= lang("description");?></td>
							<td style="width:10%;"><?= lang("units");?></td>
							<td style="width:10%;"><?= lang("quantity");?></td>
							<td style="width:15%;"><?= lang("amount");?></td>
						</tr>
						<?php 
							$r = 1;
							$total=0; 
							$free = lang('free');
							$comboLoop = "";
							$combo_units = array();
						?>
                        <?php 
							foreach ($quote_items as $quote_item): 
						?>
						<?php
							if($quote_item->option_id){
								$getvar = $this->sales_model->getAllProductVarain($quote_item->product_id);
								
								foreach($getvar as $varian){
									$Max_unitqty = $this->sales_model->getMaxqty($varian->product_id);
									$Min_unitqty = $this->sales_model->getMinqty($varian->product_id);
									$maxqty =  $Max_unitqty->maxqty;
									$minqty =  $quote_item->quantity;
									$Max_unit = $this->sales_model->getMaxunit($maxqty,$quote_item->product_id);
									$Min_unit = $this->sales_model->getMinunit($Min_unitqty->minqty,$quote_item->product_id);
									$maxunit = $Max_unit->name;
									$minunit = $Min_unit->name;  
								}
								}else{
									$maxunit = " ";
									$minunit = $quote_item->product_unit;                                
								}
                        ?>
							<tr>
								<td class="border-none" style="text-align:center; width:5%; vertical-align:top;">
									<?= $r; ?>
								</td>
								<td class="border-none" style="width:40%" >
									<?= (isset($product_name_setting) ? $product_name_setting : "") ?>
									<?= $quote_item->product_name ? $quote_item->product_name : ''; ?>
									<?php 
										if($quote_item->product_noted){
											echo '('. $quote_item->product_noted .')';
										}
									?>
									<?php										
											if($quote_item->product_type === 'combo')
												{
													$this->db->select('*');
													$this->db->where('erp_combo_items.product_id = "' . $quote_item->product_id . '"');
													$comboLoop = $this->db->get('erp_combo_items');
													$c = 1;	
													$combo_units = $comboLoop->result();
													$cTotal = count($comboLoop->result());													
														foreach ($comboLoop->result() as $val) {
															$this->db->select('erp_products.*, erp_units.name as unit_name');
															$this->db->join('erp_units', 'erp_units.id = erp_products.unit', 'left');
															$q = $this->db->get_where('erp_products', array('erp_products.code' => $val->item_code))->row();
															echo '<div style="margin-left:20px; padding:2px;"' . ($c === $cTotal ? 'class="item"' : '') . '>';
																	echo $c . '. ' . $q->name;
															echo '</div>';
															$c++;
														}
												}
										?>
								</td>
								<td class="border-none" style="text-align:center; vertical-align:top;width: 10px;">
                                    <?php
										echo $quote_item->product_unit;
										foreach ($combo_units as $combo_unit) {
											$this->db->select('erp_products.*, erp_units.name as unit_name');
											$this->db->join('erp_units', 'erp_units.id = erp_products.unit', 'left');
											$q = $this->db->get_where('erp_products', array('erp_products.code' => $combo_unit->item_code))->row();
											echo '<div style="text-align:center !important; padding:2px;">';
													echo $q->unit_name;
											echo '</div>';
										}
									?>
                                </td>
								<td class="border-none" style="width: 10%; text-align:center; vertical-align:top;">
									<?php
										echo $this->erp->formatQuantity($quote_item->quantity); 
										foreach ($combo_units as $combo_unit) {
											echo '<div style="text-align:center !important; padding:2px;">';
													echo $this->erp->formatQuantity($combo_unit->quantity);
											echo '</div>';
										}
									?>
								</td>
								<td class="border-none" style="text-align:center; width:15%;vertical-align:top;">
									<?= $quote_item->subtotal !=0 ? $this->erp->formatMoney($quote_item->subtotal) : $free; ?>
								</td>
							</tr>
                        <?php $r++ ?>
						<?php endforeach;?>
						<tr>
							<td colspan="4" style="text-align:right; font-weight:bold;">
								<?= lang("total_amount"); ?>(<?= $default_currency->code; ?>)
							</td>
							<td style="text-align:center; font-weight:bold;">
								$<?= $this->erp->formatMoney($inv->grand_total); ?>
							</td>
						</tr>	
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12" style="margin-top:20px">
					<div class="col-xs-7 text-letf">
						<p style="width:230px !important" class="text-center"><strong><?= lang("customer"); ?></strong></p>
                        <p>&nbsp;</p>
                        <p style="border-bottom: 1px solid #666;width:240px">&nbsp;</p>
                        <p><?= lang("name"); ?> :  ........................................................</p>
                        <p><?= lang("date"); ?> :  ................/................../.....................</p>
					</div>
					<div class="col-xs-5 text-letf">
						<p style="width:230px !important" class="text-center"><strong><?= lang("authorized_by"); ?></strong></p>
                        <p>&nbsp;</p>
                        <p style="border-bottom: 1px solid #666;width:240px">&nbsp;</p>
                        <p><?= lang("name"); ?> :  ........................................................</p>
                        <p><?= lang("date"); ?> :  ................/................../.....................</p>
					</div>
				</div>
			</div>
			<div class="col-xs-4 no-print">
				<a href="<?= site_url('Quotes'); ?>">
					<button class="btn btn-warning " ><?= lang("Back to List Quote"); ?></button>
				</a>
				<a href="<?= site_url('Quotes'); ?>">
					<button class="btn btn-primary " ><?= lang("Combo Invoice A4"); ?></button>
				</a>
			</div>
		</div>
	</div>
</body>

</html>
