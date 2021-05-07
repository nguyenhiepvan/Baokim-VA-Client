<?php
/**
 * @Created by : PhpStorm
 * @Author : Hiệp Nguyễn
 * @At : 07/05/2021, Friday
 * @Filename : Base.php
 **/

namespace Nguyenhiep\BaoKimVaClient\Client;


use GuzzleHttp\Client;
use Nguyenhiep\BaoKimVaClient\Services\RSA;

class Base
{

    /**
     * @var RSA
     */
    protected $encrypter;

    /**
     * @var string
     */
    protected $url_dev;


    /**
     * @var string
     */
    protected $url_prod;

    public function __construct($private_key, $public_key)
    {
        $this->encrypter = new RSA($private_key, $public_key);
    }

    protected function makeSignature(array $data)
    {
        return base64_encode($this->encrypter->encrypt(implode("|", $data)));
    }

    protected function makeClient($signature, $mode = "dev"): Client
    {
        $url = isset($this->{"url_$mode"}) ? $this->{"url_$mode"} : $this->url_dev;
        return new Client([
            'headers'  => [
                'Accept'    => 'application/json',
                'Signature' => $signature,
            ],
            'base_uri' => $url,
            'verify'   => false,
        ]);
    }
}