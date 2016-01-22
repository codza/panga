<?php

function add_meta_title($string) {
    $CI = & get_instance();
    $CI->data['meta_title'] = e($string) . ' - ' . $CI->data['meta_title'];
}

function a_edit_profil($uri, $label) {
    return anchor($uri, '<span class="glyphicon glyphicon-edit"></span>' . $label);
}

function btn_add($uri, $label="New") {
    return anchor($uri, '<span class="glyphicon glyphicon-plus"></span>'. $label, 'title="' . $label . '"');
}

function btn_edit($uri ,$label="Edit") {
    return anchor($uri, '<span class="glyphicon glyphicon-edit"></span> '.$label, 'title="' . $label . '"');
}

function btn_delete($uri,$label="Delete" ,$entity="record") {
    return anchor($uri, '<span class="glyphicon glyphicon-remove"></span>'.$label, array(
        'onclick' => "return confirm('You are about to delete a ".$entity.". This cannot be undone. Are you sure?');"
    ));
}

function btn_reset_password($uri) {
    return anchor($uri, '<span class="glyphicon glyphicon-remove"></span>reset password', array(
        'onclick' => "return confirm('Voulez vous réinitialiser le mot de passe ?');"
    ));
}

function text_trunk($text, $limit = 10) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

function put_underscore($string = "") {
    if ($string != "") {
        return str_replace(' ', '_', $string);
    }
}

function e($string) {
    return htmlentities($string);
}

function RandomStringId($length = 25) {
    return strtoupper(substr(sha1((time() * rand())), 0, $length));
}

