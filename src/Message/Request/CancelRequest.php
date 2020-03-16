<?php

/*
 * This file is part of the huozhangqi/omnipay-2paynow.
 *
 * (c) HuoZhangqi <h947136@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Omnipay\TwoPayNow\Message\Request;

use Omnipay\TwoPayNow\Message\Response\CancelResponse;

class CancelRequest extends AbstractRequest
{
    public function createResponse($data)
    {
        return new CancelResponse($this, $data);
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     *
     * @return mixed
     */
    public function getData()
    {
        $this->makeSign('cancel');

        $this->validate('sign', 'key', 'tradeNo', 'merchantId');

        $data = http_build_query([
            'trade_no'              => $this->getTradeNo(),
            'function'              => 'cancel',
            'sign'                  => $this->getSign(),
            'mid'                   => $this->getMerchantId(),
            'timestamp'             => $this->getTimestamp(),
        ]);

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return 'https://www.2paynow.com/zhifu/mc_itf';
    }
}
