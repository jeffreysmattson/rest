<?php
namespace Setup;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class User
{
    protected $user;
    private $log;
    private $validTokens = array(
        'USER5555'
    );

    public function __construct()
    {
        // Create a log channel
        $this->log = new Logger('User');
        $this->log->pushHandler(new StreamHandler('../apiLog.txt', Logger::DEBUG));
    }

    public function verifyUserToken($givenToken)
    {
        if (!isset($givenToken)) {
            return false;
        }

        foreach ($this->validTokens as $token) {
            if ($token == $givenToken) {
                $this->log->info('User token verified.');
                return true;
            }
        }
        return false;
    }
}
