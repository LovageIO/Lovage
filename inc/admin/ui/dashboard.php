<?php
/**
 * Dashboard Page
 *
 * @package Lovage
 * @author Lovage
 * @link https://lovage.io
 * @version 1.0
 */
?>

<div id="dashboard" class="lovage-admin-container">


	<div class="row">
		<div class="col-2">
			<div class="lovage-admin-box">
				<h2><?php echo esc_html__( 'General Settings' , 'lovage' ); ?></h2>
				<ul>
					<li>
						<i class="dashicons-before dashicons-format-image"></i>
						<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=title_tagline' ) );?>"><?php echo esc_html__('Upload Logo & Favicon', 'lovage');?></a>
					</li>

					<li>
						<i class="dashicons-before dashicons-art"></i>
						<a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=color_panel' ) );?>"><?php echo esc_html__('Color Scheme', 'lovage');?></a>
					</li>

					<li>
						<i class="dashicons-before dashicons-editor-textcolor"></i>
						<a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=typography_panel' ) );?>"><?php echo esc_html__('Custom Fonts', 'lovage');?></a>
					</li>

					<li>
						<i class="dashicons-before dashicons-tagcloud"></i>
						<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=layout_panel' ) );?>"><?php echo esc_html__('Header, Footer and Page Layout', 'lovage');?></a>
					</li>

					<li>
						<i class="dashicons-before dashicons-admin-generic"></i>
						<a href="<?php echo esc_url( admin_url( 'customize.php?' ) );?>"><strong><?php echo esc_html__( 'More Theme Options', 'lovage' );?></strong></a>
					</li>
				</ul>
			</div>
		</div>

		<div class="col-2 last">
			<div class="lovage-admin-box">
				
				<h2><?php echo esc_html__( 'Subscribe To Lovage Newsletter', 'lovage' );?></h2>
				<p><?php echo esc_html__( 'Get early to know Lovage theme new features, subscriber-only promotion and tutorials.', 'lovage' );?></p>
			
				<!-- Begin Mailchimp Signup Form -->
				<style type="text/css">
					/* MailChimp Form Embed Code - Classic - 12/17/2015 v10.7 */
					#mc_embed_signup form {display:block; position:relative; text-align:left; padding:10px 0 10px 0}
					#mc_embed_signup input {-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;}
					#mc_embed_signup input[type=checkbox]{-webkit-appearance:checkbox;}
					#mc_embed_signup input[type=radio]{-webkit-appearance:radio;}
					#mc_embed_signup input:focus {border-color:#333;}
				
					#mc_embed_signup .small-meta {font-size: 11px;}
					#mc_embed_signup .nowrap {white-space:nowrap;}

					#mc_embed_signup .mc-field-group {clear:left; position:relative; width:96%; padding-bottom:3%; min-height:30px;}
					#mc_embed_signup .size1of2 {clear:none; float:left; display:inline-block; width:46%; margin-right:4%;}
					* html #mc_embed_signup .size1of2 {margin-right:2%; /* Fix for IE6 double margins. */}
					#mc_embed_signup .mc-field-group label {display:block; margin-bottom:3px;}
					#mc_embed_signup .mc-field-group input {display:block; width:100%; padding:8px 0; text-indent:2%;}
					#mc_embed_signup .mc-field-group select {display:inline-block; width:99%; padding:5px 0; margin-bottom:2px;}

					#mc_embed_signup .datefield, #mc_embed_signup .phonefield-us{padding:5px 0;}
					#mc_embed_signup .datefield input, #mc_embed_signup .phonefield-us input{display:inline; width:60px; margin:0 2px; letter-spacing:1px; text-align:center; padding:5px 0 2px 0;}
					#mc_embed_signup .phonefield-us .phonearea input, #mc_embed_signup .phonefield-us .phonedetail1 input{width:40px;}
					#mc_embed_signup .datefield .monthfield input, #mc_embed_signup .datefield .dayfield input{width:30px;}
					#mc_embed_signup .datefield label, #mc_embed_signup .phonefield-us label{display:none;}

					#mc_embed_signup .indicates-required {text-align:right; font-size:11px; margin-right:4%;}
					#mc_embed_signup .asterisk {color:#e85c41; font-size:150%; font-weight:normal; position:relative; top:5px;}     
					#mc_embed_signup .clear {clear:both;}

					#mc_embed_signup .mc-field-group.input-group ul {margin:0; padding:5px 0; list-style:none;}
					#mc_embed_signup .mc-field-group.input-group ul li {display:block; padding:3px 0; margin:0;}
					#mc_embed_signup .mc-field-group.input-group label {display:inline;}
					#mc_embed_signup .mc-field-group.input-group input {display:inline; width:auto; border:none;}

					#mc_embed_signup div#mce-responses {float:left; top:-1.4em; padding:0em .5em 0em .5em; overflow:hidden; width:90%; margin: 0 5%; clear: both;}
					#mc_embed_signup div.response {margin:1em 0; padding:1em .5em .5em 0; font-weight:bold; float:left; top:-1.5em; z-index:1; width:80%;}
					#mc_embed_signup #mce-error-response {display:none;}
					#mc_embed_signup #mce-success-response {color:#529214; display:none;}
					#mc_embed_signup label.error {display:block; float:none; width:auto; margin-left:1.05em; text-align:left; padding:.5em 0;}

					#mc-embedded-subscribe {clear:both; width:auto; display:block;}
					#mc_embed_signup #num-subscribers {font-size:1.1em;}
					#mc_embed_signup #num-subscribers span {padding:.5em; border:1px solid #ccc; margin-right:.5em; font-weight:bold;}

					#mc_embed_signup #mc-embedded-subscribe-form div.mce_inline_error {display:inline-block; margin:2px 0 1em 0; padding:5px 10px; background-color:rgba(255,255,255,0.85); -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; font-size:14px; font-weight:normal; z-index:1; color:#e85c41;}
					#mc_embed_signup #mc-embedded-subscribe-form input.mce_inline_error {border:2px solid #e85c41;}
					#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
				</style>
				<div id="mc_embed_signup">
				<form action="https://lovage.us3.list-manage.com/subscribe/post?u=79b3860aac3b4d286dd67fc05&amp;id=4048c5b381" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				    <div id="mc_embed_signup_scroll">
					<div class="mc-field-group">
						<input type="email" placeholder="<?php echo esc_html__('Email Adddress', 'lovage');?>" value="<?php bloginfo('admin_email');?>" name="EMAIL" class="required email" id="mce-EMAIL">
					</div>
					<div id="mce-responses" class="clear">
						<div class="response" id="mce-error-response" style="display:none"></div>
						<div class="response" id="mce-success-response" style="display:none"></div>
					</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
				    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_0ef58d553e8e0c1b18d14fd79_f87204d2f4" tabindex="-1" value='' /></div>
				    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button button-primary"></div>
				    </div>
				</form>
				</div>

				<!--End mc_embed_signup-->

			</div>
		</div>

		<?php
	     $lovage_plugins = array(
			  array(
			    'slug' => 'elementor'
			  ),
			  array(
			    'slug' => 'woocommerce'
			  ),
			  array(
			    'slug' => 'contact-form-7'
			  ),
			  array(
			  	'slug' => 'wp-gdpr-compliance'
			  ),
			  array(
			  	'slug' => 'cookie-notice'
			  ),
			  array(
			  	'slug' => 'autoptimize'
			  )
		 );

		 array_merge( $lovage_plugins, apply_filters( 'lovage_add_plugins', array() ) );

		 if(class_exists('Lovage_Plugins_Installer')){
		    Lovage_Plugins_Installer::init($lovage_plugins);
		 }
       ?>

	</div>
</div>