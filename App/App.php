<?php
/**
 * App类 [App场景化处理]
 */
namespace tank\App;

use tank\Func\Func;
use tank\Request\Request;
use function tank\{getRoot, getAutograph};

class App
{
    /**
     * App代参
     */
    public int $AppCode;
    /**
     * 是否为入口文件
     */
    protected bool $isPublicFile;
    /**
     * App类Base64解码参数
     */
    protected array $AppBaseParams = [];
    /**
     * 不可调用类列表
     */
    protected array $NotCallClassList = [];
    /**
     * App验证
     */
    public function __construct(mixed $class)
    {
        $AppConfig = require (getRoot() . "config\\App.php");

        //?是否开启App场景化
        if (!$AppConfig["IsStartApp"])
            return;

        $this->AppCode = $AppConfig["AppCode"];

        $this->NotCallClassList = $AppConfig["AppNotCallClass"];

        if (is_subclass_of($class, "tank\BaseController")):
            header("Content-Type:application/json");
            $class = md5($class);
            header("Autograph:$class");//*签名
        endif;

        //?是否为不可调用类
        $Autograph = getAutograph();
        for ($v = 0; $v < count($AppConfig["AppNotCallClass"]); $v++) {
            if (
                $Autograph == md5($AppConfig["AppNotCallClass"][$v])
            ) {
                \tank\Error\error::create("当前类不可调用!", __FILE__, __LINE__);
            }
        }

        $this->VerIsPublicFile();
        if ($this->isPublicFile) {
            if ($AppConfig["AppParamsType"] == "GET") {
                $this->AppBaseParams = Func::BaseDeCodeUrl();
            } else if ($AppConfig["AppParamsType"] == "POST") {
                $post = Request::postparam();
                $keys = array_keys($post);
                $values = [];
                for ($v = 0; $v < count(array_values($post)); $v++) {
                    array_push($values, base64_decode(array_values($post)[$v]));
                }
                $post = array_combine($keys, $values);
                $this->AppBaseParams = $post;
            }
        }
    }
    /**
     * 获取不可调用类列表
     * @return array
     */
    public function getNotCallClassList():array
    {
        return $this->NotCallClassList;
    }
    /**
     * 验证是否为入口文件
     */
    protected function VerIsPublicFile()
    {
        str_contains("public", Func::getUrl()) ? $this->isPublicFile = true : $this->isPublicFile = false;
    }
    /**
     * 获取解码后的参数
     * @return array
     */
    public function getAppParams():array
    {
        return $this->AppBaseParams;
    }
}

