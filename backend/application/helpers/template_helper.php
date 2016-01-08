<?php
//function to build de url
function post_link($post){
    if(strcasecmp($post->post_type, 'primary_page') == 0){
        return e($post->post_slug);
    }else{
        return strtolower($post->category_name). '/' . e($post->post_slug);
    }
}
//function to build the url
function post_url($post){
        return strtolower($post->category_name). '/' . e($post->post_slug);
}
function get_post_image_url($post,$thumb=false)
{
    $image_url = "";
    if(count($post->images)>0){
        if ($post->images[0]->media_code != NULL || $post->images[0]->media_code != "" ) {

            if ($thumb == false) {
                $image_url .= $post->images[0]->media_code . $post->images[0]->media_ext;
            } else {
                $image_url .= $post->images[0]->media_code . "_thumb" . $post->images[0]->media_ext;
            }
        }
    }else{
        if ($thumb == false) {
            $image_url .= "NO_IMAGE.png";
        } else {
            $image_url .= "NO_IMAGE_thumb.png";
        }
    }
    return $image_url;
}
function get_media_url($media,$thumb=false)
{
    $media_url = "";
        if ($thumb == false) {
            $media_url .= $media->media_code . $media->media_ext;
        } else {
            $media_url .= $media->media_code . "_thumb" . $media->media_ext;
        }
    return $media_url;
}


function dispaly_post($post){

    $string= "";
    if($post == null ){
        $string .="No Post To Display";

    }else{
        $string .="<h1>".$post->title."</h1>";
        $string .="<div >".$post->content."</div>";
        $string .="<div >".$post->author."</div>";



    }
    return $string;
}



function post_links($posts){
    $string = '<ul class="text-left">';

    foreach ($posts as $post) {
        if(strcasecmp($post->post_type, 'primary_page') != 0 ){

        $url = post_url($post);
        $string .= '<li>';
        $string .= '<h4>' .( anchor($url, e($post->post_title))) .  '</h4>';//rhu-post-container
        $string .= '</li>';
        }
    }
    $string .= '</ul>';
    return $string;
}

function post_by_cat_links($posts, $cat,$website_url_array){
    $item_counter=0;
    $string = '<ul>';
        foreach ($posts as $post) {

            if(
                strcasecmp(trim($post->category_name), $cat) == 0 &&
                strcasecmp(trim($post->post_type), "primary_page") != 0 &&
                in_array($post->post_slug , $website_url_array ) != 1 ){

                $url = post_url($post);
                $string .= '<li>';
                $string .= '<h4>' . anchor($url, e($post->post_title)) .'</h4>';
                $string .= '</li>';
                $item_counter++;
            }
        }
    if( $item_counter < 1 ){
        $string .= '<li>';
        $string .= '<h4><a href="#">There are no '.$cat.'</a></h4>';
        $string .= '</li>';
    }

    $string .= '</ul>';
    return $string;
}





function get_excerpt($post, $numwords = 10){
    $string = '';
    $url = post_link($post);

    $string .= '<h2>' . anchor($url, e($post->post_title) ) .  '</h2>';
    $string .= '<p class="pubdate">' . e($post->publication_date) . '</p>';
    $string .= '<p>' . e(text_trunk(strip_tags($post->post_content), $numwords)) . '</p>';
    $string .= '<p>' . anchor($url, 'Read more ›', array('post_title' => e($post->post_title))) . '</p>';

    return $string;
}


function get_menu ($array, $child = FALSE)
{
    $CI =& get_instance();
    $str = '';

    if (count($array)) {
        $str .= $child == FALSE ? '<ul class="nav navbar-nav">' . PHP_EOL : '<ul class="dropdown-menu" role="menu">' . PHP_EOL;

        foreach ($array as $item) {

            $active = $CI->uri->segment(1) == $item['post_slug'] ? TRUE : FALSE;
            if (isset($item['children']) && count($item['children'])) {
                $str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
                $str .= '<a  class="dropdown-toggle" data-toggle="dropdown" href="' . site_url(e($item['post_slug'])) . '">' . e($item['post_title']);
                $str .= '<span class="caret"></span></a>' . PHP_EOL;
                $str .= get_menu($item['children'], TRUE);
            }
            else {
                $str .= $active ? '<li class="active">' : '<li>';
                $str .= '<a href="' . site_url($item['post_slug']) . '">' . e($item['post_title']) . '</a>';
            }
            $str .= '</li>' . PHP_EOL;
        }

        $str .= '</ul>' . PHP_EOL;
    }

    return $str;
}

function get_primary_menu ($array)
{
    $CI =& get_instance();
    $str = '';

    if (count($array)) {
        $str .=  '<ul class="nav navbar-nav ">' . PHP_EOL;

        foreach ($array as $item) {
            $active = $CI->uri->segment(1) == $item->post_slug ? TRUE : FALSE;

            if(strcasecmp($item->post_type, 'primary_page') == 0){

                if ( $active ) {
                    $str .= '<li class="active">';
                }
                else {
                    $str .= '<li>';
                }
                $str .= '<a href="' . site_url($item->post_slug ). '">' . e($item->post_name) . '</a>';
                $str .= '</li>' . PHP_EOL;
            }
        }

        $str .= '</ul>' . PHP_EOL;
    }
    return $str;
}

function get_primary_link ($array)
{
    $CI =& get_instance();
    $str = '';

    if (count($array)) {


        foreach ($array as $item) {
            $active = $CI->uri->segment(1) == $item->post_slug ? TRUE : FALSE;

            if(strcasecmp($item->post_type, 'primary_page') == 0){
                $str .= '<a class="rhu_nav_footer" href="' . site_url($item->post_slug ). '">' . e($item->post_name) . '</a>';
                $str .= '<br>' . PHP_EOL;
            }
        }

    }

    return $str;
}