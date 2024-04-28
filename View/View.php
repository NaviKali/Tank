<?php

namespace tank\View;

use tank\Error\error as Error;
use tank\Tool\Tool;
use tank\View\ViewData;
use function tank\Abort;
use function tank\getCurrentUrl;
use function tank\getRoot;

class View
{
        /**
         * 获取视图层配置
         */
        public static $ViewConfig;

        /* 当前页面 */
        public static $view;
        /* 当前渲染页面 */
        public static $viewPage;
        /* 携带参数 */
        public static $params;
        /**
         * 视图层变量
         */
        public static $var = [];
        /**
         * 开启渲染页面
         * @author LL
         * @access public
         * @param string $view 视图层 必填
         * @param array $params 携带参数 选填
         */
        public static function Start(string $view, array $params = [])
        {
                self::$ViewConfig = require (getRoot() . "/config/view.php");
                //*切换类型
                header("Content-Type:text/html");
                $url = getRoot() . "views/";
                self::$view = $view;
                self::$viewPage = $url . $view . ".html";
                //?判断html是否存在
                if (!file_exists(self::$viewPage)) {
                        return Error::create("HTML不存在!", __FILE__, __LINE__);
                }
                //*加载参数
                $TK = $params;
                //*引入渲染页面
                self::IncludeView($params);
                return;
        }
        /**
         * 引入页面
         */
        private static function IncludeView(array $TK): void
        {

                $HTML_Content = file_get_contents(self::$viewPage);
                /**
                 * 静态文件
                 */
                for ($i = 0; $i < count(self::$ViewConfig['StaticFileUrl']); $i++) {
                        $HTML_Content = str_replace(array_keys(self::$ViewConfig['StaticFileUrl'])[$i], array_values(self::$ViewConfig['StaticFileUrl'])[$i], $HTML_Content);
                }
                /**
                 * 自定义标签
                 */
                for ($i = 0; $i < count(self::$ViewConfig['CustomLabel']); $i++) {
                        $HTML_Content = str_replace(array_keys(self::$ViewConfig['CustomLabel'])[$i], array_values(self::$ViewConfig['CustomLabel'])[$i], $HTML_Content);
                }

                /**
                 * 页面切换
                 */
                for ($i = 0; $i < count(ViewData::$ViewInclude); $i++) {
                        $HTML_Content = str_replace(ViewData::$ViewInclude[$i], ViewData::$ViewChange[$i], $HTML_Content);
                }
                /**
                 * 页面属性切换
                 */
                for ($i = 0; $i < count(ViewData::$StyleInclude); $i++) {
                        $HTML_Content = str_replace(ViewData::$StyleInclude[$i], ViewData::$StyleChange[$i], $HTML_Content);
                }
                /**
                 * 函数标签切换
                 */
                for ($i = 0; $i < count(ViewData::$FunctionTagInclude); $i++) {
                        $HTML_Content = str_replace(ViewData::$FunctionTagInclude[$i], ViewData::$FunctionTagChange[$i], $HTML_Content);
                }

                Tool::AutomaticFile(getRoot() . "public/then", 'view', "html", $HTML_Content);
                include (getRoot() . "public/then/view.html");
        }
        /**
         * 获取当前级别页面
         * @author LL
         * @access public
         */
        public static function getlevelPage(): int
        {
                $pageArr = explode("\\", self::$view);
                return count($pageArr);
        }
        /**
         * For循环
         * @access private 
         * @param string $data 循环内容 必填
         * @param int $length 循环长度 选填 默认为 5
         * @return void
         */
        private static function TFor(string $data, int $length = 5): void
        {
                for ($i = 0; $i < $length; $i++) {
                        echo $data;
                }
        }
        /**
         * If判断
         * @access private
         * @param mixed $data 判断某一个值 必填
         * @param string $true true时，输出
         * @param string $false fasle时，输出
         */
        private static function TIf(mixed $data, string $true, string $false): void
        {
                if (!empty($data)) {
                        echo $true;
                } else {
                        echo $false;
                }
        }
        /**
         * 创造一个变量
         * @access private
         * @param string $key 变量键 必填
         * @param mixed $value 变量值 必填
         * @return void
         */
        private static function var(string $key, mixed $value)
        {
                self::$var[$key] = $value;
        }
        /**
         * 获取变量
         * @access private
         * @param string $key 变量键 必填
         * @param string $isReturn 是否返回 选填 默认为 false
         */
        private static function get(string $key, bool $isReturn = false)
        {
                if (!$isReturn) {
                        if (in_array($key, array_keys(self::$var)))
                                echo self::$var[$key];
                } else {
                        return self::$var[$key];
                }
        }
}
