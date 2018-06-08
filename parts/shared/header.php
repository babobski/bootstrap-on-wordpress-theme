<nav class="navbar sj-navbar">
  <div class="container-fluid">
      <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo home_url(); ?>">
              <img src="https://scholarjet.com/assets/images/ScholarJet_Logo_Primary_Navy_RGB.png" class="navbar-brand-img"/>
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
	</div>
  </div>
</nav>
