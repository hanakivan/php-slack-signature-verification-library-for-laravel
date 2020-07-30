PHP implementation of slack's API signature verification for laravel.

## Installation

### With composer
```
$ composer require hanakivan/php-slack-signature-verification-library-for-laravel
```

```json
{
    "require": {
        "hanakivan/php-slack-signature-verification-library-for-laravel": "^2.0"
    }
}
```

## Usage
```php
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use hanakivan\SlackSignatureVerification;
use hanakivan\SlackSignatureVerificationException;

class MyController extends Controller {

    public function myRoute(Request $request) {
    
        //you can have your slack signing key saved in a config file
        $signingSecret = config("slack.signing_secret");
        $verification = new SlackSignatureVerification($signingSecret);

        try {
            $verification->verify($request);
                
            //the signature verified
        } catch(SlackSignatureVerificationException $e) {
            //verification failed
        }   
    }
}
```