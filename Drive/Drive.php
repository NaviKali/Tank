<?php
/**
 * PHP驱动
 * !如果问题需要修改 Drive.env 环境变量
 */
namespace tank\Drive;

use tank\Env\env;
use tank\Tool\Tool;
use tank\Attribute\Attribute;

class Drive
{
    /**
     * 当前使用PHP的配置文件路径
     */
    public string $CurrentUsePHPiniFileUrl;
    /**
     * 驱动列表
     */
    public array $DriveList = [];
    /**
     * 获取配置文件
     * !如果问题注意环境变量
     */
    public function __construct()
    {
        $this->CurrentUsePHPiniFileUrl = (new env("Drive"))->get("PHPUrl") . (new env("Drive"))->get("PHPini");
        $this->iniFileisExiste();
        $this->iniFileHandle(Tool::FileRead($this->CurrentUsePHPiniFileUrl));
    }
    /**
     * 获取驱动列表
     * @access public
     * @param string $type 驱动类型 选填 默认为 start  [(开启的驱动)start,(关闭的驱动)close]
     */
    public function getDriveList(string $type = "start")
    {
            return $this->DriveList[$type];
    }
    /**
     * 配置文件是否存在
     * @access protected
     * @return void
     */
    protected function iniFileisExiste():void
    {
        if (!file_exists($this->CurrentUsePHPiniFileUrl))
            \tank\Error\error::create("配置文件路径错误!", __FILE__, __LINE__);
    }
    /**
     * 配置文件处理
     * @access protected
     * @param string $file 配置文件内容 必填
     * @return array
     */
    protected function iniFileHandle(string $file):array
    {
        $file = explode(PHP_EOL, $file);
        $start = [];
        $close = [];
        foreach ($file as $k => $v) {
            //* 开启的驱动
            if (str_starts_with($v, "extension=")) {
                array_push($start, trim(str_replace("extension=", "", $v)));
            }
            //* 关闭的驱动
            else if (str_starts_with($v, ";extension=")) {
                array_push($close, trim(str_replace("extension=", "", $v)));
            }
        }
        /**
         * 关闭的驱动处理
         */
        $closeHandle = [];
        foreach ($close as $k => $v) {
            array_push($closeHandle, explode(";", $v)[1]);
        }

        $this->DriveList = ["start" => $start, "close" => $closeHandle];
        return ["start" => $start, "close" => $closeHandle];
    }
}