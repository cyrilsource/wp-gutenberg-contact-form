<?php
//register an acf block contact form
function my_acf_contactForm() {
  // check function exists
  if( function_exists('acf_register_block') ) {
    // register a contact form block
    acf_register_block(array(
    'name'            => 'contact',
    'title'           => __('Contact Form'),
    'description'     => __('A contact form'),
    'render_template' => 'template-parts/blocks/contact/contact.php',
    'category'        => 'common',
    'icon'            => 'email-alt',
    'keywords'        => array( 'contact'),
    'mode'			      => 'preview',
    'enqueue_assets' 	=> function(){
      wp_enqueue_style( 'block-contact', get_template_directory_uri() . '/template-parts/blocks/contact/contact.css', array(), '1.0.0' );
      }
    ));
  }
}

//treatment contact form
function contact_form() {

  if (isset($_POST['submitted']) && isset($_POST['contact-verif']))  {

      if (wp_verify_nonce($_POST['contact-verif'], 'contact-form')) {

          $errors = [];

          if (isset($_POST['nom'])) {
            if(!array_key_exists('nom', $_POST) || $_POST['nom'] == '') {
                $errors['nom'] = "You forgot your name";
            }
          }

          if (isset($_POST['email'])) {
            if(!array_key_exists('email', $_POST) || $_POST['email'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
              $errors['email'] = "invalid email";
            }
          }

          if (isset($_POST['téléphone'])) {
            if(!array_key_exists('téléphone', $_POST) || $_POST['téléphone'] == '' || !preg_match("#[0-9]#", $_POST['téléphone'])) {
                $errors['téléphone'] = "no valid phone";
            }
          }

          if (isset($_POST['site web'])) {
            if(!array_key_exists('site web', $_POST) || $_POST['site web'] == '' || !filter_var($_POST['site web'], FILTER_VALIDATE_URL)) {
              $errors['site web'] = "no valid web site";
            }
          }

          if (isset($_POST['message'])) {
            if(!array_key_exists('message', $_POST) || $_POST['message'] == '') {
                $errors['message'] = "You forgot the message";
            }
          }

          if (!empty($errors)) {

              $datas = implode(" / ", $errors);

              session_start();
              $_SESSION['errors'] = $errors;
              $_SESSION['input'] = $_POST;

              wp_redirect( esc_url( add_query_arg( 'errors', $datas, home_url().'/contact' ) ) );

              exit();

          }
          else {
              $element = $_POST['contact-verif'];
              unset($_POST[array_search($element, $_POST)]);
              $element2 = $_POST['_wp_http_referer'];
              unset($_POST[array_search($element2, $_POST)]);
              $element3 = $_POST['submitted'];
              unset($_POST[array_search($element3, $_POST)]);
              $to = $_POST['to'];
              //we get off the recipient in the array
              unset($_POST['to']);

              $datas = implode(" / ", $_POST);

              $sent_ok = mail($to, 'message from contact form', $datas);

              if ($sent_ok==true) {
                wp_redirect( esc_url( add_query_arg( 'success', home_url().'/contact' ) ) );
              }
              else{
                wp_redirect( esc_url( add_query_arg( 'error', 'something is wrong', home_url().'/contact' ) ) );
              }

              exit();
          }

      }

  }
}
add_action('template_redirect', 'contact_form');
