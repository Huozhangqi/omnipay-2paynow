<?php

/*
 * This file is part of the huozhangqi/omnipay-2paynow.
 *
 * (c) HuoZhangqi <h947136@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Omnipay\TwoPayNow\Message\Request;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\TwoPayNow\Message\Response\WapPreCreateResponse;

class WapPreCreateRequest extends AbstractRequest
{
    public function createResponse($data)
    {
        return new WapPreCreateResponse($this, $data);
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
        $this->makeSign('wap_precreate');

        $this->validate(
            'merchantId',
            'sign',
            'passBackParameters',
            'type',
            'subject',
            'amount',
            'currency',
            'notifyUrl',
            'timeout',
            'returnUrl',
            'merchantTradeNo'
        );

        $params = [
            'type'                  => $this->getType(),
            'function'              => 'wap_precreate',
            'mid'                   => $this->getMerchantId(),
            'timestamp'             => $this->getTimestamp(),
            'subject'               => $this->getSubject(),
            'amount'                => $this->getAmount(),
            'currency'              => $this->getCurrency(),
            'notify_url'            => $this->getNotifyUrl(),
            'it_b_pay'              => $this->getTimeout(),
            'passback_parameters'   => $this->getPassBackParameters(),
            'sign'                  => $this->getSign(),
            'merchant_trade_no'     => $this->GetMerchantTradeNo(),
            'return_url'            => $this->getReturnUrl(),
        ];

        if ($this->getType() === 1) {
            unset($params['it_b_pay']);
        }

        $data = http_build_query($params);

        return $data;
    }

    /**
     * Send the request with specified data.
     *
     * @param mixed $data The data to send
     *
     * @throws InvalidRequestException
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $data = [
            'url' => $this->getEndpoint().'?'.$this->getData(),
        ];

        return $this->createResponse($data);
    }
}
