<?php

/*
 * This file is part of the huozhangqi/omnipay-2paynow.
 *
 * (c) HuoZhangqi <h947136@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Omnipay\TwoPayNow\Message\Request;

use Omnipay\TwoPayNow\Message\Response\QueryResponse;

class QueryRequest extends AbstractRequest
{
    public function createResponse($data)
    {
        return new QueryResponse($this, $data);
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
        $this->makeSign($this->isWap() ? 'wap_query' : 'query');

        $this->isWap() ? $this->setTradeNo($this->getMerchantTradeNo()) : $this->getTradeNo();

        $this->validate('merchantId', 'sign', 'tradeNo', 'key');

        $data = http_build_query([
            'function'              => $this->isWap() ? 'wap_query' : 'query',
            'mid'                   => $this->getMerchantId(),
            'timestamp'             => $this->getTimestamp(),
            'sign'                  => $this->getSign(),
            'trade_no'              => $this->getTradeNo(),
        ]);

        return $data;
    }
}
