<!DOCTYPE html>
<!--
Template Name: Tinker - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $dark_mode??false ? 'dark' : '' }}{{ $color_scheme??'default' != 'default' ? ' ' . $color_scheme??'default' : '' }}">
<!-- BEGIN: Head -->
<head>
    




    <!-- Cookie Consent by FreePrivacyPolicy.com https://www.FreePrivacyPolicy.com -->
    <script type="text/javascript" src="//www.freeprivacypolicy.com/public/cookie-consent/4.1.0/cookie-consent.js" charset="UTF-8"></script>
    <script type="text/javascript" charset="UTF-8">
    document.addEventListener('DOMContentLoaded', function () {
    cookieconsent.run({"notice_banner_type":"simple","consent_type":"express","palette":"light","language":"en","page_load_consent_levels":["strictly-necessary"],"notice_banner_reject_button_hide":false,"preferences_center_close_button_hide":false,"page_refresh_confirmation_buttons":false,"website_name":"rodpromptkai","website_privacy_policy_url":"https://rodpromptkai.com/privacypolicy"});
    });
    </script>

    <!-- Google Analytics -->
    <!-- Google tag (gtag.js) -->
        <script type="text/plain" data-cookie-consent="tracking" async src="https://www.googletagmanager.com/gtag/js?id=G-VP6F03SH9Q"></script>
        <script type="text/plain" data-cookie-consent="tracking">
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-VP6F03SH9Q');
        </script>
    <!-- end of Google Analytics-->

    <noscript>Cookie Consent by <a href="https://www.freeprivacypolicy.com/">Free Privacy Policy Generator</a></noscript>
    <!-- End Cookie Consent by FreePrivacyPolicy.com https://www.FreePrivacyPolicy.com -->





    <!-- Below is the link that users can use to open Preferences Center to change their preferences. Do not modify the ID parameter. Place it where appropriate, style it as needed. -->

    <a href="#" id="open_preferences_center">Update cookies preferences</a>




    <meta charset="utf-8">
    <?php
        if(empty($_title)) 			$_title ='RodPromptkai | รถพร้อมขาย.com';
        if(empty($_keywords)) 		$_keywords ='';
        if(empty($_description)) 	$_description ='';
    ?>

    <meta name="keywords" content="<?php echo $_keywords;?>" />
    <meta name="description" content="<?php echo $_description;?>" />
    <meta name="robot" content="index, follow" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">

    <link type="image/ico" rel="shortcut icon" href="{{asset('frontend/images/favicon.ico')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/layout.css')}}" />

    @yield('head')

    <!-- BEGIN: CSS Assets-->
    <!-- <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}" /> -->
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

@yield('body')

</html>
