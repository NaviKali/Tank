<?php
namespace tank\Upload;

use tank\Tool\Tool as Tool;
use config\Upload as Configupload;

use function tank\getAPPJSON;

/**
 * 文件上传
 * @author LL
 * @access public
 * @method mixed Upload() 文件上传
 * @method mixed ClouseUpload() 取消文件上传
 */
class Upload
{
        /**获取路径 */
        //*上传文件
        public function Upload(string $name, string $type, mixed $file)
        {
                $file_data = $file;
                //图片上传
                if ($type == "image/jpeg" || $type == "image/png") {
                        //*如果传入的file是图片，那么会经过base64编码
                        $file = base64_decode($file_data); //todo 解析
                        //*上传图片
                        Tool::AutomaticFile(getAPPJSON()->UPLOADURL, $name, "", $file);
                }
                //文件上传
                else if ($type == "text/html") {
                        $file = base64_decode($file_data); //todo 解析
                        //*上传文件
                        Tool::AutomaticFile(getAPPJSON()->UPLOADURL, $name, "", $file);
                } else {
                        $file = base64_decode($file_data); //todo 解析
                        //*上传文件
                        Tool::AutomaticFile(getAPPJSON()->UPLOADURL, $name, "", $file);
                }
                return Tool::msg(200, "上传成功!");
        }
        //*取消上传文件
        public function CloseUpload(string $name, string $type)
        {
                /**
                 * 接受需求参数
                 * @author L
                 */

                if ($type == "image/jpeg" || $type == "image/png") {
                        Tool::DeleteFile(getAPPJSON()->UPLOADURL . "/" . $name);

                } else if ($type == "text/html") {
                         Tool::DeleteFile(getAPPJSON()->UPLOADURL . "/" . $name);
                } else {
                         Tool::DeleteFile(getAPPJSON()->UPLOADURL . "/" . $name);
                }
                return Tool::msg(200, "取消上传!");
        }

}