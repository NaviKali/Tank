<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc970f1a266f43a2118de462ce989b839
{
    public static $files = array (
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
        '3a37ebac017bc098e9a86b35401e7a68' => __DIR__ . '/..' . '/mongodb/mongodb/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'tank\\' => 5,
        ),
        'r' => 
        array (
            'router\\' => 7,
        ),
        'p' => 
        array (
            'public\\' => 7,
        ),
        'c' => 
        array (
            'config\\' => 7,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
        ),
        'M' => 
        array (
            'MongoDB\\' => 8,
        ),
        'J' => 
        array (
            'Jean85\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'tank\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tank',
        ),
        'router\\' => 
        array (
            0 => __DIR__ . '/../..' . '/router',
        ),
        'public\\' => 
        array (
            0 => __DIR__ . '/../..' . '/public',
        ),
        'config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'MongoDB\\' => 
        array (
            0 => __DIR__ . '/..' . '/mongodb/mongodb/src',
        ),
        'Jean85\\' => 
        array (
            0 => __DIR__ . '/..' . '/jean85/pretty-package-versions/src',
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc970f1a266f43a2118de462ce989b839::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc970f1a266f43a2118de462ce989b839::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc970f1a266f43a2118de462ce989b839::$classMap;

        }, null, ClassLoader::class);
    }
}
