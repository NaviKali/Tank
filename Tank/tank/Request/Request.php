<?php
namespace tank\Request;

/**
 * Request请求类
 * @author LL
 */

use tank\Tool\Tool;

class Request
{
        /**
         * 获取POST参数
         * @static
         * TODO用来直接获取参数所有数据数组。
         * @return mixed
         */
        public static function postparam(): mixed
        {
                //?区分Content-Type
                $Type = self::headers("Content-Type");
                if ($Type == "application/json") {
                        $post = file_get_contents("php://input");
                        $post = json_decode($post); //JSON解码
                        return (array) $post;
                } else {
                        if (!$_POST or $_POST == [])
                                return Tool::Message(404, "没有携带任何参数！");
                        return $_POST ?? [];
                }
        }
        /**
         * 参数转换
         * TODO用来GET请求中转换请求字符串
         * @static
         * @param array $data 转换数据参数data 必填
         * @return string
         */
        public static function ChangeParams(array $data): string
        {
                $keysArr = [];
                //*获取key键
                foreach (array_keys($data) as $keys) {
                        array_push($keysArr, $keys);
                }
                $valuesArr = [];
                //*获取value值
                foreach (array_values($data) as $values) {
                        array_push($valuesArr, $values);
                }
                //*字符串拼接
                $end = "";
                for ($i = 0; $i < count($keysArr); $i++) {
                        $end .= "{$keysArr[$i]}={$valuesArr[$i]}&";
                }
                //*拼接
                $end = "?" . $end;
                //*去掉最后一个&
                $end = substr($end, 0, strlen($end) - 1);
                return $end;

        }
        /**
         * 获取GET参数
         * @static
         * TODO用来直接获取参数所有数据数组。
         * @return mixed
         */
        public static function param(): mixed
        {
                if (!$_GET or $_GET == [])
                        return Tool::Message(404, "没有携带任何参数！");
                return $_GET ?? [];
        }
        /**
         * 获取请求头
         * @static
         * TODO用来获取请求头信息数据
         * @param string $headersname 请求头名字 必填
         * @return mixed
         */
        public static function headers(string $headersname): mixed
        {
                $headersname = str_replace("_", "-", $headersname); //!防止出现下划线
                $headers = apache_request_headers();
                return $headers[$headersname] ?? null;

        }


}