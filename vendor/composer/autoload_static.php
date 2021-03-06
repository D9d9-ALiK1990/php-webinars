<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4c99e9cbc70e927696ff87e53c942634
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Config_File' => __DIR__ . '/..' . '/smarty/smarty/libs/Config_File.class.php',
        'Smarty' => __DIR__ . '/..' . '/smarty/smarty/libs/Smarty.class.php',
        'Smarty_Compiler' => __DIR__ . '/..' . '/smarty/smarty/libs/Smarty_Compiler.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4c99e9cbc70e927696ff87e53c942634::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4c99e9cbc70e927696ff87e53c942634::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4c99e9cbc70e927696ff87e53c942634::$classMap;

        }, null, ClassLoader::class);
    }
}
