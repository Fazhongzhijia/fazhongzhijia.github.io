<?php
// define('TOKEN', 'weixin'); //改成自己的TOKEN
    //define('DEBUG', false);
//$ACCESS_TOKEN = get_access_token();
//createMenu($ACCESS_TOKEN);


function createMenu($ACCESS_TOKEN){
        
        $data = '{
          
         "button":[
             {  
                  "name":"目的地",
                  "sub_button":[
                    {
                       "type":"click",
                       "name":"时尚之都：巴黎",
                       "key":"Paris"
                    },
                    {
                       "type":"click",
                       "name":"惊喜之旅：布列塔尼",
                       "key":"Bretagne"
                    },
                    {
                       "type":"click",
                       "name":"碧海蓝天：蔚蓝海岸",
                       "key":"Cote-a-zur"
                    },
                    {
                       "type":"click",
                       "name":"最热门：普罗旺斯",
                       "key":"Provence"
                    }]
              },
              { 
                  "name":"主题",
                  "sub_button":[
                    {
                       "type":"click",
                       "name":"最酷：生态游",
                       "key":"eco-tourisme"
                    },
                    {
                       "type":"click",
                       "name":"最热：亲子游",
                       "key":"famillal"
                    },
                    {
                       "type":"click",
                       "name":"最浪漫：蜜月游",
                       "key":"la lune de la miel"
                    },
                    {
                       "type":"click",
                       "name":"最经典：波尔多",
                       "key":"la lune de la miel"
                    }]
              },
              {
                  "name":"联系我们",
                  "sub_button":[
                   {
                       "type":"click",
                       "name":"定制旅游",
                       "key":"formulaire"
                    },
                    {
                       "type":"click",
                       "name":"关于我们",
                       "key":"a propos de nous"
                    },
                    {
                       "type":"click",
                       "name":"用户反馈",
                       "key":"feedback"
                    },
                    {
                       "type":"click",
                       "name":"联系方式",
                       "key":"contact"
                    },
                    {
                       "type":"click",
                       "name":"更多新闻",
                       "key":"news"
                    }]
              }]
         }';
        $ch = curl_init(); // 启动一个CURL会话
 
        curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$ACCESS_TOKEN}"); // 要访问的地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); // 发送一个常规的Post请求
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)'); // 模拟用户使用的浏览器
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Post提交的数据包x
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($ch); // 执行操作
        if (curl_errno($ch)) {
            echo 'Errno'.curl_error($ch); //捕抓异常
        }
        curl_close($ch); // 关闭CURL会话
        var_dump($tmpInfo);
 
    }

    /**
     * 删除菜单
     * @param $access_token 已获取的ACCESS_TOKEN
     */
    
    function delmenu($access_token)
    {
        # code...
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$access_token;
        $data = json_decode(file_get_contents($url),true);
        if ($data['errcode']==0) {
            echo 'true delete\n';
            return true;
        }else{
            echo 'false pas delete\n';
            return false;
        }
    }

     /**
     * 获取access_token
     */

    function get_access_token()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxe3505a220f6c9a55&secret=676fae61a826cda6f9d1a9bd3c256dc2";
        $data = json_decode(file_get_contents($url),true);
        if($data['access_token']){
            return $data['access_token'];
        }else{
            return "获取access_token错误\n";
        }
    }

?>