<?php
/**
 * Dashboard Master Template
 *
 * @package TravelerDashboard
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $current_dashboard_page;
$current_user = wp_get_current_user();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo esc_html( sprintf( __( 'Dashboard - %s', 'nextdestina-booking' ), get_bloginfo( 'name' ) ) ); ?></title>
    <?php wp_head(); ?>
</head>
<body class="traveler-dashboard-body" data-page="<?php echo esc_attr( $current_dashboard_page ); ?>">

    <nav class="navbar fixed-top navbar-expand-lg">
        <div class="container-fluid">
            <?php if ( function_exists( 'nextdestina_header_logo' ) ) {
                nextdestina_header_logo();
            } ?>
            <button class="navbar-toggler d-none d-lg-block" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <i class="fa-light fa-list"></i>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbar">
                <div class="offcanvas-header">
                    <a class="navbar-brand" href="index.html"><img class="logo" src="assets/img/logo/logo-white.png" alt=""></a>
                    <button type="button" class="cmn-btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-light fa-arrow-right"></i></button>
                </div>
                <div class="offcanvas-body align-items-center justify-content-between">
                    <ul class="navbar-nav m-auto">
                        <?php
                        $nav_items = array(
                            'home' => array(
                                'title' => __( 'Dashboard', 'nextdestina-booking' ),
                                'icon' => 'fa-grid-2',
                            ),
                            'history' => array(
                                'title' => __( 'Booking History', 'nextdestina-booking' ),
                                'icon' => 'fa-timer',
                            ),
                            'favorites' => array(
                                'title' => __( 'Favourite List', 'nextdestina-booking' ),
                                'icon' => 'fa-bag-shopping',
                            ),
                            'payments' => array(
                                'title' => __( 'Payments', 'nextdestina-booking' ),
                                'icon' => 'fa-wallet',
                            ),
                            'tickets' => array(
                                'title' => __( 'Support', 'nextdestina-booking' ),
                                'icon' => 'fa-headset',
                            ),
                            
                        );
                        
                        foreach ( $nav_items as $page => $item ) :
                            $active_class = ( $current_dashboard_page === $page ) ? 'active' : '';
                            $url = ( $page === 'home' ) ? home_url( '/my-dashboard/' ) : home_url( "/my-dashboard/{$page}/" );
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo esc_attr( $active_class ); ?>" href="<?php echo esc_url( $url ); ?>">
                                    <i class="fa-regular <?php echo esc_attr( $item['icon'] ); ?>"></i>
                                    <?php echo esc_html( $item['title'] ); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="nav-right ">
                <ul class="custom-nav header-nav">
                    <!-- Nav Profile section start -->
                    <li>
                        <a id="toggle-btn" class="nav-link d-flex toggle-btn">
                            <i class="fa-light fa-moon" id="moon"></i>
                            <i class="fa-light fa-sun-bright" id="sun"></i>
                        </a>
                    </li>
                    <!-- Notification section start -->
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                            <i class="fa-light fa-bell"></i>
                            <span class="badge badge-number">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                            <div class="dropdown-header">
                                You have 4 new notifications
                                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">clear all</span></a>
                            </div>
                            <div class="dropdown-body">
                                <div class="notification-item">
                                    <a href="">
                                        <i class="fa-light fa-circle-exclamation text-warning"></i>
                                        <div>
                                            <h4>Lorem Ipsum</h4>
                                            <p>Quae dolorem earum veritatis oditseno</p>
                                            <p>30 min. ago</p>
                                        </div>
                                    </a>
                                </div>

                                <div class="notification-item">
                                    <a href="">
                                        <i class="fa-light fa-circle-xmark text-danger"></i>
                                        <div>
                                            <h4>Atque rerum nesciunt</h4>
                                            <p>Quae dolorem earum veritatis oditseno</p>
                                            <p>1 hr. ago</p>
                                        </div>
                                    </a>
                                </div>

                                <div class="notification-item">
                                    <a href="">
                                        <i class="fa-light fa-circle-check text-success"></i>
                                        <div>
                                            <h4>Sit rerum fuga</h4>
                                            <p>Quae dolorem earum veritatis oditseno</p>
                                            <p>2 hrs. ago</p>
                                        </div>
                                    </a>
                                </div>

                                <div class="notification-item">
                                    <a href="">
                                        <i class="fa-light fa-circle-info text-primary"></i>
                                        <div>
                                            <h4>Dicta reprehenderit</h4>
                                            <p>Quae dolorem earum veritatis oditseno</p>
                                            <p>4 hrs. ago</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown-footer">
                                <a href="#">Show all notifications</a>
                            </div>
                        </div>
                    </li> -->
                    <!-- Notification section end -->

                    <li class="nav-item dropdown">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <?php echo get_avatar( $current_user->ID, 36, '', '', [ 'class' => 'rounded-circle' ] ); ?>
                            <span class="d-none d-xl-block dropdown-toggle ps-2"><?php echo esc_html($current_user->display_name); ?></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header d-flex justify-content-center align-items-center text-start">
                                <div class="profile-thum">
                                    <?php echo get_avatar( $current_user->ID, 36 ); ?>
                                </div>
                                <div class="profile-content">
                                    <h6><?php echo esc_html($current_user->display_name); ?></h6>
                                    <!-- <span>Content Creator</span> -->
                                </div>
                            </li>

                             <li>
                                <a class="dropdown-item d-flex align-items-center" href="<?php echo esc_url( home_url( '/my-dashboard/profile/' ) ); ?>">
                                    <i class="fa-light fa-user"></i>
                                    <span><?php esc_html_e('My Profile', 'nextdestina-booking'); ?></span>
                                </a>
                            </li>
                            <!--<li>
                                <a class="dropdown-item d-flex align-items-center" href="account-settings-profile.html">
                                    <i class="fa-sharp fa-light fa-gear"></i>
                                    <span>Account Settings</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="api.html">
                                    <i class="fa-regular fa-code"></i>
                                    <span>api</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                    <i class="fa-light fa-circle-question"></i>
                                    <span>Need Help?</span>
                                </a>
                            </li> -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">
                                    <i class="fa-light fa-right-from-bracket"></i>
                                    <span><?php esc_html_e( 'Sign Out', 'nextdestina-booking' ); ?></span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <!-- Nav Profile section end -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="dashboard-wrapper">
        <main class="dashboard-content">
            <?php 
            global $dashboard_instance;
            if ( isset( $dashboard_instance ) ) {
                $dashboard_instance->load_page_content( $current_dashboard_page );
            } else {
                // Fallback if instance not available
                $page = sanitize_key( $current_dashboard_page );
                $template_file = TRAVELER_DASHBOARD_PLUGIN_DIR . "templates/pages/{$page}.php";
                
                if ( file_exists( $template_file ) ) {
                    include $template_file;
                } else {
                    echo '<div class="dashboard-error">';
                    echo '<h2>' . esc_html__( 'Page Not Found', 'nextdestina-booking' ) . '</h2>';
                    echo '<p>' . esc_html__( 'The requested dashboard page could not be found.', 'nextdestina-booking' ) . '</p>';
                    echo '</div>';
                }
            }
            ?>
        </main>
    </div>

    <?php wp_footer(); ?>
</body>
</html>