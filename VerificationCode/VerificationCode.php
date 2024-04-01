<?php
/**
 * 验证码
 */
namespace tank\VerificationCode;

use tank\Attribute\Attribute;


class VerificationCode
{
    /**
     * 英文符号
     */
    private static string $EnglishFont = "qwertyuiopasdfghlkjzxcmnvb";
    /**
     * 数字符号
     */
    private static string $MathFont = "123456789";
    /**
     * 验证码
     */
    public static string $Code;
    /**
     * 生成验证码
     * @static
     * @return void
     */
    public static function MakeVerificationCode(): void
    {
        (new Attribute("FUNCTION", "生成一个随机验证码", [
            "ImageCodeWidth" => 120,
            "ImageCodeHeight" => 40,
        ]));

        $Attr = Attribute::getAttribute();
        self::getRandomCode();

        header("Content-type: image/jpg");

        $img = imagecreatetruecolor($Attr["other"]["ImageCodeWidth"], $Attr["other"]["ImageCodeHeight"]);

        $backgroundColor = imagecolorallocate($img, 255, 255, 255);
        $textColor = imagecolorallocate($img, 0, 0, 0);

        imagefill($img, 0, 0, $backgroundColor);
        imagestring($img, 10, 30, 12, self::$Code, $textColor);

        imagejpeg($img);
        imagedestroy($img);
    }
    /**
     * 验证|验证码
     * @static
     * @param string $code 验证码 必填
     * @return bool
     */
    public static function VerVerificationCode(string $code): bool
    {
        return self::$Code == $code ? true : false;
    }
    /**
     * 获取随机验证码
     * @return void
     */
    protected static function getRandomCode(): void
    {
        $english = &self::$EnglishFont;
        $english = str_shuffle($english);
        $english = substr($english, 1, 3);
        $math = self::$MathFont;
        $math = str_shuffle($math);
        $math = substr($math, 1, 3);
        $end = $english . $math;
        $end = str_shuffle($end);

        self::$Code = $end;
    }
}
