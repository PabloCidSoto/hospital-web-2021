<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc31163c42386b5a580b6d25bf09ff924
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc31163c42386b5a580b6d25bf09ff924::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc31163c42386b5a580b6d25bf09ff924::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
