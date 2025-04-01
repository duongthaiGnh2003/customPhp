<?php
global $theme_uri;

?>

<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="https://ogani.com.vn">
    <meta name="generator" content="Ogani">
    <meta name="robots" content="index,follow">
    <meta name="revisit-after" content="1 days">
    <meta name="author" content="Ogani">
    <meta name="copyright" content="Ogani @ 2022">
    <!-- OG -->
    <meta property="og:url" content="https://ogani.com.vn">
    <meta property="og:type" content="article">

    <!-- Css Styles -->
    <?php wp_head() ?> <!-- để gọi đến các cái link đã nạp vào ở wp2023_theme_register_styles -->


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-33NWYZFEGB"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-33NWYZFEGB');
    </script>
</head>

<body>
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay active"></div>
    <div class="humberger__menu__wrapper show__humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="" alt=""></a>
        </div>
        <!-- <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>$150.00</span></div>
    </div> -->
        <!-- <div class="humberger__menu__widget">
        <div class="header__top__right__language">
            <img src="" alt="">
            <div>English</div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="#">Spanis</a></li>
                <li><a href="#">English</a></li>
            </ul>
        </div>
        <div class="header__top__right__auth">
            <a href="#"><i class="fa fa-user"></i> Login</a>
        </div>
    </div> -->
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="https://ogani.com.vn">Trang chủ</a></li>
                <li class=""><a href="https://ogani.com.vn/shop">Sản phẩm</a></li>
                <li class=""><a href="https://ogani.com.vn/lien-he">Liên hệ</a></li>

            </ul>
        </nav>
        <div id="mobile-menu-wrap">
            <div class="slicknav_menu"><a href="#" aria-haspopup="true" role="button" tabindex="0" class="slicknav_btn slicknav_collapsed" style="outline: none;"><span class="slicknav_menutxt">MENU</span><span class="slicknav_icon"><span class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span></span></a>
                <nav class="slicknav_nav slicknav_hidden" aria-hidden="true" role="menu" style="display: none;">
                    <ul>
                        <li class="active"><a href="https://ogani.com.vn" role="menuitem">Trang chủ</a></li>
                        <li class=""><a href="https://ogani.com.vn/shop" role="menuitem">Sản phẩm</a></li>
                        <li class=""><a href="https://ogani.com.vn/lien-he" role="menuitem">Liên hệ</a></li>

                    </ul>
                </nav>
            </div>
        </div>
        <div class="header__top__right__social">
            <i class="fa-brands fa-facebook"></i>

        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> dominhduc1310@gmail.com</li>
                <li>Rau cung cấp đến khách hàng là rau sạch đảm bảo tiêu chuẩn an toàn và được hái trong ngày</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">

        <div class="container">
            <?php get_template_part("parts/header/header-top-bar"); ?>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    <!-- Hero Section Begin -->
    <?php get_template_part("parts/header/header-search"); ?>

    <!-- Hero Section End --><!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="5000">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <!-- <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button> -->
                        </div>
                        <div class="carousel-inner" style="height: 450px;">
                            <div class="carousel-item active">
                                <div style="background-image: url(https://ogani.com.vn/public/img/home.jpg); background-size: cover;">
                                    <div style="background: radial-gradient(at left, rgba(127, 176, 105,1) 30%, rgba(255,0,0,0) 40%); height: 100%; width: 100%; position: absolute; top: 0; left: 0;">
                                    </div>
                                    <div style="color: #fff; height: 100%; width: 40%; position: absolute; top: 0; left: 0; display: flex; justify-content: center; flex-direction: column; padding-left: 50px;">
                                        <h3 style="margin-bottom: 15px;">Rau củ quả tươi sạch đạt tiêu chuẩn VietGAP</h3>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                            <a href="https://ogani.com.vn/shop" type="button" class="btn btn-lg px-4 me-md-2" style="background-color: #FFFFFF; color: #7fad39;">Mua hàng</a>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="carousel-item">
                                <div style="background-image: url(https://ogani.com.vn/public/img/home2.jpg); background-size: cover;">
                                    <div style="background: radial-gradient(at left 80%, rgba(127, 176, 105,1) 30%, rgba(255,0,0,0) 40%); height: 100%; width: 100%; position: absolute; top: 0; left: 0;">
                                    </div>
                                    <div style="color: #fff; height: 100%; width: 40%; position: absolute; top: 0; left: 0; display: flex; justify-content: end; flex-direction: column; padding-left: 50px; padding-bottom: 20px">
                                        <h3 style="margin-bottom: 15px;">Nhận trồng rau thủy canh theo yêu cầu</h3>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                            <a href="https://ogani.com.vn/lien-he" type="button" class="btn btn-lg px-4 me-md-2" style="background-color: #FFFFFF; color: #7fad39;">Liên hệ</a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button style="width: 2rem;" class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button style="width: 2rem;" class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->