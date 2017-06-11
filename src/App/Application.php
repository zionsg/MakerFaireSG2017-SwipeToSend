<?php

namespace App;

class Application
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Receive and echo back filename of image that was swiped
     *
     * @return string JSON-encoded string
     *     {
     *         "image_name": "pic01"
     *     }
     */
    public function run()
    {
        // Get image name from POST request param
        $imgName = isset($_POST['image_name']) ? $_POST['image_name'] : '';

        return $this->response([
            'image_name' => $imgName,
        ]);
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
