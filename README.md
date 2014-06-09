Twilio SDK Wrapper for Laravel 4
===============


# Installation

This package can be installed via Composer by adding the following to your composer.json file and then running `composer update`:

	"require": {
		"dtisgodsson/twilio": "dev-master"
	}
	
After installing via Composer, you will need to add the following lineto the `providers` array in your `app/config/app.php` file:

  'Dtisgodsson\Twilio\TwilioServiceProvider'
  
# Configuration
  
To configure, publish the packages configuration files using the following command from the root of your project:

	php artisan config:publish dtisgodsson/twilio
	
You will now have the Twilio configuration file in your `app/config/packages/dtisgodsson/twilio` folder. This config file contains three options:

* sid - obtained from Twilio
* auth_token - obtained from Twilio
* defaut_from_number - a fallback number that texts/voice calls will be sent from should you not specify one

# Usage

After installing and configuring this package, using it is easy!

## Sending Text Messages

### Simplest example

	Twilio::to('232323')->message('Fancy a drink?')
	
### Overriding the from number

	Twilio::from('121212')->to('232323')->message('Hows it going?')
	
## Exceptions

The following exceptions may be thrown whilst using the package:

### Dtisgodsson\Twilio\Exceptions\TwilioException

This is the default exception and can be thrown in situations such as, trying to sending a message without specifying a number to send it to.

### Dtisgodsson\Twilio\Exceptions\TwilioAPIException

This exception is thrown when an error is thrown by the Twilio API. It simply overrides the exception provided with the Twilio SDK. The following methods can be called on the exception for more information:

* getMessage()
* getCode()
* getInformation()
* getStatus()
