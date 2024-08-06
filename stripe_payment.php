<?php 

    include "connection.php";

	$payment_id = $statusMsg = ''; 
	$ordStatus = 'error';
	$id = '';


	if(!empty($_POST['stripeToken'])){

		$token = $_POST['stripeToken'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$course = $_POST['course'];
		$card_no = $_POST['card_number'];
		$card_cvc = $_POST['card_cvc'];
		$card_exp_month = $_POST['card_exp_month'];
		$card_exp_year = $_POST['card_exp_year'];
		$price=$_POST['amount'];

		

		require_once('stripe-php/init.php');

		$stripe = array(
		"SecretKey"=>"sk_test_51PkoFIEuszaLU5xo5UZpB33YRfJXb0RzfmJbJ69sAJSg6Uu8eM6oTanw749ZLQ188QNlru10dHAEftXg3nk6DNzv00AQOP3PAu",
		"PublishableKey"=>"pk_test_51PkoFIEuszaLU5xo6NiJRIcJ8JJvDgG86EbDJMovJ7W58FxazLynOYzp3KlMddKTTf0DriAM9Qm9ppepwjQnWwjv00G71bCN9F"
		);

		\Stripe\Stripe::setApiKey($stripe['SecretKey']);

	    $customer = \Stripe\Customer::create(array( 
	        'email' => $email, 
	        'source'  => $token,
	        'name' => $name,
	        'description'=>$course
	    ));

	    $orderID = strtoupper(str_replace('.','',uniqid('', true)));
	     
	    $itemPrice = ($price);
	    $currency = "usd";
	   

	    $charge = \Stripe\Charge::create(array( 
	        'customer' => $customer->id, 
	        'amount'   => $itemPrice, 
	        'currency' => $currency, 
	        'description' => $course, 
	        'metadata' => array( 
	            'order_id' => $orderID 
	        ) 
	    ));

    	$chargeJson = $charge->jsonSerialize();

    	if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 

	        $transactionID = $chargeJson['id']; 
	        $paidAmount = $chargeJson['amount']; 
	        $paidCurrency = $chargeJson['currency']; 
	        $payment_status = $chargeJson['status'];
	        $payment_date = date("Y-m-d H:i:s");
	        $dt_tm = date('Y-m-d H:i:s');


	        $sql = "insert into registration (name,email,coursename,fees,card_number,card_expirymonth,card_expiryyear,status,paymentid,added_date) values ('".$name."','".$email."','".$course."','".$price."','".$card_no."','".$card_exp_month."','".$card_exp_year."','".$payment_status."','".$transactionID."','".$dt_tm."')";
			
			
	        mysqli_query($con,$sql) or die("Mysql Error Stripe-Charge(SQL)".mysqli_error($con));

    		

	        if($payment_status == 'succeeded'){ 
	            $ordStatus = 'success'; 
	            $statusMsg = 'Your Payment has been Successful!'; 
	    	} else{ 
	            $statusMsg = "Your Payment has Failed!"; 
	        } 
	    } else{ 
	        $statusMsg = "Transaction has been failed!"; 
	    } 
	} else{ 
	    $statusMsg = "Error on form submission."; 
	} 
	
?>

<!DOCTYPE html>
<html>
	<head>
        <title> Stripe Payment Gateway Integration in PHP </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/stripe.css">
    </head>

    <div class="container">
        <h2 style="text-align: center; color: blue;">Stripe Payment Gateway Integration in PHP </h2>
        <h4 style="text-align: center;">This is - Stripe Payment Success URL </h4>
        <br>
        <div class="row">
	        <div class="col-lg-12">
				<div class="status">
					<h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>
				
					<h4 class="heading"> ** Payment Information ** </h4>
					<br>
					
					<p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
					<p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?> ($<?php echo $price;?>.00)</p>
					<p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
					<h4 class="heading"><br><br><br><br>** Product Information ** </h4>
					<br>
					<p><b>Name:</b> <?php echo $course; ?></p>
					<p><b>Price:</b> <?php echo $price.' '.$currency; ?> ($<?php echo $price;?>.00)</p>
				</div>
				<a href="index.php" class="btn-continue">Back to Home</a>
			</div>
		</div>
	</div>
</html>