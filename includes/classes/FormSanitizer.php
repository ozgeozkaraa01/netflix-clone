<?php
class FormSanitizer
{
    public static function sanitizeFormString($inputText)
    {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        $inputText = strtolower($inputText); //strtolower, bir dizeyi küçük harfe dönüştürür
        $inputText = ucfirst($inputText); //ucfirst, bir dizenin ilk karakterini büyük harfe dönüştürür
        return $inputText;
    }
    public static function sanitizeFormUserName($inputText)
    {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText); //str_replace, kelimeler arasındaki boşlukları siler
        return $inputText;
    }
    public static function sanitizeFormPassword($inputText)
    {
        $inputText = strip_tags($inputText);
        return $inputText;
    }
    public static function sanitizeFormEmail($inputText)
    {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        return $inputText;
    }
}
