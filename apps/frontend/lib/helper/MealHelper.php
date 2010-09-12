<?php

function meal_place($meal, $msg = 'None') {
    return (!is_null($meal->getPlace())) ? $meal->getPlace()->getName() : $msg;
}

function meal_links($meal, $user_id) {
    $links = null;
    if(is_null($meal->getPlace())) {
        $vote_link = $meal->userHasVoted($user_id) ? 'Change Vote' : 'Vote' ;
        $links .= link_to($vote_link, 'vote/' . $meal->getId());
    } else {
        $links .= link_to('View Menu', 'menu/' . $meal->getPlaceId());
        $links .= link_to('Order', 'order/' . $meal->getId());
    }
    return $links;
}