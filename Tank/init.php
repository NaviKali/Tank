<?php
/**
 * 接收脚本参数
 */
$arg = $argv[1];

/**
 * 服务代理
 */
switch ($arg) {
        case 'apache':
                exec("Start ," . getcwd() . "\\.bat\\.StartApache.bat");
                break;
        case 'nginx':
                exec("Start ," . getcwd() . "\\.bat\\.StartNginx.bat");
                break;
        case 'server':
                exec("Start ," . getcwd() . "\\.bat\\.TankExec.bat");
        default:
                sleep(1);
                echo "没有该参数或中断执行!";
                echo "请重新启动init.php!";
                break;
}