<?php
namespace DanielOzeh\TerminalAfrica;

use DanielOzeh\TerminalAfrica\Traits\Response;
use DanielOzeh\TerminalAfrica\Traits\ApiCalls;
// use DanielOzeh\TerminalAfrica\Utils\Array;
use DanielOzeh\TerminalAfrica\Services\AddressService as Address;
use DanielOzeh\TerminalAfrica\Services\CarrierService as Carrier;

/**
 * @author Daniel Ozeh <hello@danielozeh.com.ng>
 */
class TerminalAfrica {

    ////////////////////////////////////
    ///// ADDRESSES //////////////
    ////////////////////////////////////
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

    /**
     * @param string $addressId
     * @param array $data [string $city, string $state, string $country, string $email., string $first_name., string $is_residential., string $last_name., string $line1., string $line2., string $metadata., string $phone., string $zip.]
     * @method PUT
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     * /** @var string $createAddress
     */
    public static function updateAddress($addressId, $data) {
        try {
            $address = new Address();
            return $address->updateAddress($addressId, $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param int $page
     * @param int $limit
     * @method GET
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public static function getAddresses($page = 1, $limit = 20) {
        try {
            $address = new Address();
            return $address->getAddresses($page, $limit);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $addressId
     * @method GET
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public static function getAddress($addressId) {
        try {
            $address = new Address();
            return $address->getAddress($addressId);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param array $data [string $city, string $state, string $country, string $line1., string $line2., string $zip.]
     * @method POST
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public static function validateAddress($data) {
        try {
            $address = new Address();
            return $address->validateAddress($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $addressId
     * @method POST
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public static function setDefaultSenderAddress($addressId) {
        try {
            $address = new Address();
            return $address->setDefaultSenderAddress($addressId);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 
     * @method GET
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public static function getDefaultSenderAddress() {
        try {
            $address = new Address();
            return $address->getDefaultSenderAddress();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param int $page.
     * @param int $limit.
     * @param boolean $active.
     * @param string type.
     * @method GET
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public static function getCarriers($query) {
        try {
            $carrier = new Carrier();
            return $carrier->getCarriers($query);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $carrierId
     * @method GET
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public static function getCarrier($carrierId) {
        try {
            $carrier = new Carrier();
            return $carrier->getCarrier($carrierId);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $carrierId
     * @param boolean $domestic
     * @param boolean $regional
     * @param boolean $international
     * @method POST
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public static function enableCarrier($carrierId, $query) {
        try {
            $carrier = new Carrier();
            return $carrier->enableCarrier($carrierId, $query);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param array [string $carrierId,  boolean $domestic, boolean $regional, boolean $international]
     * @method POST
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public static function enableMultipleCarrier($data) {
        try {
            $carrier = new Carrier();
            return $carrier->enableMultipleCarrier($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $carrierId
     * @param boolean $domestic
     * @param boolean $regional
     * @param boolean $international
     * @method POST
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public static function disableCarrier($carrierId, $query) {
        try {
            $carrier = new Carrier();
            return $carrier->disableCarrier($carrierId, $query);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param array [string $carrierId,  boolean $domestic, boolean $regional, boolean $international]
     * @method POST
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public static function disableMultipleCarrier($data) {
        try {
            $carrier = new Carrier();
            return $carrier->disableMultipleCarrier($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}