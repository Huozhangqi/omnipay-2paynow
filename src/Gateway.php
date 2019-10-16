<?php

/*
 * This file is part of the huozhangqi/omnipay-2paynow.
 *
 * (c) HuoZhangqi <h947136@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Omnipay\TwoPayNow;

use Omnipay\Common\AbstractGateway;
use Omnipay\TwoPayNow\Message\Request\CancelRequest;
use Omnipay\TwoPayNow\Message\Request\CompleteRequest;
use Omnipay\TwoPayNow\Message\Request\PreCreateRequest;
use Omnipay\TwoPayNow\Message\Request\QueryRequest;

class Gateway extends AbstractGateway
{

    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     * @return string
     */
    public function getName()
    {
        return 'TwoPayNow';
    }

    public function getDefaultParameters()
    {
        return [
            'timestamp' => intval(microtime(true)*1000),
            'timeout'   => '30m',
            'type'  => [0, 1],
            'platform' => ['web', 'wap']
        ];
    }

    public function setPlatform($value)
    {
        return $this->setParameter('platform', $value);
    }

    public function getPlatform()
    {
        return $this->getParameter('platform');
    }

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    /**
     * @param int $value
     * @return Gateway
     */
    public function setMerchantId(int $value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
    }

    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }

    public function setType(int $value)
    {
        return $this->setParameter('type', $value);
    }

    public function getType()
    {
        return $this->getParameter('type');
    }

    public function getTimeout()
    {
        return $this->getParameter('timeout');
    }

    public function setTimeout($value)
    {
        return $this->setParameter('timeout', $value);
    }

    public function setSubject(string $value)
    {
        return $this->setParameter('subject', $value);
    }

    public function getSubject()
    {
        return $this->getParameter('subject');
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount(float $value)
    {
        return $this->setParameter('amount', $value);
    }


    public function getPassBackParameters()
    {
        return $this->getParameter('passBackParameters');
    }

    public function setPassBackParameters(string $value)
    {
        return $this->setParameter('passBackParameters', $value);
    }

    public function getNotifyUrl()
    {
        return $this->getParameter('notifyUrl');
    }

    public function setNotifyUrl(string $value)
    {
        return $this->setParameter('notifyUrl', $value);
    }

    public function getFunction()
    {
        return $this->getParameter('function');
    }

    public function setFunction(string $value)
    {
        return $this->setParameter('function', $value);
    }

    public function getKey()
    {
        return $this->getParameter('key');
    }

    public function setKey(string $value)
    {
        return $this->setParameter('key', $value);
    }

    public function getTimestamp()
    {
        return $this->getParameter('timestamp');
    }

    public function setTimestamp(int $value)
    {
        return $this->setParameter('timestamp', $value);
    }

    public function setTradeNo($value)
    {
        return $this->setParameter('tradeNo', $value);
    }

    public function getTradeNo()
    {
        return $this->getParameter('tradeNo');
    }

    public function setMerchantTradeNo($value)
    {
        return $this->setParameter('merchantTradeNo', $value);
    }

    public function getMerchantTradeNo()
    {
        return $this->getParameter('merchantTradeNo');
    }

    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }

    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    /**
     * Create Payment Request
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function preCreate(array $parameters = [])
    {
        return $this->createRequest(PreCreateRequest::class, $parameters);
    }

    ///*
    // * Create Payment Request From Wap Devices
    // * @param array $parameters
    // * @return \Omnipay\Common\Message\AbstractRequest
    // */
    //public function wapPreCreate(array $parameters = [])
    //{
    //
    //}

    /**
     * Cancel Order
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function cancel(array $parameters = [])
    {
        return $this->createRequest(CancelRequest::class, $parameters);
    }

    /**
     * Query Payment Status
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function query(array $parameters = [])
    {
        return $this->createRequest(QueryRequest::class, $parameters);
    }

    /**
     * Complete Payment Callback
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function complete(array $parameters = [])
    {
        return $this->createRequest(CompleteRequest::class, $parameters);
    }
}
