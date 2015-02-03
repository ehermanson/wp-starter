<?php
/**
 * The template used for displaying social sharing buttons
 */
?>

<ul class="social-share">
  <h4>Share This</h4>
  <li class="facebook">
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink($post -> ID);?>" >
      <i class="fa fa-facebook"></i>
      <span class="text">facebook</span>
    </a>
  </li>

  <li class="twitter">
    <a href="https://twitter.com/home?status=<?php echo urlencode( get_the_title() . ' - ' . get_permalink() )?>" >
      <i class="fa fa-twitter"></i>
      <span class="text">twitter</span>
    </a>
  </li>

  <li class="googleplus">
    <a href="https://plus.google.com/share?url=<?php the_permalink($post -> ID);?>" >
      <i class="fa fa-google-plus"></i>
      <span class="text">google+</span>
    </a>
  </li>

  <li class="pinterest">
    <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink($post -> ID);?>&amp;media=<?php wp_get_attachment_image_src( get_post_thumbnail_id($post->ID)); ?>&amp;description=<?php echo urlencode( get_the_title() ); ?>">
      <i class="fa fa-pinterest"></i>
      <span class="text">pinterest</span>
    </a>
  </li>
  <li class="email">
    <a href="mailto:?subject=I%20saw%20this%20and%20thought%20of%20you!%20&amp;body=I%20saw%20this%20and%20thought%20of%20you!%20<?php the_permalink($post -> ID);?>">
      <i class="fa fa-envelope"></i>
      <span class="text">email</span>
    </a>
  </li>
</ul>