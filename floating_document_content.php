<?php
/*
Plugin Name: floating-document-content
Plugin URI: http://algorithmdog.com
Description: floating document conent
Author: lietal
Version: 0.0
Author URI: http://www.algorithmdog.com/关于作者
*/

function floating_document_content( $post_id ) {
	if ( ! wp_is_post_revision( $post_id ) ) {
		remove_action('save_post', 'floating_document_content');

		$post = get_post( $post_id );

		$my_post = [
				'ID' => $post_id,
				'post_content' => $post->post_content . '<br> Fuck '
		];

		wp_update_post( $my_post );

		// re-hook this function
		add_action('save_post', 'floating_document_content');
	}
}
add_action('save_post', 'floating_document_content');
