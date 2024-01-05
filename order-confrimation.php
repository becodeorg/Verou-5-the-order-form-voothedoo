<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirmation</title>
</head>
<body>
  
<h1><?=("Order submitted succesfully")?></h1>
<hr>
<h2>You ordered:</h2>
<!-- <?php 
  // $products = $_POST["products"];
  //   if (is_array($products)) {
  //       foreach ($products as $product) { 
  //           echo "<p>" . htmlspecialchars($product) . "</p>";
  //       }
  //   } else {
  //       echo "No products selected";
  // }
?> -->
<hr>
<h2>It will be delivered to:</h2>
<p>
  <?= ($_POST["street"] .", ". $_POST["streetnumber"] .", ". $_POST["city"] .", ". $_POST["zipcode"]); ?>
</p>

</body>
</html>


