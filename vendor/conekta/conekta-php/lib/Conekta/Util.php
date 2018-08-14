<?php 

namespace Conekta;

use \Conekta\Object;

abstract class Util
{
    public static $types = array(
        'webhook'                     => '\Conekta\Webhook',
        'webhook_log'                 => '\Conekta\WebhookLog',
        'billing_address'             => '\Conekta\Address',
        'bank_transfer_payout_method' => '\Conekta\Method',
        'payout'                      => '\Conekta\Payout',
        'payee'                       => '\Conekta\Payee',
        'payout_method'               => '\Conekta\PayoutMethod',
        'card_payment'                => '\Conekta\PaymentMethod',
        'cash_payment'                => '\Conekta\PaymentMethod',
        'bank_transfer_payment'       => '\Conekta\PaymentMethod',
        'card'                        => '\Conekta\Card',
        'charge'                      => '\Conekta\Charge',
        'customer'                    => '\Conekta\Customer',
        'event'                       => '\Conekta\Event',
        'plan'                        => '\Conekta\Plan',
        'subscription'                => '\Conekta\Subscription'
    );

    public static function convertToConektaObject($resp)
    {
        $types = self::$types;
        if (is_array($resp)) {
            if (isset($resp['object']) && is_string($resp['object']) && isset($types[$resp['object']])) {
                $class = $types[$resp['object']];
                $instance = new $class();
                $instance->loadFromArray($resp);

                return $instance;
            }

            if (isset($resp['street1']) || isset($resp['street2'])) {
                $class = '\Conekta\Address';
                $instance = new $class();
                $instance->loadFromArray($resp);

                return $instance;
            }
            if (current($resp)) {
                $instance = new Object();
                $instance->loadFromArray($resp);

                return $instance;
            }

            return new Object();
        }

        return $resp;
    }

    public static function shiftArray($array, $k)
    {
        unset($array[$k]);
        end($array);
        $lastKey = key($array);

        for ($i = $k; $i < $lastKey; ++$i) {
            $array[$i] = $array[$i + 1];
            unset($array[$i + 1]);
        }

        return $array;
    }
}
