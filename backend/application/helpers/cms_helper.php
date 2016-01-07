<?php

function add_meta_title($string) {
    $CI = & get_instance();
    $CI->data['meta_title'] = e($string) . ' - ' . $CI->data['meta_title'];
}

function a_edit_profil($uri, $link_labal) {
    return anchor($uri, '<span class="glyphicon glyphicon-edit"></span>' . $link_labal);
}

function btn_add($uri, $name) {
    return anchor($uri, '<span class="glyphicon glyphicon-plus"></span> Create ' . $name, 'title="Create ' . $name . '"');
}

function video_link($uri) {
    return anchor($uri, '<span class="glyphicon glyphicon-play-circle"></span>play');
}

function btn_edit($uri) {
    return anchor($uri, '<span class="glyphicon glyphicon-edit"></span>Modifier');
}

function btn_delete($uri) {
    return anchor($uri, '<span class="glyphicon glyphicon-remove"></span>Supprimer', array(
        'onclick' => "return confirm('Vous allez supprimer cette vid&eacute;. Cette action ne peux &ecirc;tre annul&eacute;e. Confirmer ?');"
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

