<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="<?php echo ( $post != NULL ) ?/*1*/ ($post->first_name != NULL ) ? $post->first_name." ".$post->last_name: ""/*1*/ :"";?>" >
    <meta name="description" content="<?php echo ( $post != NULL ) ?/*1*/($post->post_description!= NULL ) ? $post->post_description: ""/*1*/ :"";?>" >
    <meta name="keywords" content="<?php echo ( $post != NULL ) ?/*1*/ ($post->post_keywords!= NULL) ? $post->post_keywords : ""/*1*/ :"";?>" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <link rel="icon" href="<?php echo site_url('assets/images/rhu-logo.ico'); ?>" />

    <title><?php echo $meta_title_acronym;echo ($post!=NULL) ? /*1*/ ($post->post_name!= NULL) ? " - ".$post->post_name:""/*1*/ :"";?></title>
    <!-- Bootstrap core CSS -->
    <!-- half-slider.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/bootstrap/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/bootstrap/css/half-slider.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('frontend/css/front_page_global.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('frontend/css/responsive_global.css'); ?>" />

    <!-- Add custom CSS here -->
</head>

<body>


