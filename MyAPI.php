<?php
require_once 'AbstractAPI.php';
require_once 'User.php';
require_once 'Key.php';

class MyAPI extends AbstractAPI
{
    protected $User;
    protected $request;

    public function __construct($request, $origin) {
        parent::__construct($request);
 
        $Key = new Key;
        $User = new User;

        /*if (!array_key_exists('apiKey', $this->request)) {
            var_dump($this->request);
            throw new Exception('No API Key provided');
        } else if (!$Key->verifyKey($this->request['apiKey'], $origin)) {
            throw new Exception('Invalid API Key');
        } else if (array_key_exists('token', $this->request) &&
             !$User->verifyUserToken('token', $this->request['token'])) {
            throw new Exception('Invalid User Token');
        }*/

        //$this->User = $User;
    }

    /**
     * Example of an Endpoint
     */
     protected function outage($args) {
        echo "Args: ";
        var_dump($args);
        
        if ($this->method == 'PUT') {
            return "This method is PUT";
        } else {
            return "Only accepts PUT requests";
        }
     }
 }
 ?>