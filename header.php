<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes() ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes() ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes() ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes() ?>><!--<![endif]-->
    <head>
        <link rel="manifest" href="/manifest.json"><script charset="UTF-8" src="https://cdn.pushpushgo.com/js/5b150930611f7f000bf8c04b.js" async="async"></script>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MWMS427');</script>
        <!-- End Google Tag Manager -->
        <meta charset="<?php bloginfo( 'charset' ) ?>">
        <link rel="icon" href="<?php echo get_bloginfo('template_url') . '/favicon.ico' ?>" type="image/x-icon">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <?php 
        $term = get_queried_object();  
        $title = get_field('title', $term);
        ?>
        <?php if($title): ?>
            <meta name="title" content="<?php echo $title; ?> - --usuniete-- Blog">
        <?php endif; ?>
        <?php if($term->description): ?>
            <meta name="description" content="<?php echo $term->description; ?>">
        <?php endif; ?>
       
       
        <title><?php wp_title( '|', true, 'right' ) ?></title>
		<meta name="author" content="">
		<link rel="author" href="">
        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '659510714384979');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
          src="https://www.facebook.com/tr?id=659510714384979&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->
		<?php wp_head() ?>
        


    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    <body <?php body_class() ?>>
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v3.1&appId=414737419049141&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MWMS427"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
		<?php get_template_part('template-parts/header-nav', 'page'); ?>
