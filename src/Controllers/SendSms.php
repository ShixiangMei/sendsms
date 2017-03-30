<?php

namespace Yzxsms\Sendsms\Controllers;

use Yzxsms\Sendsms\Ucpass;

class ContactController extends Controller
{
    public function sendSms(Ucpass $ucpass)
    {
        $result = $ucpass->templateSMS($appId, $to, $templateId, $param);
        var_dump($result);
        $result = json_decode($result, true);
        $data   = $result['resp']['respCode'];
        if ($data == 000000) {
            echo '短信发送成功';
        }
    }
}
