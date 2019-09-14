<?php
/**
 *	Search Result Page Template
 */

if(!isset($_GET['post_type'])){
    if(get_post_type() == 'post'){
	    get_template_part('template-parts/content');
	}
}else{
	if($_GET['post_type'] == 'product'){
	    wc_get_template('archive-product.php');
    }
}

do_action('lovage_search_result');