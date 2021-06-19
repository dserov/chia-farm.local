<?php

namespace App\Http\Controllers;

use App\Events\OrderWasPayed;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;

class CryptoBoxCallbackController extends Controller
{
    // callback payment
    public function callback(Request $request)
    {
        \Log::debug('CryptoBoxCallbackController', $_POST);

        function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "")
        {

            // Debug - new payment email notification for webmaster
            // Uncomment lines below and make any test payment
            // You can use page https://gourl.io/info/ipn to send
            // dummy payment data to your website,
            // you will receive this email notification
            // --------------------------------------------
            // $email = "....your email address....";
            // mail($email, "Payment - " . $paymentID . " - " . $box_status, " \n Payment ID: " . $paymentID . " \n\n Status: " . $box_status . " \n\n Details: " . print_r($payment_details, true));

            /** .............
             * .............
             *
             * PLACE YOUR CODE HERE
             *
             * Update database with new payment, send email to user, etc
             * Please note, all received payments store in your table `crypto_payments` also
             * See - https://gourl.io/api-php.html#payment_history
             * .............
             * .............
             * For example, you have own table `user_orders`...
             * You can use function run_sql() from cryptobox.class.php ( https://gourl.io/api-php.html#run_sql )
             *
             * .............
             * // Save new Bitcoin payment in database table `user_orders`
             * $recordExists = run_sql("select paymentID as nme FROM `user_orders` WHERE paymentID = ".intval($paymentID));
             * if (!$recordExists) run_sql("INSERT INTO `user_orders` VALUES(".intval($paymentID).",'".addslashes($payment_details["user"])."','".addslashes($payment_details["order"])."',".floatval($payment_details["amount"]).",".floatval($payment_details["amountusd"]).",'".addslashes($payment_details["coinlabel"])."',".intval($payment_details["confirmed"]).",'".addslashes($payment_details["status"])."')");
             *
             * .............
             * // Received second IPN notification (optional) - Bitcoin payment confirmed (6+ transaction confirmations)
             * if ($recordExists && $box_status == "cryptobox_updated")  run_sql("UPDATE `user_orders` SET txconfirmed = ".intval($payment_details["confirmed"])." WHERE paymentID = ".intval($paymentID));
             * .............
             * .............
             *
             * // Onetime action when payment confirmed (6+ transaction confirmations)
             * $processed = run_sql("select processed as nme FROM `crypto_payments` WHERE paymentID = ".intval($paymentID)." LIMIT 1");
             * if (!$processed && $payment_details["confirmed"])
             * {
             * // ... Your code ...
             *
             * // ... and update status in default table where all payments are stored - https://github.com/cryptoapi/Payment-Gateway#mysql-table
             * $sql = "UPDATE crypto_payments SET processed = 1, processedDate = '".gmdate("Y-m-d H:i:s")."' WHERE paymentID = ".intval($paymentID)." LIMIT 1";
             * run_sql($sql);
             * }
             *
             * .............
             */

            \Log::debug('cryptobox_new_payment - ', $payment_details);

            // Onetime action when payment confirmed (6+ transaction confirmations)
            $processed = run_sql("select processed as nme FROM `crypto_payments` WHERE paymentID = " . intval($paymentID) . " LIMIT 1");
            if (!$processed && $payment_details["confirmed"]) {
                \Log::debug('cryptobox_new_payment - if(true)' . json_encode($processed));
                // ... Your code ...
                $order = Order::where('user_id', $payment_details['user'])
                    ->where('id', $payment_details['order'])
                    ->first();
                $order->status_id = Status::PAYED;
                $order->save();
                // ... and update status in default table where all payments are stored - https://github.com/cryptoapi/Payment-Gateway#mysql-table
                $sql = "UPDATE crypto_payments SET processed = 1, processedDate = '" . gmdate("Y-m-d H:i:s") . "' WHERE paymentID = " . intval($paymentID) . " LIMIT 1";
                run_sql($sql);
                \Log::debug('cryptobox_new_payment - order was payed');
            }

            return true;
        }

        DEFINE("CRYPTOBOX_PHP_FILES_PATH", app_path('CryptoBox' . DIRECTORY_SEPARATOR));            // path to directory with files: cryptobox.class.php / cryptobox.callback.php / cryptobox.newpayment.php;
        // cryptobox.newpayment.php will be automatically call through ajax/php two times - payment received/confirmed

        if (!defined("CRYPTOBOX_WORDPRESS")) define("CRYPTOBOX_WORDPRESS", false);

        if (!CRYPTOBOX_WORDPRESS) require_once(CRYPTOBOX_PHP_FILES_PATH . "cryptobox.class.php");
        elseif (!defined('ABSPATH')) exit; // Exit if accessed directly in wordpress


        // a. check if private key valid
        $valid_key = false;
        if (isset($_POST["private_key_hash"]) && strlen($_POST["private_key_hash"]) == 128 && preg_replace('/[^A-Za-z0-9]/', '', $_POST["private_key_hash"]) == $_POST["private_key_hash"]) {
            $keyshash = array();
            $arr = explode("^", CRYPTOBOX_PRIVATE_KEYS);
            foreach ($arr as $v) $keyshash[] = strtolower(hash("sha512", $v));
            if (in_array(strtolower($_POST["private_key_hash"]), $keyshash)) $valid_key = true;
        }


        // b. alternative - ajax script send gourl.io json data
        if (!$valid_key && isset($_POST["json"]) && $_POST["json"] == "1") {
            $data_hash = $boxID = "";
            if (isset($_POST["data_hash"]) && strlen($_POST["data_hash"]) == 128 && preg_replace('/[^A-Za-z0-9]/', '', $_POST["data_hash"]) == $_POST["data_hash"]) {
                $data_hash = strtolower($_POST["data_hash"]);
                unset($_POST["data_hash"]);
            }
            if (isset($_POST["box"]) && is_numeric($_POST["box"]) && $_POST["box"] > 0) $boxID = intval($_POST["box"]);

            if ($data_hash && $boxID) {
                $private_key = "";
                $arr = explode("^", CRYPTOBOX_PRIVATE_KEYS);
                foreach ($arr as $v) if (strpos($v, $boxID . "AA") === 0) $private_key = $v;

                if ($private_key) {
                    $data_hash2 = strtolower(hash("sha512", $private_key . json_encode($_POST) . $private_key));
                    if ($data_hash == $data_hash2) $valid_key = true;
                }
                unset($private_key);
            }

            if (!$valid_key) die("Error! Invalid Json Data sha512 Hash!");

        }


        // c.
        if ($_POST) foreach ($_POST as $k => $v) if (is_string($v)) $_POST[$k] = trim($v);


        // d.
        if (isset($_POST["plugin_ver"]) && !isset($_POST["status"]) && $valid_key) {
            echo "cryptoboxver_" . (CRYPTOBOX_WORDPRESS ? "wordpress_" . GOURL_VERSION : "php_" . CRYPTOBOX_VERSION);
            die;
        }


        // e.
        if (isset($_POST["status"]) && in_array($_POST["status"], array("payment_received", "payment_received_unrecognised")) &&
            $_POST["box"] && is_numeric($_POST["box"]) && $_POST["box"] > 0 && $_POST["amount"] && is_numeric($_POST["amount"]) && $_POST["amount"] > 0 && $valid_key) {

            foreach ($_POST as $k => $v) {
                if ($k == "datetime") $mask = '/[^0-9\ \-\:]/';
                elseif (in_array($k, array("err", "date", "period"))) $mask = '/[^A-Za-z0-9\.\_\-\@\ ]/';
                else                                $mask = '/[^A-Za-z0-9\.\_\-\@]/';
                if ($v && preg_replace($mask, '', $v) != $v) $_POST[$k] = "";
            }

            if (!$_POST["amountusd"] || !is_numeric($_POST["amountusd"])) $_POST["amountusd"] = 0;
            if (!$_POST["confirmed"] || !is_numeric($_POST["confirmed"])) $_POST["confirmed"] = 0;


            $dt = gmdate('Y-m-d H:i:s');
            $obj = run_sql("select paymentID, txConfirmed from crypto_payments where boxID = " . intval($_POST["box"]) . " && orderID = '" . addslashes($_POST["order"]) . "' && userID = '" . addslashes($_POST["user"]) . "' && txID = '" . addslashes($_POST["tx"]) . "' && amount = " . floatval($_POST["amount"]) . " && addr = '" . addslashes($_POST["addr"]) . "' limit 1");


            $paymentID = ($obj) ? $obj->paymentID : 0;
            $txConfirmed = ($obj) ? $obj->txConfirmed : 0;

            // Save new payment details in local database
            if (!$paymentID) {
                $sql = "INSERT INTO crypto_payments (boxID, boxType, orderID, userID, countryID, coinLabel, amount, amountUSD, unrecognised, addr, txID, txDate, txConfirmed, txCheckDate, recordCreated)
				VALUES (" . intval($_POST["box"]) . ", '" . addslashes($_POST["boxtype"]) . "', '" . addslashes($_POST["order"]) . "', '" . addslashes($_POST["user"]) . "', '" . addslashes($_POST["usercountry"]) . "', '" . addslashes($_POST["coinlabel"]) . "', " . floatval($_POST["amount"]) . ", " . floatval($_POST["amountusd"]) . ", " . ($_POST["status"] == "payment_received_unrecognised" ? 1 : 0) . ", '" . addslashes($_POST["addr"]) . "', '" . addslashes($_POST["tx"]) . "', '" . addslashes($_POST["datetime"]) . "', " . intval($_POST["confirmed"]) . ", '$dt', '$dt')";

                $paymentID = run_sql($sql);

                $box_status = "cryptobox_newrecord";
            } // Update transaction status to confirmed
            elseif ($_POST["confirmed"] && !$txConfirmed) {
                $sql = "UPDATE crypto_payments SET txConfirmed = 1, txCheckDate = '$dt' WHERE paymentID = " . intval($paymentID) . " LIMIT 1";
                run_sql($sql);

                $box_status = "cryptobox_updated";
            } else {
                $box_status = "cryptobox_nochanges";
            }


            /**
             *  User-defined function for new payment - cryptobox_new_payment(...)
             *  For example, send confirmation email, update database, update user membership, etc.
             *  You need to modify file - cryptobox.newpayment.php
             *  Read more - https://gourl.io/api-php.html#ipn
             */

            if (in_array($box_status, array("cryptobox_newrecord", "cryptobox_updated"))) cryptobox_new_payment($paymentID, $_POST, $box_status);
        } else
            $box_status = "Only POST Data Allowed";

        return $box_status; // don't delete it
    }
}
