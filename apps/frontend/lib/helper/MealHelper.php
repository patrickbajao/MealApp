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

function meal_status($meal) {
    $status = null;
    if(is_null($meal->getPlace())) {
        if(!$meal->isVotingStopped()) {
            $status = 'Voting is ongoing. Place your vote now.';
        }
    } else {
        if(!$meal->isOrderingStopped()) {
            $status = 'You can now place your order.';
        }
    }
    return $status;
}

function meal_links($meal, $user) {
    $links = null;
    if(is_null($meal->getPlace())) {
        $vote_link = $meal->userHasVoted($user->getId()) ? 'Change Vote' : 'Vote' ;
        if(!$meal->isVotingStopped()) {
            $links .= link_to($vote_link, 'vote/' . $meal->getId());
        }
        
        if($meal->getVoteCount() > 0) {
            $links .= '&nbsp;|&nbsp;';
            $links .= link_to('View Votes', 'votes/' . $meal->getId());
        }
        
        if($user->getIsSuperAdmin()) {
            if($meal->getVoteCount() > 0 && !$meal->isVotingStopped()) {
                $links .= '&nbsp;|&nbsp;';
                $links .= link_to('Stop Votes', 'stopVotes/' . $meal->getId());
            }
        }
    } else {
        $order_link = $meal->userHasOrdered($user->getId()) ? 'Change Order' : 'Order' ;
        if(!$meal->isOrderingStopped()) {
            $links .= link_to($order_link, 'order/' . $meal->getId());
        }
        
        if($meal->getOrderCount() > 0) {
            $links .= '&nbsp;|&nbsp;';
            $links .= link_to('View Orders', 'orders/' . $meal->getId());
        }
        
        if($user->getIsSuperAdmin()) {
            if($meal->getOrderCount() > 0 && !$meal->isOrderingStopped()) {
                $links .= '&nbsp;|&nbsp;';
                $links .= link_to('Stop Orders', 'stopOrders/' . $meal->getId());
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