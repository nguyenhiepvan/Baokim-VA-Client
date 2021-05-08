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

    /**
     * @param array $data data will be signed
     * @param string $separator
     * @param null $structure structure of signature
     * @return string signature
     * @throws \Nguyenhiep\BaoKimVaClient\Exceptions\SignFailedException
     */
    protected function makeSignature(array $data, string $separator = "|", $structure = null)
    {
        if ($structure) {
            $data = array_filter($data, function ($k) use ($structure) {
                return in_array($k, explode("|", $structure));
            }, ARRAY_FILTER_USE_KEY);
        }
        if ($separator == "json") {
            return $this->encrypter->sign(json_encode($data));
        }
        return $this->encrypter->sign(implode($separator, $data));
    }

    /**
     * @param $signature
     * @param string $mode dev|production
     * @return Client
     */
    protected function makeClient($signature, $mode = "dev"): Client
    {
        $url = isset($this->{"url_$mode"}) ? $this->{"url_$mode"} : $this->url_dev;
        return new Client([
            'headers'  => [
                'Content-Type' => "application/json",
                'Signature'    => $signature,
            ],
            'base_uri' => $url
        ]);
    }
}
