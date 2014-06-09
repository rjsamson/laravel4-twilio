Twilio SDK Wrapper for Laravel 4
===============


# Installation

This package can be installed via Composer by adding the following to your composer.json file and then running `composer update`:

	"require": {
		"dtisgodsson/twilio": "dev-master"
	}
	
After installing via Composer, you will need to add the following lineto the `providers` array in your `app/config/app.php` file:

  'Dtisgodsson\Twilio\TwilioServiceProvider',
