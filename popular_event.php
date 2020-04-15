<?php

function get_popular_event_fun($atts) {

	$title = $atts['title'];
	$layout = $atts['layout'];
	$sub_title = $atts['sub_title'];

	if($layout == "style_one"){ $ppp = 4; }
	
	global $post, $wpdb, $wp_query;

	$popular_event = '';

	if($layout == "style_one") {  /** get popular events **/

    	$args = array(
			'post_type' => 'event_listing',
			'meta_key' => 'event_views_count',
			'orderby' => 'meta_value_num',
        	'order' => 'DESC',
       		'posts_per_page' => $ppp
       );
	}

	
	$popular_query = new WP_Query( $args );


if($layout == "style_one") {

	$popular_event .='<div class="popular-course event-popularcourse">';

	if($title){
		$popular_event .='<div class="text-center">';
		$popular_event .='<div class="boldheading">'.$title.'</div>';
		$popular_event .='<div class="path"></div>';
		$popular_event .='</div>';
	}

	$popular_event .='<div class="container">';
	$popular_event .='<div class="row">';

}

if($popular_query->have_posts()) :
  while ($popular_query->have_posts()) : $popular_query->the_post();

  $popular_eve_id = get_the_ID();

	$popular_img = wp_get_attachment_image_src( get_post_thumbnail_id( $popular_eve_id), 'large' );
    $pevent_addr = get_post_meta(  $popular_eve_id, '_event_address', true );
    $pevent_stime = get_post_meta(  $popular_eve_id, '_event_start_time', true );
    $pevent_etime = get_post_meta(  $popular_eve_id, '_event_end_time', true );
	$pevent_sdate = get_post_meta(  $popular_eve_id, '_event_start_date', true );

     $post_categories = get_the_terms( $popular_eve_id, 'event_categories' );

     if($layout == "style_one")
     {
		    $popular_event .='<div class="col-sm-3">';
			$popular_event .='<div class="course-list">';
			$popular_event .='<div class="img-sec">';
			$popular_event .='<a href="'.get_permalink( $popular_eve_id ).'"><img src="'.$popular_img[0].'" alt="course-img" class="img-fluid thumbnail"></a>';
			
			$popular_event .='</div>';
			$popular_event .='<div class="row">';
			$popular_event .='<div class="col-sm-12">';
			$popular_event .='<div class="contentslider">';
			$popular_event .='<span class="taglabel">'.$post_categories[0]->name.'</span>';
			$popular_event .='<div class="formheading pb-2"><a href="'.get_permalink( $popular_eve_id ).'">'.get_the_title($popular_eve_id).'</a></div>';
			$popular_event .='<div class="officename pb-1">'.$pevent_addr.'</div>';
			
			$popular_event .='<div class="datetime">'.date('d-m-Y',strtotime($pevent_sdate)).'</div>';
			$popular_event .='</div>';
			$popular_event .='</div>';
			$popular_event .='</div>';
			$popular_event .='</div>';
			$popular_event .='</div>';
	}


endwhile;
endif;

if($layout == "style_one")
  {
	$popular_event .='</div>';
	$popular_event .='</div>';
	$popular_event .='</div>';
}

wp_reset_postdata();
return $popular_event;

}

add_shortcode('popular_events', 'get_popular_event_fun');
?>
