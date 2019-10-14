<?php
/**
 * @Author: h9471
 * @Created: 2019/9/4 16:20
 */
namespace Omnipay\TwoPayNow\Tests;

use Omnipay\Omnipay;
use PHPUnit\Framework\TestCase;
use Omnipay\Common\Exception\InvalidRequestException;

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

    /**
     *
     */
    public function testWebPreCreate(): void
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

    /**
     *
     */
    public function testCancel(): void
    {
        $this->gateway->setPlatform('web');
        $this->gateway->setKey('zG93Cv85BCCp2h'); //Random
        $this->gateway->setMerchantId('4002563369'); //Random
        $this->gateway->setTradeNo('A19101413442297969'); //Random
        $response = $this->gateway->cancel()->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertEquals(403, $response->getCode());
        $this->assertSame('mid not exist', $response->getErrorInfo());
    }

    /**
     * @param array $params
     * @dataProvider completeProvider
     */
    public function testCompleteWithBadRequest($params): void
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage('sign check failed');

        $this->gateway->setPlatform('web');
        $this->gateway->setKey('zG93Cv85BBCp2h'); //Random
        $this->gateway->setMerchantId('4252563369'); //Random

        $this->gateway->complete(
            ['request_params' => $params]
        )->send();
    }

    /**
     * @param array $params
     * @dataProvider completeProvider
     */
    public function testComplete($params): void
    {
        $this->gateway->setPlatform('web');
        $this->gateway->setKey('zG93Cv85BCCp2h'); //Random
        $this->gateway->setMerchantId('4002563369'); //Random

        $response = $this->gateway->complete(
            ['request_params' => $params]
        )->send();

        $this->assertEquals($response->isPaid(), true);
        $this->assertEquals($response->isSuccessful(), true);
        $this->assertEquals($response->getAmount(), 0.01);
    }

    /**
     * @return array
     */
    public function completeProvider(): array
    {
        parse_str('sign=4f83e30f527ff4ed0fc9c03185f43f97&timestamp=1571034662245&trade_no=A19101413542297869&merchant_trade_no=&amount_cny=0.08&function=precreate&currency=EUR&trade_status=TRADE_SUCCESS&mid=4002563369&passback_parameters={"serial_number":"16223658963","vip_id":904425,"is_wap":0}&amount=0.01', $data);

        return [
            [$data]
        ];
    }
}

