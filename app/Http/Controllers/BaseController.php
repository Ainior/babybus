<?php

namespace App\Http\Controllers;

use App\Exceptions\HOError;

class BaseController extends Controller
{

    protected $error;

    // 这个方法只应该在接口顺利完成了对请求业务的处理之后调用
    public function response($data = '', $msg = '')
    {
        $this->parseNull($data);
        return response()->horesp(200, $data, $msg);
    }

    // 成功返回
    public function success($data, $msg = "success")
    {
        $this->parseNull($data);
        $result = [
            "code" => 200,
            "msg" => $msg,
            "data" => $data,
        ];
        return response()->json($result, 200);
    }

    // 失败返回
    public function error($code = "422", $data = '', $msg = "fail")
    {
        $this->error = new HOError();
        return $this->error;

        $result = [
            "code" => $code,
            "msg" => $msg,
            "data" => $data,
        ];
        return response()->json($result, 200);
    }

    // 如果返回的数据中有 null 则那其值修改为空 （安卓和IOS 对null型的数据不友好，会报错）
    private function parseNull(&$data)
    {
        if (is_array($data)) {
            foreach ($data as &$v) {
                $this->parseNull($v);
            }
        } else {
            if (is_null($data)) {
                $data = "";
            }
        }
    }

}
