<?php
namespace Rest;

class User
{
    protected $user;
    private $nhecToken = 'nhec2017';

    public function __construct()
    {
    }

    public function verifyUserToken($type, $givenToken)
    {
        if (!isset($givenToken) || !isset($type)) {
            return false;
        }

        if ($type == 'token' && $givenToken == $this->nhecToken) {
            return true;
        } else {
            return false;
        }
    }
}
