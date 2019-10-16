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
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->makeSign('query');

        $this->validate('merchantId', 'sign', 'tradeNo', 'key');

        $data =  http_build_query([
            'function'              =>      'query',
            'mid'                   =>      $this->getMerchantId(),
            'timestamp'             =>      $this->getTimestamp(),
            'sign'                  =>      $this->getSign(),
            'trade_no'              =>      $this->getTradeNo(),
        ]);

        return $data;
    }
}
