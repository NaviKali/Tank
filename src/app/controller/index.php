<?php
namespace app\controller;

require_once '../../config/Base.php';
use tank\Func\Func;

use function tank\Success;
use function tank\VerificationInclude;


Func::SingleVerCallFunction('GET', 'index', function () {
        \tank\Weclome();
});

Func::SingleVerCallFunction('GET', 'ceshi', function () {
}, VerificationInclude('index')['add']);
