<?php
/**
 * 读取Tank的环境变量
 */
namespace tank\Env;

use function tank\getRoot;


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
        $envList = self::$EnvList;
        $env = [];
        
        foreach ($envList as $k => $v) {
            $env[trim(explode("=", $v)[0])] = trim(explode("=", $v)[1]);
        }

        if ($key != DEFAULT_GET) {
            if (in_array($key, array_keys($env))) {
                return $env[$key];
            }
        }
        return $env;
    }

}