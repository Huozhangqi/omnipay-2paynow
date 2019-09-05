<?php
/**
 * @Author: h9471
 * @Created: 2019/9/4 16:20
 */
namespace Omnipay\TwoPayNow\Tests;

use Omnipay\Omnipay;
use PHPUnit\Framework\TestCase;

class TwoPayNowTest extends TestCase
{
    /**
     * @var \Omnipay\TwoPayNow\Gateway $gateway
     */
    protected $gateway;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = Omnipay::create('TwoPayNow');

    }

    public function testWebPreCreate()
    {
        $this->gateway->setPlatform('web');
        $this->gateway->setKey('zG93Cv85BCCp2h'); //Random
        $this->gateway->setMerchantId('4002563369'); //Random
        $this->gateway->setType(0);
        $this->gateway->setSubject('test_subject');
        $this->gateway->setAmount(8.99);
        $this->gateway->setPassBackParameters(json_encode(['test' => 'test']));
        $this->gateway->setCurrency('EUR');
        $this->gateway->setNotifyUrl('https://example.com/notify');

        $response = $this->gateway->preCreate()->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals(403, $response->getCode());
        $this->assertSame('mid not exist', $response->getErrorInfo());
    }
}

