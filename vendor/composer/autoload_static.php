<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit78d57b204118f2a44b4fd07336aefb72
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Carefy\\Mvc\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Carefy\\Mvc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit78d57b204118f2a44b4fd07336aefb72::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit78d57b204118f2a44b4fd07336aefb72::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit78d57b204118f2a44b4fd07336aefb72::$classMap;

        }, null, ClassLoader::class);
    }
}