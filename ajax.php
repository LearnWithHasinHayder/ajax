<?php
/**
 * Plugin Name: Ajax 
 * Description: A simple plugin to demonstrate how to use AJAX in WordPress
 * Version: 1.0
 * Author: Hasin Hayder
 * Author URI: http://hasin.me
 */

class Ajax_Examples {
    public function __construct() {
        add_action('init', [$this, 'init']);
    }

    function init() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wp_ajax_contact', [$this, 'contact']);
        add_action('wp_ajax_backup', [$this, 'backup']);
        add_action('wp_ajax_comic', [$this, 'comic']);

        add_action('wp_ajax_nopriv_backup', [$this, 'backup']);
        
    }

    function comic(){
        check_ajax_referer('comic');
        $number = $_POST['number'];
        $response = wp_remote_get("https://xkcd.com/{$number}/info.0.json");
        $body = wp_remote_retrieve_body($response);
        echo ($body);
        wp_die();
    }

    function contact(){
        // return wp_send_json($_POST);
        // echo "Ok".$_POST['name'];
        // wp_die();

        check_ajax_referer('contact');
        // if(!wp_verify_nonce($_POST['nonce'], 'contact1')){
        //     return wp_send_json(['error' => 'Nonce is invalid']);
        // }

        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        // return wp_send_json([
        //     'email' => $email,
        //     'subject' => $subject,
        //     'message' => $message
        // ]);

        // wp_mail('admin@academy.local', $subject, $message, ['From' => $email]);
    }

    function backup(){
        echo "Backup is in progress. Please wait...";
        wp_die();
    }

    function enqueue_scripts() {
        //tailwindcss cdn
        // wp_enqueue_script('tailwindcss', '//cdn.tailwindcss.com', [], '1.0');

        $ajax_url = admin_url('admin-ajax.php');
        $nonce = wp_create_nonce('contact');
        $comic_nonce = wp_create_nonce('comic');

        if(is_page('contact')){
            wp_enqueue_style('ajax-css', plugin_dir_url(__FILE__) . 'assets/css/form.css');
            wp_enqueue_script('ajax-js', plugin_dir_url(__FILE__) . 'assets/js/main.js', ['jquery'], '1.0', true);
            wp_localize_script('ajax-js', 'ajax_object', [
                'ajax_url' => $ajax_url,
                'nonce' => $nonce,
                'comic_nonce' => $comic_nonce
            ]);
        }
        
    }

}


new Ajax_Examples();