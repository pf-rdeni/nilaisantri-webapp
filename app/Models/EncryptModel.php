<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Encryption;

class EncryptModel extends Model
{
    protected $encrypter;

    public function __construct()
    {
        $config = new Encryption();
        $this->encrypter = \Config\Services::encrypter($config);
    }

    public function encryptData($plainText)
    {
        $encrypted = $this->encrypter->encrypt(hex2bin($plainText));
        return $encrypted ;
    }

    public function decryptData($encryptedText)
    {
        $decrypted = $this->encrypter->decrypt(hex2bin($encryptedText));
        return $decrypted;
    }
}
