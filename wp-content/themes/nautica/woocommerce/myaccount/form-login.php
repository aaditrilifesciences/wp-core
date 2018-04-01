<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.6
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="row" id="customer_login">

	<div class="col-md-6 col-sm-6 col-xs-12">

<?php endif; ?>

		<h2><?php esc_html_e( 'Sign in', 'woocommerce' ); ?></h2>

		<form method="post" class="login" role="form">

			<?php do_action( 'woocommerce_login_form_start' ); ?>
			<div class="wc-login-form-container">
				<p class="form-group form-row form-row-wide">
					<label for="username" class="wc_login_label"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text form-control" autocomplete="off" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
				</p>
				<p class="form-group form-row form-row-wide">
					<label for="password" class="wc_login_label"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input class="input-text form-control" autocomplete="off" type="password" name="password" id="password" />
				</p>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<p class="form-group form-row">
					<?php wp_nonce_field( 'woocommerce-login' ); ?>
					<label for="rememberme" class="inline pull-left wc_rememberme">
						<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'woocommerce' ); ?>
					</label>
					<a class="pull-right wc-lost-pass" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>

				</p>
				<p>
					<input type="submit" class="button btn btn-primary" name="login" value="<?php esc_html_e( 'Login now', 'woocommerce' ); ?>" />
				</p>
			</div>
			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>


<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="col-md-6 col-sm-6 col-xs-12">

		<h2><?php esc_html_e( 'Create a new account', 'woocommerce' ); ?></h2>

		<form method="post" class="register widget" role="form">
			<?php do_action( 'woocommerce_register_form_start' ); ?>
			<div class="wc-login-form-container">
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
					<p class="form-group form-row form-row-wide">
						<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="text" autocomplete="off" class="input-text form-control" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					</p>

				<?php endif; ?>

				<p class="form-group form-row form-row-wide">
					<label for="reg_email" class="wc_login_label"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="email" autocomplete="off" class="input-text form-control" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="form-group form-row form-row-wide">
						<label for="reg_password" class="wc_login_label"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="password" autocomplete="off" class="input-text form-control" name="password" id="reg_password" />
					</p>

				<?php endif; ?>

				<!-- Spam Trap -->
				<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php esc_html_e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

				<?php do_action( 'woocommerce_register_form' ); ?>
				<?php do_action( 'register_form' ); ?>

				<p class="form-group form-row">
					<?php wp_nonce_field( 'woocommerce-register' ); ?>
					<input type="submit" class="button btn btn-primary" name="register" value="<?php esc_html_e( 'Sign up', 'woocommerce' ); ?>" />
				</p>
			</div>
			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>
		<h2><?php esc_html_e( 'SIGN UP TODAY AND YOU\'LL BE ABLE TO', 'nautica' ); ?></h2>
		<ul class="wc-register-able">
			<li><i class="fa fa-check"></i> <?php esc_html_e( 'Speed your way through the checkout.', 'nautica' ); ?></li>
			<li><i class="fa fa-check"></i> <?php esc_html_e( 'Track your orders easily.', 'nautica' ); ?></li>
			<li><i class="fa fa-check"></i> <?php esc_html_e( 'Keep a record of all purchases.', 'nautica' ); ?></li>
		</ul>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>