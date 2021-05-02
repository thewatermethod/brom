
<?php


    $rest_route = '/wp/v2/posts';


    while ( have_posts() ){

        the_post();


        if( is_single() ) {
            
            $content_type = 'posts';

            if( get_post_type() == 'page' ) {
                $content_type = 'pages';
            }

            $rest_route = '/wp/v2/' . $content_type .'/' . get_the_ID();
        }

        $request = new WP_REST_Request( 'GET', $rest_route );
        $response = rest_do_request( $request );
         
        if ( $response->is_error() ) {
            // Convert to a WP_Error object.
            $error = $response->as_error();
            $message = $response->get_error_message();
            $error_data = $response->get_error_data();
            $status = isset( $error_data['status'] ) ? $error_data['status'] : 500;
            wp_die( printf( '<p>An error occurred: %s (%d)</p>', $message, $error_data ) );
        }
         
        $data = $response->get_data();
        echo json_encode($data);


    }
    



