<?php
namespace NewApp;

class Application extends \Rails\Application\Application
{
    protected function initConfig($config)
    {
        $config['assets']['compressors']['js']['invokeArgs'] = [
            ['jarFile' => '/home/blackmesa/www/closure/compiler.jar']
        ];
        // $config['assets']['compress'] = true;
        $config['serve_static_assets'] = true;
    }
}
