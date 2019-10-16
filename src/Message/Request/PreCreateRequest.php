<?php

/*
 * This file is part of the huozhangqi/omnipay-2paynow.
 *
 * (c) HuoZhangqi <h947136@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Omnipay\TwoPayNow\Message\Request;

use Omnipay\TwoPayNow\Message\Response\PreCreateResponse;

class PreCreateRequest extends AbstractRequest
{
    public function createResponse($data)
    {
        return new PreCreateResponse($this, $data);
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
        $this->makeSign('precreate');

        $this->validate('merchantId', 'sign', 'passBackParameters', 'type', 'subject', 'amount', 'currency', 'notifyUrl', 'timeout');

        $data =  http_build_query([
            'type'                  =>      $this->getType(),
            'function'              =>      'precreate',
            'mid'                   =>      $this->getMerchantId(),
            'timestamp'             =>      $this->getTimestamp(),
            'subject'               =>      $this->getSubject(),
            'amount'                =>      $this->getAmount(),
            'currency'              =>      $this->getCurrency(),
            'notify_url'            =>      $this->getNotifyUrl(),
            'it_b_pay'              =>      $this->getTimeout(),
            'passback_parameters'   =>      $this->getPassBackParameters(),
            'sign'                  =>      $this->getSign(),
        ]);

        return $data;
    }
}
