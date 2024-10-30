<?php
/**
 * Plugin Name: Case History
 * Plugin URI: https://www.matteotestoni.it
 * Description: Case History, Case Study per wordpress
 * Version: 1.3.0
 * Author: RSW Studio
 * Author URI: https://www.matteotestoni.it
 * License: GPL2
 */
 
  defined('ABSPATH') or die("No script kiddies please!");
	define( 'casehistory_Version', '1.s.0' );
	define( 'casehistory_Directory', dirname( plugin_basename( __FILE__ ) ) );
	define( 'casehistory_Path', plugin_dir_path( __FILE__ ) );
	define( 'casehistory_URL', plugin_dir_url( __FILE__ ) );

  include 'casehistory_metabox.php';
  include 'casehistory_pluginaggiuntivi.php';
  //include 'casehistory_opzioni.php';
  include 'casehistory_tassonomie.php';
  include 'casehistory_widget.php';
  include 'casehistory_shortcode.php';
  
  load_plugin_textdomain('casehistory', false, basename( dirname( __FILE__ ) ) . '/lang' );

	function casehistory_print(){
		//echo rwmb_meta('casehistory_arredato');
	}
	
	function casehistory_init() {
	  $labels = array(
	    'name' => 'Case History',
	    'singular_name' => 'Case History',
	    'add_new' => 'Aggiungi Case History',
	    'add_new_item' => 'Aggiungi Case History',
	    'edit_item' => 'Modifica',
	    'new_item' => 'Nuova Case History',
	    'all_items' => 'Tutti le Case History',
	    'view_item' => 'Vedi la pagina',
	    'search_items' => 'Cerca',
	    'not_found' =>  'Nessuna Case History trovata',
	    'not_found_in_trash' => 'Nessun Case History trovata nel cestino', 
	    'parent_item_colon' => '',
	    'menu_name' => 'Case History'
	  );
	
	  $args = array(
	    'labels' => $labels,
	    'public' => true, //se è visibile nel pannello admin
	    'publicly_queryable' => true,
	    'show_ui' => true, //should we display an admin panel for this custom post type
	    'show_in_menu' => true, 
	    'query_var' => true,
			'menu_icon' => 'dashicons-book', //parte dalla cartella dove si trova function
			'rewrite' => array( 'slug' => 'casehistory' ), //modifica il permalink con il nome della sezione (es: servizi) //'rewrite' => true,  // 
	    'capability_type' => 'post', //wordpress deve sapere come comportarsi per leggere, editare e cancellare il post - a livello di permessi
	    'has_archive' => true, 
	    'hierarchical' => false, //gerarchico come le pagine
	    'menu_position' => null, //oppure un numero
	    'supports' => array( 'title', 'excerpt', 'editor', 'thumbnail','page-attributes','custom-fields' ) // quali item sono supportati ed inseriti nella pagina add/edit del pannello wp-admin - 'editor', 'author', 'comments' 
	  ); 
	  register_post_type( 'casehistory', $args );
	}
	
	function casehistory_updated_messages( $messages ) {
		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );
		$messages['casehistory'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Case History aggiornata.', 'casehistory' ),
			2  => __( 'Custom field updated.', 'casehistory' ),
			3  => __( 'Custom field deleted.', 'casehistory' ),
			4  => __( 'Case History aggiornata.', 'casehistory' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Case History ripristinata alla revisione %s', 'casehistory' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Case History pubblicata.', 'casehistory' ),
			7  => __( 'Case History salvata.', 'casehistory' ),
			8  => __( 'Case History inviata.', 'casehistory' ),
			9  => sprintf(
				__( 'Case History schedulata per: <strong>%1$s</strong>.', 'casehistory' ),
				date_i18n( __( 'M j, Y @ G:i', 'casehistory' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Bozza Case History aggiornata.', 'casehistory' )
		);
	
		if ( $post_type_object->publicly_queryable ) {
			$permalink = get_permalink( $post->ID );
			$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'Visualizza Case History', 'casehistory' ) );
			$messages[ $post_type ][1] .= $view_link;
			$messages[ $post_type ][6] .= $view_link;
			$messages[ $post_type ][9] .= $view_link;
	
			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Anteprima Case History', 'casehistory' ) );
			$messages[ $post_type ][8]  .= $preview_link;
			$messages[ $post_type ][10] .= $preview_link;
		}
		return $messages;
	}
	
	function casehistory_add_help_text( $contextual_help, $screen_id, $screen ) {
	  if ( 'casehistory' == $screen->id ) {
	    $contextual_help =
	      '<p>' . __('Cose da ricordare in modifica di una Case History:', 'casehistory') . '</p>' .
	      '<ul>' .
	      '<li>' . __('Specifica dettagliatamente in che categorie può essere inserito.', 'casehistory') . '</li>' .
	      '<li>' . __('Speicifica nel titolo la tipologia.', 'casehistory') . '</li>' .
	      '</ul>' .
	      '<p>' . __('Se vuoi schedulare che un annuncio sia pubblicato nel futuro:', 'casehistory') . '</p>' .
	      '<ul>' .
	      '<li>' . __('Sotto il modulo di Pubblica, fare clic sul link Modifica accanto a Pubblica.', 'casehistory') . '</li>' .
	      '<li>' . __('Modificare la data di pubblicazione con una data nel futuro, quindi fare clic su Ok.', 'casehistory') . '</li>' .
	      '</ul>' .
	      '<p><strong>' . __('Per maggiori informazioni:', 'casehistory') . '</strong></p>' .
	      '<p>' . __('http://www.rswstudio.it/worpress/plugin-case-history-per-wordpress/', 'casehistory') . '</p>';
	  } elseif ( 'edit-casehistory' == $screen->id ) {
	    $contextual_help =
	      '<p>' . __('Elenco case history inserite con dettaglio di categoria e visualizzazioni.', 'casehistory') . '</p>' ;
	  }
	  return $contextual_help;
	}
	
	function casehistory_aggiungiattributialcontenuto($content){
    
		$casehisstory_listagalleria=rwmb_meta('casehistory_galleria', 'type=image' );
		if (count($casehisstory_listagalleria)>1){
			$casehistory_galleria="<ul class=\"clearing-thumbs\" data-clearing>";
			foreach ( $casehisstory_listagalleria as $image ){
				$casehistory_galleria.="<li><a href='{$image['full_url']}' title='{$image['title']}'><img src='{$image['url']}' class=\"th\" data-caption='{$image['title']}' alt='{$image['title']}' /></a></li>\n";
			}
			$casehistory_galleria.="</ul>";
		}else{
			$casehistory_galleria="";
		}

		$casehistory_listaallegati=rwmb_meta('casehistory_allegati','type=file');
		if (count($casehistory_listaallegati)>1){
	    $casehistory_allegati="<ul class=\"inline-list\">";
			foreach ( $casehistory_listaallegati as $allegato ){
			  $casehistory_allegati.="<li><a href='{$allegato['url']}' title='{$allegato['title']}' role='button' target='_blank'><i class=\"fa fa-file-pdf-o fa-lg fa-fw\" style=\"color:#CF1312\"></i>{$allegato['title']}</a><li>";
			}
			$casehistory_allegati.="</ul>";
		}else{
			$casehistory_allegati="";
		}

		$casehistory_tabellacaratteristiche="<table cellpadding=\"5\" cellspacing=\"5\" width=\"100%\">";
		$casehistory_tabellacaratteristiche.="</table>";
		
		$content.=" ".$casehistory_galleria.$casehistory_allegati.$casehistory_tabellacaratteristiche;
		return $content;
	}

	add_action('init', 'casehistory_init' );
	add_action('contextual_help', 'casehistory_add_help_text', 10, 3 );		
	add_filter('post_updated_messages', 'casehistory_updated_messages' );
 	
	//add_filter('the_content', 'casehistory_aggiungiattributialcontenuto');
