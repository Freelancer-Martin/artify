<?php
/**
 * Calls the class on the post edit screen.
 */
function call_someClass() {
    new someClass();
}

if ( is_admin() ) {
    add_action( 'load-post.php',     'call_someClass' );
    add_action( 'load-post-new.php', 'call_someClass' );
}

/**
 * The Class.
 */
class someClass {

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post',      array( $this, 'save'         ) );
    }

    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        // Limit meta box to certain post types.
        $post_types = array( 'places' );

        //if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'some_meta_box_name',
                __( 'Marker Info', 'textdomain' ),
                array( $this, 'render_meta_box_content' ),
                $post_type,
                'advanced',
                'high'
            );
        //}
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
        if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) ) {
            return $post_id;
        }

        $nonce = $_POST['myplugin_inner_custom_box_nonce'];

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) ) {
            return $post_id;
        }

        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check the user's permissions.
        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }

        /* OK, it's safe for us to save the data now. */

        // Sanitize the user input.
        //$mydata = sanitize_text_field( $_POST['myplugin_new_field'] );
        $latitude = sanitize_text_field( $_POST['latitude'] );
        $longitude = sanitize_text_field( $_POST['longitude'] );
        $author_name = sanitize_text_field( $_POST['author_name'] );
        $author_email = sanitize_text_field( $_POST['author_email'] );
        $wiki_test_select = sanitize_text_field( $_POST['wiki_test_select'] );
        $submitted_address = sanitize_text_field( $_POST['submitted_address'] );

        // Update the meta field.
        //update_post_meta( $post_id, '_my_meta_value_key', $mydata );
        update_post_meta( $post_id, 'latitude', $latitude );
        update_post_meta( $post_id, 'longitude', $longitude );
        update_post_meta( $post_id, 'author_name', $author_name );
        update_post_meta( $post_id, 'author_email', $author_email );
        update_post_meta( $post_id, 'wiki_test_select', $wiki_test_select );
        update_post_meta( $post_id, 'submitted_address', $submitted_address );
    }


    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );

        // Use get_post_meta to retrieve an existing value from the database.
        //$value = get_post_meta( $post->ID, '_my_meta_value_key', true );
        $latitude = get_post_meta ( $post->ID, 'latitude', true );
      	$longitude = get_post_meta ( $post->ID, 'longitude', true );
      	$author_name = get_post_meta ( $post->ID, 'author_name', true );
      	$author_email = get_post_meta ( $post->ID, 'author_email', true );
        $wiki_test_select = get_post_meta ( $post->ID, 'wiki_test_select', true );
        $submitted_address = get_post_meta ( $post->ID, 'submitted_address', true );
        $address = get_post_meta ( $post->ID, 'address', true );

        //print_r( $submitted_address );
        //print_r( $address );



        // Display the form, using the current value.


        ?>
        <label class="alignleft" style="color: black;"  for="latitude">
            <?php _e( 'Latitude', 'textdomain' ); ?>
        </label>
        <input type="text" id="latitude" name="latitude" value="<?php echo esc_attr( $latitude ); ?>" size="25" /></br>

        <label class="alignleft" style="color: black;" for="longitude">
            <?php _e( 'Longitude', 'textdomain' ); ?>
        </label>
        <input type="text" class="alignleft" id="longitude" name="longitude" value="<?php echo esc_attr( $longitude ); ?>" size="25" /></br>

        <label class="alignleft" style="color: black;" for="author_name">
            <?php _e( 'Author Name', 'textdomain' ); ?>
        </label>
        <input type="text" class="alignleft" id="author_name" name="author_name" value="<?php echo esc_attr( $author_name ); ?>" size="25" /></br>

        <label class="alignleft" style="color: black;" for="author_email">
            <?php _e( 'Author Email', 'textdomain' ); ?>
        </label>
        <input type="text" class="alignleft" id="author_email" name="author_email" value="<?php echo esc_attr( $author_email ); ?>" size="25" /></br>

        <label class="alignleft"  style="color: black;" for="author_email">
            <?php _e( 'Premission', 'textdomain' ); ?>

        </label>
        <input type="text" class="alignleft" id="wiki_test_select" name="wiki_test_select" value="<?php echo esc_attr( $wiki_test_select ); ?>" size="25" /></br>

        <label class="alignleft"  style="color: black;" for="submitted_address">
            <?php _e( 'Aaddress', 'textdomain' ); ?>

        </label>
        <input type="text" class="alignleft" id="submitted_address" name="submitted_address" value="<?php echo esc_attr( $submitted_address ); ?>" size="25" /></br>
        <?php
    }
}
