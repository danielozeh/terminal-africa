<?php
namespace DanielOzeh\TerminalAfrica;

use DanielOzeh\TerminalAfrica\Traits\Response;
use DanielOzeh\TerminalAfrica\Traits\ApiCalls;
// use DanielOzeh\TerminalAfrica\Utils\Array;
use DanielOzeh\TerminalAfrica\Services\AddressService as Address;

/**
 * @author Daniel Ozeh <hello@danielozeh.com.ng>
 */
class TerminalAfrica {

    /**
     * @param array $data [string $city, string $state, string $country, string $email., string $first_name., boolean $is_residential., string $last_name., string $line1., string $line2., string $metadata., string $phone., string $zip.]
     * @method POST
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     * @return array [boolean status, string message, array data]
     */
    public static function createAddress($data) {
        try {
            $address = new Address();
            return $address->createAddress($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}