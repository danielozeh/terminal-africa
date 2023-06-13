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
            // call terminal africa endpoint to create address
            $createAddress = $this->sendRequest('POST', $this->addressUrl, [], $data);
            // error_log($createAddress);
            if($createAddress && $createAddress['status']) {
                return $this->sendSuccess($createAddress['message'], $createAddress['data']);
            }
            return $this->sendError($createAddress['message'], $createAddress['data']);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return $this->internalServerError($error);
        }
    }
}