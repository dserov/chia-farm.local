<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // display payment form
    public function show_old(Order $order)
    {
        // --------------------------------------
        DEFINE("CRYPTOBOX_PHP_FILES_PATH", app_path('Lib' . DIRECTORY_SEPARATOR . 'CryptoBox' . DIRECTORY_SEPARATOR));            // path to directory with files: cryptobox.class.php / cryptobox.callback.php / cryptobox.newpayment.php;
        // cryptobox.newpayment.php will be automatically call through ajax/php two times - payment received/confirmed
        DEFINE("CRYPTOBOX_IMG_FILES_PATH", "/images/");    // path to directory with coin image files (directory 'images' by default)
        DEFINE("CRYPTOBOX_JS_FILES_PATH", "/js/");            // path to directory with files: ajax.min.js/support.min.js


        // Change values below
        // --------------------------------------
        DEFINE("CRYPTOBOX_LANGUAGE_HTMLID", "alang");    // any value; customize - language selection list html id; change it to any other - for example 'aa';	default 'alang'
        DEFINE("CRYPTOBOX_COINS_HTMLID", "acoin");        // any value;  customize - coins selection list html id; change it to any other - for example 'bb';	default 'acoin'
        DEFINE("CRYPTOBOX_PREFIX_HTMLID", "acrypto_");    // any value; prefix for all html elements; change it to any other - for example 'cc';	default 'acrypto_'

        // Open Source Bitcoin Payment Library
        // ---------------------------------------------------------------
        require_once(CRYPTOBOX_PHP_FILES_PATH . "cryptobox.class.php");

        $userID = $order->user_id;             // place your registered userID or md5(userID) here (user1, user7, uo43DC, etc).
        // You can use php $_SESSION["userABC"] for store userID, amount, etc
        // You don't need to use userID for unregistered website visitors - $userID = "";
        // if userID is empty, system will autogenerate userID and save it in cookies
        $userFormat = "COOKIE";        // save userID in cookies (or you can use IPADDRESS, SESSION, MANUAL)
        $orderID = $order->id;            // invoice number - 000383
        $amountUSD = $order->price * $order->plot_amount;  // invoice amount - 2.21 USD; or you can use - $amountUSD = convert_currency_live("EUR", "USD", 22.37); // convert 22.37EUR to USD

        $period = "NOEXPIRY";    // one time payment, not expiry
        $def_language = "en";            // default Language in payment box
        $def_coin = "bitcoin";        // default Coin in payment box


        // List of coins that you accept for payments
        //$coins = array('bitcoin', 'bitcoincash', 'bitcoinsv', 'litecoin', 'dogecoin', 'dash', 'speedcoin', 'reddcoin', 'potcoin', 'feathercoin', 'vertcoin', 'peercoin', 'monetaryunit', 'universalcurrency');
        $coins = array('bitcoin', 'bitcoincash', 'litecoin', 'dogecoin', 'dash');  // for example, accept payments in bitcoin, bitcoincash, litecoin, dash, speedcoin

        // Create record for each your coin - https://gourl.io/editrecord/coin_boxes/0 ; and get free gourl keys
        // It is not bitcoin wallet private keys! Place GoUrl Public/Private keys below for all coins which you accept

        $all_keys = array(
            "bitcoincash" => array(
                "public_key" => "58329AASpU3dBitcoincash77BCHPUBGzrRgvwUTVz5VIjZFQS",
                "private_key" => "58329AASpU3dBitcoincash77BCHPRVEhQhgOBAy1PPCZRGzgH"
            ),
            "bitcoin" => array(
                "public_key" => "58259AA6oMPpBitcoin77BTCPUBDne0eGNE95WHsjIN9ZLBOBY",
                "private_key" => "58259AA6oMPpBitcoin77BTCPRVlzMru3ycbjg8bvGGQ32t0Uc"
            ),
            "litecoin" => array(
                "public_key" => "58330AAiLxc8Litecoin77LTCPUBhyPimo7q28Z3FDrJp5q1SZ",
                "private_key" => "58330AAiLxc8Litecoin77LTCPRVj7zglwEOMiUgrZAOtWKOsP"
            ),
            "dash" => array(
                "public_key" => "58331AAe0kduDash77DASHPUBTNKVAV7n1zwDSd5Mpe1Kb1ym1",
                "private_key" => "58331AAe0kduDash77DASHPRVeEr5Ghg7cDP0fsFtlSlUz3roe"
            ),
            "dogecoin" => array(
                "public_key" => "58332AAIcQuHDogecoin77DOGEPUBlwDYBdOkRhU3cVdel1MVt",
                "private_key" => "58332AAIcQuHDogecoin77DOGEPRV3YuUzcupcZXdsrz5O0R99"
            ),
        ); // etc.

        // Demo Keys; for tests	(example - 5 coins)
//        $all_keys = array("bitcoin" => array("public_key" => "25654AAo79c3Bitcoin77BTCPUBqwIefT1j9fqqMwUtMI0huVL",
//            "private_key" => "25654AAo79c3Bitcoin77BTCPRV0JG7w3jg0Tc5Pfi34U8o5JE"),
//            "bitcoincash" => array("public_key" => "25656AAeOGaPBitcoincash77BCHPUBOGF20MLcgvHMoXHmMRx",
//                "private_key" => "25656AAeOGaPBitcoincash77BCHPRV8quZcxPwfEc93ArGB6D"),
//            "litecoin" => array("public_key" => "25657AAOwwzoLitecoin77LTCPUB4PVkUmYCa2dR770wNNstdk",
//                "private_key" => "25657AAOwwzoLitecoin77LTCPRV7hmp8s3ew6pwgOMgxMq81F"),
//            "dogecoin" => array("public_key" => "25678AACxnGODogecoin77DOGEPUBZEaJlR9W48LUYagmT9LU8",
//                "private_key" => "25678AACxnGODogecoin77DOGEPRVFvl6IDdisuWHVJLo5m4eq"),
//            "dash" => array("public_key" => "25658AAo79c3Dash77DASHPUBqwIefT1j9fqqMwUtMI0huVL0J",
//                "private_key" => "25658AAo79c3Dash77DASHPRVG7w3jg0Tc5Pfi34U8o5JEiTss"),
//            "speedcoin" => array("public_key" => "20116AA36hi8Speedcoin77SPDPUBjTMX31yIra1IBRssY7yFy",
//                "private_key" => "20116AA36hi8Speedcoin77SPDPRVNOwjzYNqVn4Sn5XOwMI2c")); // Demo keys!

        //  IMPORTANT: Add in file /lib/cryptobox.config.php your database settings and your gourl.io coin private keys (need for Instant Payment Notifications) -
        /* if you use demo keys above, please add to /lib/cryptobox.config.php -
            $cryptobox_private_keys = array("25654AAo79c3Bitcoin77BTCPRV0JG7w3jg0Tc5Pfi34U8o5JE", "25678AACxnGODogecoin77DOGEPRVFvl6IDdisuWHVJLo5m4eq",
                        "25656AAeOGaPBitcoincash77BCHPRV8quZcxPwfEc93ArGB6D", "25657AAOwwzoLitecoin77LTCPRV7hmp8s3ew6pwgOMgxMq81F",
                        "25678AACxnGODogecoin77DOGEPRVFvl6IDdisuWHVJLo5m4eq", "25658AAo79c3Dash77DASHPRVG7w3jg0Tc5Pfi34U8o5JEiTss",
                        "20116AA36hi8Speedcoin77SPDPRVNOwjzYNqVn4Sn5XOwMI2c");
             Also create table "crypto_payments" in your database, sql code - https://github.com/cryptoapi/Payment-Gateway#mysql-table
             Instruction - https://gourl.io/api-php.html
         */

        // Re-test - all gourl public/private keys
        $def_coin = strtolower($def_coin);
        if (!in_array($def_coin, $coins)) $coins[] = $def_coin;
        foreach ($coins as $v) {
            if (!isset($all_keys[$v]["public_key"]) || !isset($all_keys[$v]["private_key"])) die("Please add your public/private keys for '$v' in \$all_keys variable");
            elseif (!strpos($all_keys[$v]["public_key"], "PUB")) die("Invalid public key for '$v' in \$all_keys variable");
            elseif (!strpos($all_keys[$v]["private_key"], "PRV")) die("Invalid private key for '$v' in \$all_keys variable");
            elseif (strpos(CRYPTOBOX_PRIVATE_KEYS, $all_keys[$v]["private_key"]) === false)
                die("Please add your private key for '$v' in variable \$cryptobox_private_keys, file /lib/cryptobox.config.php.");
        }

        // Current selected coin by user
        $coinName = cryptobox_selcoin($coins, $def_coin);

        // Current Coin public/private keys
        $public_key = $all_keys[$coinName]["public_key"];
        $private_key = $all_keys[$coinName]["private_key"];


        /** PAYMENT BOX **/
        $options = array(
            "public_key" => $public_key,    // your public key from gourl.io
            "private_key" => $private_key,    // your private key from gourl.io
            "webdev_key" => "",            // optional, gourl affiliate key
            "orderID" => $orderID,        // order id or product name
            "userID" => $userID,        // unique identifier for every user
            "userFormat" => $userFormat,    // save userID in COOKIE, IPADDRESS, SESSION  or MANUAL
            "amount" => 0,            // product price in btc/bch/bsv/ltc/doge/etc OR setup price in USD below
            "amountUSD" => $amountUSD,    // we use product price in USD
            "period" => $period,        // payment valid period
            "language" => $def_language  // text on EN - english, FR - french, etc
        );

        // Initialise Payment Class
        $box = new \Cryptobox ($options);

        if ($box->is_paid()) {
            $order->status_id = Status::PAYED;
            $order->save();
        }

        if (in_array($order->status_id, [Status::PAYED, Status::PLOT_QUEUED, Status::PLOT_READY ])) {
            return redirect()->route('orders::index')->with('error', 'Order already payed!');
        }

        // Text above payment box
        $custom_text = "";

        ob_start();
        // Display payment box
        echo $box->display_cryptobox_bootstrap($coins, $def_coin, $def_language, $custom_text, 71, 200, false, "", "default", 250, "", "ajax", false);

        $content = ob_get_clean();

//        \Log::debug('options', $options);

        return View::make('payments.show', [
            'content' => $content,
        ]);
    }
}
