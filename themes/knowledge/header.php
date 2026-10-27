<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php
	global $tp_options;
	if(isset($tp_options['favicon-logo-image']['url']) &&
		$tp_options['favicon-logo-image']['url'] != ''){		
		?>
		<link rel="icon" href="<?php echo $tp_options['favicon-logo-image']['url'];?>" type="image/x-icon"/>
		<?php
	}else{
		?>
		<link rel="icon" href="<?php echo site_url();?>/wp-content/uploads/2016/04/logo-2.png" type="image/x-icon"/>
		<?php
	}
	?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>-->
	<?php wp_head(); ?>
</head>
<div id="myPopup" style="display:none;">
    <div id="popupContent">
        <h2 id="popupTitle"></h2>
        <div id="popupBody"></div>
        <button id="closePopup">Đóng</button>
    </div>
</div>
<body <?php body_class(); ?>>

    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- Add your site or application content here -->
    <!-- preloader -->
    <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- preloader end  -->
    <!-- header-area start -->
     <header>
         <div id="hideshow-sticky-menu">
            <div id="theme-menu-one" class="main-header-area menu-style-1 pt-20 pb-15">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2 col-6">
                            <div class="logo-img"> 
                            	<?php
																logo_knowledgetheme();
														  ?>
														</div>
                        </div>

                        <div class="col-xl-10 col-lg-10 col-6 d-flex align-items-center justify-content-end">
                            <nav id="topheader" class="navbar navbar-expand-lg justify-content-end mr-25">
                                <div class="nav-container">
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    	 <?php if( has_nav_menu( 'primary-menu' ) ): ?>
																				  <?php
																					wp_nav_menu( array(
																					  'container' => false,
																					  'theme_location' => 'primary-menu',
																					  'menu_class'     => 'navbar-nav list-style-none',
																					  'add_li_class'  => 'nav-item'
																					  ));
																				  ?>
																				 <?php endif; ?>                                        
                                    </div>
                                </div>
                            </nav>
                            <div class="right-nav d-flex align-items-center justify-content-end">
                                <div class="hamburger-menu d-md-inline-block d-lg-none text-right mr-15">
                                    <a href="javascript:void(0);">
                                        <i class="far fa-bars"></i>
                                    </a>
                                </div>
                                <ul class="list-style-none right-btn d-flex align-items-center">
                                    <li>
                                        <a class="theme_btn theme_btn_border d-none d-xl-inline-block" href="<?php echo site_url(); ?>/contact-for-sourcing/">
                                            <span>BOOK A CALL</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.theme-main-menu -->
         </div>
     </header>
    <!-- header-area end -->
    <!-- slide-bar start -->
    <aside class="slide-bar">
        <div class="close-mobile-menu">
            <a href="javascript:void(0);"><i class="fas fa-times"></i></a>
        </div>

        <!-- side-mobile-menu start -->
        <nav class="side-mobile-menu">
            <?php 
                if( has_nav_menu( 'primary-menu' ) ): 
                    wp_nav_menu( array(
                      'container' => false,
                      'theme_location' => 'primary-menu',
                      'menu_class'     => 'menu-class',
                      'add_li_class'  => 'menu-li'
                      ));
                    ?>
                <?php endif; ?>          
        </nav>
        <!-- side-mobile-menu end -->
    </aside>
    <div class="body-overlay"></div>
    <main>