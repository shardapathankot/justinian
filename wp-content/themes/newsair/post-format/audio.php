<?php
/**
 * The template for displaying the Gallery content.
 * @package Newsair
 */
 
if (!function_exists('newsair_audio_format')) :
        function newsair_audio_format()
        { ?>
<div class="audio">
    <?php 
    $post_id = get_the_ID();
    $audio = get_children( array('post_parent' => $post_id->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'audio' ) ); ?>
    <?php if ( empty( $audio ) ) : ?>
    <?php else : ?>
    <?php foreach ( $audio as $attachment_id => $attachment ) : ?>


    <div class="player">
        <audio controls>
            <source src="<?php echo wp_get_attachment_url( $attachment_id, 'full' ); ?>" type="audio/mpeg">
        </audio>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php } endif; ?>