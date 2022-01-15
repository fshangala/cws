<?php
namespace Fshangala\Cws\Core;
use Fshangala\Cws\Models\Wallet;
use Fshangala\Cws\Models\Transaction;

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

    public function depositRequest($user_id,$currency,$debit,$reference)
    {
        try {
            $wallet = Wallet::findOrFail($user_id);
            $instance = Transaction::create([
                "wallet_id"=>$wallet->id,
                "currency"=>$currency,
                "debit"=>$debit,
                "credit"=>0,
                "reference"=>$reference,
                "status"=>"pending"
            ]);
            return $instance;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function approveTransaction($transaction_id)
    {
        try {
            $instance = Transaction::findOrFail($transaction_id);
            $instance->update([
                "status"=>"approved"
            ]);
            return $instance;
        } catch (Exception $e) {
            throw $e;
        }
    }
}