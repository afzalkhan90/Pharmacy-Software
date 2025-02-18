<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Invoice Print</title>

		<style>
			.invoice-box {
				max-width: 400px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				    border-collapse: collapse;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				/*border-top: 2px solid #eee;*/
				font-weight: bold;
				
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>
<?php
     
             require_once('constant/connect.php');
              $sql = "SELECT  * FROM purchase_invoice WHERE   pid='".$_GET['id']."' ";
              //echo $sql;exit;
$result = $connect->query($sql);
foreach ($result as $row) { //print_r($row);exit;

             ?>
	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="8">
						<table>
							<tr> 
								<td class="title">
									<img src="assets/uploadImage/Logo/logo.png" style="width: 100%; max-width: 170px" />
								</td>

								<td >
									<h2 style="margin:0 0 11px;">Invoice</h2><b> #:</b> <?php echo $row['inv_no'] ?><br />
									<b>Date:</b> <?php echo $row['date'] ?><br />
									
								</td>
								
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="8">

						<table>
							<tr><?php 
							 require_once('constant/connect.php');
								$sql1 = "SELECT email,address,user_id FROM users ";
              //echo $sql;exit;
$result1 = $connect->query($sql1);
//echo $result1;exit;
foreach ($result1 as $row1) {?>
								<td>
									<?php echo $row1[''] ?><br />
									<?php echo $row1[''] ?><br />
									
								</td>
<?php } ?>

								<td>
									<b>Company Name: </b> <?php echo $row['comapny'] ?>
									<br />
									<b>Contact Bill No : </b><?php echo $row['compnaybill_no'] ?>
									<br />
									
									
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<!-- <tr class="heading">
					<td colspan="3">Payment Method</td>

					<td colspan="4">Amount</td>
				</tr>

				<tr class="details">
					<td colspan="3"><?php if($row['paymentType']==4){echo "Phone Pe";} if($row['paymentType']==5){echo "Google Pay";} if($row['paymentType']==3){echo "Credit Card";} if($row['paymentType']==2){echo "Cash";} if($row['paymentType']==1){echo "Cheque";}?></td>

					<td colspan="4"><?php echo $row['grandTotalValue'] ?></td>

				</tr> -->

				<tr class="heading">
					<td>Medicine Name</td>
					<td>Quantity</td>
					<td>Rate</td>
					<td>Total</td>
					<td>Discount</td>

					
				</tr>
<?php 
							 require_once('constant/connect.php');
								$sql2 = "SELECT * FROM purchase_order_tem WHERE last_id='".$_GET['id']."' ";
              //echo $sql2;exit;
$result2 = $connect->query($sql2);
//echo $result2;exit;
foreach ($result2 as $row2) { //print_r($row2);exit; ?>
				<tr class="item">
<td><?php
                                                       //echo "SELECT * FROM product WHERE product_id='".$row2['productName']."'";exit;
                     $stmt1 = "SELECT * FROM product WHERE product_id='".$row2['product_name']."'";
                     $result2 = $connect->query($stmt1);

                     foreach($result2 as $key1)
                     ?>
                       
                    <?php echo $key1['product_name'];?></td>
					
					
					<td><?php echo $row2['quantity'] ?></td>
					
					<td><?php echo $row2['rate'] ?></td>

					<td><?php echo $row2['total']; ?></td>
					
					<td><?php echo $row2['discount'] ?></td>
				</tr>
				<!-- <tr>
					
					<td colspan="3"  style="border: 1px solid;text-align: left;">TOTAL DISCOUNT</td>
					<?php

$stmt1 = "SELECT * FROM orders WHERE clientName='".$row['clientName']."'";
                     $cola = $connect->query($stmt1);

                     foreach($cola as $pepsi)
					 ?>
					<td  style="border: 1px solid"><?php echo $pepsi['discount'] ?></td>
				</tr> -->
				<!-- <tr>
					<td colspan="3"  style="border: 1px solid">TOTAL GST</td>
					<td  style="border: 1px solid;text-align: left;"><?php echo $pepsi['gstn'] ?></td>
				</tr> -->
				<!-- <tr>
					<td colspan="3" style="border: 1px solid">GRAND TOTAL</td>
					<td style="border: 1px solid;text-align: left;"><?php echo $pepsi['grandTotalValue'] ?></td>
				</tr> -->
				
<?php $totalAmount += $pepsi['grandTotalValue'];}?>

		
				<tr class="total" >
					
					
<?php
 
// $number = $totalAmount;
//    $no = floor($number);
//    $point = round($number - $no, 2) * 100;
//    $hundred = null;
//    $digits_1 = strlen($no);
//    $i = 0;
//    $str = array();
//    $words = array('0' => '', '1' => 'One', '2' => 'Two',
//     '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
//     '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
//     '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
//     '13' => 'Thirteen', '14' => 'Fourteen',
//     '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
//     '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
//     '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
//     '60' => 'Sixty', '70' => 'Seventy',
//     '80' => 'Eighty', '90' => 'Ninety');
//    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
//    while ($i < $digits_1) {
//      $divider = ($i == 2) ? 10 : 100;
//      $number = floor($no % $divider);
//      $no = floor($no / $divider);
//      $i += ($divider == 10) ? 1 : 2;
//      if ($number) {
//         $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
//         $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
//         $str [] = ($number < 21) ? $words[$number] .
//             " " . $digits[$counter] . $plural . " " . $hundred
//             :
//             $words[floor($number / 10) * 10]
//             . " " . $words[$number % 10] . " "
//             . $digits[$counter] . $plural . " " . $hundred;
//      } else $str[] = null;
//   }
//   $str = array_reverse($str);
//   $result = implode('', $str);
//   $points = ($point) ?
//     "." . $words[$point / 10] . " " . 
//           $words[$point = $point % 10] : '';
  

 ?> 

<tr class="information">
					<td colspan="8">

						<table>
							<tr><?php 
							 require_once('constant/connect.php');
								$sql1 = "SELECT email,address,user_id FROM users ";
              //echo $sql;exit;
$result1 = $connect->query($sql1);
//echo $result1;exit;
foreach ($result1 as $row1) {?>
								<td>
									<?php echo $row1[''] ?><br />
									<?php echo $row1[''] ?><br />
									
								</td>
<?php } ?>

								<td>
									<b>Bonus: </b> <?php echo $row['bonus'] ?>
									<br />
									<b>Tax(%) : </b><?php echo $row['tax'] ?>
									<br />
                                    <b>Total Amount : </b><?php echo $row['grand_total'] ?>
									<br />
                                    <b>Peyment Status : </b><?php echo $row['peyment_status'] ?>
									<br />
									
									
								</td>
							</tr>
						</table>
					</td>
				</tr>

			<!-- <td>Total: <?php echo $totalAmount;?> </td>		 -->
				</tr>
			</table>
		
		</div>
	</body>
	<?php }?>
</html>