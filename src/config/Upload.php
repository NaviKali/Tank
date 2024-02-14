<?php
namespace config;

use function tank\getAPPJSON;

/**
 * (配置)文件上传
 */

class Upload 
{
        /* 主要路径 */
        public  $UploadUrl =  getAPPJSON()->UPLOADURL;
}