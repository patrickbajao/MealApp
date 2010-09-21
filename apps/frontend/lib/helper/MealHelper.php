<?php

function meal_place($meal, $msg = 'None') {
    return (!is_null($meal->getPlace())) ? $meal->getPlace()->getName() : $msg;
}

function meal_links($meal, $user) {
    $links = null;
    if(is_null($meal->getPlace())) {
        $vote_link = $meal->userHasVoted($user->getId()) ? 'Change Vote' : 'Vote' ;
        $links .= link_to($vote_link, 'vote/' . $meal->getId());
        if($user->getIsSuperAdmin()) {
            if($meal->getVoteCount() > 0 && !$meal->isVotingStopped()) {
                $links .= link_to('Stop Votes', 'stopVotes/' . $meal->getId());
            }
        }
    } else {
        $order_link = $meal->userHasOrdered($user->getId()) ? 'Change Order' : 'Order' ;
        $links .= link_to($order_link, 'order/' . $meal->getId());
        if($user->getIsSuperAdmin()) {
            if($meal->getOrderCount() > 0 && !$meal->isOrderingStopped()) {
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
    $desc = $place->getContact();
    if(empty($desc)) {
        $desc = 'N/A';
    }
    return $desc;
}