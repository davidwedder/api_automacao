<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitacfb6fe844f5f80d660504c509a082b8
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

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitacfb6fe844f5f80d660504c509a082b8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitacfb6fe844f5f80d660504c509a082b8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitacfb6fe844f5f80d660504c509a082b8::$classMap;

        }, null, ClassLoader::class);
    }
}
