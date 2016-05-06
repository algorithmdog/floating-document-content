<?php
/*
Plugin Name: floating-document-content
Plugin URI: http://algorithmdog.com
Description: floating document conent
Author: lietal
Version: 0.0
Author URI: http://www.algorithmdog.com/关于作者
*/

add_filter('the_content', 'hello_world');
add_filter('the_content', 'test_a');

function test_a($content){
	return $content . "hahah";
}

register_activation_hook(__FILE__, 'hello_world_install');
register_deactivation_hook(__FILE__, 'hello_world_remove');

function hello_world_install(){
	add_option("hello_world_data", 'Default', '', 'yes');
}

function hello_world_remove(){
	delete_option('hello_world_data');
}

function hello_world($content){
	if (is_single()){
		 return $content . '<h1>' .  get_option('hello_world_data') . '</h1>';
	}
	return $content;	
}


if ( is_admin() ){
	add_action('admin_menu', 'hello_world_admin_menu');
	function hello_world_admin_menu(){
		add_options_page('Hello World', 'Hello World', 'administrator', 'hello-world', 'hello_world_html_page');
	}
}
?>
<?php
function hello_world_html_page(){
?>
<div>
<h2> Hello World Options </h2>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<table width="510">
<tr valign="top">
<th width="92" scope="row">输入显示内容</th>
<td width="406">
<input name="hello_world_data" type="text" id="hello_world_data" 
value="<?php echo get_option('hello_world_data'); ?>" />
(ex. Hello World)</td>
</tr>
</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="hello_world_data" />

<p>
<input type="submit" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
<?php
}
?>
