<?php 
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 */

$unique_id = manit_unique_id( 'search-form-' );

?>
<div class="search-widget">
   <form method="get" action="<?php echo esc_url( home_url('/') ); ?>" class="searchform" >
        <div>
           <input type="text" name="s" id="<?php echo esc_attr( $unique_id ); ?>" placeholder="<?php echo esc_attr__( 'Search...','manit' ); ?>">
            <button type="submit"><i class="ti-search"></i></button>
        </div>
    </form>
</div>
