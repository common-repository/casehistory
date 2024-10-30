<?php
	function casehistory_menu() {
		add_options_page('Case History pagina', 'Case History', 'manage_options', 'casehistory', 'casehistory_opzioni');
	}
	
	function casehistory_opzioni_validate() {
		return true;
	}

  function casehistory_registraopzioni() { // whitelist options
	  register_setting( 'casehistory_opzioni', 'casehistory_facebook' );
	  register_setting( 'casehistory_opzioni', 'casehistory_youtube' );
	  register_setting( 'casehistory_opzioni', 'casehistory_twitter' );
	  register_setting( 'casehistory_opzioni', 'casehistory_agoogleplus' );
	  register_setting( 'casehistory_opzioni', 'casehistory_smtphost' );
	  register_setting( 'casehistory_opzioni', 'casehistory_smtpuser' );
	  register_setting( 'casehistory_opzioni', 'casehistory_smtppassword' );
	}
	
	function casehistory_opzioni() {
		global $casehistory_opzioni;
		?>
		<div class="wrap">
		<div class="icon32" id="icon-tools"><br /></div>
		<h2>Opzioni plugin Case History</h2>
		<p>Inserisci i dati per personalizzare la visualizzazione.</p>
		<form method="post" action="options.php" enctype="multipart/form-data">
			<?php settings_fields('casehistory_opzioni'); ?>
			<?php do_settings_sections('casehistory'); ?>
			<table class="optiontable form-table">
			<tr valign="top">
				<th scope="row" colspan="2"><hr><strong>Configurazioni plugin</strong></th>
			</tr>
			<tr valign="top">
				<th scope="row" colspan="2"><hr><div id="icon-link-manager" class="icon32"></div><strong>Social</strong></th>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="casehistory_facebook">Indirizzo Facebook</label></th>
				<td><input name="casehistory_facebook" type="text" id="casehistory_facebook" value="<?php print(get_option('casehistory_facebook')); ?>" size="40" class="regular-text" />
				<span class="description">Indirizzo del profilo o della pagina FB</span></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="casehistory_youtube">Indirizzo YouTube</label></th>
				<td><input name="casehistory_youtube" type="text" id="casehistory_youtube" value="<?php print(get_option('casehistory_youtube')); ?>" size="40" class="regular-text" />
				<span class="description">Indirizzo canale YouTube</span></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="casehistory_twitter">Indirizzo Twitter</label></th>
				<td><input name="casehistory_twitter" type="text" id="casehistory_twitter" value="<?php print(get_option('casehistory_twitter')); ?>" size="40" class="regular-text" />
				<span class="description">Indirizzo del profilo Twitter</span></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="casehistory_googleplus">Indirizzo Google+</label></th>
				<td><input name="casehistory_googleplus" type="text" id="casehistory_googleplus" value="<?php print(get_option('casehistory_googleplus')); ?>" size="40" class="regular-text" />
				<span class="description">Indirizzo del profilo o della pagina Google+</span></td>
			</tr>
			<tr valign="top">
				<th scope="row" colspan="2"><hr><strong>Configurazioni di invio email</strong></th>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="casehistory_smtphost">host SMTP</label></th>
				<td><input name="casehistory_smtphost" type="text" id="casehistory_smtphost" value="<?php print(get_option('casehistory_smtphost')); ?>" size="40" class="regular-text" />
				<span class="description">Server della posta in uscita</span></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="casehistory_smtpuser">user SMTP</label></th>
				<td><input name="casehistory_smtpuser" type="text" id="casehistory_smtpuser" value="<?php print(get_option('casehistory_smtpuser')); ?>" size="40" class="regular-text" />
				<span class="description">Nome utente per invio posta SMTP</span></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="casehistory_smtppassword">password SMTP</label></th>
				<td><input name="casehistory_smtppassword" type="text" id="casehistory_smtppassword" value="<?php print(get_option('casehistory_smtppassword')); ?>" size="40" class="regular-text" />
				<span class="description">Password per invio posta SMTP</span></td>
			</tr>
			</table>
			<?php submit_button(); ?>
		</form>
		</div>
		<?php
	}

	if ( is_admin() ){ // admin actions
  	add_action( 'admin_menu', 'casehistory_menu' );
	  add_action( 'admin_init', 'casehistory_registraopzioni' );
	}