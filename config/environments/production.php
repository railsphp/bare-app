<?php
return function($config) {
    $config['error']['report_types'] = E_WARNING;
    
    $config['serve_static_assets'] = true;
    
    $config['assets']['digest'] = true;
};
