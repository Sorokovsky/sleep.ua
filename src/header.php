<!DOCTYPE html>
<html <?php echo get_language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Каталог з цінами на постільну білизну в інтернет магазині, Хмельницький.">
    <meta name="keywords" content="Постільна білизна, простирадло, підковдра, наволочки, в Хмельницькому">
    <?php wp_head(); ?>
    <title><?php the_title(); ?></title>
    <?php get_header(); ?>
</head>
<body>
    <header class="header">
        <?php get_one_tell(); ?>
        <div class="container header__container">
            <a href="<?php echo home_url(); ?>" class="logo header__logo">
                <img src=<?php echo get_custom_logo_url(); ?> alt="">
            </a>
            <p class="header__ukrane">
                <span>Український виробник</span> <img src="<?php echo get_theme_file("/img/ukrane.png"); ?>">
            </p>
            <nav class="header__nav nav">
                <ul class="menu header__menu">
                    
                    <?php
                    $menu = get_menu();
                    foreach ($menu as $item) { ?>
                        <li class="menu__item header__item">
                        <a href="<?php echo $item->url; ?>" class="header__link menu__link"><?php echo $item->title; ?></a>
                    </li>
                    <?php } ?> 
                </ul>
                <div class="burger">
                    <div class="burger-body"></div>
                </div>
            </nav>
        </div>
    </header>
    <main class="page">
