<?php

namespace config;

/**
 * (配置)MongoDB数据库
 */
class  MongoClient
{
        public static $Mongo =
                [
                        /* 数据库类型 */
                        "SQLType" => 'MongoDB',
                        /* 数据库地址 */
                        "SQLLocalhost" => "localhost",
                        /* 数据库端口 */
                        "SQLPort" => 27017,
                        /* 数据库名称 */
                        "SQLDatabaseName" => 'Tank',
                ];

}

