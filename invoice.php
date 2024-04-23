<?php
  include 'config.php';

  session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css" type="text/css" media="all" />
</head>

<body>
<?php
        $query2 = $conn->query("SELECT * FROM purchase WHERE purchase_id='$_GET[id]'");
        $result = $query2->fetch_assoc();
    ?>
  <div>
    <div class="py-4">
      <div class="px-14 py-6">
        <table class="w-full border-collapse border-spacing-0">
          <tbody>
            <tr>
              <td class="w-full align-top">
                <div>
                  <img src="ngopss/assets/logo.png" class="h-12" />
                </div>
              </td>

              <td class="align-top">
                <div class="text-sm">
                  <table class="border-collapse border-spacing-0">
                    <tbody>
                      <tr>
                        <td class="border-r pr-4">
                          <div>
                            <p class="whitespace-nowrap text-slate-400 text-right">Date</p>
                            <p class="whitespace-nowrap font-bold text-main text-right"><?php echo $result['date'] ?></p>
                          </div>
                        </td>
                        <td class="pl-4">
                          <div>
                            <p class="whitespace-nowrap text-slate-400 text-right">PO #</p>
                            <p class="whitespace-nowrap font-bold text-main text-right"><?php echo $result['purchase_id'] ?></p>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="bg-slate-100 px-14 py-6 text-sm">
        <table class="w-full border-collapse border-spacing-0">
          <tbody>
            <tr>
              <td class="w-1/2 align-top">
                <div class="text-sm text-neutral-600">
                  <p class="font-bold">Ship To</p>
                  <br>
                  <p class="font-bold">Ngops Coffee</p>
                  <p>23456789</p>
                  <p>Jl.Sudirman No.60</p>
                  <p>Jakarta</p>
                  <p>Indonesia</p>
                </div>
              </td>
              <td class="w-1/2 align-top text-right">
                <div class="text-sm text-neutral-600">
                  <p class="font-bold">Supplier</p>
                  <br>
                  <p class="font-bold"><?php echo $result['vendor'] ?></p>
                  <p><?php echo $result['phone'] ?></p>
                  <p><?php echo $result['address'] ?></p>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="px-14 py-10 text-sm text-neutral-700">
        <table class="w-full border-collapse border-spacing-0">
          <thead>
            <tr>
              <td class="border-b-2 border-main pb-3 pl-3 font-bold text-main">#</td>
              <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Product details</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">Price</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-center font-bold text-main">Qty.</td>
              <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">Subtotal</td>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = mysqli_query($conn,"SELECT * FROM purchase_products where purchase_id = '$_GET[id]' ");
              $counter = 1;
              if(mysqli_num_rows($query) > 0){
                while($fetch_orders = mysqli_fetch_assoc($query)){
            ?>
            <tr>
              <td class="border-b py-3 pl-3"><?php echo $counter; ?>.</td>
              <td class="border-b py-3 pl-2"><?php echo $fetch_orders['product_name']; ?></td>
              <td class="border-b py-3 pl-2 text-right">Rp. <?php echo number_format($fetch_orders['product_price']); ?></td>
              <td class="border-b py-3 pl-2 text-center"><?php echo $fetch_orders['product_qty']; ?></td>
              <td class="border-b py-3 pl-2 text-right">Rp. <?php $price= $fetch_orders['product_qty'] * $fetch_orders['product_price']; echo number_format($price); ?></td>
            </tr>
            <?php
                  $counter++;
               }
            }else{
               echo '<tr><td colspan="7" class="empty">No product order placed yet!</td></tr>';
            }
            ?>
            <tr>
              <td colspan="7">
                <table class="w-full border-collapse border-spacing-0">
                  <tbody>
                    <tr>
                      <td class="w-full"></td>
                      <td>
                        <table class="w-full border-collapse border-spacing-0">
                          <tbody>
                            <tr>
                              <td class="border-b p-3">
                                <div class="whitespace-nowrap text-slate-400">Net total:</div>
                              </td>
                              <td class="border-b p-3 text-right">
                                <div class="whitespace-nowrap font-bold text-main">Rp. <?php $net = $result['total'] / 1.1; echo number_format($net); ?></div>
                              </td>
                            </tr>
                            <tr>
                              <td class="border-b p-3">
                                <div class="whitespace-nowrap text-slate-400">Tax:</div>
                              </td>
                              <td class="border-b p-3 text-right">
                                <div class="whitespace-nowrap font-bold text-main">Rp. <?php echo number_format($net * 0.1); ?></div>
                              </td>
                            </tr>
                            <tr>
                              <td class="bg-main p-3">
                                <div class="whitespace-nowrap font-bold text-white">Total:</div>
                              </td>
                              <td class="bg-main p-3 text-right">
                                <div class="whitespace-nowrap font-bold text-white">Rp. <?php echo number_format($result['total']); ?></div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="px-14 text-sm text-neutral-700">
        <p class="text-main font-bold">PAYMENT & TERMS</p>
        <p>Arrival Date: <?php echo $result['arrival'] ?></p>
        <p>Payment Terms: <?php echo $result['terms'] ?> Days</p>
        <p>Bank <?php echo $result['bank'] ?></p>
        <p>Account Number: <?php echo $result['account'] ?></p>
      </div>

      <div class="px-14 py-10 text-sm text-neutral-700">
        <p class="text-main font-bold">Notes</p>
        <p class="italic">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries
          for previewing layouts and visual mockups.</p>
        </dvi>

        <footer class="fixed bottom-0 left-0 bg-slate-100 w-full text-neutral-600 text-center text-xs py-3">
          Ngops Coffee
          <span class="text-slate-300 px-2">|</span>
          ngops@gmail.com
          <span class="text-slate-300 px-2">|</span>
          +62-212-3134
        </footer>
      </div>
    </div>
</body>

</html>