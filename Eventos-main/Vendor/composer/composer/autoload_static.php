<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb72897db78e0fceca38491763c49a4fb
{
    public static $files = array (
        '606a39d89246991a373564698c2d8383' => __DIR__ . '/..' . '/symfony/polyfill-php85/bootstrap.php',
        '3a37ebac017bc098e9a86b35401e7a68' => __DIR__ . '/..' . '/mongodb/mongodb/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php85\\' => 23,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'MongoDB\\' => 8,
        ),
        'F' => 
        array (
            'Fatec\\Eventos\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php85\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php85',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'MongoDB\\' => 
        array (
            0 => __DIR__ . '/..' . '/mongodb/mongodb/src',
        ),
        'Fatec\\Eventos\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'NoDiscard' => __DIR__ . '/..' . '/symfony/polyfill-php85/Resources/stubs/NoDiscard.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb72897db78e0fceca38491763c49a4fb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb72897db78e0fceca38491763c49a4fb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb72897db78e0fceca38491763c49a4fb::$classMap;

        }, null, ClassLoader::class);
    }
}
