<?php

function userType() {
    return Request::route('user_type');
}

function authUser() {
    return Auth::guard(userType())->user();
}