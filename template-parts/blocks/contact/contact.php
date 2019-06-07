<?php
/**
 * Block Name: Contact
 *
 * This is the template that displays the contact form block.
 */

$message_succes = get_field('message_de_succes');
$text_bouton_envoi = get_field('texte_bouton_envoi');
$couleur_ = get_field('couleur_');
$couleur_texte_bouton_envoi = get_field('couleur_texte_bouton_envoi');
$couleur_hover = get_field('couleur_hover');
$taille_de_la_font_du_message_denvoi = get_field('taille_de_la_font_du_message_denvoi');
$to = get_field('to');

if (isset($_GET['success'])) {
  $datas = $_GET['success']; ?>
  <div class="alert-message success">
    <span><?php echo $message_succes; ?></span></br>
    <span><strong><?php echo $datas; ?></strong></span>
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

<div class="form1">

  <?php if( have_rows('input') ): ?>
       <form action="#" id="contactForm" method="post">
        <?php wp_nonce_field('contact-form', 'contact-verif');
    // loop through the rows of data
      while ( have_rows('input') ) : the_row();

          // display a sub field value
          $label = get_sub_field('label');

            switch ($label) {
              case 'nom': ?>
                <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
            <input type="text" name="<?php echo $label; ?>" id="<?php echo $label; ?>" value="<?= isset($_SESSION['input']['nom']) ? $_SESSION['input']['nom']:'';   ?>" /><?php
                break;
               case 'email': ?>
                <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
            <input type="email" name="<?php echo $label; ?>" id="<?php echo $label; ?>" value="<?= isset($_SESSION['input']['email']) ? $_SESSION['input']['email']:'';   ?>" /><?php
                break;
              case 'téléphone': ?>
                <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
                <input type="text" name="<?php echo $label; ?>" id="<?php echo $label; ?>" value="<?= isset($_SESSION['input']['téléphone']) ? $_SESSION['input']['téléphone']:'';   ?>" /><?php
                break;
               case 'site web': ?>
                <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
                <input type="url" name="<?php echo $label; ?>" id="<?php echo $label; ?>" value="<?= isset($_SESSION['input']['site web']) ? $_SESSION['input']['site web']:'';   ?>" /><?php
                break;
               case 'sujet': ?>
                <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
                <input type="text" name="<?php echo $label; ?>" id="<?php echo $label; ?>" value="<?= isset($_SESSION['input']['sujet']) ? $_SESSION['input']['sujet']:'';   ?>" /><?php
                break;
              default: ?>
                <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
        <textarea name="<?php echo $label; ?>" id="<?php echo $label; ?>" rows="20" cols="30"><?= isset($_SESSION['input']['message']) ? $_SESSION['input']['message']:'';   ?></textarea><?php
                break;
            }

      endwhile; ?>
      <input type="hidden" name="action" value="contact" />
			<?php wp_nonce_field('ajax_contact_nonce', 'security');?>
      <button id="submit" type="submit"><?php echo $text_bouton_envoi; ?></button>
      <input type="hidden" name="submitted" id="submitted" value="true" />
      <input type="hidden" name="to" id="to" value="<?php echo $to; ?>" />
  </form>
</div>
<?php else :

    // no rows found

endif;
unset($_SESSION['errors']);
unset($_SESSION['input']);

?>

<style type="text/css">
.form1 button {
  background-color: <?php echo $couleur_; ?>;
  color:  <?php echo $couleur_texte_bouton_envoi; ?>;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
  margin-top: 10px;
  font-size: <?php echo $taille_de_la_font_du_message_denvoi; ?>px;
}

.form1 button:hover {
  background-color: <?php echo $couleur_hover; ?>;
}

.alert-message.success {
  background-color: <?php echo $couleur_; ?>;
  padding: 10px;
  line-height: 2em;
}

</style>
