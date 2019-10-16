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

class CompleteResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return $this->isPaid();
    }

    public function isPaid()
    {
        return $this->data['trade_status'] === 'TRADE_SUCCESS';
    }

    public function getTradeNo()
    {
        return $this->data['trade_no'];
    }

    public function getSign()
    {
        return $this->data['sign'];
    }

    /**
     * @return string
     */
    public function getFunction()
    {
        return $this->data['function'];
    }

    /**
     * @return string
     */
    public function getTimestamp()
    {
        return $this->data['timestamp'];
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return (float) $this->data['amount'];
    }

    /**
     * @return float
     */
    public function getAmountCny()
    {
        return (float) $this->data['amount_cny'];
    }

    /**
     * @return array
     */
    public function getPassback()
    {
        return $this->data['passback_parameters'];
    }
}
