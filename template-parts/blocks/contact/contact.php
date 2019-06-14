<?php
/**
 * Block Name: Contact
 *
 * This is the template that displays the contact form block.
 */

$message_success = get_field('message_succes');
$text_bouton_send = get_field('texte_bouton_send');
$color_ = get_field('color_');
$color_text_bouton_send = get_field('color_text_bouton_send');
$color_hover = get_field('color_hover');
$size_font_sent_message = get_field('size_font_sent_message');
$to = get_field('to');

//get the current page slug for the redirect after form sending
global $wp;
$current_slug = add_query_arg( array(), $wp->request );

?>
<div id="contactAlert" >

	<?php if (isset($_GET['success'])) {
	  $datas = $_GET['success']; ?>
	  <div class="alert-message success">
	    <span><?php echo $message_success; ?></span></br>
	  </div>
	<?php }

	if(array_key_exists('errors', $_SESSION)):
	  if (isset($_GET['errors'])) {
	    $datas = $_GET['errors']; ?>
	    <div class="alert-message error">
	      <span><?php echo $datas; ?></span>
	    </div>
	  <?php }

	endif; ?>

</div>

<div class="form1">

  <?php if( have_rows('input') ): ?>
    <form action="#" id="contactForm" method="post">
    <?php wp_nonce_field('contact-form', 'contact-verif');
    // loop through the rows of data
    while ( have_rows('input') ) : the_row();
	  // display a sub field value
	  $label = get_sub_field('label');

            switch ($label) {
              case 'name': ?>
                <label for="name">name</label>
            <input type="text" name="name" id="name" value="<?= isset($_SESSION['input']['name']) ? $_SESSION['input']['name']:'';   ?>" /><?php
                break;
               case 'email': ?>
                <label for="email">email</label>
            <input type="email" name="email" id="email" value="<?= isset($_SESSION['input']['email']) ? $_SESSION['input']['email']:'';   ?>" /><?php
                break;
              case 'phone': ?>
                <label for="phone">phone</label>
                <input type="text" name="phone" id="phone" value="<?= isset($_SESSION['input']['phone']) ? $_SESSION['input']['phone']:'';   ?>" /><?php
                break;
               case 'url': ?>
                <label for="url">url</label>
                <input type="url" name="url" id="url" value="<?= isset($_SESSION['input']['url']) ? $_SESSION['input']['url']:'';   ?>" /><?php
                break;
               case 'subject': ?>
                <label for="subject">subject</label>
                <input type="text" name="subject" id="subject" value="<?= isset($_SESSION['input']['subject']) ? $_SESSION['input']['subject']:'';   ?>" /><?php
                break;
              default: ?>
                <label for="subject">Message</label>
        <textarea name="message" id="message" rows="20" cols="30"><?= isset($_SESSION['input']['message']) ? $_SESSION['input']['message']:'';   ?></textarea><?php
                break;
            }

      endwhile; ?>
      <button id="submit" type="submit"><?php echo $text_bouton_envoi; ?></button>
      <input type="hidden" name="to" id="to" value="<?php echo $to; ?>" />
      <input type="hidden" name="current_slug" id="current_slug" value="<?php echo $current_slug; ?>" />
  </form>
</div>
<?php else :

    // no rows found

endif;
unset($_SESSION['errors']);
unset($_SESSION['input']);

?>

<style type="text/css">	
* {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

.form1 input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

.form1 input[type=email], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

.form1 input[type=url], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

.form1 input[type=tel], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

textarea {
  height: 150px;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

.container {
  padding: 20px;
}

.alert-message.error {
  background-color: red;
  padding: 10px;
  line-height: 2em;
}

.alert-message span {
  color: white;
}
.form1 button {
  background-color: <?php echo $color_; ?>;
  color:  <?php echo $color_text_bouton_send; ?>;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
  margin-top: 10px;
  font-size: <?php echo $size_font_sent_message; ?>px;
}

.form1 button:hover {
  background-color: <?php echo $color_hover; ?>;
}

.alert-message.success {
  background-color: <?php echo $color_; ?>;
  padding: 10px;
  line-height: 2em;
}

</style>
