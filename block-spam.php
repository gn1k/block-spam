<?php

/*
 * Plugin Name: Gn1k Block Spam
 * Description: This is an plugin for block spam - cloudcraft team
 * Author: Nguyen Dinh Hao - cloudcraft team
*/
	// For using current_user_can->wp_get_current_user();
	require_once( ABSPATH . '/wp-includes/pluggable.php' );
	function modify_admin_bar( $wp_admin_bar ) {
		// Add the Parent link.
		// Them admin_url() de khi truy cap Block Spam ben ngoai pham vi trang wp-admin - khong bi redirect sai
		$wp_admin_bar->add_node(
			array(
				'title' => __( 'Block Spam', 'block-spam' ),
				'href'  => admin_url('admin.php?page=blockspam'),
				'id'    => 'block_spam_admin_bar_menu',
			)
		);
	}

	function add_admin_pages() {
		// Title - Name in Wordpress menu left side - User have access - Slug (admin.php?=SLUG) - Function show page - ICON - Order show on left side
		add_menu_page( 'Block Spam', __( 'Block Spam', 'block-spam' ), 'manage_options', 'blockspam', 'show_page', '', 100 );
	}

//----------------------------------------------------------------------
	// Show page
	function show_page() {
	
		if(array_key_exists('button_save_email', $_POST)) {
			update_option('save_email', $_POST['textarea_author']);
			?>
			<div class="wrapper"><div class="submit"><strong>Saved.</strong></div></div>
			<?php
		}
		$input_script = get_option('save_email', '');
		?>
		<html>
		<head>
			<title>Including css</title>
		<link rel="stylesheet" href="https://bluegag.com/wp-content/plugins/block-spam/style.css" type="text/css">
		</head>
		<body>
			<div class="wrapper">
			<section class="group-top">
				<div class="grid-container">
					<div>Block Spam by Cloud craft team.</div>
				</div>
			</section>
			
			<form method="post" action="">

			<section class="group-bot">
				<div class="grid-container-mid">
					<div>Input matching author.</div>
					<textarea name="textarea_author" rows="6"></textarea>
				</div>
			</section>
			<section class="group-bot">
                                <div class="grid-container-bot">
					<input type="submit" name="button_save_author" class="button button-primary" value="Save"></input>
				</div>
                        </section>
				
			<section class="group-bot">
				<div class="grid-container-mid">
					<div>Input matching email.</div>
					<textarea name="textarea_email" rows="6"></textarea>
				</div>
			</section>
			<section class="group-bot">
                                <div class="grid-container-bot">
					<input type="submit" name="button_save_email" class="button button-primary" value="Save"></input>
				</div>
                        </section>
			
			<section class="group-bot">
				<div class="grid-container-mid">
					<div>Input matching URL.</div>
					<textarea name="textarea_url" rows="6"></textarea>
				</div>
			</section>
			<section class="group-bot">
                                <div class="grid-container-bot">
					<input type="submit" name="button_save_url" class="button button-primary" value="Save"></input>
				</div>
                        </section>
			
			<section class="group-bot">
				<div class="grid-container-mid">
					<div>Input matching content.</div>
					<textarea name="textarea_content" rows="6"></textarea>
				</div>
			</section>
			<section class="group-bot">
                                <div class="grid-container-bot">
					<input type="submit" name="button_save_content" class="button button-primary" value="Save"></input>
				</div>
                        </section>
			</form>
			</div>
		</body>
		</html>
		<?php
	}

	//function test() {
	//	$header = get_option('bs_input_scripts', 'none');
	//	print $header;
	//}

	//add_action('wp_head', 'test');

//----------------------------------------------------------------------
	// Add admin page	
	if ( is_multisite() ) {
		add_action( 'network_admin_menu', 'add_admin_pages' );
	} else {
		add_action( 'admin_menu', 'add_admin_pages' );
	}

	if ( current_user_can('manage_options') ) {
		// Admin bar links
		add_action( 'admin_bar_menu', 'modify_admin_bar', 100 );
	}


?>
