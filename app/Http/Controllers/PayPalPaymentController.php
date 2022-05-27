<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
// use Srmklive\PayPal\Services\ExpressCheckout;
use App\Subscription;
use App\Package;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\User;
use Auth;
use App\USerInterface;
use Carbon\Carbon;
use PayPal;
class PayPalPaymentController extends Controller
{

  private $provider;
  function __construct(PayPalClient $provider){
    $provider->getAccessToken();
    $this->provider = $provider;
  }
  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
      return Validator::make($data, [
          'package_id' => ['required', 'string', 'max:255']
      ]);
  }

  public function handlePayment_old(Request $request)
  {
   $validation = $this->validator($request->all());
     if(!$validation->fails()) {
       $product = [];
       $product['items'] = [];
       $total = 0;
       // get all items of the order
       $order_id = Subscription::max('id');
       $profile_desc = 'USBSwiper Monthly Subscription';
       $package = Package::find($request->get('package_id'));
       $product['invoice_id'] = $order_id+1;
       // $product['package_id'] = $package->id;
       $product['invoice_description'] = $profile_desc;//"Subscription #{$product['invoice_id']} Bill";
       $product['return_url'] = route('success.payment');
       $product['cancel_url'] = route('cancel.payment');
       $product['total'] = $package->price;
       $profile_desc = 'USBSwiper Monthly Subscription';//!empty($product['subscription_desc']) ? $product['subscription_desc'] : 'Guest user';
       //$product['L_BILLINGTYPE0'] = 'RecurringPayments';
       $product['subscription_desc'] = $profile_desc;
       // $product['L_PAYMENTTYPE0'] = 'any';
       // $product['L_CUSTOM0'] = '';

       $provider = new ExpressCheckout;
       $response = $provider->setExpressCheckout($product);

       $response = $provider->setExpressCheckout($product, true, false);

       print_r($response);
       // The $token is the value returned from SetExpressCheckout API call
        $startdate = Carbon::now()->toAtomString();

        $data = [
            'PROFILESTARTDATE' => $startdate,
            'DESC' => $profile_desc,
            'BILLINGPERIOD' => 'Month', // Can be 'Day', 'Week', 'SemiMonth', 'Month', 'Year'
            'BILLINGFREQUENCY' => 1, //
            'AMT' => 10, // Billing amount for each billing cycle
            'CURRENCYCODE' => 'USD', // Currency code
            'TRIALBILLINGPERIOD' => 'Day',
            'TRIALBILLINGFREQUENCY' => 10, // (Optional) set 12 for monthly, 52 for yearly
            'TRIALTOTALBILLINGCYCLES' => 1, // (Optional) Change it accordingly
            'TRIALAMT' => 0, // (Optional) Change it accordingly
        ];
        $token = $response['TOKEN'];
        $response = $provider->createBillingAgreement($token);
        dd($response);
        $response = $provider->getExpressCheckoutDetails($token);
        $token = $response['TOKEN'];
        print_r($response);
        // The $token is the value returned from SetExpressCheckout API call
       //

       $response = $provider->createRecurringPaymentsProfile($data, $token);

       session()->put('formData', $request->all());
       return redirect($response['paypal_link']);
     }else{
       return response()->json([
        'order_id' => 0,
        'status' => 'failed',
        'errors'  => $validation->errors()->all()
       ]);
     }
  }

  public function handlePayment(Request $request)
  {
    // print_r($this->provider->listProducts());
    // print_r($this->create_plan('PROD-0BT705854F979080X'));
    // $response = $this->create_subscription('P-4G857535EJ338422RMKHZLKY');
    //I-J0VC0YRVJHKR subscription id
    // $plans = $this->provider->listPlans();
    // $response = $this->provider->showSubscriptionDetails('I-LYDX6EW6W9J0');
    // $activateSubscription = $this->provider->activateSubscription('I-LYDX6EW6W9J0', 'Reactivating the subscription');
    // $response = $this->provider->captureSubscriptionPayment('I-LYDX6EW6W9J0', 'Charging as the balance reached the limit', 100);
   $validation = $this->validator($request->all());
     if(!$validation->fails()) {
       $order_id = Subscription::max('id');
       $package = Package::find($request->get('package_id'));
       $invoice_description = "Subscription #{$order_id} Bill";
       $data = [
         'plan_id' => $package->paypal_plan_id,
         //'start_time' => $data['start_time'], //2022-11-01T00:00:00Z
         'quantity' => 1,
         'shipping_amount' => [
           'currency_code' => USerInterface::CURRENCY_NAME,
           'value' => $package->price
         ],
         'application_context' => [
           'brand_name' => 'Language Links',
           'locale' => 'en-US',
           'shipping_preference' => 'NO_SHIPPING', // NO_SHIPPING ,GET_FROM_FILE, SET_PROVIDED_ADDRESS
           'user_action' => 'SUBSCRIBE_NOW', // CONTINUE, SUBSCRIBE_NOW
           "payment_method"=> [
             "payer_selected"=> 'PAYPAL',
             "payee_preferred"=> "IMMEDIATE_PAYMENT_REQUIRED" // UNRESTRICTED
           ],
           'return_url' => route('success.payment'),
           'cancel_url' => route('cancel.payment')
         ]
       ];
       $response = $this->create_subscription($data);
       session()->put('formData', $request->all());
       if(!isset($response['error']))
        return redirect($response['links'][0]['href']);
       else
        return redirect()->back()->withErrors('some error occurred');
     }else{
       return response()->json([
        'order_id' => 0,
        'status' => 'failed',
        'errors'  => $validation->errors()->all()
       ]);
     }

  }

  public function paymentCancel()
  {
     dd('Your payment has been declend. The payment cancelation page goes here!');
  }

  public function paymentSuccess(Request $request)
  {
    if(isset($request->subscription_id)){
     $formData = session()->get('formData');
     $response = $this->provider->showSubscriptionDetails($request->subscription_id);
     // $response = $provider->getExpressCheckoutDetails($request->token);
     $amount = $response['shipping_amount']['value'];
     $package_id = $formData['package_id'];
     $email = $response['subscriber']['email_address'];
     $user_id = 0 ;
     $user = User::where('email', $email)->first();
     $password = Str::random(10);
     if (isset($user->id)){
        $user_id = $user->id;
        $user->package_id = $package_id;
        $user->status = '1';
        $user->credit = (intval($user->credit) + intval($amount));
        $user->save();
     }else{
       $name = $response['subscriber']['name']['given_name'].' '.$response['subscriber']['name']['surname'];
       $user_id = User::create([
         'name' => $name,
         'email' => $email,
         'password' =>  Hash::make($password),
         'package_id' => $package_id,
         'user_type' => UserInterFace::STUDENT_ROLE_ID,
         'status' => '1',
         'credit'  => $amount
       ])->id;
       // $user_id = $created_user;
     }

     if (isset($response['status']) && $response['status'] == 'ACTIVE') {
        Subscription::create([
          'transaction_id' => $response['id'],
          'payment_amount' => $amount,
          'payment_status' => $response['status'],
          'payment_method' => 'Paypal',
          'payment_currency_code' => $response['shipping_amount']['currency_code'],
          'is_expired' => false,
          'expire_at' => date('Y-m-d', strtotime($response['billing_info']['next_billing_time'])),
          'package_id' => $package_id,
          'user_id' => $user_id
        ]);

        $emailBody = 'Your subscription has been created successfully. Please log in dashboard with your following credentials.
                      Email address: '.$email.'
                      Password: '.$password.'
                      login Link: '.url('/login');
                      
        $res= Mail::raw($emailBody, function($message) {
           $message -> from('ranamehran17@gmail.com', 'Language Links');
           $message -> to('mrmehranrajpoot@gmail.com');
           $message -> subject('Subscription created');
        });

        return redirect('/')->withSuccess('success', 'Your subscription has been created successfully.');

     }
     else {
       return ['payment'=>false, 'payment_details'=>$response];
     }
   }

     dd('Error occured!');
   }

   public function create_product($data){
     $data = [
       'name' => $data['name'],
       'description' => $data['description'],
       'type' => $data['type'],
       'category' => $data['category'],
       'home_url' => $data['home_url'],
     ];
      $data = json_encode($data);
      $request_id = 'create-product-'.time();
      return $product = $this->provider->createProduct($data, $request_id);
   }

   public function create_plan($product_id, $data){
     $plan = [
       'product_id' => $product_id,
       'name' => $data['name'],
       'description' => $data['description'],
       'status' => $data['status'],
       'billing_cycles' => [
          'frequency' => [
            'interval_unit' => $data['interval_unit'], //DAY,WEEK, Month, Year
            'interval_count' => $data['interval_count'] //For example, if the interval_unit=2 is DAY billed once every two days
          ],
          'tenure_type' => $data['tenant_type'], // REGULAR or TRIAL
          'sequence' => $data['equence'], // for trail 1 and for regular billing cycle 2
          'total_cycles' => $data['total_cycles'], // 1 or 2
       ],
       'payment_preferences' => [
         'auto_bill_outstanding' => $data['auto_bill_outstanding'], // true or false
         'setup_fee' => [
             'value' => $data['setup_fee'],
             'currency_code' => $data['currency_code'],
          ],
          'setup_fee_failure_action' => "CONTINUE",
          'payment_failure_threshold' => 3
       ]
     ];

    $plan = json_encode($plan);
    $request_id = 'create-plan-'.time();
    return  $plan = $this->provider->createPlan($plan, $request_id);
   }

   public function create_subscription($data){
      $request_id = 'create-subscription-'.time();
      return  $subscription = $this->provider->createSubscription($data, $request_id);
   }
}

// Create a subscription Data
// $dataa = [
//   'plan_id' => $data['plan_id'],
//   //'start_time' => $data['start_time'], //2022-11-01T00:00:00Z
//   'quantity' => $data['quantity'],
//   'shipping_amount' => [
//     'currency_code' => $data['currency_code'],
//     'value' => $data['value']
//   ],
//   'application_context' => [
//     'brand_name' => $data['brand_name'],
//     'locale' => $data['locale'],
//     'shipping_preference' => isset($data['shipping_preference']) ? $data['shipping_preference'] : 'NO_SHIPPING', // NO_SHIPPING ,GET_FROM_FILE, SET_PROVIDED_ADDRESS
//     'user_action' => $data['user_action'], // CONTINUE, SUBSCRIBE_NOW
//     "payment_method"=> [
//       "payer_selected"=> isset($data['payment_method']) ? $data['payment_method'] : 'PAYPAL',
//       "payee_preferred"=> "IMMEDIATE_PAYMENT_REQUIRED" // UNRESTRICTED
//     ],
//     'return_url' => $data['return_url'],
//     'cancel_url' => $data['cancel_url']
//   ]
// ];
