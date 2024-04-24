<?php

namespace tank\View;

use tank\Error\error as Error;
use tank\Tool\Tool;

use function tank\Abort;
use function tank\getCurrentUrl;
use function tank\getRoot;
use function tank\LocationTo;

class View
{
        /* 页面包含 */
        public static $ViewInclude = ["$-", "-$", "$(", ")$", "@for", "for@", "@-", "-@", "@if", "if@", "@~", "~@","@foreach","foreach@"];
        /* 页面切换 */
        public static $ViewChange = ["<?php\techo $", ";\t?>", "<?php\t", "\t?>", "<?php\tfor", "\t?>", "echo\t$", "\t;", "<?php\tif", "\t?>", "echo\t$", "\t;","<?php\tforeach","\t?>"];
        /* 当前页面 */
        public static $view;
        /* 当前渲染页面 */
        public static $viewPage;
        /* 携带参数 */
        public static $params;
        /**
         * 开启渲染页面
         * @author LL
         * @access public
         * @param string $view 视图层 必填
         * @param array $params 携带参数 选填
         */
        public static function Start(string $view, array $params = [])
        {
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
                for ($i = 0; $i < count(self::$ViewInclude); $i++) {
                        $HTML_Content = str_replace(self::$ViewInclude[$i], self::$ViewChange[$i], $HTML_Content);
                }
                Tool::AutomaticFile(getRoot() . "public/then", 'view', "html", $HTML_Content);
                include(getRoot() . "public/then/view.html");
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
}
