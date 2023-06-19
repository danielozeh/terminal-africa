<?php
namespace DanielOzeh\TerminalAfrica\Services;

use DanielOzeh\TerminalAfrica\Traits\Response;
use DanielOzeh\TerminalAfrica\Traits\ApiCalls;

/**
 * @author Daniel Ozeh <hello@danielozeh.com.ng>
 */
class PackagingService {
    protected $baseUri;
    protected $headers;
    protected $v1;
    protected $packagingUrl;

    public function __construct() {
        $this->baseUri = config('terminal_africa.url');
        $this->v1 = config('terminal_africa.v1');
        $this->headers = [
            //'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . config('terminal_africa.secret_key'),
        ];
        $this->packagingUrl = "$this->baseUri/$this->v1/packaging";
    }
    use ApiCalls;

    use Response; //use Response Trait

     /**
     * @param array [int $height, int $length, string $name, string $size_unit, string $type, int $width, int $weight, string $weight_unit]
     * @method POST
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public function createPackaging($data) {
        try {
            $carriers = $this->sendRequest('POST', $this->packagingUrl, [], $data);
            if($carriers && $carriers['status']) {
                return $this->sendSuccess($carriers['message'], $carriers['data'] ?? []);
            }
            return $this->sendError($carriers['message'], $carriers['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }

    /**
     * @param string $packagingId
     * @param array [int $height, int $length, string $name, string $size_unit, string $type, int $width, int $weight, string $weight_unit]
     * @method PUT
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public function updatePackaging($packagingId, $data) {
        try {
            $carriers = $this->sendRequest('PUT', "$this->packagingUrl/$packagingId", [], $data);
            if($carriers && $carriers['status']) {
                return $this->sendSuccess($carriers['message'], $carriers['data'] ?? []);
            }
            return $this->sendError($carriers['message'], $carriers['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }

     /**
     * @param int $page.
     * @param int $limit.
     * @method GET
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public function getPackagings($query) {
        try {
            $carriers = $this->sendRequest('GET', $this->packagingUrl, $query);
            if($carriers && $carriers['status']) {
                return $this->sendSuccess($carriers['message'], $carriers['data'] ?? []);
            }
            return $this->sendError($carriers['message'], $carriers['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }

    /**
     * @param string $packagingId
     * @method GET
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public function getPackaging($packagingId) {
        try {
            $carriers = $this->sendRequest('GET', "$this->packagingUrl/$packagingId", []);
            if($carriers && $carriers['status']) {
                return $this->sendSuccess($carriers['message'], $carriers['data'] ?? []);
            }
            return $this->sendError($carriers['message'], $carriers['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }

    /**
     * @method GET
     * 
     * @return array [boolean status, string message, array data]
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     */
    public function terminalDefaultPackaging() {
        try {
            $carriers = $this->sendRequest('GET', "$this->packagingUrl/default/terminal", []);
            if($carriers && $carriers['status']) {
                return $this->sendSuccess($carriers['message'], $carriers['data'] ?? []);
            }
            return $this->sendError($carriers['message'], $carriers['data'] ?? []);
        } catch (\Exception $e) {
            return $this->internalServerError($e->getMessage());
        }
    }
}