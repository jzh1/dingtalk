<?php

namespace Jzh1\DingTalk;

use GuzzleHttp\Client;
use Jzh1\DingTalk\Exceptions\HttpException;

class SendMessage
{
    // 请求地址
    protected $url;
    // 通知电话字符串
    protected $telString;
    // 通知电话
    protected $telArray;
    // 环境变量标示
    protected $environmental;

    protected $guzzleOptions = [];

    public function __construct(string $url, string $telString, string $environmental)
    {
        $this->url = $url;
        $this->telString = $telString;
        $this->environmental = $environmental;
        $this->telArray = explode('@', $this->telString);
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    // 发送 Markdown 消息
    public function sendMarkdownMessage($title, $sendMessage)
    {
        // 发送数据组装
        $content = [
            'msgtype' => 'markdown',
            'markdown' => [
                'title' => $title,
                'text' => $sendMessage . "\n" . $this->telString,
            ],
            'at' => [
                'atMobiles' => $this->telArray,
                'isAtAll' => false
            ]

        ];

        $response = $this->getHttpClient()->post($this->url, [
            'query' => $content,
        ])->getBody()->getContents();
    }

    // 发送 text 类型消息
    public function sendTextMessage($sendMessage)
    {
        $content = [
            'msgtype' => 'text',
            'text' => [
                'content' => $sendMessage . $this->telString
            ],
            'at' => [
                'atMobiles' => $this->telArray,
                'isAtAll' => false
            ]
        ];

        try {
            $response = $this->getHttpClient()->post($this->url, [
                'query' => $content,
            ])->getBody()->getContents();

            return $response;
        } catch (\Exception $e) {

            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }

    }
}
