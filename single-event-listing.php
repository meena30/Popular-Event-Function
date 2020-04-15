<?php get_header(); ?>

<style>
#menu-item-113 a {color: #da1f3d;}
</style>

<?php

 $post, $wpdb;

    $cur_postid = $post->ID;
    $event_title = get_the_title($cur_postid);
    $fb = "http://www.facebook.com/share.php?u=".$eventurl."&title=".$event_title."";
    $linkedin = "http://www.linkedin.com/shareArticle?mini=true&url=".$eventurl."&title=".$event_title."";
    $twitter = "http://twitter.com/home?status=".$event_title."+".$eventurl."";

    $post_object = get_post( $cur_postid );

?>

<div class="event-content">
        <div class="bg-color Partner-banner position-relative">
          <div class="bottom-bg"></div>
          <div class="container position-relative">
            <div class="top-bg"></div>
            <div class="partner-form-fields events-page-detail">
              <div class="row">
                <div class="col-sm-12">
                      <div class="row">
                      	<div class="col-sm-12 pl-0">

                          <?php
                            while ( have_posts() ) : the_post();

                            setEventViews($post->ID); // function call to get view event count
                            the_content(); // get post content

                            endwhile;
                          ?>

                      		</div>
                        </div>
                      </div>
                    </div>


        </div>
      </div>
    </div>
  </div>
</div>

<?php echo do_shortcode( '[popular_events title="Popular Events" layout="style_one"]' ); ?>
<?php get_footer(); ?>
