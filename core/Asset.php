<?php

namespace Core;

class Asset {

    private const PATH_ASSETS = "public/assets/";

    public static function includeCss($filename) {

        return self::siteURL() . self::PATH_ASSETS . "css/" . $filename;
    }

    public static function includeJS($filename) {

        return self::siteURL() . self::PATH_ASSETS . "js/" . $filename;
    }

    public static function siteURL() {

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'] . '/';
        return $protocol . $domainName;
    }

}
