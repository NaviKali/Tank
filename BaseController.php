<?php
namespace tank;

use tank\Tool\Tool;
use tank\MG\MG;

class BaseController
{
        /**
         * 密码验证场景规则
         * TODO常规的密码正则表达式验证法，用来严格验证密码类型。
         * @static
         * @access public
         * @param string $password 密码 必填
         * @return bool 是否验证成功
         */
        public static function VerPassWordPreg(string $password): bool
        {
                //*密码必须是0-9的数字注册，长度必须小于等于10
                if (preg_match('/[0-9]/', $password) and strlen($password) <= 10)
                        return true;
                return false;
        }
        /**
         * 判断获取文档数据是否为空值或没有
         * TODO用来快捷方便判断Select查询后的值
         * @static
         * @access public
         * @param string|array $data 需要判断的值data 必填
         * @param \Closure $success 成功回调 必填
         * @param \Closure $error 失败回调 必填
         * @return void 成功或失败的回调函数
         */
        public static function VerIsNull(string|array $data, \Closure $success, \Closure $error): void
        {
                 !empty($data) || $data == [] ? $error() : $success($data);
        }
        /**
         * 字段相连表
         * TODO用来截取其余别的字段来附加在对应关联文档上。
         * @static
         * @access public
         * @param array $data 主表文档 必填
         * @param string $OtherOutsize 其余表 必填
         * @param string $filed 相同字段 必填
         * @return array 相连后的数据
         */
        public static function Join(array $data, string $OtherOutsize, string $filed): array
        {
                for ($i = 0; $i < count($data); $i++) {
                        foreach ((new MG($OtherOutsize))->where([$filed => $data[$i]->$filed])->select() as $value) {
                                foreach (array_keys((array) $value) as $key => $values) {
                                        $data[$i]->$values = array_values((array) $value)[$key];
                                }
                        }
                }
                return $data;
        }
        /**
         * 树Tree
         * TODO用来关联表来制造树结构。
         * @static
         * @access public
         * @param array $select 查询的数据(主表数据) 必填
         * @param string $tables 关联的表(其余表) 必填
         * @param string $fontName 关联的字段 必填
         * @return void
         */
        public static function Tree(array $select, string $tables, string $fontName): void
        {
                for ($a = 0; $a < count($select); $a++) {
                        $select[$a]->children = (new MG($tables))->where([$fontName => $select[$a]->$fontName])->select();
                }
        }
        /**
         * 域名获取
         * TODO用来判断验证获取域名
         * @static
         * @access public
         * @param string $domainType 顶级域名 选填 默认为"com"
         * @return string 完整域名
         */
        public static function getdomain(string $domainType = "com"): string
        {
                //*获取当前路径
                $Url = $_SERVER['HTTP_HOST'];
                return str_contains($Url, $domainType) ? $Url : Tool::abort('这不是一个有效的域名！');
        }
        /**
         * 毁值
         * TODO用来销毁某一文档字段中的某个值。
         * @static
         * @access public
         * @param object $data 传入的值 必填
         * @param array|string $field 需要销毁值的字段 必填
         * @return mixed
         */
        public static function UnSet(object $data, array|string $field): mixed
        {
                if (is_array($field)) {
                        for ($i = 0; $i < count($field); $i++) {
                                $data = self::UnSet($data, $field[$i]);
                        }
                }
                if (is_string($field)) {
                        $data->$field = null;
                }
                return $data;
        }
        /**
         * Table表单字段获取集->AntDesignVue组件库
         * TODO用来给前台Table表单定义字段列集合。
         * @static
         * @access public
         * @param mixed $model 模型层 必填
         * @return array
         */
        public static function getTableFontsOfAntDesignVue(mixed $model): array
        {
                //获取表单字段获取集
                $con = [];
                $Source_title = array_values((new $model)::$writefield);
                $Source_index = array_keys((new $model)::$writefield);
                for ($i = 0; $i < count($Source_index); $i++) {
                        array_push($con, ['title' => $Source_title[$i], 'dataIndex' => $Source_index[$i]]);
                }
                array_push($con, ['title' => '操作', 'dataIndex' => '操作', 'fixed' => 'right']);
                return $con;
        }

}