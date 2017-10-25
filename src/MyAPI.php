<?php
namespace Setup;

use Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MyAPI extends AbstractAPI
{
    protected $User;
    private $log;
    private $origin;

    public function __construct($request, $origin)
    {
        parent::__construct($request);
 
        // Create a log channel
        $this->log = new Logger('MyAPI');
        $this->log->pushHandler(new StreamHandler('../apiLog.txt', Logger::DEBUG));

        $this->origin = $origin;
    }

    /**
     * Outage Endpoint
     */
    protected function outage($args)
    {
        if(!$this->authenticationVerification($this->request, $this->origin)){
            die();
        }
        //echo "Args: ";
        var_dump($_POST);
        
        if ($this->method == 'POST') {
            $this->log->info('POST occurred');
            return "This method is POST";
        } else {
            return "Only accepts POST requests";
        }
    }

    /**
     * Authenticate credentials provided by client.
     * 
     * @param  array    $request
     * @return boolean  True if verification succeeds.
     */
    private function authenticationVerification($request, $origin){
        
        // Create User and key object.
        $Key = new Key;
        $User = new User;

        if (!array_key_exists('apiKey', $this->request)) {
            $this->log->info('No API Key provided', array($origin, $request));
            return false;
        } elseif (!$Key->verifyKey($this->request['apiKey'], $origin)) {
            $this->log->info('Invalid API Key', array($origin, $request));
            return false;
        } elseif (array_key_exists('token', $this->request) &&
            !$User->verifyUserToken($this->request['token'])) {
            $this->log->info('Invalid User Token', array($origin, $this->request['token']));
            return false;
        }
        return true;
    }
}
