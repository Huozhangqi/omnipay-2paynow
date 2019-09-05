<?php

namespace Omnipay\TwoPayNow\Message\Response;

use Omnipay\TwoPayNow\Message\Response\AbstractResponse;

class PreCreateResponse extends AbstractResponse
{
    public function isRedirect()
    {
        return $this->isSuccessful();
    }

    public function getTradeNo()
    {
        return $this->data['trade_no'];
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

     public function getQrCode()
    {
        return $this->data['qr_code'];
    }

     public function getPicUrl()
    {
        return $this->data['pic_url'];
    }
}