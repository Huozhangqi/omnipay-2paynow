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
use Omnipay\TwoPayNow\Message\Response\CompleteResponse;

class CompleteRequest extends AbstractRequest
{
    public function getRequestParams()
    {
        return $this->getParameter('request_params');
    }

    public function setRequestParams($requestParams)
    {
        $this->setParameter('request_params', $requestParams);
    }

    public function createResponse($data)
    {
        return new CompleteResponse($this, $data);
    }

    public function sendData($data)
    {
        $data = $this->getData();

        $data['passback_parameters'] = json_decode($data['passback_parameters'], true);

        $realSign = md5($data['function'] . $data['mid'] . $data['timestamp'] . $this->getKey());

        if ($realSign !== $data['sign']) {
            throw new InvalidRequestException('sign check failed');
        }

        return $this->createResponse($data);
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $params = [
            'amount',
            'amount_cny',
            'currency',
            'function',
            'merchant_trade_no',
            'mid',
            'passback_parameters',
            'sign',
            'timestamp',
            'trade_no',
            'trade_status',
        ];

        if (!$this->getRequestParams()) {
            throw new InvalidRequestException('bad request params！');
        }

        foreach ($this->getRequestParams() as $key => $value) {
            $data[$key] = $value;
        }

        array_walk($params, function ($value) use ($data) {
            if (!in_array($value, array_keys($data))) {
                throw new InvalidRequestException('bad request params'. $value);
            }
        });

        return $data;
    }
}
