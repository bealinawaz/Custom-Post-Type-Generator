<?php
/*
Plugin Name: Custom Post Type Generator
Plugin URI: http://codeconvolution.com/
description: a plugin to create custom post types
Version: 1.0
Author: Ali Nawaz
Author URI: http://codeconvolution.com/
License: GPL2
*/

/**
* @Defined important variables
*/
define("fep_PluginName", "Front End Publisher");
define("fep_Prefix", "fep");
define("fep_Version", 1.0);
define("fep_post_type", "fep");
define("fep_shortcode", "fep");

#function fep_enqueue_script() { wp_enqueue_script( 'jquery-ui-datepicker', plugin_dir_url( __FILE__ ) . 'js/jquery-ui-datepicker.min.js' ); } add_action('wp_enqueue_scripts', 'fep_enqueue_script');

/**
* @register a custom post type "fep"
*/
function fep_create_post_type() {
	register_post_type( fep_post_type, array( 'labels' => array( 'name' => __( fep_PluginName ), 'singular_name' => __( fep_PluginName ) ), 'public' => true, 'has_archive' => false, ) );
} add_action( 'init', 'fep_create_post_type' );

/**
* @Register Sub Page in fep Custom Piost type "Settings Page"
*/
function fep_admin_menu() {
    add_submenu_page('edit.php?post_type='.fep_post_type, 'Settings', 'Setting', 'manage_options', 'settings', 'fep_settings'); 
} add_action('admin_menu', 'fep_admin_menu'); 

/**
* @Settings Page HTML
*/
function fep_settings() { ?><div class="wrap">
	<h1><?php _e( fep_PluginName.' Setting', fep_Prefix ); ?></h1>
	<p><?php _e( 'Lorem ipsum dolalr', fep_Prefix ); ?></p>
</div><?php }

/**
* @Admin CSS to remove View Post Options
*/
function fep_posttype_admin_css() { global $post_type; $post_types = array( fep_post_type ); if(in_array($post_type, $post_types)) { ob_start(); ?>
    <style type="text/css">#wp-admin-bar-view, #minor-publishing-actions {display: none;}</style>
<?php $output = ob_get_contents(); ob_get_clean(); echo $output; } } add_action( 'admin_head-post-new.php', 'fep_posttype_admin_css' ); add_action( 'admin_head-post.php', 'fep_posttype_admin_css' );

/**
 * Call a function for an array tocreate fields.
 */
function metaBoxClass_ARR() { $data =""; $data = array();
	$data["title1"] = array("type" => "title", "id" => "", "name" => "", "title" => "Create Custom Post");
	$data["divider1"] = array("type" => "divider", "id" => "", "name" => "", "title" => "");
	$data["post_type_name"] = array("type" => "text", "id" => "post_type_name", "name" => "post_type_name", "title" => "Post type. (max. 20 characters, cannot contain capital letters or spaces)");
	$data["fullname"] = array("type" => "text", "id" => "fullname", "name" => "fullname", "title" => "General name for the post type Default is Posts/Pages");
	$data["singular_name"] = array("type" => "text", "id" => "singular_name", "name" => "singular_name", "title" => "Name for one object of this post type. Default is Post/Page");
	$data["slug"] = array("type" => "text", "id" => "slug", "name" => "slug", "title" => "Customize the permalink structure slug. Defaults to the post type value. Should be translatable.");
	$data["description"] = array("type" => "textarea", "id" => "description", "name" => "description", "title" => "A short descriptive summary of what the post type is.");
	$data["supports_title"] = array("type" => "show/hide", "id" => "supports_title", "name" => "supports_title", "title" => "Show title box in the post type or not?");
	$data["supports_editor"] = array("type" => "show/hide", "id" => "supports_editor", "name" => "supports_editor", "title" => "Show Editor box in the post type or not?");
	$data["supports_author"] = array("type" => "show/hide", "id" => "supports_author", "name" => "supports_author", "title" => "Show Author box in the post type or not?");
	$data["supports_thumbnail"] = array("type" => "show/hide", "id" => "supports_thumbnail", "name" => "supports_thumbnail", "title" => "Show featured image in the post type or not?");
	$data["supports_excerpt"] = array("type" => "show/hide", "id" => "supports_excerpt", "name" => "supports_excerpt", "title" => "Show short summary box in the post type or not?");
	$data["supports_trackbacks"] = array("type" => "show/hide", "id" => "supports_trackbacks", "name" => "supports_trackbacks", "title" => "Show trackbacks box in the post type or not?");
	$data["supports_custom_fields"] = array("type" => "show/hide", "id" => "supports_custom_fields", "name" => "supports_custom_fields", "title" => "Show custom fields box in the post type or not?");
	$data["supports_comments"] = array("type" => "show/hide", "id" => "supports_comments", "name" => "supports_comments", "title" => "Show comments box in the post type or not?");
	$data["supports_revisions"] = array("type" => "show/hide", "id" => "supports_revisions", "name" => "supports_revisions", "title" => "Show revisions box in the post type or not?");
	$data["supports_page_attributes"] = array("type" => "show/hide", "id" => "supports_page_attributes", "name" => "supports_page_attributes", "title" => "Show page attributes box in the post type or not?");
	$data["supports_post_formats"] = array("type" => "show/hide", "id" => "supports_post_formats", "name" => "supports_post_formats", "title" => "Show post formats box in the post type or not?");

	$data["title2"] = array("type" => "title", "id" => "", "name" => "", "title" => "Create Custom Post Category");
	$data["divider2"] = array("type" => "divider", "id" => "", "name" => "", "title" => "");
	$data["cat_name"] = array("type" => "text", "id" => "cat_name", "name" => "cat_name", "title" => "The name of the taxonomy. Name should only contain lowercase letters and the underscore character, and not be more than 32 characters long.");
	$data["cat_fullname"] = array("type" => "text", "id" => "cat_fullname", "name" => "cat_fullname", "title" => "General name for the taxonomy, usually plural. Default is 'Categories'.");
	$data["cat_singular_name"] = array("type" => "text", "id" => "cat_singular_name", "name" => "cat_singular_name", "title" => "Name for one object of this taxonomy. Default is 'Category'.");
	$data["cat_slug"] = array("type" => "text", "id" => "cat_slug", "name" => "cat_slug", "title" => "Used as pretty permalink text (i.e. /category/).");

	$data["title3"] = array("type" => "title", "id" => "", "name" => "", "title" => "Create Custom Post Tags");
	$data["divider3"] = array("type" => "divider", "id" => "", "name" => "", "title" => "");
	$data["tag_name"] = array("type" => "text", "id" => "tag_name", "name" => "tag_name", "title" => "The name of the taxonomy. Name should only contain lowercase letters and the underscore character, and not be more than 32 characters long.");
	$data["tag_fullname"] = array("type" => "text", "id" => "tag_fullname", "name" => "tag_fullname", "title" => "General name for the taxonomy, usually plural. Default is 'Tags'.");
	$data["tag_singular_name"] = array("type" => "text", "id" => "tag_singular_name", "name" => "tag_singular_name", "title" => "Name for one object of this taxonomy. Default is 'Tag'.");
	$data["tag_slug"] = array("type" => "text", "id" => "tag_slug", "name" => "tag_slug", "title" => "Used as pretty permalink text (i.e. /tag/).");
return $data; }

/**
 * Calls the class on the post edit screen.
 */
function call_metaBoxClass() { new metaBoxClass(); }
if ( is_admin() ) { add_action( 'load-post.php',     'call_metaBoxClass' ); add_action( 'load-post-new.php', 'call_metaBoxClass' ); }
 
/**
 * The Class.
 */
class metaBoxClass {
    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() { add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) ); add_action( 'save_post',      array( $this, 'save'         ) ); }
 
    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        // Limit meta box to certain post types.
        $post_types = array( fep_post_type );
        if ( in_array( $post_type, $post_types ) ) { add_meta_box('some_meta_box_name', __( fep_PluginName.' Options', fep_Prefix ), array( $this, 'render_meta_box_content' ), $post_type, 'advanced', 'high' ); }
    }
 
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save( $post_id ) {
        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */
        // Check if our nonce is set.
        if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) ) { return $post_id; } $nonce = $_POST['myplugin_inner_custom_box_nonce'];
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) ) { return $post_id; }
 
        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
 
        // Check the user's permissions.
        if ( fep_post_type == $_POST['post_type'] ) { if ( ! current_user_can( 'edit_page', $post_id ) ) { return $post_id; } } else { if ( ! current_user_can( 'edit_post', $post_id ) ) { return $post_id; } }
 
        /* OK, it's safe for us to save the data now. */
		foreach(metaBoxClass_ARR() as $k => $v) {
			if($v["type"] == "title") { continue; }
			if($v["type"] == "divider") { continue; }
			#var_dump($k." - ".$_POST[$v["name"]]);
			$mydata = sanitize_text_field( $_POST[$v["name"]] ); // Sanitize the user input.
			update_post_meta( $post_id, $v["name"], $mydata ); // Update the meta field.
		}
    }

    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {
        wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' ); // Add an nonce field so we can check for it later. // Display the form, using the current value. ?>
		<style type="text/css">
			.row { margin-bottom:30px; } .row:after {  content:""; display:block; clear:both; }
			.row h4 { margin: 0px; font-size: 2em; text-transform: uppercase; line-height: 1; }
			.row label { margin-bottom: 10px; display: block; }
			.row input, .row textarea, .row select { display: block; width: 100%; padding: 5px 10px; line-height: 1.4; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; -ms-box-sizing: border-box; -o-box-sizing: border-box; box-sizing: border-box; }
			.row textarea { min-height:100px; }
		</style>
		<?php foreach(metaBoxClass_ARR() as $k => $v) { /* Use get_post_meta to retrieve an existing value from the database.*/ $value = get_post_meta( $post->ID, $v["name"], true ); ?>
			<div class="row">
				<?php $title = '<label for="'.$v["id"].'">'.$v["title"].'</label>'; ?>
				<?php if($v["type"] == "text") { ?>
					<?php _e( $title ); ?>
					<input type="text" id="<?php echo $v["id"]; ?>" name="<?php echo $v["name"]; ?>" value="<?php echo esc_attr( $value ); ?>" />
				<?php } elseif($v["type"] == "textarea") { ?>
					<?php _e( $title ); ?>
					<textarea id="<?php echo $v["id"]; ?>" name="<?php echo $v["name"]; ?>"><?php echo esc_textarea( $value ); ?></textarea>
				<?php } elseif($v["type"] == "show/hide") { ?>
					<?php _e( $title ); ?>
					<select id="<?php echo $v["id"]; ?>" name="<?php echo $v["name"]; ?>">
						<option <?php selected("show", $value); ?> value="show">Show</option>
						<option <?php selected("hide", $value); ?> value="hide">Hide</option>
					</select>
				<?php } elseif($v["type"] == "divider") { ?>
					<hr style="border-top-style: dashed; border-top-width: 5px; border-top-color: #000;" />
				<?php } elseif($v["type"] == "title") { ?>
					<h4><?php _e( $v["title"], fep_Prefix ); ?></h4>
				<?php } ?>
			</div>
		<?php } ?>

	<?php }
}

/**
* @desc	Update row actions
*/
function fep_remove_row_actions ( $actions ) {
	if( get_post_type() === fep_post_type ) { //remove "fep" post_type to whatever post_type you want the row-actions to hide
		unset( $actions['view'] );	// view
	} return $actions; //return $actions array
} add_filter( 'post_row_actions', 'fep_remove_row_actions', 10, 1 ); // filter row-actions

/*function fep_Shortcode_input_ARR() { return array(); }
function fep_Shortcode_ARR() { return array(); }
function fep_Shortcode( $atts ) { $atts = shortcode_atts( fep_Shortcode_ARR(), $atts ); ob_start(); ?>
	<style type="text/css">
	</style>
<?php $output = ob_get_contents(); ob_get_clean(); return $output; } add_shortcode( fep_shortcode, "fep_Shortcode" );*/

/**
* @Show the Custom Post Types add in fep custom post
*/
function fep_init_post_types() { $loop = array("post_type" => fep_post_type, "post_status" => "publish", "posts_per_page" => -1); $loop = new WP_Query($loop); if($loop->have_posts()) { while($loop->have_posts()) { $loop->the_post(); $postID = $loop->post->ID;

	/*Collect all variables from metabox of fep*/
	$ab = ""; $ab = array(); foreach(metaBoxClass_ARR() as $k => $v) { if(!empty($v["name"])) { $ab[$k] = get_post_meta($postID, $v["name"], true); } }

	/*Array for supports information data*/
	$supports = ""; $supports = array();
	if($ab["supports_title"] == "show") { $supports[] = "title"; }
	if($ab["supports_editor"] == "show") { $supports[] = "editor"; }
	if($ab["supports_author"] == "show") { $supports[] = "author"; }
	if($ab["supports_thumbnail"] == "show") { $supports[] = "thumbnail"; }
	if($ab["supports_excerpt"] == "show") { $supports[] = "excerpt"; }
	if($ab["supports_trackbacks"] == "show") { $supports[] = "trackbacks"; }
	if($ab["supports_custom_fields"] == "show") { $supports[] = "custom-fields"; }
	if($ab["supports_comments"] == "show") { $supports[] = "comments"; }
	if($ab["supports_revisions"] == "show") { $supports[] = "revisions"; }
	if($ab["supports_page_attributes"] == "show") { $supports[] = "page-attributes"; }
	if($ab["supports_post_formats"] == "show") { $supports[] = "post-formats"; }

	if(!empty($ab["post_type_name"]) && !empty($ab["fullname"]) && !empty($ab["singular_name"]) && !empty($ab["slug"])) { #CUSTOM POST TYPE

		/*Create New Custom Post Labels*/
		$labels = array(
			'name'               => _x( $ab["fullname"], 'post type general name', fep_Prefix ),
			'singular_name'      => _x( $ab["singular_name"], 'post type singular name', fep_Prefix ),
			'menu_name'          => _x( $ab["fullname"], 'admin menu', fep_Prefix ),
			'name_admin_bar'     => _x( $ab["singular_name"], 'add new on admin bar', fep_Prefix ),
			'add_new'            => _x( 'Add New', 'book', fep_Prefix ),
			'add_new_item'       => __( 'Add New '.$ab["singular_name"], fep_Prefix ),
			'new_item'           => __( 'New '.$ab["singular_name"], fep_Prefix ),
			'edit_item'          => __( 'Edit '.$ab["singular_name"], fep_Prefix ),
			'view_item'          => __( 'View '.$ab["singular_name"], fep_Prefix ),
			'all_items'          => __( 'All '.$ab["fullname"], fep_Prefix ),
			'search_items'       => __( 'Search '.$ab["fullname"], fep_Prefix ),
			'parent_item_colon'  => __( 'Parent '.$ab["fullname"].':', fep_Prefix ),
			'not_found'          => __( 'No '.$ab["singular_name"].' found.', fep_Prefix ),
			'not_found_in_trash' => __( 'No '.$ab["singular_name"].' found in Trash.', fep_Prefix )
		);

		/*Create New Custom Post options array*/
		$args = array(
			'labels'             => $labels,
			'description'        => __( $ab["description"], fep_Prefix ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $ab["slug"] ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => $supports
		);

		/*Get a new custom post type*/
		$post_type_name = $ab["post_type_name"];
		
		/*Register a new Custom Post Type*/
		register_post_type( $post_type_name, $args);

		if(!empty($ab["cat_name"]) && !empty($ab["cat_fullname"]) && !empty($ab["cat_singular_name"]) && !empty($ab["cat_slug"])) { #CUSTOM TAXONOMY CATEGORY
			
			// Add new taxonomy, make it hierarchical (like categories)
			$labels = array(
				'name'              => _x( $ab["cat_fullname"], 'taxonomy general name', fep_Prefix ),
				'singular_name'     => _x( $ab["cat_singular_name"], 'taxonomy singular name', fep_Prefix ),
				'search_items'      => __( 'Search '.$ab["cat_fullname"], fep_Prefix ),
				'all_items'         => __( 'All '.$ab["cat_fullname"], fep_Prefix ),
				'parent_item'       => __( 'Parent '.$ab["cat_singular_name"], fep_Prefix ),
				'parent_item_colon' => __( 'Parent '.$ab["cat_singular_name"].':', fep_Prefix ),
				'edit_item'         => __( 'Edit '.$ab["cat_singular_name"], fep_Prefix ),
				'update_item'       => __( 'Update '.$ab["cat_singular_name"], fep_Prefix ),
				'add_new_item'      => __( 'Add New '.$ab["cat_singular_name"], fep_Prefix ),
				'new_item_name'     => __( 'New '.$ab["cat_singular_name"].' Name', fep_Prefix ),
				'menu_name'         => __( $ab["cat_singular_name"], fep_Prefix ),
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $ab["cat_slug"] ),
			);

			/*Get a new custom taxonomy*/
			$cat_name = $ab["cat_name"];

			/*Register a new Custom Taxonomy*/
			register_taxonomy( $cat_name, $post_type_name, $args );

		} #CUSTOM TAXONOMY CATEGORY

		if(!empty($ab["tag_name"]) && !empty($ab["tag_fullname"]) && !empty($ab["tag_singular_name"]) && !empty($ab["tag_slug"])) { #CUSTOM TAXONOMY CATEGORY
			
			// Add new taxonomy, make it hierarchical (like categories)
			$labels = array(
				'name'              => _x( $ab["tag_fullname"], 'taxonomy general name', fep_Prefix ),
				'singular_name'     => _x( $ab["tag_singular_name"], 'taxonomy singular name', fep_Prefix ),
				'search_items'      => __( 'Search '.$ab["tag_fullname"], fep_Prefix ),
				'all_items'         => __( 'All '.$ab["tag_fullname"], fep_Prefix ),
				'parent_item'       => __( 'Parent '.$ab["tag_singular_name"], fep_Prefix ),
				'parent_item_colon' => __( 'Parent '.$ab["tag_singular_name"].':', fep_Prefix ),
				'edit_item'         => __( 'Edit '.$ab["tag_singular_name"], fep_Prefix ),
				'update_item'       => __( 'Update '.$ab["tag_singular_name"], fep_Prefix ),
				'add_new_item'      => __( 'Add New '.$ab["tag_singular_name"], fep_Prefix ),
				'new_item_name'     => __( 'New '.$ab["tag_singular_name"].' Name', fep_Prefix ),
				'menu_name'         => __( $ab["tag_singular_name"], fep_Prefix ),
			);

			$args = array(
				'hierarchical'      => false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $ab["tag_slug"] ),
			);

			/*Get a new custom taxonomy*/
			$tag_name = $ab["tag_name"];

			/*Register a new Custom Taxonomy*/
			register_taxonomy( $tag_name, $post_type_name, $args );

		} #CUSTOM TAXONOMY CATEGORY

	} #CUSTOM POST TYPE

} } wp_reset_query(); } add_action( 'init', 'fep_init_post_types', 90 ); ?>