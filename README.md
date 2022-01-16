# cws
#### A centralised wallet system to include in your php laravel projects
### Installation
Install with composer: `composer require fshangala/cws`
## Laravel
Laravel will automatically register the service upon installation.
Run the command `php artisan migrate` migrations should run.
If that doesnt happen for you, you can follow the steps for lumen. They work for laravel as well.
## Lumen
After installation, register the service provider in your `bootstrap/app.php` file.
```
//$app->register(App\Providers\AppServiceProvider::class);
//$app->register(App\Providers\AuthServiceProvider::class);
//$app->register(App\Providers\EventServiceProvider::class);
```
after the lines above in your `bootstrap/app.php file` add the following
`$app->register(Fshangala\Cws\CwsServiceProvider::class);`
Then run the command `php artisan migrate` migrations should run.
You're good to go!

## Usage
Create wallet
```
<?php

namespace App\Http\Controllers;
use Fshangala\Cws\Core\WalletCore;

class ExampleController extends Controller
{
  public function exampleMethod()
  {
    $wallet = new WalletCore();
    $user_id = 1;
    $response = createWallet($user_id);
    
    return response($response);
  }
}
```

Deposit request
```
<?php

namespace App\Http\Controllers;
use Fshangala\Cws\Core\WalletCore;

class ExampleController extends Controller
{
  public function exampleMethod()
  {
    $wallet = new WalletCore();
    $user_id = 1;
    $currency = "USD";
    $debit = 200;
    $reference = "Deposit request";
    $response = depositRequest($user_id,$currency,$debit,$reference);
    
    return response($response);
  }
}
```


Withdraw request
```
<?php

namespace App\Http\Controllers;
use Fshangala\Cws\Core\WalletCore;

class ExampleController extends Controller
{
  public function exampleMethod()
  {
    $wallet = new WalletCore();
    $user_id = 1;
    $currency = "USD";
    $credit = 200;
    $response = withdrawRequest($user_id,$currency,$credit);
    
    return response($response);
  }
}
```


transfer request
```
<?php

namespace App\Http\Controllers;
use Fshangala\Cws\Core\WalletCore;

class ExampleController extends Controller
{
  public function exampleMethod()
  {
    $wallet = new WalletCore();
    $user_id = 1;
    $wallet_id = 2;
    $currency = "USD";
    $amount = 200;
    $reference = "Transfer funds to account 2";
    $response = transfer($user_id,$wallet_id,$currency,$amount,$reference);
    
    return response($response);
  }
}
```

approve transaction
```
<?php

namespace App\Http\Controllers;
use Fshangala\Cws\Core\WalletCore;

class ExampleController extends Controller
{
  public function exampleMethod()
  {
    $wallet = new WalletCore();
    $transaction_id = 1;
    $response =  approveTransaction($transaction_id);
    
    return response($response);
  }
}
```

transaction history
```
<?php

namespace App\Http\Controllers;
use Fshangala\Cws\Core\WalletCore;

class ExampleController extends Controller
{
  public function exampleMethod()
  {
    $wallet = new WalletCore();
    $user_id = 1;
    $response = transactionHistory($user_id);
    
    return response($response);
  }
}
```

get transaction
```
<?php

namespace App\Http\Controllers;
use Fshangala\Cws\Core\WalletCore;

class ExampleController extends Controller
{
  public function exampleMethod()
  {
    $wallet = new WalletCore();
    $transaction_id = 1;
    $response =  getTransaction($transaction_id);
    
    return response($response);
  }
}
```

get total balance
```
<?php

namespace App\Http\Controllers;
use Fshangala\Cws\Core\WalletCore;

class ExampleController extends Controller
{
  public function exampleMethod()
  {
    $wallet = new WalletCore();
    $response = totalBalance();
    
    return response($response);
  }
}
```

get total wallet balance
```
<?php

namespace App\Http\Controllers;
use Fshangala\Cws\Core\WalletCore;

class ExampleController extends Controller
{
  public function exampleMethod()
  {
    $wallet = new WalletCore();
    $user_id = 1;
    $response = totalWalletBalance($user_id);
    
    return response($response);
  }
}
```
