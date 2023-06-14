<?php
namespace DanielOzeh\TerminalAfrica\Services;

use DanielOzeh\TerminalAfrica\Traits\Response;
use DanielOzeh\TerminalAfrica\Traits\ApiCalls;
// use DanielOzeh\TerminalAfrica\Utils\Array;

/**
 * @author Daniel Ozeh <hello@danielozeh.com.ng>
 */
class AddressService {
    protected $baseUri;
    protected $headers;
    protected $v1;
    protected $addressUrl;

    public function __construct() {
        $this->baseUri = config('terminal_africa.url');
        $this->v1 = config('terminal_africa.v1');
        $this->headers = [
            //'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . config('terminal_africa.secret_key'),
        ];
        $this->addressUrl = "$this->baseUri/$this->v1/addresses";
    }
    use ApiCalls;

    use Response; //use Response Trait

    /**
     * @param array $data [string $city, string $state, string $country, string $email., string $first_name., string $is_residential., string $last_name., string $line1., string $line2., string $metadata., string $phone., string $zip.]
     * @method POST
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     * /** @var string $createAddress
     */
    public function createAddress($data) {
        try {
            /** @var string $createAddress */
            $createAddress = $this->sendRequest('POST', $this->addressUrl, [], $data);
            if($createAddress && $createAddress['status']) {
                return $this->sendSuccess($createAddress['message'], $createAddress['data'] ?? []);
            }
            return $this->sendError($createAddress['message'], $createAddress['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
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
    public function updateAddress($addressId, $data) {
        try {
            $updateAddress = $this->sendRequest('PUT', "$this->addressUrl/$addressId", [], $data);
            if($updateAddress && $updateAddress['status']) {
                return $this->sendSuccess($updateAddress['message'], $updateAddress['data']);
            }
            return $this->sendError($updateAddress['message'], $updateAddress['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
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
    public function getAddresses($page = 1, $limit = 20) {
        try {
            $queryParams = [
                'page' => $page,
                'perPage' => $limit
            ];
            $getAddresses = $this->sendRequest('GET', $this->addressUrl, $queryParams, []);
            if($getAddresses && $getAddresses['status']) {
                return $this->sendSuccess($getAddresses['message'], $getAddresses['data'] ?? []);
            }
            return $this->sendError($getAddresses['message'], $getAddresses['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }

    /**
     * @param string $addressId
     * @method GET
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public function getAddress($addressId) {
        try {
            $address = $this->sendRequest('GET', "$this->addressUrl/$addressId", [], []);
            if($address && $address['status']) {
                return $this->sendSuccess($address['message'], $address['data']);
            }
            return $this->sendError($address['message'], $address['data']);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }

    /**
     * @param array $data [string $city, string $state, string $country, string $line1., string $line2., string $zip.]
     * @method POST
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public function validateAddress($data) {
        try {
            $validate = $this->sendRequest('POST', "$this->addressUrl/validate", [], $data);
            if($validate && $validate['status']) {
                return $this->sendSuccess($validate['message'], $validate['data']);
            }
            return $this->sendError($validate['message'], $validate['data']);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return $this->internalServerError($error);
        }
    }

    /**
     * @param string $addressId
     * @method POST
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public function setDefaultSenderAddress($addressId) {
        try {
            $data = [
                'address_id' => $addressId
            ];
            $address = $this->sendRequest('POST', "$this->addressUrl/default/sender", [], $data);
            if($address && $address['status']) {
                return $this->sendSuccess($address['message'], $address['data']);
            }
            return $this->sendError($address['message'], $address['data']);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }

    /**
     * 
     * @method GET
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public function getDefaultSenderAddress() {
        try {
            $address = $this->sendRequest('GET', "$this->addressUrl/default/sender", [], []);
            if($address && $address['status']) {
                return $this->sendSuccess($address['message'], $address['data']);
            }
            return $this->sendError($address['message'], $address['data']);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }
}