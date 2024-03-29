<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5d4283bf7ff81d046e6cdafdb803d665
{
    public static $files = array (
        '2cffec82183ee1cea088009cef9a6fc3' => __DIR__ . '/..' . '/ezyang/htmlpurifier/library/HTMLPurifier.composer.php',
        'decc78cc4436b1292c6c0d151b19445c' => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'phpseclib3\\' => 11,
        ),
        'V' => 
        array (
            'VisualAppeal\\' => 13,
        ),
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'Psr\\Log\\' => 8,
            'ParagonIE\\ConstantTime\\' => 23,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'L' => 
        array (
            'Laizerox\\' => 9,
        ),
        'I' => 
        array (
            'IPLib\\' => 6,
        ),
        'D' => 
        array (
            'Desarrolla2\\Cache\\' => 18,
        ),
        'C' => 
        array (
            'Composer\\Semver\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'phpseclib3\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib',
        ),
        'VisualAppeal\\' => 
        array (
            0 => __DIR__ . '/..' . '/visualappeal/php-auto-update/src',
        ),
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'ParagonIE\\ConstantTime\\' => 
        array (
            0 => __DIR__ . '/..' . '/paragonie/constant_time_encoding/src',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'Laizerox\\' => 
        array (
            0 => __DIR__ . '/..' . '/laizerox/php-wowemu-auth/src',
        ),
        'IPLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/mlocati/ip-lib/src',
        ),
        'Desarrolla2\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/desarrolla2/cache/src',
        ),
        'Composer\\Semver\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/semver/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'H' => 
        array (
            'HTMLPurifier' => 
            array (
                0 => __DIR__ . '/..' . '/ezyang/htmlpurifier/library',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'HTMLPurifier_AttrDef_Float' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/AttrDef/Float.php',
        'HTMLPurifier_AttrDef_HTML5_ARel' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/AttrDef/HTML5/ARel.php',
        'HTMLPurifier_AttrDef_HTML5_Datetime' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/AttrDef/HTML5/Datetime.php',
        'HTMLPurifier_AttrDef_HTML5_Duration' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/AttrDef/HTML5/Duration.php',
        'HTMLPurifier_AttrDef_HTML5_Week' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/AttrDef/HTML5/Week.php',
        'HTMLPurifier_AttrDef_HTML5_YearlessDate' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/AttrDef/HTML5/YearlessDate.php',
        'HTMLPurifier_AttrDef_HTML_Bool2' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/AttrDef/HTML/Bool2.php',
        'HTMLPurifier_AttrTransform_HTML5_Dialog' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/AttrTransform/HTML5/Dialog.php',
        'HTMLPurifier_AttrTransform_HTML5_Progress' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/AttrTransform/HTML5/Progress.php',
        'HTMLPurifier_AttrTransform_HTML5_Script' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/AttrTransform/HTML5/Script.php',
        'HTMLPurifier_ChildDef_HTML5_Abstract' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/ChildDef/HTML5/Abstract.php',
        'HTMLPurifier_ChildDef_HTML5_Details' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/ChildDef/HTML5/Details.php',
        'HTMLPurifier_ChildDef_HTML5_Fieldset' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/ChildDef/HTML5/Fieldset.php',
        'HTMLPurifier_ChildDef_HTML5_Figure' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/ChildDef/HTML5/Figure.php',
        'HTMLPurifier_ChildDef_HTML5_Media' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/ChildDef/HTML5/Media.php',
        'HTMLPurifier_ChildDef_HTML5_Picture' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/ChildDef/HTML5/Picture.php',
        'HTMLPurifier_ChildDef_HTML5_Script' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/ChildDef/HTML5/Script.php',
        'HTMLPurifier_ChildDef_HTML5_Time' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/ChildDef/HTML5/Time.php',
        'HTMLPurifier_HTML5Config' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTML5Config.php',
        'HTMLPurifier_HTML5Definition' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTML5Definition.php',
        'HTMLPurifier_HTMLModule_HTML5_Bdo' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTMLModule/HTML5/Bdo.php',
        'HTMLPurifier_HTMLModule_HTML5_Edit' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTMLModule/HTML5/Edit.php',
        'HTMLPurifier_HTMLModule_HTML5_Forms' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTMLModule/HTML5/Forms.php',
        'HTMLPurifier_HTMLModule_HTML5_Hypertext' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTMLModule/HTML5/Hypertext.php',
        'HTMLPurifier_HTMLModule_HTML5_Iframe' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTMLModule/HTML5/Iframe.php',
        'HTMLPurifier_HTMLModule_HTML5_Interactive' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTMLModule/HTML5/Interactive.php',
        'HTMLPurifier_HTMLModule_HTML5_List' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTMLModule/HTML5/List.php',
        'HTMLPurifier_HTMLModule_HTML5_Media' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTMLModule/HTML5/Media.php',
        'HTMLPurifier_HTMLModule_HTML5_Ruby' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTMLModule/HTML5/Ruby.php',
        'HTMLPurifier_HTMLModule_HTML5_SafeScripting' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTMLModule/HTML5/SafeScripting.php',
        'HTMLPurifier_HTMLModule_HTML5_Scripting' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTMLModule/HTML5/Scripting.php',
        'HTMLPurifier_HTMLModule_HTML5_Text' => __DIR__ . '/..' . '/xemlock/htmlpurifier-html5/library/HTMLPurifier/HTMLModule/HTML5/Text.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5d4283bf7ff81d046e6cdafdb803d665::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5d4283bf7ff81d046e6cdafdb803d665::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit5d4283bf7ff81d046e6cdafdb803d665::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit5d4283bf7ff81d046e6cdafdb803d665::$classMap;

        }, null, ClassLoader::class);
    }
}
