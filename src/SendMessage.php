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

    /**
     * 发送 Markdown 类型的消息
     *
     * @param $title
     * @param $sendMessage
     * @param string $format
     * @param bool $isAtAll
     * @return mixed|string
     * @throws HttpException
     */
    public function sendMarkdownMessage($sendMessage,$title, $format = 'json', $isAtAll = false)
    {
        // 发送数据组装
        $content = [
            'msgtype' => 'markdown',
            'markdown' => [
                'title' => $title,
                'text' => $sendMessage . $this->telString,
            ],
            'at' => [
                'atMobiles' => $this->telArray,
                'isAtAll' => $isAtAll
            ]
        ];

        try {
            $response = $this->getHttpClient()->post($this->url, [
                'json' => $content,
            ])->getBody()->getContents();

            return 'json' === $format ? json_decode($response, true) : $response;
        } catch (\Exception $e) {

            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 发送 text 类型消息
     *
     * @param $sendMessage  发送消息体
     * @param string $format 返回数据整理 json（default） or array
     * @param bool $isAtAll 是否@所有人 true（default） 是 false 否
     * @return mixed|string
     * @throws HttpException
     */
    public function sendTextMessage($sendMessage, $format = 'json', $isAtAll = false)
    {
        $content = [
            'msgtype' => 'text',
            'text' => [
                'content' => $sendMessage . $this->telString
            ],
            'at' => [
                'atMobiles' => $this->telArray,
                'isAtAll' => $isAtAll
            ]
        ];

        try {
            $response = $this->getHttpClient()->post($this->url, [
                'json' => $content
            ])->getBody()->getContents();

            return 'json' === $format ? json_decode($response, true) : $response;
        } catch (\Exception $e) {

            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 链接类型
     *
     * @param $title 标题
     * @param $sendMessage 发送信息
     * @param $messageUrl 发送链接url
     * @param string $picUrl 图片url
     * @param string $format
     * @return mixed|string
     * @throws HttpException
     */
    public function sendLinkMessage($sendMessage, $title, $messageUrl, $picUrl = '', $format = 'json')
    {
        $content = [
            'msgtype' => 'link',
            'link' => [
                'title' => $title,
                'text' => $sendMessage,
                'picUrl' => $picUrl,
                'messageUrl' => $messageUrl,
            ]
        ];

        try {
            $response = $this->getHttpClient()->post($this->url, [
                'json' => $content
            ])->getBody()->getContents();

            return 'json' === $format ? json_decode($response, true) : $response;
        } catch (\Exception $e) {

            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
