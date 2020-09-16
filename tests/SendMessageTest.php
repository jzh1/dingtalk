<?php

/*
 * This file is part of the jzh/dingtalk.
 *
 * (c) 江兆辉 <949363409@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

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
        $class = new SendMessage($url, $tel, $env);
        $dd = $class->sendTextMessage($sendMessage);
        $dd2 = $class->sendLinkMessage($sendMessage, $sendMessage, $sendMessage);
        $dd3 = $class->sendMarkdownMessage($sendMessage, $sendMessage);

        print_r($dd);
        print_r($dd2);
        print_r($dd3);
    }
}
