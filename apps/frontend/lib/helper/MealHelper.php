<?php

function meal_date($date, $days) {
    return date('F j, Y', strtotime('+' . $days . ' days', strtotime($date)));
}

function meal_place($meal, $msg = 'None') {
    return (!is_null($meal->getPlace())) ? $meal->getPlace()->getName() : $msg;
}

function meal_icon($meal) {
    $icon = null;
    switch($meal->getType()) {
        case 'breakfast':
            $icon = image_tag('meal-bfast-icon.gif');
            break;
        case 'lunch':
            $icon = image_tag('meal-lunch-icon.gif');
            break;
        case 'dinner':
            $icon = image_tag('meal-dinner-icon.gif');
            break;
    }
    return $icon;
}

function meal_status($meal, $user) {
    $status = null;
    if(is_null($meal->getPlace())) {
        if(!$meal->isVotingStopped()) {
            $meal_places = $meal->getMealPlaces();
            if($meal_places->count() > 0) {
                $status = $meal->userHasVoted($user->getId()) ? 'You have already voted for this meal. You can still change your vote until the voting stops.' : 'Voting is ongoing. Place your vote now.' ;
            } else {
                $status = 'This meal has no places for voting yet.';
            }
        }
    } else {
        if(!$meal->isOrderingStopped()) {
            $status = $meal->userHasOrdered($user->getId()) ? 'You have already ordered for this meal.' : 'The place for this meal has been chosen. You can now place your order.' ;
        } else {
            $status = 'Ordering has been stopped. You can now only view the orders for this meal.';
        }
    }
    return $status;
}

function meal_links($meal, $user, $current_page = 'meals') {
    $links = null;
    if(is_null($meal->getPlace())) {
        $vote_link = $meal->userHasVoted($user->getId()) ? 'Change Vote' : 'Vote' ;
        $meal_places = $meal->getMealPlaces();
        if($meal_places->count() > 0) {
            if(!$meal->isVotingStopped() && !$meal->isMealFinished()) {
                $links .= link_to($vote_link, '@vote?meal_id=' . $meal->getId() . '&from=' . $current_page, array('class' => 'modal'));
            }
            
            if($meal->getVoteCount() > 0 && !$meal->isMealFinished()) {
                $links .= '&nbsp;|&nbsp;';
                $links .= link_to('View Votes', 'votes/' . $meal->getId(), array('class' => 'modal'));
            }
        
            if($user->getIsSuperAdmin()) {
                if($meal->getVoteCount() > 0 && !$meal->isVotingStopped() && !$meal->isMealFinished()) {
                    $links .= '&nbsp;|&nbsp;';
                    $links .= link_to('Stop Votes', '@stop_vote?meal_id=' . $meal->getId() . '&from=' . $current_page, array('class' => 'meal-link'));
                }
            }
        }
    } else {
        $order_link = $meal->userHasOrdered($user->getId()) ? 'Change Order' : 'Order' ;
        if(!$meal->isOrderingStopped() && !$meal->isMealFinished()) {
            $links .= link_to($order_link, '@order?meal_id=' . $meal->getId() . '&from=' . $current_page, array('class' => 'modal'));
        }
        
        if($meal->getOrderCount() > 0) {
            $links .= !$meal->isOrderingStopped() && !$meal->isMealFinished() ? '&nbsp;|&nbsp;' : '' ;
            $links .= link_to('View Orders', 'orders/' . $meal->getId(), array('class' => 'modal'));
        }
        
        if($user->getIsSuperAdmin()) {
            if($meal->getOrderCount() > 0 && !$meal->isOrderingStopped() && !$meal->isMealFinished()) {
                $links .= '&nbsp;|&nbsp;';
                $links .= link_to('Stop Orders', '@stop_order?meal_id=' . $meal->getId() . '&from=' . $current_page, array('class' => 'meal-link'));
            }
        }
    }
    return $links;
}

function place_contact($place) {
    $contact = $place->getContact();
    if(empty($contact)) {
        $contact = 'N/A';
    }
    return $contact;
}

function place_description($place) {
    $desc = $place->getDescription();
    if(empty($desc)) {
        $desc = 'N/A';
    }
    return $desc;
}

function order_menu($menu_items, $order) {
    $menu = '<ul class="checkbox_list">';
    foreach($menu_items as $item) {
        $checked = null;
        $quantity = 1;
        $comments = '';
        if($order != null) {
            foreach($order as $o) {
                if($o['item_id'] == $item->getId()) {
                    $checked = 'checked';
                    $quantity = $o['quantity'];
                    $comments = $o['comments'];
                }
            }
        }
        $menu .= '<li>';
        $menu .= '<label>Qty</label>';
        $menu .= '<input type="text" value="' . $quantity . '" name="meal_order[items][' . $item->getId() . '][quantity]" class="qty" />';
        $menu .= '<input type="checkbox" value="' . $item->getId() . '" name="meal_order[items][' . $item->getId() . '][item_id]" ' . $checked . ' />';
        $menu .= '<label>' . $item->getName() . '</label>';
        $menu .= '<span class="details">';
        $menu .= '<label>Comments</label>';
        $menu .= '<input type="text" name="meal_order[items][' . $item->getId() . '][comments]" value="' . $comments . '" />';
        $menu .= '</span>';
        $menu .= '</li>';
    }
    $menu .= '</ul>';
    return $menu;
}

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

function suggestion_type($type) {
    $type_text = null;
    switch($type) {
        case 'place':
            $type_text = 'a Place';
            break;
        case 'item':
            $type_text = 'an Item';
            break;
    }
    return $type_text;
}

function suggestion_fields($type, $form) {
    $fields = null;
    switch($type) {
        case 'place':
            $fields .= $form['contact']->renderLabel();
            $fields .= $form['contact']->render();
            break;
        case 'item':
            $fields .= '<span class="required">*</span>' . $form['price']->renderLabel();
            $fields .= $form['price']->render();
            $fields .= $form['price']->renderError();
            break;
    }
    return $fields;
}