<?php
	session_start();
	if(!isset($_SESSION['user_id'])) {
        header("location:login.php");
		exit();
	}else{
        include('config/db.php');
	}
    // include('actions/cart-pos.php');
//   include('actions/cart.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | Seang </title>

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Product -->
    <link rel="stylesheet" href="dist/css/product.css">
    <!-- Data Table CSS -->
    <?php include("part/data-table-css.php");?>
    <!-- Data Table CSS end -->
    <!-- All CSS -->
    <?php include("part/all-css.php");?>
    <!-- All CSS end -->
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
	  
	<!-- Navbar -->
	<?php include("part/navbar.php");?>
	<!-- Navbar end -->
		
	<!-- Sidebar -->
	<?php include("part/sidebar.php");?>
	<!--  Sidebar end -->
	  
  <!-- Content Wrapper. Contains page content -->


	<!-- Footer -->
	<?php include("part/footer.php");?>
	<!-- Footer End -->

	
	<!-- Alert -->
	<?php include("part/alert.php");?> 
	<!-- Alert end --> 


	<!-- All JS -->
	<?php include("part/all-js.php");?>
	<!-- All JS end -->
	<!-- Data Table JS -->
	<?php include("part/data-table-js.php");?>
	<!-- Data Table JS end -->

    <!-- select2 input field -->
    <script>
      $(function() {
          //Initialize Select2 Elements
          $(".select2").select2();

          //Initialize Select2 Elements
          $(".select2bs4").select2({
              theme: "bootstrap4",
          });

          $(".select2-custom-tags").select2({
            // tags: true
          });
          $(".select2-custom-tags2").select2({
            // tags: true,
            placeholder: "Select/Type medicine name..."
          });

          // reset medicine select input field
          $("#medicine-in").val("").trigger( "change" );
      });
    </script>

    <!-- Total price function -->
    <script>
      totalPrice();

      function totalPrice(){
        // Total purchase
        var i = 0;
        $(".field_item_total_price").each(function() {
            i = i + parseFloat($(this).val());
        });
        $("#totalPurchase").text(i);

        // Total Quantity
        var k = 0;
        $(".field_item_qty").each(function() {
            k = k + parseFloat($(this).val());
        });
        $("#totalQuantity").text(k);

        // console.log(k);
      }
    </script>

    <!-- Ajax -->
    <script>
      $(function() {
        // Product search option
        $(".select2-custom-tags2").on("change", function(e) {
            e.preventDefault();
            e.stopPropagation();
            var val = $(this).val();
            var quantity = 1;
            // console.log(val);
            var reeq = $.ajax({
              method: "GET",
              url: "actions/cart-pos.php",
              data: {
                code: val,
                quantity: quantity,
                action_pos: "add"
              }
            });
            reeq.done(function(msg) {
              $("#onisku").load(window.location.href + " #onisku");
              totalPrice();
            });

            setTimeout(function(){ totalPrice(); },100);
        });

        $(document).on("click", ".prd", function(e) {
            e.preventDefault();
            e.stopPropagation();
            var code = $(this).data("code");
            var quantity = 1;
            // console.log(code);
            var reeq = $.ajax({
              method: "GET",
              url: "actions/cart-pos.php",
              data: {
                code: code,
                quantity: quantity,
                action_pos: "add"
              }
            });
            reeq.done(function(msg) {
              $("#onisku").load(window.location.href + " #onisku");
              totalPrice();
            });

            setTimeout(function(){ totalPrice(); },100);
        });

      });
    </script>

    <!-- On input field change in table -->
    <script>
      $(function() {

        // On change qty field
        $(document).on("change keyup", ".field_item_qty", function() {
          var v = $(this).val();
          var code = $(this).data("code");
          var price = $(".price_field_"+code).val();
          var vv = parseFloat(price*v);
          $(".inc_qty_"+code).val(vv);
          totalPrice();
          
          // Quantity update
          var reeq = $.ajax({
              method: "GET",
              url: "actions/cart-pos.php",
              data: {
                code: code,
                qty: v,
                incQty: "incQty"
              }
          });
        });

        // On change item price field
        $(document).on("change keyup", ".field_item_price", function() {
          var v = $(this).val();
          var code = $(this).data("code");
          var qty = $(".qty_field_"+code).val();
          var vv = parseFloat(v*qty);
          $(".inc_qty_"+code).val(vv);
          totalPrice();
          // console.log(code + " "+qty+" "+v);
        });

        // On change total item price field
        $(document).on("change keyup", ".field_item_total_price", function() {
          // var v = $(this).val();
          // console.log(v);
          totalPrice();
        });
      });
    </script>

    <!-- Proceed invoice, discount -->
    <script>
      $(function() { 
        // proceed invoice
          var v = $('#totalQuantity').text();
          var v2 = $('#totalPurchase').text();
        
        $('.proceed-invoice').on( "click", function() {
          totalPrice();
          var customer = $(".customertypef").val();

          v = $('#totalQuantity').text();
          v2 = $('#totalPurchase').text();

          $('.totalQuantity').val(v);
          $('.totalPurchase').val(v2);
          $("#after-discount").val(v2);

          // Check customer due
          var reeq = $.ajax({
                method: "GET",
                url: "actions/payment_process.php",
                data: {
                    customer: customer,
                    payBtn: "payBtn"
                }
            });
            reeq.done(function(data) {
                // $("#previous_due").text(data);
                $("#previous_due").val(data);
                // console.log(data);
            });
        });

        // discount calculate
        $(".discountActivity").on("keyup change", function() {
          var discount = $("#discount_med").val();
          var type = $("#discount_type").val();
          v2 = $('#totalPurchase').text();
          var amount = v2;
          var reeq = $.ajax({
            method: "GET",
            url: "actions/payment_process.php",
            data: {
              discount: discount,
              amount: amount,
              type: type,
              applyDiscount: "applyDiscount"
            }
          });
          reeq.done(function(msg) {
              var obj = JSON.parse(msg);
              $(".after-discount").text(obj['amount']);
              $("#after-discount").val(obj['amount']);
          });
        });

        // paid status
        $(".paid-amount").on("keyup change", function() {
          var customer = $(".customertypef").val();
          var payable = $("#after-discount").val();
          var paid = $(this).val();
          var due = $('#previous_due').text();
          var reeq = $.ajax({
            method: "GET",
            url: "actions/payment_process.php",
            data: {
              customer: customer,
              payable: payable,
              paid: paid,
              due: due,
              paidStatus: "paidStatus"
            }
          });
          reeq.done(function(data) {
              console.log(data);
              var obj = JSON.parse(data);
              $('#current_due').text(obj['currentDue']);
              $('.current_due').val(obj['currentDue']);
              $('.wallet').val(obj['wallet']);
          });
        });
      });
    </script>

  </body>
</html>
