<?php
namespace Setup;

use Exception;

class MyAPI extends AbstractAPI
{
    protected $User;

    public function __construct($request, $origin)
    {
        parent::__construct($request);
 
        $Key = new Key;
        $User = new User;

        if (!array_key_exists('apiKey', $this->request)) {
            throw new Exception('No API Key provided');
        } elseif (!$Key->verifyKey($this->request['apiKey'], $origin)) {
            throw new Exception('Invalid API Key');
        } elseif (array_key_exists('token', $this->request) &&
            !$User->verifyUserToken($this->request['token'])) {
            throw new Exception('Invalid User Token');
        }
    }

    /**
     * Outage Endpoint
     */
    protected function outage($args)
    {
        //echo "Args: ";
        var_dump($this->file);
        
        if ($this->method == 'POST') {
            return "This method is POST";
        } else {
            return "Only accepts POST requests";
        }
    }
}
