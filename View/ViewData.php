<?php
namespace tank\View;

class ViewData
{
    /* 页面包含 */
    public static $ViewInclude = [
        "$-",
        "-$",
        "$(",
        ")$",
        "@for",
        "for@",
        "@-",
        "-@",
        "@if",
        "if@",
        "@~",
        "~@",
        "@foreach",
        "foreach@",
        '@link{',
        '@script{',
        '}link@',
        '}script@',
        "%(",
        ")%",
    ];
    /* 页面切换 */
    public static $ViewChange = [
        "<?php\techo $",
        ";\t?>",
        "<?php\t",
        "\t?>",
        "<?php\tfor",
        "\t?>",
        "echo\t$",
        "\t;",
        "<?php\tif",
        "\t?>",
        "echo\t$",
        "\t;",
        "<?php\tforeach",
        "\t?>",
        "<link rel='stylesheet' href='",
        "<script src='",
        "'>",
        "'></script>",
        "(function(){",
        "})()",
    ];
    /**
     * 页面标签属性包含
     */
    public static $StyleInclude = [
        't-hidden',
        't-show',
        't-flex-center',
        't-flex-left',
        't-flex-right',
        't-flex',
    ];
    /**
     * 页面标签属性切换
     */
    public static $StyleChange = [
        "style='display:none'",
        "style='display:unset'",
        "style='align-items: center;align-content: center;justify-content: center;justify-items: center;text-align:center;'",
        "style='justify-content: left;justify-items: left;'",
        "style='justify-content: right;justify-items: right;'",
        "style='display:flex'",
    ];
    /**
     * 函数标签包含
     */
    public static $FunctionTagInclude =[
        "T-for(",
        "T-if(",
        "var(",
        "get(",
        ")",
    ];
    /**
     * 函数标签切换
     */
    public static $FunctionTagChange = [
        "self::TFor(",
        "self::TIf(",
        "self::var(",
        "self::get(",
        ")",
    ];

}