<h1 align="center"> dingtalk </h1>

<p align="center"> A DingTalk SDK.</p>


## Installing

```shell
$ composer require jzh1/dingtalk -vvv
```

## 申请使用钉钉通知

钉钉开发文档地址：https://ding-doc.dingtalk.com/doc#/serverapi2/qf2nxq
发送的信息内包含关键字

## 使用方法

```shell
require __DIR__ .'/vendor/autoload.php';

use Jzh1\DingTalk\SendMessage;

// 钉钉请求路由
$url = 'https://oapi.dingtalk.com/robot/send?access_token=8bfd991b04f12ec3cfa439858616364d5469684a49ec437a27298a29bc11eba8';
// link链接地址
$messageUrl = 'XXXXX';
// 钉钉群中@的人
$tel = '@13386434116@15949904116';
// 项目环境
$env = '测试环境';
// 发送标题
$title = '订单测试message';
// 发送消息体
$sendMessage = '订单测试message';

$class = new SendMessage($url,$tel,$env);
// 发送 text 格式的消息
$dd1 = $class->sendTextMessage($sendMessage);
// 发送 link 格式的消息
$dd2 = $class->sendLinkMessage($sendMessage,$title,$messageUrl);
// 发送 markdowm 格式的消息
$dd3 = $class->sendMarkdownMessage($sendMessage,$title);

```
## Usage

TODO

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/jzh1/dingtalk/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/jzh1/dingtalk/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
