<?php namespace Dtisgodsson\Twilio;

use Services_Twilio;
use Services_Twilio_RestException;
use Dtisgodsson\Twilio\Exceptions\TwilioException;
use Dtisgodsson\Twilio\Exceptions\TwilioAPIException;

class Twilio
{
    protected $fromNumber;
    protected $toNumber;

    private $defaultFromNumber;

    public function __construct($sid, $authToken, $defaultFromNumber)
    {
        $this->defaultFromNumber = $defaultFromNumber;

        $this->twilioClient = new Services_Twilio($sid, $authToken);
    }

    public function from($number)
    {
        $this->fromNumber = $number;

        return $this;
    }

    public function to($number)
    {
        $this->toNumber = $number;

        return $this;
    }

    public function message($message, $params = [])
    {
        if(!$this->toNumber)
        {
            throw new TwilioException("Please provide a number to send this message to.");
        }

        try
        {
            $this->twilioClient->account->sms_messages->create($this->getFromNumber(), $this->toNumber, $message, $params);
        }
        catch(Services_Twilio_RestException $exception)
        {
            throw new TwilioAPIException($exception->getStatus(), $exception->getMessage(), $exception->getCode(), $exception->getInfo());
        }
    }

    public function call($url, $options=array())
    {
        if(!$this->toNumber)
        {
            throw new TwilioException("Please provide a number to call.");
        }

        try
        {
            return $this->twilioClient->account->calls->create($this->getFromNumber(), $this->toNumber, $url, $options);
        }
        catch(Services_Twilio_RestException $exception)
        {
            throw new TwilioAPIException($exception->getStatus(), $exception->getMessage(), $exception->getCode(), $exception->getInfo());
        }
    }

    private function getFromNumber()
    {
        return $this->fromNumber ? $this->fromNumber : $this->defaultFromNumber;
    }
}