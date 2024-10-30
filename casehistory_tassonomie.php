<?php
  /* categorie*/
	function casehistory_tassonomia_categoria() {
		$labels = array(
			'name'              => __( 'Categorie', 'taxonomy general name' ),
			'singular_name'     => __( 'Categorie', 'taxonomy singular name' ),
			'search_items'      => __( 'Cerca categoria' ),
			'all_items'         => __( 'Tutte le categorie' ),
			'parent_item'       => __( 'Categoria padre' ),
			'parent_item_colon' => __( 'Categoria padre:' ),
			'edit_item'         => __( 'Modifica categoria' ), 
			'update_item'       => __( 'Aggiorna categoria' ),
			'add_new_item'      => __( 'Aggiungi nuova categoria' ),
			'new_item_name'     => __( 'Nome della nuova categoria' ),
			'menu_name'         => __( 'Categorie' ),
		);
		$args = array(
			'labels' => $labels,
			'hierarchical' => true,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'show_in_nav_menus'     => true,
		);
		register_taxonomy( 'casehistory_cat', 'casehistory', $args );
	}
	add_action( 'init', 'casehistory_tassonomia_categoria', 0 );
	
	function casehistory_tassonomia_tag() {
		$labels = array(
			'name'              => __( 'Tag', 'taxonomy general name' ),
			'singular_name'     => __( 'Tag', 'taxonomy singular name' ),
			'search_items'      => __( 'Cerca tag' ),
			'all_items'         => __( 'Tutte i tag' ),
			'parent_item'       => __( 'Tag padre' ),
			'parent_item_colon' => __( 'Tag padre:' ),
			'edit_item'         => __( 'Modifica tag' ), 
			'update_item'       => __( 'Aggiorna tag' ),
			'add_new_item'      => __( 'Aggiungi nuovo tag' ),
			'new_item_name'     => __( 'Nome del tag' ),
			'menu_name'         => __( 'Tag' ),
			'not_found'         => __( 'Nessun Tag Case History trovato' ),
		);
		$args = array(
			'labels' => $labels,
			'hierarchical' => true,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'show_in_nav_menus'     => true,
		);
		register_taxonomy( 'casehistory_tag', 'casehistory', $args );
	}
	add_action( 'init', 'casehistory_tassonomia_tag', 0 );