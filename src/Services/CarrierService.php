<?php
namespace DanielOzeh\TerminalAfrica\Services;

use DanielOzeh\TerminalAfrica\Traits\Response;
use DanielOzeh\TerminalAfrica\Traits\ApiCalls;

/**
 * @author Daniel Ozeh <hello@danielozeh.com.ng>
 */
class CarrierService {
    protected $baseUri;
    protected $headers;
    protected $v1;
    protected $carrierUrl;

    public function __construct() {
        $this->baseUri = config('terminal_africa.url');
        $this->v1 = config('terminal_africa.v1');
        $this->headers = [
            //'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . config('terminal_africa.secret_key'),
        ];
        $this->carrierUrl = "$this->baseUri/$this->v1/carriers";
    }
    use ApiCalls;

    use Response; //use Response Trait

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
    public function getCarriers($query) {
        try {
            $carriers = $this->sendRequest('GET', $this->carrierUrl, $query);
            if($carriers && $carriers['status']) {
                return $this->sendSuccess($carriers['message'], $carriers['data'] ?? []);
            }
            return $this->sendError($carriers['message'], $carriers['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }

    /**
     * @param string $carrierId
     * @method GET
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public function getCarrier($carrierId) {
        try {
            $carrier = $this->sendRequest('GET', "$this->carrierUrl/$carrierId", [], []);
            if($carrier && $carrier['status']) {
                return $this->sendSuccess($carrier['message'], $carrier['data'] ?? []);
            }
            return $this->sendError($carrier['message'], $carrier['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
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
    public function enableCarrier($carrierId, $query) {
        try {
            $enable = $this->sendRequest('POST', "$this->carrierUrl/enable/$carrierId", $query, []);
            if($enable && $enable['status']) {
                return $this->sendSuccess($enable['message'], $enable['data'] ?? []);
            }
            return $this->sendError($enable['message'], $enable['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }

    /**
     * @param array [string $carrierId,  boolean $domestic, boolean $regional, boolean $international]
     * @method POST
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public function enableMultipleCarrier($data) {
        try {
            $enable = $this->sendRequest('POST', "$this->carrierUrl/multiple/enable", [], $data);
            if($enable && $enable['status']) {
                return $this->sendSuccess($enable['message'], $enable['data'] ?? []);
            }
            return $this->sendError($enable['message'], $enable['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
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
    public function disableCarrier($carrierId, $query) {
        try {
            $disable = $this->sendRequest('POST', "$this->carrierUrl/disable/$carrierId", $query, []);
            if($disable && $disable['status']) {
                return $this->sendSuccess($disable['message'], $disable['data'] ?? []);
            }
            return $this->sendError($disable['message'], $disable['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }

    /**
     * @param array [string $carrierId,  boolean $domestic, boolean $regional, boolean $international]
     * @method POST
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public function disableMultipleCarrier($data) {
        try {
            $disable = $this->sendRequest('POST', "$this->carrierUrl/multiple/disable", [], $data);
            if($disable && $disable['status']) {
                return $this->sendSuccess($disable['message'], $disable['data'] ?? []);
            }
            return $this->sendError($disable['message'], $disable['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }
}