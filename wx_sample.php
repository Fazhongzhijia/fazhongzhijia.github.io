<?php

define("ToKEN", "weixin");   //定义一个常量

$wechatObj = new wechatCallbackapiTest();

//标准模版
if (isset($_GET['echostr'])) {
    //echo $_GET['echostr'];
    $wechatObj->valid();
} else {
    //$ACCESS_TOKEN = $wechatObj->get_access_token();
    //$wechatObj->createMenu($ACCESS_TOKEN);
    $wechatObj->responseMsg();
}

class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;   //输出一个消息并且退出当前脚本
        }
    }

    //验证微信签名
    private function checkSignature()
    {
        $signature = $_GET["signature"];    //微信加密签名
        $timestamp = $_GET["timestamp"];    //时间戳
        $nonce = $_GET["nonce"];    //随机数

        $token = TOKEN; //微信token
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);  //对数组进行排序
        $tmpStr = implode($tmpArr); //将一个一维数组的值转化为字符串
        $tmpStr = sha1($tmpStr);    //计算字符串的 sha1 散列值

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
    

    //发送信息
    public function responseMsg()
    {
        /**
         *  基本上$GLOBALS['HTTP_RAW_POST_DATA'] 和 $_POST是一样的。但是如果post过来的数据不是PHP能够识别的，
         * 你可以用 $GLOBALS['HTTP_RAW_POST_DATA']来接收，比如 text/xml 或者 soap 等等
         */
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        if (!empty($postStr)) { //检查一个变量是否为空
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName; //发送方微信号
            $toUsername = $postObj->ToUserName; //  开发者微信公众帐号
            $CreateTime = intval($postObj->CreateTime); //消息的创建时间,并且把这个时间转换成整数。
            $formTime = date("Y-m-d H:i:s", $CreateTime);
            $MsgId = $postObj->MsgId;   //消息内容的随机ID
            $MsgType = $postObj->MsgType;   //消息类型

            $Event = $postObj->Event;

            //返回给微信服务器的模版
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
            $time = time();
            
            if($MsgType == 'text')
            {
                $contentStr = "我们会尽快回复您！\n我们的系统正在不断更新中，将为您提供更多精彩内容，敬请期待^_^";
                $msgType = "text";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
                exit;
            }
            
            if($MsgType == 'event')
            {
                if($Event == 'subscribe')
                {
                    $contentStr = "欢迎您的订阅！我们的系统正在不断更新中，将为您提供更多精彩内容，敬请期待^_^";
                    $msgType = "text";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                    exit;
                }
                
                if($Event == 'CLICK')
                {

                    $EventKey = $postObj->EventKey;
                    
                    switch($EventKey)
                    {
                        //button "mudidi"
                        case '1' : 
                        /*
                                $msg = "开发者id: " . $toUsername . "\n";
                                $msg .= "用户id: " . $fromUsername . "\n";
                                $msg .= "事件消息类型: " . $MsgType . "\n";
                                $msg .= "事件消息的动作: " . $Event . "\n";*/
                                
                                $contentStr = "Paris\n我们的系统正在不断更新中，将为您提供更多精彩内容，敬请期待^_^";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                         case '惊喜：布列塔尼' : 
                                $contentStr = "Bretagne\n我们的系统正在不断更新中，将为您提供更多精彩内容，敬请期待^_^";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                         case '惬意：蔚蓝海岸' : 
                                $contentStr = "Core-A-Zur\n我们的系统正在不断更新中，将为您提供更多精彩内容，敬请期待^_^";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                         case '最热：普罗旺斯' : 
                                $contentStr = "Provence\n我们的系统正在不断更新中，将为您提供更多精彩内容，敬请期待^_^";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                        case '更多惊喜...' : 
                                $contentStr = "more...\n我们的系统正在不断更新中，将为您提供更多精彩内容，敬请期待^_^";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                        
                        //button "themes"
                        case '最热：生态游' : 
                                $contentStr = "最热：生态游\n我们的系统正在不断更新中，将为您提供更多精彩内容，敬请期待^_^";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                        case '最浪漫：蜜月游' : 
                                $contentStr = "最浪漫：蜜月游\n我们的系统正在不断更新中，将为您提供更多精彩内容，敬请期待^_^";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                        case '最经典：波尔多' : 
                                $contentStr = "最经典：波尔多\n我们的系统正在不断更新中，将为您提供更多精彩内容，敬请期待^_^";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                        case '更多惊喜...' : 
                                $contentStr = "more...\n我们的系统正在不断更新中，将为您提供更多精彩内容，敬请期待^_^";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                        
                        //button "us"
                        case '定制旅游' : 
                                $contentStr = "定制旅游";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                         case '关于我们' : 
                                $contentStr = "La Maison du voyage";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                        case '用户反馈' : 
                                $contentStr = "feeedback\n我们的系统正在不断更新中，将为您提供更多精彩内容，敬请期待^_^";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                        case '联系方式' : 
                                $contentStr = "90 Rue Bonaparte, La Maison de L'Afrique!";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                        case '更多新闻' : 
                                $contentStr = "更多新闻";
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                echo $resultStr;
                                break;
                    }
                    
                }
            }

        } else {
            exit;
        }
    }
}

?>