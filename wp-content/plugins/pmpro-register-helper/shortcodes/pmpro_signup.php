<?php
/*
	This shortcode will show a signup form. It will only show user account fields.
	If the level is not free, the user will have to enter the billing information on the checkout page.
*/
function pmprorh_signup_shortcode($atts, $content=null, $code="")
{
	// $atts    ::= array of attributes
	// $content ::= text within enclosing form of shortcode element
	// $code    ::= the shortcode found, when == callback name
	// examples: [pmpro_signup level="3" short="1" intro="0" button="Signup Now"]

	//make sure PMPro is activated
	if(!function_exists('pmpro_getLevel'))
		return "Paid Memberships Pro must be installed to use the pmpro_signup shortcode.";

	//set defaults
	extract(shortcode_atts(array(
		'button' => "Sign Up Now",
		'intro' => "0",
		'level' => NULL,
		'login' => true,
		'short' => NULL,
		'title' => NULL,
	), $atts));
	
	// set title
	if (isset($title))
		if(!empty($level))
			$title = 'Register For ' . pmpro_getLevel($level)->name;
		else
			
			$title = 'Register For ' . get_option('blogname');
	
	//turn 0's into falses
	if($login === "0" || $login === "false" || $login === "no")
		$login = false;
	else
		$login = true;

	if($short === "0" || $short === "false" || $short === "no")
		$short = false;
	else
		$short = true;

	if($intro === "0" || $intro === "false" || $intro === "no")
		$intro = false;

	// treat this page load as a checkout
	add_filter( 'pmpro_is_checkout', '__return_true' );
	
	// load recaptcha if needed
	if ( ! function_exists( 'pmpro_recaptcha_get_html' ) ) {
		pmpro_init_recaptcha();
	}

	global $current_user, $membership_levels;	
	
	ob_start();
	?>
		<?php if(!empty($current_user->ID) && pmpro_hasMembershipLevel($level,$current_user->ID)) { ?>
			<p><?php printf( esc_html__( 'You are logged in as %s.', 'pmpro-register-helper' ), $current_user->user_login ); ?></p>
		<?php } else { ?>
		<form class="pmpro_form pmpro_signup_form" action="<?php echo pmpro_url("checkout"); ?>" method="post">
			<h2><?php echo esc_html( $title ); ?></h2>
			<?php
				if(!empty($intro))
					echo wp_kses_post( wpautop($intro) );
			?>
			<input type="hidden" id="level" name="level" value="<?php echo esc_attr( $level ); ?>" />
			<?php
				if(!empty($current_user->ID))
				{
					?>
					<p id="pmpro_account_loggedin">
						<?php
						$allowed_html = array(
							'a' => array(
								'href' => array(),
								'target' => array(),
								'title' => array(),
							),
							'strong' => array(),
						);
						echo wp_kses( sprintf( __('You are logged in as <strong>%s</strong>. If you would like to use a different account for this membership, <a href="%s">log out now</a>.', 'pmpro-register-helper'), $current_user->user_login, esc_url( wp_logout_url( $_SERVER['REQUEST_URI'] ) ) ), $allowed_html );
						?>
					</p>
					<?php
				}
				else
				{
					?>
					<div>
						<label for="username"><?php esc_html_e( 'Username', 'pmpro-register-helper' ); ?></label>
						<input id="username" name="username" type="text" class="input" size="30" value="" />
					</div>
					<?php do_action("pmpro_checkout_after_username");?>
					<div>
						<label for="password"><?php esc_html_e( 'Password', 'pmpro-register-helper' ); ?></label>
						<input id="password" name="password" type="password" class="input" size="30" value="" />
					</div>
					<?php if($short) { ?>
						<input type="hidden" name="password2_copy" value="1" />
					<?php } else { ?>
						<div>
							<label for="password2"><?php esc_html_e( 'Confirm Password', 'pmpro-register-helper' ); ?></label>
							<input id="password2" name="password2" type="password" class="input" size="30" value="" />
						</div>
					<?php } ?>
					<?php do_action("pmpro_checkout_after_password");?>
					<div>
						<label for="bemail"><?php esc_html_e( 'E-mail Address', 'pmpro-register-helper' ); ?></label>
						<input id="bemail" name="bemail" type="email" class="input" size="30" value="" />
					</div>
					<?php if($short) { ?>
						<input type="hidden" name="bconfirmemail_copy" value="1" />
					<?php } else { ?>
						<div>
							<label for="bconfirmemail"><?php esc_html_e( 'Confirm E-mail', 'pmpro-register-helper' ); ?></label>
							<input id="bconfirmemail" name="bconfirmemail" type="email" class="input" size="30" value="" />
						</div>
					<?php } ?>
					<?php do_action("pmpro_checkout_after_email");?>
					<div class="pmpro_hidden">
						<label for="fullname"><?php esc_html_e( 'Full Name', 'pmpro-register-helper' ); ?></label>
						<input id="fullname" name="fullname" type="text" class="input" size="30" value="" /> <strong><?php esc_html_e( 'LEAVE THIS BLANK', 'pmpro-register-helper' ); ?></strong>
					</div>

					<div class="pmpro_captcha">
						<?php
							global $recaptcha, $recaptcha_publickey;							
							if($recaptcha == 2 || (!empty($level) && $recaptcha == 1 && pmpro_isLevelFree(pmpro_getLevel($level))))
							{
								echo pmpro_recaptcha_get_html($recaptcha_publickey, NULL, true);
							}
						?>
					</div>
					<?php
				}
			?>
			<div>
				<span id="pmpro_submit_span" >
					<input type="hidden" name="submit-checkout" value="1" />
					<input type="submit" class="pmpro_btn pmpro_btn-submit-checkout" value="<?php echo esc_attr( $button ); ?>" />
				</span>
			</div>
			<?php if(!empty($login) && empty($current_user->ID)) { ?>
			<div style="text-align:center;">
				<a href="<?php echo esc_url( wp_login_url(get_permalink() ) ); ?>"><?php esc_html_e('Log In','pmpro-register-helper'); ?></a>
			</div>
			<?php } ?>
		</form>
		<?php } ?>
	<?php
	$temp_content = ob_get_contents();
	ob_end_clean();
	return $temp_content;
}
add_shortcode("pmpro_signup", "pmprorh_signup_shortcode");
