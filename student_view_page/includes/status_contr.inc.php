<?php

declare(strict_types=1);

function is_input_empty(int $studentno ){

    if(empty($studentno)){
        return true;
    } else {
        return false;
    }
}

function is_studentno_right(bool|array $result){

    if(!$result){
        return true;
    } else {
        return false;
    }
}