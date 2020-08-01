<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Index\UserModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function reg()
    {
        return view('index.user.reg');
    }
    //发送手机验证码
    public function regMobileSendCode()
    {
        $mobile=\request()->user_mobile;
        $code=Str::random(4);
        //将验证码存session 判断正确和超时
        $data=[
            'time'=>time(),
            'code'=>$code
        ];
        session(['codeInfo'=>$data]);
        $host = "http://dingxin.market.alicloudapi.com";
        $path = "/dx/sendSms";
        $method = "POST";
        $appcode = env('CodeSendMobile');
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "mobile={$mobile}&param=code%3A{$code}&tpl_id=TP1711063";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_exec($curl);
        return $data=[
            'code'=>0,
            'msg'=>'发送成功'
        ];
    }
    //手机号注册
    public function regMobile()
    {
        request()->validate([
            'user_name' => 'required|unique:users',
            'user_mobile'=>'required|regex:/^1[345789][0-9]{9}$/',
            'user_pwd'=>'required|between:5,15',
            'user_pwds'=>'same:user_pwd'
        ],[
            'user_name.required'=>'请输入用户名',
            'user_name.unique'=>'用户名已存在',
            'user_pwd.required'=>'密码不能位空',
            'user_mobile.required'=>'手机号不能为空',
            'user_mobile.regex'=>'手机号格式不对',
            'user_pwd.between'=>'密码长短不够',
            'user_pwds.same'=>'密码不一致'
        ]);

        $data=\request()->all();

        $code=session('codeInfo.code');
        $time=session('codeInfo.time');
        if($data['mobile_code']!=$code){
            return $arr=[
                'code'=>500,
                'msg'=>'验证码不对'
            ];
        }
        if(time()-$time>300){
            return $arr=[
                'code'=>500,
                'msg'=>'验证码超时,请重新获取'
            ];
        }
        $arr=[
            'user_name'=>$data['user_name'],
            'user_pwd'=>password_hash($data['user_pwd'],PASSWORD_BCRYPT),
            'user_mobile'=>$data['user_mobile'],
            'user_time'=>time()
        ];
        $res=UserModel::insertGetId($arr);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

    public function onlyName()
    {
        $name=\request()->user_name;
        $uName=UserModel::where(['user_name'=>$name])->first();
        if($uName){
            return $a=[
                'code'=>500,
                'msg'=>'用户名已被注册'
            ];
        }
    }

    //邮箱注册
    public function regEmailSendCode()
    {
        $email=\request()->email;
        $c=Str::random(4);
        $code=[
            'code'=>"你的验证码是：".$c
        ];
        $data=[
            'time'=>time(),
            'code'=>$c
        ];
        session(['emailCode'=>$data]);
        Mail::send('index.user.regEmail',$code,function($message) use($email){
            $to = [
                $email
            ];
            $message ->to($to)->subject('hello');
        });
        return $a=[
            'code'=>0,
            'msg'=>'发送成功'
        ];
    }

    public function regEmail()
    {
        request()->validate([
            'user_name' => 'required|unique:users',
            'user_email'=>'required|email',
            'user_pwd1'=>'required|between:5,15',
            'user_pwd2'=>'same:user_pwd1'
            ],[
            'user_name.required'=>'请输入用户名',
            'user_name.unique'=>'用户名已存在',
            'user_email.required'=>'邮箱不能位空',
            'user_email.email'=>'邮箱格式不对',
            'user_pwd1.required'=>'密码不能位空',
            'user_pwd1.between'=>'密码长短不够',
            'user_pwd2.same'=>'密码不一致'
        ]);
        $data=\request()->all();

        $code=session('emailCode.code');
        $time=session('emailCode.time');
        if($data['email_code']!=$code){
            return $arr=[
                'code'=>500,
                'msg'=>'验证码不对'
            ];
        }
        if(time()-$time>300){
            return $arr=[
                'code'=>500,
                'msg'=>'验证码超时,请重新获取'
            ];
        }

        $arr=[
            'user_email'=>$data['user_email'],
            'user_pwd'=>password_hash($data['user_pwd1'],PASSWORD_BCRYPT),
            'user_name'=>$data['user_name'],
            'user_time'=>time()
        ];
        $res=UserModel::insertGetId($arr);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

    //登录
    public function login()
    {
        return view('index.user.login');
    }

    public function loginDo()
    {
        $data=\request()->all();
        $res=UserModel::where(['user_name'=>$data['user_name']])->first();
        if($res){
            $pass=password_verify($data['user_pwd'],$res->user_pwd);
            if($pass){
                session(['user'=>$res->toArray()]);
                return $arr=[
                    'code'=>0,
                    'msg'=>'登录成功'
                ];
            }else{
                return $arr=[
                    'code'=>500,
                    'msg'=>'密码不对'
                ];
            }
        }else{
            return $arr=[
                'code'=>404,
                'msg'=>'用户名不存在'
            ];
        }
    }
}
