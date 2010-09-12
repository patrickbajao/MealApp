<?php

function meal_place($meal, $msg = 'None') {
    return (!is_null($meal->getPlace())) ? $meal->getPlace()->getName() : $msg;
}