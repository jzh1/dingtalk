<?php
namespace Jzh1\DingTalk\Tests;

use Jzh1\DingTalk\SendMessage;
use PHPUnit\Framework\TestCase;

class SendMessageTest extends TestCase
{
    public function testSendTextMessage()
    {
        $url = 'https://oapi.dingtalk.com/robot/send?access_token=8bfd991b04f12ec3cfa439858616364d5469684a49ec437a27298a29bc11eba8';
        $tel = '@13386434116@15949904116';
        $env = '测试环境';
        $sendMessage = '订单测试message';
        $class = new SendMessage($url,$tel,$env);
        $dd = $class->sendLinkMessage($sendMessage,$sendMessage,$sendMessage);

        print_r($dd);
    }
}
