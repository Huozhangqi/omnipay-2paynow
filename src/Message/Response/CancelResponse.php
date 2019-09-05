<?php

namespace Omnipay\TwoPayNow\Message\Response;

use Omnipay\TwoPayNow\Message\Response\AbstractResponse;

class CancelResponse extends AbstractResponse
{
    public function isCancelled()
    {
        return $this->isSuccessful() && $this->data['function'] === 'cancel';
    }

    public function getSign()
    {
        return $this->data['sign'];
    }

     public function getFunction()
    {
        return $this->data['function'];
    }

     public function getTimestamp()
    {
        return $this->data['timestamp'];
    }
}