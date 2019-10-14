<?php

namespace Omnipay\TwoPayNow\Message\Request;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

abstract class AbstractRequest extends CommonAbstractRequest
{

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    /**
     * @param int $value
     * @return AbstractRequest
     */
    public function setMerchantId(int $value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function setType(int $value)
    {
        return $this->setParameter('type', $value);
    }

    public function getType()
    {
        return $this->getParameter('type');
    }

    public function setSubject(string $value)
    {
        return $this->setParameter('subject', $value);
    }

    public function getSubject()
    {
        return $this->getParameter('subject');
    }

    public function getPassBackParameters()
    {
        return $this->getParameter('passBackParameters');
    }

    public function setPassBackParameters(string $value)
    {
        return $this->setParameter('passBackParameters', $value);
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

    public function getUrl()
    {
        return $this->getParameter('url');
    }

    public function setUrl(string $value)
    {
        return $this->setParameter('url', $value);
    }

    public function getTimestamp()
    {
        return $this->getParameter('timestamp');
    }

    public function setTimestamp(int $value)
    {
        return $this->setParameter('timestamp', $value);
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data The data to send
     * @return ResponseInterface
     * @throws InvalidRequestException
     */
    public function sendData($data)
    {
        $response = $this->httpClient->request(
            'GET',
            $this->getEndpoint() . '?' . $this->getData()
        );

        return $this->createResponse(json_decode($response->getBody()->getContents(), true));
    }

    public function setSign($value)
    {
        return $this->setParameter('sign', $value);
    }

    public function getSign()
    {
        return $this->getParameter('sign');
    }

    public function getTimeout()
    {
        return $this->getParameter('timeout');
    }

    public function setTimeout($value)
    {
        return $this->setParameter('timeout', $value);
    }

    public function setTradeNo($value)
    {
        return $this->setParameter('tradeNo', $value);
    }

    public function getTradeNo()
    {
        return $this->getParameter('tradeNo');
    }

    protected function makeSign($function)
    {
        return $this->setSign(md5( $function . $this->getMerchantId() . $this->getTimestamp() . $this->getKey()));
    }

    public function getPlatform()
    {
        return $this->getParameter('platform');
    }

    public function setPlatform($value)
    {
        return $this->setParameter('platform', $value);
    }

    public function setMerchantTradeNo($value)
    {
        return $this->setParameter('merchantTradeNo', $value);
    }

    public function getMerchantTradeNo()
    {
        return $this->getParameter('merchantTradeNo');
    }

    /**
     * @return string
     * @throws InvalidRequestException
     */
    public function getEndpoint()
    {
        $this->validate('platform');

        //wap端, 微信和支付宝
        if ($this->getPlatform() === 'wap' && $this->getType() === 1) {
            //weChat
            return 'http://www.2paynow.com/wap/WxpayAPI/jsapi.php';
        } else {
            //Web
            return 'https://www.2paynow.com/zhifu/mc_itf';
        }

    }

    abstract public function createResponse($data);
}
