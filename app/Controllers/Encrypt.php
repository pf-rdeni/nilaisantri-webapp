<?php
namespace App\Controllers;
//use Config\Encryption;
use App\Models\EncryptModel;

class Encrypt extends BaseController
{
    public $encryptModel;
    public function __construct()
    {
        $this->encryptModel = new EncryptModel();
    }

    public function encrypt($data)
    {
        $returnData = $this->encryptModel->encryptData($data);
        $this->decrypt($returnData);
    }
    public function decrypt($data)
    {
        $returnData = $this->encryptModel->decryptData($data);
    }
    
}
