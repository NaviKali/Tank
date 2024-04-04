<?php
/**
 * 读取Tank的环境变量
 */
namespace tank\Env;

use function tank\getRoot;
use tank\Attribute\Attribute;

define("DEFAULT_GET", 100);
class env
{
    /**
     * 环境变量的集合
     */
    public static array $EnvList = [];
    /**
     * 构造拿取
     * @access public
     * @param string $envfile Env文件 选填 默认为 tank
     */
    public function __construct(string $envfile = "tank")
    {
        (new Attribute("FUNCTION","环境变量是不可缺少的东西。"));
        if (file_exists(getRoot() . "env/{$envfile}.env")) {
            $env = file(getRoot() . "env/{$envfile}.env");
            self::$EnvList = $env;
        } else {
            \tank\Error\error::create("没有该环境变量文件!", __FILE__, __LINE__);
        }
    }
    /**
     * 获取环境变量
     * @static
     * @access public
     * @param string $key 环境变量键 选填 默认为 DEFAULT_GET
     */
    public function get(string $key = DEFAULT_GET)
    {
        (new Attribute("FUNCTION","可以快速拿到对应环境变量。"));
        $envList = self::$EnvList;
        $env = [];
        
        foreach ($envList as $k => $v) {
            $env[trim(explode("=", $v)[0])] = trim(explode("=", $v)[1]);
        }

        if ($key != DEFAULT_GET) {
            //?是否存在你索要的环境变量的key 有则给 否则为[]
            if (in_array($key, array_keys($env))) {
                return $env[$key];
            }else{
                return [];
            }
        }
        return $env;
    }

}