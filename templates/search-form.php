<?php

// Custom Search Form

?>

<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
  <div class="search-field">
    <label class="screen-readers">Search For:</label>
    <input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search" placeholder="Search...">
  </div>
</form>