<?php

/*
 * This file is part of the huozhangqi/omnipay-2paynow.
 *
 * (c) HuoZhangqi <h947136@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Omnipay\TwoPayNow\Message\Response;

use Omnipay\TwoPayNow\Message\Response\AbstractResponse;

class QueryResponse extends AbstractResponse
{
    public function isRefunded()
    {
        return $this->getRefundAmount() > 0;
    }

    public function isSuccessful()
    {
        return $this->getTransStatus() === 'TRADE_SUCCESS';
    }

    public function isFailed()
    {
        return $this->getTransStatus() === 'TRADE_FAILED';
    }

    public function isClosed()
    {
        return $this->getTransStatus() === 'TRADE_CLOSED';
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

    public function getTransStatus()
    {
        return $this->data['trans_status'];
    }

    public function getTransTime()
    {
        return $this->data['trans_time'];
    }

    public function getForexRate()
    {
        return $this->data['forex_rate'];
    }

    public function getRefundAmount()
    {
        return $this->data['refund_amount'] ?? 0;
    }

    public function getCurrency()
    {
        return $this->data['currency'];
    }
}
