<?php
function return_marker_arrays( )
{
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'markers',
      'fields' => 'ids',

    );

    $post_IDs = get_posts( $args );

    foreach ( $post_IDs as $post_key => $post_id ) {
      $get_all_posts = get_post_meta( $post_id , '' , true);
      $get_images = get_the_post_thumbnail_url( $post_id );
      //print_r( $get_all_posts );
      foreach ($get_all_posts as $key => $value) {
        //print_r($value[0]);
        $markers_array[$key] = $value[0];
      }
      $filtered_post_meta[$post_key] = $markers_array;
      $img_array[$post_key] = $get_images;
    }


    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'markers',

    );

    $post_fields = get_posts( $args );

    foreach ( $filtered_post_meta as $post_key => $post_value ) {

      $combined_array[$post_key] = array_merge( $post_value , (array)$post_fields[$post_key], (array)$img_array[$post_key] );

    }

    //$encode = json_encode( $combined_array );
    //print_r( $combined_array );
    //return $combined_array;

    //$fields = return_marker_arrays();
    foreach ( $combined_array as $key => $value ) {
/*
      if (  isset( $value['latitude'] ) && isset( $value['longitude'] )) {
        $cordinates['coordinates'] = array( $value['longitude'] , $value['latitude'] );
      }
*/
      if (  isset( $value['ID'] ) ) {
        $id['id'] = $value['ID'];
      }
      if (  isset( $value['post_content'] ) ) {
        $post_content['popupContent'] = $value['post_content'];
      }
      if (  isset( $value['post_title'] ) ) {
        $post_title['title'] = $value['post_title'];
      }
      if (  ! empty( $value['author_name'] ) ) {
        $author_name = $value['author_name'];
      }
      if (  isset( $value['author_email'] ) ) {
        $author_email['author_email'] = $value['author_email'];
      }
      if (  isset( $value[0] ) ) {
        $image['thumbnail'] = $value[0];
      }
      if (  isset( $value['guid'] ) ) {
        $marker_url['url'] = $value['guid'];
      }
      //print_r(  $value['author_name'] );

      $filtered_array[] = //array(

          array(
            'title' => $post_title['title'],
            'url' => $marker_url['url'],
            'id' => $id['id']
          );





    }
    $encode = json_encode( $filtered_array );
    return $filtered_array;
    //print_r( $filtered_array );


}


function return_cordinates( )
{
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'markers',
      'fields' => 'ids',

    );

    $post_IDs = get_posts( $args );

    foreach ( $post_IDs as $post_key => $post_id ) {
      $get_all_posts = get_post_meta( $post_id , '' , true);
      $get_images = get_the_post_thumbnail_url( $post_id );
      //print_r( $get_all_posts );
      foreach ($get_all_posts as $key => $value) {
        //print_r($value[0]);
        $markers_array[$key] = $value[0];
      }
      $filtered_post_meta[$post_key] = $markers_array;
      $img_array[$post_key] = $get_images;
    }


    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'markers',

    );

    $post_fields = get_posts( $args );

    foreach ( $filtered_post_meta as $post_key => $post_value ) {

      $combined_array[$post_key] = array_merge( $post_value , (array)$post_fields[$post_key], (array)$img_array[$post_key] );

    }

    foreach ( $combined_array as $key => $value ) {

      if (  isset( $value['latitude'] ) && isset( $value['longitude'] )) {
        $cordinates[] = array( 'lat' => $value['latitude'] , 'lng' => $value['longitude'] );
      }

    }
    $encode = json_encode( $cordinates );
    return $encode;
    //print_r( $filtered_array );


}
