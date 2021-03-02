<?php

namespace App\Http\Controllers\user_controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\Http;

//use GuzzleHttp\Client;

use App\Models\Auction;
use App\Models\WinnerBill;


// use Omnipay\Omnipay;
// use Omnipay\Common\CreditCard;

//use App\Http\Controllers\user_controllers\twoCheckout\lib\Twocheckout;

//use Vendor\omnipay\common\src\Common\CreditCard;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\PaymentExecution;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class paymentController extends Controller
{

	protected $apiContext;

    protected function setContext(){

        $this->apiContext = new ApiContext(
                new OAuthTokenCredential(
                        config('payment.accounts.client_id'),
                        config('payment.accounts.secret_client')
                    )
            );

        $this->apiContext->setConfig(config('payment.setting'));
    }


    function checkout(Request $request){

    	if( (!session('login') && !\Cookie::get('remembered')) || !session('live_id'))
    		return back()->with('failed', 'oops! choose a color and size');
    	$auctions = Auction::where('user_id',session('login'))->where('live_id',session('live_id'))->where('winner',1)->get();

    	if(is_null($auctions))return back()->with('failed', 'not winner');

    	session(['auctions'=>$auctions]);
    	$total = 0;
    	$ids = '';
    	foreach ($auctions as $auction) {
    		$total = $auction->price + $total;
    		$ids = $auction->id.'#'.$ids;
    	}


    	$this->setContext();

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $items_products = [];
        //foreach($bill->products as $billProduct){

            $item1 = new Item();
            $item1->setName('product from auction')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setSku($ids) // Similar to `item_number` in Classic API
                ->setPrice($total);

            $items_products[] = $item1;
        //}

        $itemList = new ItemList();
        $itemList->setItems($items_products);

        $details = new Details();
        $details->setShipping(0)//تسعيرة الشحن
            ->setTax(0)//سعر الضرائب
            ->setSubtotal($total);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($total + 0)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Auction payment products")
            ->setInvoiceNumber(uniqid());

        $baseUrl = url('/');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/success/true")
            ->setCancelUrl("$baseUrl/success/false");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $request = clone $payment;

        try {
            $payment->create($this->apiContext);
        } catch (Exception $ex) {
            //ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
            exit(1);
        }

        $approvalUrl = $payment->getApprovalLink();

        session(['total_coast'=>$total,
                 //'shipping_coast' => $bill->shipping_coast,
            ]);

        return Redirect($approvalUrl);

    	///////////////////////////////////////////////

  //   	$response = Http::withHeaders([
		// 	    'authorization' => 'S6JN9GNBM6-JB2BKBZHHH-T2W2ZWDMHJ',
		// 	    'content-type' => 'application/json'
		// 	])->post('https://secure-global.paytabs.com/payment/request', [
		// 	    'profile_id' => '57058',
		// 	    'merchant_email' => 'alaarko1@gmail.com',
		// 	    'tran_type' => 'sale',
		// 	    'tran_class' => 'ecom',
		// 	    'cart_id' => '111',
		// 	    'cart_description' => 'desc',
		// 	    'cart_currency' => 'USD',
		// 	    'cart_amount' => '40',
		// 	    'callback' => 'http://localhost:8000/2checkout-callbak',
		// 	    'return' => 'http://localhost:8000/home',
		// 	]);
		// 	dd($response);
  //   	//dd($request->all());
  //   	//
		// // A very simple PHP example that sends a HTTP POST to a remote site
		// //
  //   	$headers = ['authorization: S6JN9GNBM6-JB2BKBZHHH-T2W2ZWDMHJ','content-type: application/json'];

		// $ch = curl_init();

		// curl_setopt($ch, CURLOPT_POST, 10);
		// curl_setopt($ch, CURLOPT_URL,"https://secure-global.paytabs.com/payment/request");
		// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($ch, CURLOPT_POSTFIELDS,
		//             "profile_id=57058&merchant_email=alaarko1@gmail.com&tran_type=sale&tran_class=ecom&cart_id=id1&cart_description=desc&cart_currency=USD&cart_amount=40&callback=http://localhost:8000/2checkout-callbak&return=http://localhost:8000/home");

		// // In real life you should use something like:
		// // curl_setopt($ch, CURLOPT_POSTFIELDS, 
		// //          http_build_query(array('postvar1' => 'value1')));

		// // Receive server response ...
		// //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// $server_output = curl_exec($ch);
		// if (curl_errno($ch)) { 
		//    dd(curl_error($ch)); 
		// }

		// curl_close ($ch);
		// dd($server_output);

		// // Further processing ...
		// if ($server_output == "OK") { dd('ok'); } else { dd('not ok'); }

	/////////////////////////////////////////////////////////


  //   	Twocheckout::privateKey('private-key');
		// Twocheckout::sellerId('seller-id');
		// try {
		//     $charge = Twocheckout_Charge::auth(array(
		//         "merchantOrderId" => "123",
		//         "token"      => $_POST['token'],
		//         "currency"   => 'USD',
		//         "total"      => '10.00',
		//         "billingAddr" => array(
		//             "name" => 'Testing Tester',
		//             "addrLine1" => '123 Test St',
		//             "city" => 'Columbus',
		//             "state" => 'OH',
		//             "zipCode" => '43123',
		//             "country" => 'USA',
		//             "email" => 'example@2co.com',
		//             "phoneNumber" => '555-555-5555'
		//         )
		//     ));

		//     if ($charge['response']['responseCode'] == 'APPROVED') {
		//         echo "Thanks for your Order!";
		//         echo "<h3>Return Parameters:</h3>";
		//         echo "<pre>";
		//         print_r($charge);
		//         echo "</pre>";

		//     }
		// } catch (Twocheckout_Error $e) {print_r($e->getMessage());}


  //   	// Create a gateway for the PayPal RestGateway
		// // (routes to GatewayFactory::create)
		// $gateway = Omnipay::create('PayPal');

		// // Initialise the gateway
		// $gateway->initialize(array(
		//     'clientId' => 'AQNUoD-ciun5qjv_yfsHHMxaerdk1rFhPXBJH9HXFciRpIumMRhIBSbXtWxFpSJZLAGN-2dPEJDEBi5C',
		//     'secret'   => 'EJZ5IXuqiUcwS-5aCLaJJ6-Et2fmmZwtjxMI8Nv-9z6lp4zFFtX610tyamGXPu169wiluz-Mb5jPqmkD',
		//     'testMode' => true, // Or false when you are ready for live transactions
		// ));

		// // Create a credit card object
		// // DO NOT USE THESE CARD VALUES -- substitute your own
		// // see the documentation in the class header.
		// $card = array(
		//             'firstName' => 'Example',
		//             'lastName' => 'User',
		//             'number' => '4242424242424242',
		//             'expiryMonth'           => '01',
		//             'expiryYear'            => '2022',
		//             'cvv'                   => '123',
		//             'billingAddress1'       => '1 Scrubby Creek Road',
		//             'billingCountry'        => 'AU',
		//             'billingCity'           => 'Scrubby Creek',
		//             'billingPostcode'       => '4999',
		//             'billingState'          => 'QLD',
		// );

		// // Do a purchase transaction on the gateway
		// $transaction = $gateway->purchase(array(
		//     'amount'        => '10.00',
		//     'currency'      => 'AUD',
		//     'description'   => 'This is a test purchase transaction.',
		//     'card'          => $card,
		// ));
		// $response = $transaction->send();
		// if ($response->isSuccessful()) {
		// 	dd('suc');
		//     echo "Purchase transaction was successful!\n";
		//     $sale_id = $response->getTransactionReference();
		//     echo "Transaction reference = " . $sale_id . "\n";
		// }elseif ($response->isRedirect()) {
		//     dd('redirect'); // this will automatically forward the customer
		// }else{
		// 	dd('s');
		// }
/////////////////////////////////////////////////////////////////
    	
			// $merchantCode = "250712686285";
			// $key = "r?2X_laZ]d~Rt=TJIQ^)";

			// $apiVersion = '6.0';
			// $resource = 'leads';
			// $host = "https://api.2checkout.com/rest/".$apiVersion."/".$resource."/";

			// $date = gmdate('Y-m-d H:i:s');
			// $string = strlen($merchantCode) . $merchantCode . strlen($date) . $date;
			// $hash = hash_hmac('md5', $string, $key);
			// $payload = '';

			// $ch = curl_init();

			// $headerArray = array(
			//     "Content-Type: application/json",
			//     "Accept: application/json",
			//     "X-Avangate-Authentication: code=\"{$merchantCode}\" date=\"{$date}\" hash=\"{$hash}\"",
			//     'Cookie: XDEBUG_SESSION=PHPSTORM'
			// );

			// curl_setopt($ch, CURLOPT_URL, $host);
			// curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			// curl_setopt($ch, CURLOPT_HEADER, FALSE);
			// curl_setopt($ch, CURLOPT_POST, FALSE);
			// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			// curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			// curl_setopt($ch, CURLOPT_SSLVERSION, 0);
			// curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);

			// $response = curl_exec($ch);
			// dd($response);


   //  	$response = Http::post('https://www.2checkout.com/checkout/api/1/250712686285/rs/authService', [
			//     'sellerId' => '250712686285',
			//     'privateKey' => '49041FFD-0551-4C79-831B-D91C544E20D6',
			//     'merchantOrderId' => '123',
			//     'token' => $request->token,
			//     'currency' => 'USD',
			//     'total' => '10',
			//     'billingAddr' => [
			// 	    "name"=> "John Doe",
			// 	    "addrLine1"=> "123 Test St",
		 //            "city"=> "Columbus",
   //                  "state"=> "Ohio",
   //                  "zipCode"=> "43123",
   //                  "country"=> "USA",
   //                  "email"=> "example@2co.com",
   //                  "phoneNumber"=> "5555555555"

			// 	],
			//     'demo' => 'true',
			//     // 'callback' => 'http://localhost:8000/2checkout-callbak',
			//     // 'return' => 'http://localhost:8000/home',
			// ]);
			// dd($response);


/////////////////////////////////////////////////////////////////

  //   	$client = new Client();

		// $request = $client->request('POST','https://test.oppwa.com/v1/checkouts',[
		// 							'entityId' => '8a8294174b7ecb28014b9699220015ca',
		// 						    'amount' => '92.00',
		// 						    'currency' => 'EUR',
		// 						    'paymentType' => 'DB'
		// 							]);
		// 			// ->addPostFiles(array(
		// 			// 	'entityId' => '8a8294174b7ecb28014b9699220015ca',
		// 			//     'amount' => '92.00',
		// 			//     'currency' => 'EUR',
		// 			//     'paymentType' => 'DB'),
		// 			// ('Authorization: Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));

		// $response = $request->send();
		// dd($response);

   //  	$response = Http::withHeaders([
			//     'Authorization' => 'Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg=',
			// ])->post('https://test.oppwa.com/v1/checkouts', [
			//     'entityId' => '8a8294174b7ecb28014b9699220015ca',
			//     'amount' => '92.00',
			//     'currency' => 'EUR',
			//     'paymentType' => 'DB',
			//     // 'callback' => 'http://localhost:8000/2checkout-callbak',
			//     // 'return' => 'http://localhost:8000/home',
			// ]);
			// dd($response);


  //   	$url = "https://test.oppwa.com/v1/checkouts";
		// $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
	 //                "&amount=92.00" .
	 //                "&currency=EUR" .
	 //                "&paymentType=DB";

		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL, $url);
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	 //                   'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
		// curl_setopt($ch, CURLOPT_POST, 1);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $responseData = curl_exec($ch);
		// if(curl_errno($ch)) {
		// 	return curl_error($ch);
		// }
		// curl_close($ch);
		// //return response()->json(['operation'=>'suc','responseData'=>$responseData]);
		// return $responseData;
    }

    function makePaymentCallback(Request $request,$status){

    	if($status == "true"){
	    	if(isset($request->paymentId) && $request->paymentId != '' &&
	            isset($request->token) && $request->token != '' &&
	            isset($request->PayerID) && $request->PayerID != ''){

	                $this->setContext();

	                $total_coast = session('total_coast');
	                $shipping_coast = 0;
	                session()->forget('total_coast');

	                $paymentId = $request->paymentId;
	                $payment = Payment::get($paymentId, $this->apiContext);

	                $execution = new PaymentExecution();
	                $execution->setPayerId($request->PayerID);


	                $transaction = new Transaction();
	                $amount = new Amount();
	                $details = new Details();

	                $details->setShipping(0)//chrging
	                    ->setTax(0)
	                    ->setSubtotal($total_coast);

	                $amount->setCurrency('USD');
	                $amount->setTotal($total_coast + 0);
	                $amount->setDetails($details);
	                $transaction->setAmount($amount);

	                $execution->addTransaction($transaction);
	                
	                try {

	                    $result = $payment->execute($execution, $this->apiContext);


	                    try {
	                        $payment = Payment::get($paymentId, $this->apiContext);
	                    } catch (Exception $ex) {

	                            exit(1);
	                        }
	                } catch (Exception $ex) {

	                    exit(1);
	                }
	                //return $payment;
	                // if(!session('login') && !\Cookie::get('remembered'))return \Redirect::route('login');
	                // if(!session('login'))session(['login'=> \Cookie::get('remembered')]);
	                
	                // $bill = $billClass->checkBill(session('login'));
	                // dispatch(new MakeNewOrder($bill->id));
	                if($payment->state == 'approved'){
	                    //if(!$bill)return back()->with('failed', 'oops! , there is something happen');
	                    $auctions = session('auctions');
	                    foreach ($auctions as $auction) {
	                    	WinnerBill::create(['user_id'=>session('login'),
	                    					'live_id'=>session('live_id'),
	                    					'auction_id'=>$auction->id,
	                    					'final_price'=>$auction->price,
	                    					'payment_method'=>$payment->payer->payment_method,
	                    					'id_payment'=>$payment->id]);
	                    }
	                    

	                    // $bill->update(['id_payment'=> $payment->id,'payment'=>$payment->payer->payment_method]);
	                    // dispatch(new MakeNewOrder($bill->id));
	                    session()->forget('auctions');
	                    return back()->with('success', 'success');
	                }
	                
	                //dd($payment);
	        }
	    }
	    return back()->with('failed', 'failed');
	    //dd('false');

    }
    
}
