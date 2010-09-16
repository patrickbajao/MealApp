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
        $links .= link_to('View Menu', 'menu/' . $meal->getPlaceId());
        $links .= link_to('Order', 'order/' . $meal->getId());
        if($user->getIsSuperAdmin()) {
            $links .= link_to('Stop Orders', 'stopOrders/' . $meal->getId());
        }
    }
    return $links;
}