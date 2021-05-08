<?php
/**
 * @Created by : PhpStorm
 * @Author : Hiệp Nguyễn
 * @At : 07/05/2021, Friday
 * @Filename : RSA.php
 **/

namespace Nguyenhiep\BaoKimVaClient\Services;


use Nguyenhiep\BaoKimVaClient\Exceptions\InvalidSignatureException;
use Nguyenhiep\BaoKimVaClient\Exceptions\KeyNotFoundException;
use Nguyenhiep\BaoKimVaClient\Exceptions\SignFailedException;

class RSA
{
    /**
     * @var string
     */
    protected $pubkey;

    /**
     * @var string
     */
    protected $privkey;

    /**
     * RSA constructor.
     * @param $privkey
     * @param $pubkey
     * @throws KeyNotFoundException
     */
    public function __construct($privkey, $pubkey)
    {
        $this->privkey = $privkey;
        $this->pubkey  = $pubkey;
        if (!$this->pubkey) {
            throw new KeyNotFoundException("No public key found");
        }
        if (!$this->privkey) {
            throw new KeyNotFoundException("No private key found");
        }
    }

    /**
     * @param $data
     * @return string
     * @throws SignFailedException
     */
    public function sign($data)
    {
        if (openssl_sign($data, $encrypted, $this->privkey, OPENSSL_ALGO_SHA1)) {
            return base64_encode($encrypted);
        }
        throw new SignFailedException('can not sign data');
    }

    /**
     * @param $data
     * @return string
     */
    public function verify($data, $signature)
    {
        $ok = openssl_verify($data, $signature, $this->pubkey, OPENSSL_ALGO_SHA1);
        switch ($ok) {
            case 1:
                return true;
            case 0:
                return false;
            default:
                throw new InvalidSignatureException("error checking signature");
        }
    }
}
