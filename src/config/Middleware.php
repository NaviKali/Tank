<?php
namespace config;

use config\Base\Base as Base;
use function tank\getRoot;

/**
 * 引入中间件
 */
//*获取路径名字
$Url = getRoot()."app/middleware";
/**
 * 自动引入中间件
 */
Base::AutomaticInclude($Url);
/**
 * (配置)中间件
 */
$userMiddleware = [
        "\app\middleware\middleware",
        "\app\middleware\loginmiddleware",
        "\app\middleware\\tokenmiddleware",
];


/**
 * 循环遍历使用中间件
 */
foreach ($userMiddleware as $value) {
        $value::Handle();
}