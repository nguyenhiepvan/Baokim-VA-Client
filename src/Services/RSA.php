<?php
/**
 * @Created by : PhpStorm
 * @Author : Hiệp Nguyễn
 * @At : 07/05/2021, Friday
 * @Filename : RSA.php
 **/

namespace Nguyenhiep\BaoKimVaClient\Services;


use Nguyenhiep\BaoKimVaClient\Exceptions\EncryptFailedException;

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
     * @param $privkey string
     * @param $pubkey string
     */
    public function __construct($privkey, $pubkey)
    {
        $this->privkey = $privkey;
        $this->pubkey  = $pubkey;
    }

    public function encrypt($data)
    {
        if (openssl_public_encrypt($data, $encrypted, $this->pubkey)) {
            $data = base64_encode($encrypted);
        } else {
            throw new EncryptFailedException('Unable to encrypt data. Perhaps it is bigger than the key size?');
        }
        return $data;
    }

    public function decrypt($data)
    {
        if (openssl_private_decrypt(base64_decode($data), $decrypted, $this->privkey)) {
            $data = $decrypted;
        } else {
            $data = '';
        }
        return $data;
    }
}
