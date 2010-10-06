<?php 

function cross_app_link_to($app, $route, $args = null) {
    // get the host to build the absolute paths needed because this menu lets switch between sf apps
    $host = sfContext::getInstance()->getRequest()->getHost();
    
    // get the current environment. Needed to switch between the apps preserving the environment
    $env = sfConfig::get('sf_environment');
    
    $sf_root_dir = sfConfig::get('sf_root_dir');
    
    // get the routing file
    $app_routing_file = $sf_root_dir . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . $app . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routing.yml';
    
    // get the route in the routing file
    if(file_exists($app_routing_file)) {
        $yml = sfYaml::load($app_routing_file);
        $route_url = $yml[$route]['url'];
        if($args) {
            foreach($args as $k => $v) {
                $route_url = str_replace(':'.$k, $v, $route_url);
            }
        }
        if(strrpos($route_url, '*') == strlen($route_url)-1) {
            $route_url = substr($route_url, 0, strlen($route_url)-2);
        }
    }
    if($env == 'dev') {
        $path = 'http://' . $host . '/' . $app . '_dev.php' . $route_url;
    } else {
        $path = 'http://' . $host . $route_url;
    }
    return $path;
}