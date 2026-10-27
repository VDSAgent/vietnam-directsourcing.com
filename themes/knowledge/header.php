<?php
/**
 * Site header: <head>, logo and main navigation.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <!-- header-area start -->
     <header>
         <div id="hideshow-sticky-menu">
            <div id="theme-menu-one" class="main-header-area menu-style-1 pt-20 pb-15">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2 col-6">
                            <div class="logo-img"> 
                            	<?php
																logo_knowledgetheme();
														  ?>
														</div>
                        </div>

                        <div class="col-xl-9 col-lg-10 col-6 d-flex align-items-center justify-content-end">
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