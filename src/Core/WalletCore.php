<?php
namespace Fshangala\Cws\Core;
use Fshangala\Cws\Models\Wallet;

class WalletCore
{
    public function createWallet($user_id)
    {
        try {
            $instance = Wallet::create([
                "user_id"=>$user_id,
                "status"=>"pending",
            ]);
            return $instance;
        } catch (Exception $e) {
            throw $e;
        }
    }
}