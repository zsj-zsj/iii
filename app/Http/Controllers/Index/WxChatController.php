<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WxChatController extends Controller
{
    //生成二维码
    public function wxChat()
    {
        $accessToken=$this->getAccessToken();
        //post
        $status = md5(uniqid());
        $postData = [
            'expire_seconds' => 604800,
            'action_name' => 'QR_STR_SCENE',
            'action_info' => [
                'scene' => [
                    'scene_str' =>$status
                ]
            ]
        ];
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$accessToken;
        $client = new Client();
        $response =$client->request('POST',$url,[
            'body'=>json_encode($postData,JSON_UNESCAPED_UNICODE),
        ]);
        $t=$response->getBody();
        $arr=json_decode($t,true);

        //转二维码
        $tickets=UrlEncode($arr['ticket']);
        $urls='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$tickets;
        return view('index.user.wxChat',['wxChatImg'=>$urls,'status'=>$status]);
    }
    //获取token
    protected function getAccessToken()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WxappID').'&secret='.env('Wxappsecret');
        $json= file_get_contents($url);
        $token=json_decode($json,true);
        return $token['access_token'];
    }

    public function wxChatStatus(Request $request)
    {
        $status = $request->status;   //二维码唯一标识
        $openid = session('openid');
        if(!$openid){
            return json_encode(['code'=>0,'msg'=>'用户未扫码']);
        }
        return json_encode(['code'=>1,'msg'=>'扫码成功,请等待PC端跳转']);
    }

    public static function getOpenid()
    {
        //先去session里取openid
        $openid = session('openid');
        //var_dump($openid);die;
        if(!empty($openid)){
            return $openid;
        }
        //微信授权成功后 跳转咱们配置的地址 （回调地址）带一个code参数
        $code = request()->input('code');
        if(empty($code)){
            //没有授权 跳转到微信服务器进行授权
            $host = $_SERVER['shops777.com'];  //域名
            $uri = $_SERVER['/wxChatStatus']; //路由参数
            $redirect_uri = urlencode("http://".$host.$uri);  // ?code=xx
            // dd($redirect_uri);
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".env('WxappID')."&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
            header("location:".$url);die;
        }else{
            //通过code换取网页授权access_token
            $url =  "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".env('WxappID')."&secret=".env('Wxappsecret')."&code={$code}&grant_type=authorization_code";
            $data = file_get_contents($url);
            $data = json_decode($data,true);
            $openid = $data['openid'];
            //获取到openid之后  存储到session当中
            session(['openid'=>$openid]);
            return $openid;
            //如果是非静默授权 再通过openid  access_token获取用户信息
        }
    }
}
