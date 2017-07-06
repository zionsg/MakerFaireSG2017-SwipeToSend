<?php

namespace App;

/**
 * @api {post} /app Submit name of swiped image
 *
 * @apiParam {string} image_name Name of image
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "image_name": "pic01",
 *       "api_call": {
 *         "code": 200,
 *         "response": "OK"
 *       }
 *     }
 * @see http://apidocjs.com
 */
class Application
{
    protected $endpointUrl;

    public function __construct(array $config)
    {
        $this->endpointUrl = $config['endpoint_url'];
    }

    /**
     * Receive and echo back filename of image that was swiped
     *
     * @return string JSON-encoded string
     *     {
     *         "data": "pic01"
     *     }
     */
    public function run()
    {
        // Get image name from POST request param
        $imgName = isset($_POST['image_name']) ? $_POST['image_name'] : '';

        $apiCall = $this->call($this->endpointUrl, ['data' => $imgName]);

        return $this->response([
            'image_name' => $imgName,
            'api_call' => $apiCall,
        ]);
    }

    /**
     * Send cURL request to external API
     *
     * @param  string $url
     * @param  array $data
     * @return array ['code' => <HTTP response code>, 'response' => <response data>]
     */
    protected function call($url, array $data)
    {
        if (! $url) {
            return [
                'code' => null,
                'response' => null,
            ];
        }

        $headers = ['Content-Type: application/json; charset=utf-8'];
        $curlHandler = curl_init();
        curl_setopt_array($curlHandler, [
            CURLOPT_RETURNTRANSFER => true, // return value instead of output to browser
            CURLOPT_HEADER => false, // do not include headers in return value
            CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'], // some servers reject requests with no user agent
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
        ]);
        $apiResponse = curl_exec($curlHandler);
        $curlInfo = curl_getinfo($curlHandler);
        $apiCode = $curlInfo['http_code'];
        curl_close($curlHandler);

        return [
            'code' => $apiCode,
            'response' => $apiResponse,
        ];
    }

    /**
     * Return JSON response
     *
     * @param  array $data
     * @return void
     */
    protected function response(array $data, $responseCode = 200)
    {
        $response = json_encode($data);
        header_remove();
        http_response_code($responseCode);
        header('Content-Type: application/json; charset=utf8');
        echo $response;
        exit;
    }
}
