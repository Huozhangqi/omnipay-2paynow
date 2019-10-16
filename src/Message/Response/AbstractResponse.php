<?php

/*
 * This file is part of the huozhangqi/omnipay-2paynow.
 *
 * (c) HuoZhangqi <h947136@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace  Omnipay\TwoPayNow\Message\Response;

use Omnipay\Common\Message\AbstractResponse as CommonAbstractRequest;

class AbstractResponse extends CommonAbstractRequest
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->data['status'] === 200 && isset($this->data['function']);
    }


    /**
     * Get response data
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get returned code
     * @return int
     */
    public function getCode()
    {
        return $this->data['status'];
    }


    /**
     * Get error code when status in error
     * @return int|null
     */
    public function getErrorCode()
    {
        return $this->data['status'] !== 200 ? $this->data['status'] : null;
    }

    /**
     * Get error info when status in error
     * @return string|null
     */
    public function getErrorInfo()
    {
        return $this->data['status'] !== 200 ? $this->data['error_info'] : null;
    }
}
