<?php
namespace DanielOzeh\TerminalAfrica\Traits;

use GuzzleHttp\Client;

/**
 * @author Daniel Ozeh hello@danielozeh.com.ng
 * 
 * Used to consume external resources
 */

/**
 * 
 */
trait ApiCalls
{
    /**
     * Send a request to any service
     * @return response
     * @author Daniel Ozeh <hello@danielozeh.com.ng>
     * @param string $method
     * @param string $requestUrl
     * @param array $queryParams
     * @param array $requestBody
     * @param bool $hasFile
     */
    public function sendRequest($method, $requestUrl, $queryParams = [], $data = [], $hasFile = false) {
        $client = new Client([
            'base_uri' => $this->baseUri,
            'headers' => $this->headers,
            'verify' => false,
            'http_errors' => false
        ]);

        $bodyType = 'json';
        if($hasFile) {
            $bodyType = 'multipart';
            $multipart = [];

            foreach($data as $name => $contents) {
                $multipart[] = [
                    'name' => $name,
                    'contents' => $contents
                ];
            }
        }
        $response = $client->request($method, $requestUrl, [
            'query' => $queryParams,
            $bodyType => $hasFile ? $multipart : $data
        ]);

        $statusCode = $response->getStatusCode();
        $response = json_decode($response->getBody()->getContents(), true); //get contents from reponse body
        return $response;
    }
}
