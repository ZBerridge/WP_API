<?php
/**
 * Created by PhpStorm.
 * User: zack
 * Date: 11/18/2018
 * Time: 1:47 PM
 */

if ( ! class_exists('ZB_RestEndpoints')):

    class ZB_RestEndpoints {
        public function __construct()
        {
            $this->addPostRoute();
            $this->addPageRoute();
            $this->addPostsRoute();
        }

        private function addPostRoute(){
            register_rest_route('zb/v1', 'zb-post', array(
                'methods' => 'GET',
                'callback' => array ($this, 'getPostBySlug')
            ));
        }

        public function getPostBySlug(WP_REST_REQUEST $request){
            $post_full = $request['full'];
            if ($post_full === 'true') {
                $zb_post = $this->getPostFull($request);
            } else {
                $zb_post = $this->getPostContent($request);
            }
            return $zb_post;
        }

        private function getPostFull($request){
            $zb_get_post = get_posts( array( 'name' => $request['slug'] ));

            foreach ( $zb_get_post as $post ) :
                $response['slug'] = get_post_field('post_name', $post->ID );
                $has_thumbnail = has_post_thumbnail($post->ID);
                if($has_thumbnail):
                    $response['featured_image'] = get_the_post_thumbnail( $post->ID, 'thumbnail' );
                    $response['featured_image_url'] = get_the_post_thumbnail_url( $post->ID, 'thumbnail' );
                endif;
                $response['post_title'] = get_the_title($post->ID);
                $response['post_date'] = get_the_date('F d, Y', $post->ID);
                $response['post_content'] = $post->post_content;

            endforeach;

            return $response;
        }

        private function getPostContent($request){
            $zb_get_post = get_posts( array( 'name' => $post_slug ) );
            $post_content = $zb_get_post[0]->post_content;
            return $post_content;
        }

        private function addPostsRoute(){
            register_rest_route('zb/v1', 'zb-posts', array(
                'methods' => 'GET',
                'callback' => array ($this, 'getPosts')
            ));
        }

        public function getPosts(WP_REST_REQUEST $request)
        {
            $posts_full = $request['full'];

            if($posts_full === 'true'){
                $zb_post_list = $this->postListingContentFull($request);
            } else {
                $zb_post_list = $this->postListingContent($request);
            }

            return $zb_post_list;
        }

        private function postListingContent($request){

            $count = $request['count'];
            $skip = $request['skip'];

            ob_start();
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $count,
                'offset' => $skip,
                'orderby' => 'post_date',
                'order' => 'DESC'
            );

            $zb_posts = new WP_Query( $args );

            if ( $zb_posts->have_posts() ){
                while( $zb_posts->have_posts() ){
                    $zb_posts->the_post();
                    get_template_part('template-parts/zb-blog-listing');
                }
            }

            return ob_get_clean();
        }

        private function postListingContentFull($request){

            $count = $request['count'];
            $skip = $request['skip'];
            $response = [];
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $count,
                'offset' => $skip,
                'orderby' => 'post_date',
                'order' => 'DESC'
            );
            $posts = get_posts( $args );

            foreach ( $posts as $post ) :
                $response[$post->ID] = the_title();
                $response[$post->ID]['slug'] = get_post_field('post_name', $post->ID );
                $has_thumbnail = has_post_thumbnail($post->ID);
                if($has_thumbnail):
                    $response[$post->ID]['featured_image'] = get_the_post_thumbnail( $post->ID, 'thumbnail' );
                endif;
                $response[$post->ID]['title'] = the_title($post->ID);
                $response[$post->ID]['post_date'] = get_the_date('F d, Y', $post->ID);
                $response[$post->ID]['post_excerpt'] = wp_kses_post( wp_trim_words( $post->post_content, 100, '' ) );

            endforeach;

            return $response;
        }

        private function addPageRoute() {
            register_rest_route('zb/v1', 'zb-page', array(
                'methods' => 'GET',
                'callback' => array ($this, 'getPage')
            ));
        }

        public function getPage(WP_REST_REQUEST $request) {
            $page_id = $request['id'];
            $zb_post = get_post( $page_id );
            return $zb_post;
        }

    }

endif;

function zb_initiate_rest_functions(){
    $rest_functions = new ZB_RestEndpoints();
}

add_action('rest_api_init', 'zb_initiate_rest_functions');
