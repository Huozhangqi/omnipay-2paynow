<?php

/*
 * This file is part of the huozhangqi/omnipay-2paynow.
 *
 * (c) HuoZhangqi <h947136@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Omnipay\TwoPayNow\Message\Response;

class WapPreCreateResponse extends AbstractResponse
{
    public function isRedirect()
    {
        return $this->isSuccessful();
    }

    public function isSuccessful()
    {
        return $this->data['url'] !== null;
    }

    public function getRedirectUrl()
    {
        return $this->data['url'];
    }
}
