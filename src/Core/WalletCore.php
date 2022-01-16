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

    public function withdrawRequest($user_id,$currency,$credit)
    {
        try {
            $wallet = Wallet::findOrFail($user_id);
            $instance = Transaction::create([
                "wallet_id"=>$wallet->id,
                "currency"=>$currency,
                "debit"=>0,
                "credit"=>$credit,
                "reference"=>"Withdraw request",
                "status"=>"pending"
            ]);
            return $instance;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function transfer($user_id,$wallet_id,$currency,$amount,$reference)
    {
        try {
            $instance = Wallet::findOrFail($user_id);
            $credit = Transaction::create([
                "wallet_id"=>$instance->id,
                "currency"=>$currency,
                "debit"=>0,
                "credit"=>$amount,
                "reference"=>$reference,
                "status"=>"approved"
            ]);
            $debit = Transaction::create([
                "wallet_id"=>$wallet_id,
                "currency"=>$currency,
                "debit"=>$amount,
                "credit"=>0,
                "reference"=>$reference,
                "status"=>"pending"
            ]);
            
            return $debit;
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

    public function transactionHistory($user_id)
    {
        try {
            $wallet = Wallet::findOrFail($user_id);
            $instances = Transaction::where("wallet_id",$wallet->id)->get();
            $wallet["transaction_history"] = $instances;
            return $wallet;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getTransaction($transaction_id)
    {
        try {
            $instance = Transaction::findOrFail($transaction_id);
            return $instance;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function totalBalance()
    {
        try {
            $instances = Transaction::all();
            if(count($instances)>0){
                $debit = 0;
                $credit = 0;
                foreach ($instances as $instance) {
                    $debit = $debit + $instance["debit"];
                    $credit = $credit + $instance["credit"];
                }
            } else {
                $debit = 0;
                $credit = 0;
            }
            return ["debit"=>$debit,"credit"=>$credit];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function totalWalletBalance($user_id)
    {
        try {
            $wallet = Wallet::findOrFail($user_id);
            $instances = Transaction::where("wallet_id",$wallet->id)->get();
            if(count($instances)>0){
                $debit = 0;
                $credit = 0;
                foreach ($instances as $instance) {
                    $debit = $debit + $instance["debit"];
                    $credit = $credit + $instance["credit"];
                }
            } else {
                $debit = 0;
                $credit = 0;
            }
            return ["debit"=>$debit,"credit"=>$credit];
        } catch (Exception $e) {
            throw $e;
        }
    }
}