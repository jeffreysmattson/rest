<?php
namespace Setup;

class Key
{
    protected $key;

    private $accessKeys = array(
        array(
            'origin'    => '192.168.33.10',
            'key'       => '123456'
        ),
        array(
            'origin'    => 'local.testing.dev',
            'key'       => '654321'
        )
    );

    public function __construct()
    {
    }

    public function verifyKey($key, $origin)
    {
        foreach ($this->accessKeys as $access) {
            if (($access['origin'] == $origin) && ($access['key'] == $key)) {
                return true;
            }
        }
        return false;
    }
}
