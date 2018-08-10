<nav class="navbar sj-navbar">
  <div class="container-fluid">
      <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo home_url(); ?>">
              <img src="https://app.scholarjet.com/assets/images/ScholarJet_Logo_Primary_Navy_RGB.png" class="navbar-brand-img"/>
          </a>
          <button type="button" class="sj-navbar__toggle collapsed"
                  data-toggle="collapse" data-target="#sj-navbar"
                  aria-expanded="false" aria-controls="navbar">
              <span class="hamburger"></span>
              <span class="nav-X"></span>
              Menu
          </button>
      </div>
	<div class="collapse navbar-collapse" id="sj-navbar">
		 <?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => false,
                'menu_class'        => 'nav navbar-nav navbar-left',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
        <?php if (isset($_COOKIE["__sj_logged_in"])): ?>
            // cookies:
            //  * __sj_logged_in
            //  * __sj_display_name
            //  * __sj_profile_url
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false">
                                        Hello, <?php echo $_COOKIE["__sj_display_name"] ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li *ngIf="student; else profileLink">
                             <a href="<?php echo $_COOKIE["__sj_profile_url"] ?>">Profile</a>
                         </li>
                         <li>
                             <a href="https://app.scholarjet.com/changeEmailPassword">
                               Change Email/Password
                             </a>
                         </li>
                         <li>
                             <a href="https://app.scholarjet.com/signOut?fromWp=true">
                                 Sign Out
                             </a>
                         </li>
                    </ul>
                </li>
            </ul>
        <?php else: ?>
            <?php
            wp_nav_menu( array(
                                          'menu'              => 'primary-right',
                                          'theme_location'    => 'primary-right',
                                          'depth'             => 2,
                                          'container'         => false,
                                          'menu_class'        => 'nav navbar-nav navbar-right',
                                          'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                          'walker'            => new wp_bootstrap_navwalker())
                                      );
            ?>
        <?php endif;?>
	</div>
  </div>
</nav>
