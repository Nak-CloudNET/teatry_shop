
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->lang->line("delivery_note") . " " . $inv->do_reference_no; ?></title>
    <link href="<?php echo $assets ?>styles/theme-inv.css" rel="stylesheet">
    <style type="text/css">
        html, body {
            height: 100%;
            background: #FFF;
        }

        body:before, body:after {
            display: none !important;
        }

        .table th {
            text-align: center;
            padding: 5px;
        }

        .table td {
            padding: 4px;
        }
		hr{
			border-color: #333;
			width:100px;
			margin-top: 70px;
		}
        @media print,screen{
            body {
                width: 100%;
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
<div class="print_rec" id="wrap" style="width: 90%; margin: 0 auto;">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($logo) { ?>
				<div class="col-xs-3 text-center" style="margin-bottom:20px;">
                    <img style="width:150px" src="<?= base_url() . 'assets/uploads/logos/' . $biller->logo; ?>" alt="">
                </div>
                <div class="col-xs-8 text-center">
                    <?php if($biller->company_kh){ ?>
                        <h2><strong style="text-transform: uppercase;"><?= $biller->company_kh ?></strong></h2>
                    <?php } ?>
                    <h2><strong style="text-transform: uppercase;"><?= $biller->company ?></strong></h2>
                    <?php 
                        if($biller->address){echo $biller->address;}
						echo '<br>';
                        if($biller->phone){echo lang("tel") . " : ".$biller->phone;}
						echo '<br>';
                        if($biller->email){echo "&nbsp &nbsp".lang("email")." : ". $biller->email;}
                    ?> 
					 
                </div>
                <div class="col-xs-1">
                   
                </div>
            <?php } ?>
            <div class="clearfix"></div>
			 <div class="row">
				<div class="col-xs-12 text-center">
					<h2><?= lang("deliver_note")?></h2>
				</div>
			 </div>
            <br>
            <div class="row padding10">
                <div class="col-xs-5" style="float: left;font-size:14px">
                    <table>
                        <tr>
                            <td>
                                <p><?= lang("company");?></p>
                            </td>
                            <td>
                                <p>&nbsp;:&nbsp;</p>
                            </td>
                            <td>
                                <p><?= "<b>".$customer->company."</b>"; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><?= lang("customer");?></p>
                            </td>
                            <td>
                               <p>&nbsp;:&nbsp;</p>
                            </td>
                            <td>
                                <p><?= "<b>".$inv->customer."</b>"; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><?= lang("address");?></p>
                            </td>
                            <td>
                                <p>&nbsp;:&nbsp;</p>
                            </td>
                            <td>
                                <p><?= "<b>".$customer->address."</b>"; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><?= lang("tel");?></p>
                            </td>
                            <td>
                                <p>&nbsp;:&nbsp;</p>
                            </td>
                            <td>
                                <p><?= "<b>".$customer->phone."</b>"; ?></p>
                            </td>
                        </tr>
                    </table>
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-2">
                    
                </div>
                <div class="col-xs-5"  style="float: right;font-size:14px;padding-left:70px !important;">
                    <table>
                        <tr>
                            <td>
                                <p><?= lang("Deli_n"); ?><sup>o</sup></p>
                            </td>
                            <td>
                                <p>&nbsp;:&nbsp;</p>
                            </td>
                            <td>
                                <p><?= "<b>".$inv->do_reference_no."</b>";?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><?= lang("refer_no"); ?></p>
                            </td>
                            <td>
                                <p>&nbsp;:&nbsp;</p>
                            </td>
                            <td>
                                <p><?= "<b>".$inv->sale_reference_no ."</b>";?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><?= lang("po"); ?></p>
                            </td>
                            <td>
                                <p>&nbsp;:&nbsp;</p>
                            </td>
                            <td>
                                <p><?= "<b>".($po->po ? $po->po : '')."</b>";?></p>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <p><?= lang("date"); ?></p>
                            </td>
                            <td>
                                <p>&nbsp;:&nbsp;</p>
                            </td>
                            <td>
                                <p><?= "<b>".$this->erp->hrsd($inv->date)."</b>";?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row padding10" style="display:none">
                <div class="col-xs-6" style="float: left;">
                    <span class="bold"><?= $Settings->site_name; ?></span><br>
                    <?= $warehouse->name ?>

                    <?php
                    echo $warehouse->address . "<br>";
                    echo ($warehouse->phone ? lang("tel") . ": " . $warehouse->phone . "<br>" : '') . ($warehouse->email ? lang("email") . ": " . $warehouse->email : '');
                    ?>
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-5" style="float: right;">
                    <div class="bold">
                        <?= lang("date"); ?>: <?= $this->erp->hrld($inv->date); ?><br>
                        <?= lang("ref"); ?>: <?= $inv->reference_no; ?>
                        <div class="clearfix"></div>
                        <?php $this->erp->qrcode('link', urlencode(site_url('sales/view/' . $inv->id)), 1); ?>
                        <img src="<?= base_url() ?>assets/uploads/qrcode<?= $this->session->userdata('user_id') ?>.png"
                             alt="<?= $inv->reference_no ?>" class="pull-right"/>
                        <?php $br = $this->erp->save_barcode($inv->reference_no, 'code39', 50, false); ?>
                        <img src="<?= base_url() ?>assets/uploads/barcode<?= $this->session->userdata('user_id') ?>.png"
                             alt="<?= $inv->reference_no ?>" class="pull-left"/>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="clearfix"></div>
			<div><br/></div>
            <div class="-table-responsive">
                <table class="table table-bordered table-hover table-striped" style="width: 100%;border-top:1px solid #000>
                    <thead  style="font-size: 13px;">
						<tr>
							<th>ល.រ (<?= lang("n");?><sup>o</sup>)</th>
							<?php if($setting->show_code == 1 && $setting->separate_code == 1) { ?>
							<!--<th>លេខកូដទំនិញ​ (<?= lang('product_code'); ?>)</th>-->
							<?php } ?>
							<th>បរិយាយ(<?= lang("descript"); ?>)</th>
							<th>ឯកតា(<?= lang("unit"); ?>)</th>
							<th>បរិមាណ​ (<?= lang("qty"); ?>)</th>
						</tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php
                            $no = 1;
                            $total_amount = 0;
							$combo_qty = 0;
                            $row = 0;
							$comboLoop = "";
							$combo_units = array();
                        ?>
                       <?php foreach($inv_items as $inv_item) { ?>
                            <?php
                                $str_unit = "";
                                if($inv_item->option_id){
                                    $var = $this->sale_order_model->getVar($inv_item->option_id);
                                    $str_unit = $var->name;
                                }else{
                                    $str_unit = $inv_item->unit;
                                }
                            ?>
							<tr>
								<td style="text-align:center; width:5%;"><?= $no; ?></td>
								<?php if($setting->show_code == 1 && $setting->separate_code == 1) { ?>
								<!--<td style="vertical-align:middle; width:10%;" >
									<?= $inv_item->code ?>
								</td-->
								<?php } ?>
								<td style="vertical-align:middle;width:50%">
									<?= $inv_item->description?>
									<?php 
										if($inv_item->product_type === 'combo')
											{
												$this->db->select('*');
												$this->db->where('erp_combo_items.product_id = "' . $inv_item->product_id . '"');
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
                                <td style="width:20%" class="text-center">
                                    <?php 
										echo $str_unit;
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
                                <td style="width:20%" class="text-center">
                                    <?php
										echo $this->erp->formatQuantity($inv_item->qty);
										foreach ($combo_units as $combo_unit) {
											$combo_qty += $combo_unit->quantity;
											echo '<div style="text-align:center !important; padding:2px;">';
													echo $this->erp->formatQuantity($combo_unit->quantity);
											echo '</div>';
										}
									?>
                                </td>
							</tr>
                            <?php
                            $no++;
                            if($inv_item->option_id){
                                $total_amount +=  $inv_item->qty;
                            }else{
                                $total_amount += $inv_item->qty;
                            }
                            
                            $row++;
                         }
                        ?>
                    </tbody>
                    <tfoot style="font-size: 13px;">
                    <?php
    					$discount_percentage = '';
    					if (strpos(isset($inv->order_discount_id), '%') !== false) {
    						$discount_percentage = $inv->order_discount_id;
					}
                    ?>
                    <?php if (isset($inv->grand_total) != isset($inv->total)) { 
                        $row = 1;
                        
                        if($return_sale && $return_sale->surcharge != 0){
                            $row++;
                        }
                        if($inv->order_discount != 0){
                            $row++;
                        }
                        if($inv->shipping != 0){
                            $row++;
                        }
                        if($inv->shipping != 0){
                            $row++;
                        }
                        if($Settings->tax2 && $inv->order_tax != 0){
                            $row++;
                        }
                    ?>
                        <tr>
                            
                            <td colspan="5" rowspan="<?= $row;?>">
                                <?php if ($inv->note || $inv->note != "") { ?>
                                    <b><p class="bold"><?= lang("note"); ?>:</p></b>
                                <?= $this->erp->decode_html($inv->note); ?>
                                <?php } ?>
                            </td>
                            <td style="text-align:right;"><?= lang("total"); ?>
                                (<?= $default_currency->code; ?>)
                            </td>
                            <?php
                            if ($Settings->tax1) {
                                echo '<td style="text-align:right;">' . $this->erp->formatMoney($inv->product_tax) . '</td>';
                            }
                            if ($Settings->product_discount) {
                                echo '<td style="text-align:right;">' . $this->erp->formatMoney($inv->product_discount) . '</td>';
                            }
                            ?>
                            <td style="text-align:right;"><?= $this->erp->formatMoney($total); ?></td>
                        </tr>
                    <?php } ?>
                    <?php if ($return_sale && $return_sale->surcharge != 0) {
                        echo '<tr><td colspan="5"></td><td colspan="3" style="text-align:right;">' . lang("surcharge") . ' (' . $default_currency->code . ')</td><td style="text-align:right;">' . $this->erp->formatMoney($return_sale->surcharge) . '</td></tr>';
                    }
                    ?>
                    <?php if (isset($inv->order_discount) != 0) {
                        echo '<tr><td colspan="2" style="text-align:right;">' . lang("order_discount") . ' (' . $default_currency->code . ')</td><td style="text-align:right;"><span class="pull-left">'.($discount_percentage?"(" . $discount_percentage . ")" : '').'</span>' . $this->erp->formatMoney($inv->order_discount) . '</td></tr>';
                    }
                    ?>
					<?php if (isset($inv->shipping) != 0) {
                        echo '<tr><td colspan="2" style="text-align:right;">' . lang("shipping") . ' (' . $default_currency->code . ')</td><td style="text-align:right;">' . $this->erp->formatMoney($inv->shipping) . '</td></tr>';
                    }
                    ?>
                    <?php if (isset($Settings->tax2) && isset($inv->order_tax) != 0) {
                        echo '<tr><td colspan="2" style="text-align:right;">' . lang("order_tax") . ' (' . $default_currency->code . ')</td><td style="text-align:right;">' . $this->erp->formatMoney($inv->order_tax) . '</td></tr>';
                    }
                    ?>
                    
                    <tr>
                        <td colspan="2">
                        </td>
                        <td  style="text-align:right; font-weight:bold;"><?= lang("total_amount"); ?>:
                        </td>
                        <td style="text-align:center; font-weight:bold;"><?= $this->erp->formatQuantity($total_amount + $combo_qty); ?></td>
                    </tr>
					<tr>
                        <td colspan="4">
                            <div>
                                <p style="text-align:left; font-weight:bold;"><?= lang("note"); ?>:<?= $this->erp->decode_html($inv->note); ?></p>
							</div>
                        </td>
					</tr>
					<tr>
                        <td colspan="4" style="vertical-align:top !important;">
							<strong>* Additional Remark</strong>
							<ul class="list" style="line-height:1.8">
								<li>សូមបញ្ជាក់ថាហាងយើងខ្ញុំផ្ដល់សេវាបញ្ជូនទំនិញត្រឹមជាន់ផ្ទាល់ដីតែប៉ុណ្ណោះ រាល់ការទាមទារក្រៅ​ពីនេះយើង​ខ្ញុំមិន​ទទួលខុសត្រូវឡើយ​ ។</li>
							</ul>
						</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <br>
            <div class="row">
                    <div class="col-lg-2 col-xs-3" style="font-size: 11px">
                        <p class="bold">
							អ្នកទទួលទំនិញ<br>
                            Receive by
                        </p>
                        <br><br><br><br>
                        <p style="border-top: 1px solid #666;"></p>
                        <p><?= lang("name"); ?> : ...............................</p>
                        <p><?= lang("date"); ?> :  ......../............/............</p>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2 col-xs-3" style="font-size: 11px">
                        <p class="bold">
							អ្នកដឹកជញ្ជូនទំនិញ <br>
                            Delivery by
                        </p>
                        <br><br><br><br>
                        <p style="border-top: 1px solid #666;"></p>
                        <p><?= lang("name"); ?> : ...............................</p>
                        <p><?= lang("date"); ?> :  ......../............/............</p>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2 col-xs-3" style="font-size: 11px">
                        <p class="bold">
							អ្នកលក់ <br>
							Saleman
                        </p>
                        <br><br><br><br>
                        <p style="border-top: 1px solid #666;"></p>
                        <p><?= lang("name"); ?> : ...............................</p>
                        <p><?= lang("date"); ?> :  ......../............/............</p>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2 col-xs-3" style="font-size: 11px">
                        <p class="bold">
							អ្នកបញ្ជេញទំនិញ <br>
                            stock_keeper/issued_by
                        </p>
                        <br><br><br><br>
                        <p style="border-top: 1px solid #666;"></p>
                        <p><?= lang("name"); ?> : ...............................</p>
                        <p><?= lang("date"); ?> : ......../............/............</p>
                    </div>
            </div>
        </div>
    </div>
</div>
<div id="mydiv" style="display:none;">

<div id="wrap" style="width: 90%; margin: 0 auto;">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($logo) { ?>
                <div class="text-center" style="margin-bottom:20px; text-align: center;">
                    <!--<img src="<?= base_url() . 'assets/uploads/logos/' . $Settings->logo; ?>" alt="<?= $Settings->site_name; ?>">-->
                    <img src="<?= base_url() . 'assets/uploads/logos/' . $biller->logo; ?>"
                         alt="<?= $biller->company != '-' ? $biller->company : $biller->name; ?>">
                </div>
            <?php } ?>
            <div class="clearfix"></div>
            <div class="row padding10">
                <div class="col-xs-5" style="float: left;">
                    <h2 class=""><?= $biller->company != '-' ? $biller->company : $biller->name; ?></h2>
                    <?= $biller->company ? "" : "Attn: " . $biller->name ?>
                    <?php
                    echo $biller->address . "<br />" . $biller->city . " " . $biller->postal_code . " " . $biller->state . "<br />" . $biller->country;
                    echo "<p>";
                    if ($biller->cf1 != "-" && $biller->cf1 != "") {
                        echo "<br>" . lang("bcf1") . ": " . $biller->cf1;
                    }
                    if ($biller->cf2 != "-" && $biller->cf2 != "") {
                        echo "<br>" . lang("bcf2") . ": " . $biller->cf2;
                    }
                    if ($biller->cf3 != "-" && $biller->cf3 != "") {
                        echo "<br>" . lang("bcf3") . ": " . $biller->cf3;
                    }
                    if ($biller->cf4 != "-" && $biller->cf4 != "") {
                        echo "<br>" . lang("bcf4") . ": " . $biller->cf4;
                    }
                    if ($biller->cf5 != "-" && $biller->cf5 != "") {
                        echo "<br>" . lang("bcf5") . ": " . $biller->cf5;
                    }
                    if ($biller->cf6 != "-" && $biller->cf6 != "") {
                        echo "<br>" . lang("bcf6") . ": " . $biller->cf6;
                    }
                    echo "</p>";
                    echo lang("tel") . ": " . $biller->phone . "<br />" . lang("email") . ": " . $biller->email;
                    ?>
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-5"  style="float: right;">
                    <h2 class=""><?= $customer->company ? $customer->company : $customer->name; ?></h2>
                    <?= $customer->company ? "" : "Attn: " . $customer->name ?>
                    <?php
                    echo $customer->address . "<br />" . $customer->city . " " . $customer->postal_code . " " . $customer->state . "<br />" . $customer->country;
                    echo "<p>";
                    if ($customer->cf1 != "-" && $customer->cf1 != "") {
                        echo "<br>" . lang("ccf1") . ": " . $customer->cf1;
                    }
                    if ($customer->cf2 != "-" && $customer->cf2 != "") {
                        echo "<br>" . lang("ccf2") . ": " . $customer->cf2;
                    }
                    if ($customer->cf3 != "-" && $customer->cf3 != "") {
                        echo "<br>" . lang("ccf3") . ": " . $customer->cf3;
                    }
                    if ($customer->cf4 != "-" && $customer->cf4 != "") {
                        echo "<br>" . lang("ccf4") . ": " . $customer->cf4;
                    }
                    if ($customer->cf5 != "-" && $customer->cf5 != "") {
                        echo "<br>" . lang("ccf5") . ": " . $customer->cf5;
                    }
                    if ($customer->cf6 != "-" && $customer->cf6 != "") {
                        echo "<br>" . lang("ccf6") . ": " . $customer->cf6;
                    }
                    echo "</p>";
                    echo lang("tel") . ": " . $customer->phone . "<br />" . lang("email") . ": " . $customer->email;
                    ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row padding10">
                <div class="col-xs-5" style="float: left;">
                    <span class="bold"><?= $Settings->site_name; ?></span><br>
                    <?= $warehouse->name ?>

                    <?php
                    echo $warehouse->address . "<br>";
                    echo ($warehouse->phone ? lang("tel") . ": " . $warehouse->phone . "<br>" : '') . ($warehouse->email ? lang("email") . ": " . $warehouse->email : '');
                    ?>
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-5" style="float: right;">
                    <div class="bold">
                        <?= lang("date"); ?>: <?= $this->erp->hrld($inv->date); ?><br>
                        <?= lang("ref"); ?>: <?= $inv->reference_no; ?>
                        <div class="clearfix"></div>
                        <?php $this->erp->qrcode('link', urlencode(site_url('sales/view/' . $inv->id)), 1); ?>
                        <img src="<?= base_url() ?>assets/uploads/qrcode<?= $this->session->userdata('user_id') ?>.png"
                             alt="<?= $inv->reference_no ?>" class="pull-right"/>
                        <?php $br = $this->erp->save_barcode($inv->reference_no, 'code39', 50, false); ?>
                        <img src="<?= base_url() ?>assets/uploads/barcode<?= $this->session->userdata('user_id') ?>.png"
                             alt="<?= $inv->reference_no ?>" class="pull-left"/>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row padding10" style="display:none">
            <div class="-table-responsive">
                <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                    <thead  style="font-size: 13px;">
                    <tr>
                        <th><?= lang("no"); ?></th>
                        <th><?= lang("description"); ?> (<?= lang("code"); ?>)</th>
                        <th><?= lang("quantity"); ?></th>
                        <?php
                        if ($Settings->product_serial) {
                            echo '<th style="text-align:center; vertical-align:middle;">' . lang("serial_no") . '</th>';
                        }
                        ?>
                        <th><?= lang("unit_price"); ?></th>
                        <?php
                        if ($Settings->tax1) {
                            echo '<th>' . lang("tax") . '</th>';
                        }
                        if ($Settings->product_discount) {
                            echo '<th>' . lang("discount") . '</th>';
                        }
                        ?>
                        <th><?= lang("subtotal"); ?></th>
                    </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                    <?php $r = 1;
                    foreach ($rows as $row):
                        ?>
                        <tr>
                            <td style="text-align:center; width:40px; vertical-align:middle;"><?= $r; ?></td>
                            <td style="vertical-align:middle;"><?= $row->product_name . " (" . $row->product_code . ")" . ($row->variant ? ' (' . $row->variant . ')' : ''); ?>
                                <?= $row->details ? '<br>' . $row->details : ''; ?>
                            </td>
                            <td style="width: 80px; text-align:center; vertical-align:middle;"><?= $this->erp->formatQuantity($row->quantity); ?></td>
                            <?php
                            if ($Settings->product_serial) {
                                echo '<td>' . $row->serial_no . '</td>';
                            }
                            ?>
                            <td style="text-align:right; width:90px;"><?= $this->erp->formatMoney($row->real_unit_price); ?></td>
                            <?php
                            if ($Settings->tax1) {
                                echo '<td style="width: 90px; text-align:right; vertical-align:middle;">' . ($row->taxs != 0 && $row->taxs ? '<small>(' . $row->taxs . ')</small> ' : '') . $this->erp->formatMoney($row->item_tax) . '</td>';
                            }
                            if ($Settings->product_discount) {
                                echo '<td style="width: 90px; text-align:right; vertical-align:middle;">' . ($row->discount != 0 ? '<small>(' . $row->discount . ')</small> ' : '') . $this->erp->formatMoney($row->item_discount) . '</td>';
                            }
                            ?>
                           <!--  <td style="vertical-align:middle; text-align:right; width:110px;"><?= $this->erp->formatMoney($row->subtotal);
                                ?></td> -->
                        </tr>
                        <?php
                        $r++;
                    endforeach;
                    ?>
                    </tbody>
                    <tfoot style="font-size: 13px;">
                    <?php
                    $col = 6;
                    if ($Settings->product_serial) {
                        $col++;
                    }
                    if ($Settings->product_discount) {
                        $col++;
                    }
                    if ($Settings->tax1) {
                        $col++;
                    }
                    if ($Settings->product_discount && $Settings->tax1) {
                        $tcol = $col - 2;
                    } elseif ($Settings->product_discount) {
                        $tcol = $col - 1;
                    } elseif ($Settings->tax1) {
                        $tcol = $col - 1;
                    } else {
                        $tcol = $col;
                    }
                    ?>
                    <?php if ($inv->grand_total != $inv->total) { ?>
                        <tr>
                            <td colspan="<?= $tcol; ?>" style="text-align:right;"><?= lang("total"); ?>
                            
                            </td>
                            <?php
                            if ($Settings->tax1) {
                                echo '<td style="text-align:right;">' . $this->erp->formatMoney($inv->product_tax) . '</td>';
                            }
                            if ($Settings->product_discount) {
                                echo '<td style="text-align:right;">' . $this->erp->formatMoney($inv->product_discount) . '</td>';
                            }
                            ?>
                            <td style="text-align:right;"><?= $this->erp->formatMoney($inv->total + $inv->product_tax); ?></td>
                            <td></td>
                        </tr>
                    <?php } ?>
                    <?php if ($return_sale && $return_sale->surcharge != 0) {
                        echo '<tr><td colspan="' . $col . '" style="text-align:right;">' . lang("surcharge") . ' (' . $default_currency->code . ')</td><td style="text-align:right;">' . $this->erp->formatMoney($return_sale->surcharge) . '</td></tr>';
                    }
                    ?>
                    <?php if ($inv->order_discount != 0) {
                        echo '<tr><td colspan="' . $col . '" style="text-align:right;">' . lang("order_discount") . ' (' . $default_currency->code . ')</td><td style="text-align:right;">' . $this->erp->formatMoney($inv->order_discount) . '</td></tr>';
                    }
                    ?>
					<?php if ($inv->shipping != 0) {
                        echo '<tr><td colspan="' . $col . '" style="text-align:right;">' . lang("shipping") . ' (' . $default_currency->code . ')</td><td style="text-align:right;">' . $this->erp->formatMoney($inv->shipping) . '</td></tr>';
                    }
                    ?>
                    <?php if ($Settings->tax2 && $inv->order_tax != 0) {
                        echo '<tr><td colspan="' . $col . '" style="text-align:right;">' . lang("order_tax") . ' (' . $default_currency->code . ')</td><td style="text-align:right;">' . $this->erp->formatMoney($inv->order_tax) . '</td></tr>';
                    }
                    ?>
                    <tr>
                        <td colspan="<?= $col; ?>"
                            style="text-align:right; font-weight:bold;"><?= lang("total_amount"); ?>
                        
                        </td>
                        <td style="text-align:right; font-weight:bold;"><?= $this->erp->formatMoney($inv->grand_total); ?></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="<?= $col; ?>" style="text-align:right; font-weight:bold;"><?= lang("paid"); ?>
                            (<?= $default_currency->code; ?>)
                        </td>
                        <td style="text-align:right; font-weight:bold;"><?= $this->erp->formatMoney($inv->paid); ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="<?= $col; ?>" style="text-align:right; font-weight:bold;"><?= lang("balance"); ?>
                            (<?= $default_currency->code; ?>)
                        </td>
                        <td style="text-align:right; font-weight:bold;"><?= $this->erp->formatMoney($inv->grand_total - $inv->paid); ?></td>
                        <td></td>
                    </tr>

                    </tfoot>
                </table>
            </div>

            <div class="row">
                
                <div class="clearfix"></div>
                <div class="col-xs-4  pull-left" style="float: left;">
                    <p style="height: 80px;"><?= lang("seller"); ?>
                        : <?= $biller->company != '-' ? $biller->company : $biller->name; ?> </p>
                    <hr>
                    <p><?= lang("stamp_sign"); ?></p>
                </div>
                <div class="col-xs-4  pull-right" style="float: right;">
                    <p style="height: 80px;"><?= lang("customer"); ?>
                        : <?= $customer->company ? $customer->company : $customer->name; ?> </p>
                    <hr>
                    <p><?= lang("stamp_sign"); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<br/><br/>
<div id="wrap" style="width: 90%; margin:0px auto;">
<div class="col-xs-10" style="margin-bottom:20px;">

	<button type="button" class="btn btn-primary btn-default no-print pull-left" onclick="window.print();">
		<i class="fa fa-print"></i> <?= lang('print'); ?>
	</button>&nbsp;&nbsp;

</div>
</div> 
<div></div>
<!-- <div style="margin-bottom:50px;">
	<div class="col-xs-4" id="hide" >
		<a href="<?= site_url('sales'); ?>"><button class="btn btn-warning " ><?= lang("Back to Add Sale"); ?></button></a>&nbsp;&nbsp;&nbsp;
		<button class="btn btn-primary" id="print_receipt"><?= lang("Print"); ?>&nbsp;<i class="fa fa-print"></i></button>
	</div>
</div> -->
<script type="text/javascript" src="<?= $assets ?>js/jquery-2.0.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $(document).on('click', '#b-add-quote' ,function(event){
    event.preventDefault();
    localStorage.removeItem('slitems');
    window.location.href = "<?= site_url('quotes/add'); ?>";
  });
});

</script>
</body>
</html>
