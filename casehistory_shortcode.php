<?php
  add_shortcode('casehistory_ultimecasehistoryinserite', 'casehistory_ultimecasehistoryinserite' );
  
  function casehistory_ultimecasehistoryinserite(){
		$casehistory_strReturn="<h2>Ultime Case History inserite</h2>";
		$casehistory_args = array('posts_per_page' =>10,'post_type' => 'casehistory');
		$casehistory_ultimecasehistoryinserite = get_posts($casehistory_args);
		foreach( $casehistory_ultimecasehistoryinserite as $casehistory ){
			$casehistory_strReturn.="<p>".get_the_date('j F Y',$casehistory["ID"])."</p>";
			$casehistory_strReturn.="<a href=\"".get_permalink($casehistory["ID"])."\">".$casehistory["post_title"]."</a><hr>";
		}
	
		return $strReturn;
	}
