
我们选择利用 Lumen 项目试试，安装插件

![](http://ow20g4tgj.bkt.clouddn.com/2018-02-21-15191962200930.jpg)

在 bootstrap/app.php 引入注册插件 ServiceProvider：

```
$app->register(Fanly\Msgrobot\FanlyMsgrobotServiceProvider::class);
```

我们写一个 test，试试效果，先创建独立跳转 ActionCard 类型消息，然后给已创建的机器人对应的「access_token」钉钉群推送此消息

```php
// text
        $text = new Text('hello fanly/msgrobot package');
        Msgrobot::accessToken('cb36a3c3cab1242b94516d026a02d909f1611ec048d89c93cb3e1132f08b4e')
            ->message($text)
            ->send();

        // link
        $link = new Link([
            'text' => 'link text',
            'title' => 'link title',
            'picUrl' => 'http://f.hiphotos.baidu.com/image/pic/item/503d269759ee3d6db032f61b48166d224e4ade6e.jpg',
            'messageUrl' => 'http://f.hiphotos.baidu.com/image/pic/item/503d269759ee3d6db032f61b48166d224e4ade6e.jpg'
        ]);
        Msgrobot::accessToken('cb36a3c3cab1242b94516d026a02d909f1611ec048d89c93cb3e1132f08b4e')
            ->message($link)
            ->send();


        // markdown
        $md = new Markdown([
            'title' => 'link text',
            'text' => "#### 杭州天气 @156xxxx8827\n > 9度，西北风1级，空气良89，相对温度73%\n\n> ![screenshot](http://image.jpg)\n> ###### 10点20分发布 [天气](http://www.thinkpage.cn/) \n"
        ]);

        Msgrobot::accessToken('cb36a3c3cab1242b94516d026a02d909f1611ec048d89c93cb3e1132f08b4e')
            ->message($md)
            ->send();

        // Single ActionCard
        $sac = new SingleActionCard([
            'title' => 'link title',
            'text' => '![screenshot](@lADOpwk3K80C0M0FoA) 
 ### 乔布斯 20 年前想打造的苹果咖啡厅 
 Apple Store 的设计正从原来满满的科技感走向生活化，而其生活化的走向其实可以追溯到 20 年前苹果一个建立咖啡馆的计划',
            'hideAvatar' => 0,
            'btnOrientation' => 0,
            'singleTitle' => '阅读原文',
            'singleURL' => 'http://f.hiphotos.baidu.com/image/pic/item/503d269759ee3d6db032f61b48166d224e4ade6e.jpg'
        ]);

        Msgrobot::accessToken('cb36a3c3cab1242b94516d026a02d909f1611ec048d89c93cb3e1132f08b4e')
            ->message($sac)
            ->send();

        // More ActionCard
        $btns = [
            new ActionCardBtn([
                'title' => '内容不错',
                'actionURL' => 'http://f.hiphotos.baidu.com/image/pic/item/503d269759ee3d6db032f61b48166d224e4ade6e.jpg'
            ]),
            new ActionCardBtn([
                'title' => '不感兴趣',
                'actionURL' => 'http://f.hiphotos.baidu.com/image/pic/item/503d269759ee3d6db032f61b48166d224e4ade6e.jpg'
            ])
        ];

        $mac = new MoreActionCard([
            'title' => 'link title',
            'text' => '![screenshot](@lADOpwk3K80C0M0FoA) 
 ### 乔布斯 20 年前想打造的苹果咖啡厅 
 Apple Store 的设计正从原来满满的科技感走向生活化，而其生活化的走向其实可以追溯到 20 年前苹果一个建立咖啡馆的计划',
            'hideAvatar' => 0,
            'btnOrientation' => 0,
            'btns' => $btns
        ]);

        Msgrobot::accessToken('cb36a3c3cab1242b94516d026a02d909f1611ec048d89c93cb3e1132f08b4e')
            ->message($mac)
            ->send();

        // FeedCard
        $links = [
            new FeedCardLink([
                'title' => "时代的火车向前开",
                "messageURL" => "https://mp.weixin.qq.com/s?__biz=MzA4NjMwMTA2Ng==&mid=2650316842&idx=1&sn=60da3ea2b29f1dcc43a7c8e4a7c97a16&scene=2&srcid=09189AnRJEdIiWVaKltFzNTw&from=timeline&isappinstalled=0&key=&ascene=2&uin=&devicetype=android-23&version=26031933&nettype=WIFI",
                "picURL" => "http://f.hiphotos.baidu.com/image/pic/item/503d269759ee3d6db032f61b48166d224e4ade6e.jpg"
            ]),
            new FeedCardLink([
                'title' => "时代的火车向前开",
                "messageURL" => "https://mp.weixin.qq.com/s?__biz=MzA4NjMwMTA2Ng==&mid=2650316842&idx=1&sn=60da3ea2b29f1dcc43a7c8e4a7c97a16&scene=2&srcid=09189AnRJEdIiWVaKltFzNTw&from=timeline&isappinstalled=0&key=&ascene=2&uin=&devicetype=android-23&version=26031933&nettype=WIFI",
                "picURL" => "http://f.hiphotos.baidu.com/image/pic/item/503d269759ee3d6db032f61b48166d224e4ade6e.jpg"
            ])
        ];

        $fc = new FeedCard($links);

        Msgrobot::accessToken('cb36a3c3cab1242b94516d026a02d909f1611ec048d89c93cb3e1132f08b4e')
            ->message($fc)
            ->send();
```

![](http://ow20g4tgj.bkt.clouddn.com/2018-02-21-15191972792790.jpg)

![](http://ow20g4tgj.bkt.clouddn.com/2018-02-21-15191973189646.jpg)

![](http://ow20g4tgj.bkt.clouddn.com/2018-02-21-15191973482711.jpg)

![](http://ow20g4tgj.bkt.clouddn.com/2018-02-21-15191973751098.jpg)