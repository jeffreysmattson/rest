<?php
namespace Rest;

class User
{
    protected $user;
    private $validTokens = array(
        'nhec2017'
    );

    public function __construct()
    {
    }

    public function verifyUserToken($givenToken)
    {
        if (!isset($givenToken) || !isset($type)) {
            return false;
        }

        foreach ($this->validTokens as $token) {
            if ($token == $givenToken) {
                return true;
            }
        }
        return false;
    }
}
