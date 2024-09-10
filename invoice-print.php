<?php
	session_start();
	if(!isset($_SESSION['user_id'])) {
		header("location:login.php");
		exit();
	}elseif(!isset($_SESSION["invoice_user_print"])){
    echo "<script>window.history.back();</script>";
    exit();
  }else{
		include('config/db.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Invoice #<?php echo $_SESSION["invoice_user_print"]["invoice"]; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <div class="invoice">
    <hr class="border-top: 2px dotted red;">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h4>
            <i class="fas fa-globe"> Fan កាហ្វេដូងក្រអូប សាខាភ្នំពេញថ្មី</i>
            <small class="float-right">Date: <?php echo date('Y-m-d'); ?> </small>
            <!-- <h3 class="float-right">Invoice #<?php echo $_SESSION["invoice_user_print"]["invoice"]; ?></h3><br> -->
            <hr class="border-top: 3px dashed red">
        </h4>
      </div>
    </div>

    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
        From
            <address>
                <!-- <strong>Seang CO.,LTD.</strong><br> -->
                ផ្ទះលេខ ០៦ , ផ្លូវ ១០០៧<br>
                ភ្នំពេញថ្មី , សែនសុខ , ភ្នំពេញ<br>
                Phone: (+855) 87 21 99 96<br>
                Email: keokimhot8@gmail.com
            </address>
        </div>
      <div class="col-sm-6 invoice-col">
        To
        <address>
          <strong><?php echo $_SESSION["invoice_user_print"]["name"]; ?></strong><br>
          Phone: <?php echo $_SESSION["invoice_user_print"]["phone"]; ?><br>
          Email: <?php echo $_SESSION["invoice_user_print"]["email"]; ?><br>
          Address: <?php echo $_SESSION["invoice_user_print"]["address"]; ?>
        </address>
      </div>
        <div class="col-sm-2">
        <h3 class="float-right">Invoice #<?php echo $_SESSION["invoice_user_print"]["invoice"]; ?></h3><br>
        </div>
    </div>
    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Nº</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price [Riel]</th>
            <th>Subtotal [Riel]</th>
          </tr>
          </thead>
          <tbody>
          <?php
            $sumPrice = 0; $total = 0; $n = 0;
            foreach($_SESSION["invoice_cart_print"] as $value){
                $sumPrice += $value['price']*$value['quantity'];
                $total += $sumPrice;
            ?>
          <tr>
            <td><?php echo ++$n; ?></td>
            <td><?php echo $value['name'] ?></td>
            <td><?php echo $value['quantity'] ?></td>
            <td><?php echo $value['price'] ?> ៛</td>
            <td><?php echo $sumPrice ?> ៛</td>
          </tr>
          <?php $sumPrice =0; } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
      <p class="lead">Payment Methods:</p>
                  <img src="dist/img/credit/aba.png" alt="ABA" width="100" height="100" style="border-radius: 10px;">
                  <img src="dist/img/credit/ac.png" alt="Acleda" width="100" height="100" style="border-radius: 10px;">
                  <img src="dist/img/credit/wing.png" alt="Acleda" width="100" height="100" style="border-radius: 10px;">
        <!-- <img src="dist/img/credit/american-express.png" alt="American Express">
        <img src="dist/img/credit/paypal2.png" alt="Paypal"> -->

        <!-- <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
          plugg
          dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p> -->

      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead">Amount Due <?php echo date('Y-m-d'); ?></p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td><?php echo $total ?> Riel</td>
            </tr>
            <tr>
              <th>Discount (<?php echo $_SESSION["invoice_user_print"]["discount_type"]; ?>)</th>
              <td><?php echo ($_SESSION["invoice_user_print"]["discount"] < 0) ? 0 : $_SESSION["invoice_user_print"]["discount"]; ?> Riel</td>
            </tr>
            <tr>
              <th>Grand Total: </th>
              <td><?php echo $_SESSION["invoice_user_print"]["after_discount"]; ?> Riel</td>
            </tr>
            <tr>
              <th>Paid: </th>
              <td><?php echo $_SESSION["invoice_user_print"]["paid"]; ?> Riel</td>
            </tr>
            <tr>
              <th>Due: </th>
              <td><?php echo ($_SESSION["invoice_user_print"]["due"] < 0) ? 0 : $_SESSION["invoice_user_print"]["due"]; ?> Riel</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
