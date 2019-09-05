<?php

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
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->makeSign('cancel');

        $this->validate('sign', 'key', 'tradeNo', 'merchantId');

        $data =  http_build_query([
            'trade_no'              =>      $this->getTradeNo(),
            'function'              =>      'cancel',
            'sign'                  =>      $this->getSign(),
            'mid'                   =>      $this->getMerchantId(),
            'timestamp'             =>      $this->getTimestamp(),
        ]);

        return $data;
    }
}

