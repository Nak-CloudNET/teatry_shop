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
		.box1 {
			border: 1px solid #000000;
			height: 95px;
			line-height : 20px;
			padding: 5px;
			width: 50%;
			font-size:11px;
		}
		.box2{
			border: 1px solid #000000;
			height:95px;
			line-height : 20px;
			width:45%;
			padding: 5px;
			font-size:11px;
		}
		.box3{
			height: 95px;
			width: 5%;
		}
		.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
			border:1px solid #000000;
			line-height: 1.2;
			padding: 5px;
			vertical-align: top;
		}
		@media print{
            body {
                width: 100%;
            }
			.box1{
				margin-left : -15px !important;
			}
			.box2{
				margin-right : -15px !important;
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
            <div class="clearfix"></div>
			<div class="row">
				<div class="col-xs-12">
					<h3 class="text-center" style="margin-top: -5px;"><b style="float:left;">TTR II</b><b style="margin-left: -65px;">Delivery Note</b></h3>
					<div class="box1 col-xs-6">
						<div style="font-size: 12px;">
							<div>
								<span><b>ក្រុមហ៊ុន / Company</b></span><span>: <?=$customer->company;?></span>
							</div>
							<div>
								<span><b>អតិថិជន​ / Customer</b></span><span>: <?=$customer->name;?></span>
							</div>
							<div>
								<span><b>អាស័យដ្ឋាន / Address</b></span><span>: <?=$customer->address;?></span>
							</div>
							<div>
								<span><b>លេខទូរស័ព្ទ / Phone No</b></span><span>: <?=$customer->phone;?></span>
							</div>
						</div>
					</div>
					
					<div class="box2 col-xs-6 pull-right">
						<div style="font-size: 12px;">
							<div>
								<span><b><?= lang("Deli_n"); ?><sup>o</sup></b></span><span>: <?=$inv->do_reference_no;?></span>
							</div>
							<div>
								<span><b><?= lang("refer_no"); ?></b></span><span>: <?=$inv->sale_reference_no;?></span>
							</div>
							<div>
								<span><b>ថ្ងៃខែ​ឆ្នាំ / Date</b></span><span>: <?=$this->erp->hrsd($inv->date);?></span>
							</div>
							<div>
								<span><b>PO</b></span><span style="font-weight:bold;">: <?=$po->po ? $po->po : ''; ?></span>
							</div>
						</div>	
					</div>
				</div>
			</div>
            <div class="clearfix"></div>
			<div><br/></div>
            <div class="-table-responsive">
                <table class="table table-bordered table-hover table-striped" style="width: 100%;border-top:1px solid #000">
                    <thead  style="font-size: 13px;">
						<tr>
							<th>ល.រ (<?= lang("n");?><sup>o</sup>)</th>
							<?php if($setting->show_code == 1 && $setting->separate_code == 1) { ?>
							<!--<th>លេខកូដទំនិញ​ (<?= lang('product_code'); ?>)</th>-->
							<?php } ?>
							<th style="vertical-align:top !important;">បរិយាយ(<?= lang("descript"); ?>)</th>
							<th style="vertical-align:top !important;">ឯកតា(<?= lang("unit"); ?>)</th>
							<th style="vertical-align:top !important;">បរិមាណ​ (<?= lang("qty"); ?>)</th>
						</tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php
                            $no = 1;
                            $total_amount = 0;
                            $row = 0;
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
								<td style="text-align:center; width:5%; vertical-align:middle;"><?= $no; ?></td>
								<?php if($setting->show_code == 1 && $setting->separate_code == 1) { ?>
								<!--<td style="vertical-align:middle; width:10%;" >
									<?= $inv_item->code ?>
								</td-->
								<?php } ?>
								<td style="vertical-align:middle;width:50%;">
									<?= $inv_item->description?>
								</td>
                                <td style="vertical-align:middle;width:20%;" class="text-center" >
                                    <?= $str_unit ?>
                                </td>
                                <td style="vertical-align:middle;width:20%;" class="text-center">
                                    <?= $this->erp->formatQuantity($inv_item->qty)?>
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
                            <td style="text-align:right;"><?= $this->erp->formatQuantity($total); ?></td>
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
                        <td style="text-align:center; font-weight:bold;"><?= $this->erp->formatQuantity($total_amount); ?></td>
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
            <div>
                <table style="width: 100%;">
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
