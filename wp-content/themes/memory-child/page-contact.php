<?php

/**
 * Template Name: Contact Us
 * Description: A custom template to display the About using an ACF relationship field.
 */
acf_form_head();
get_header();


?>
<style>
  .contact-us__form input[type="text"],
  .contact-us__form input[type="email"],
  .contact-us__form textarea {
    padding: 15px !important;
  }

  .contact-us__form input[type="submit"] {
    background: #68471F !important;
    color: #fff !important;
    margin-top: 15px !important;
  }
</style>
<div class="container contact-us">
  <div class="row g-4 justify-content-between">

    <!-- LEFT: FORM -->
    <div class="col-lg-7 contact-us__form">
      <h5 class="mb-5 display-5 ">
        Fill in the form below and send us your message.<br>
        We will get back to you as soon as possible.
      </h5>

      <?php
      if (isset($_GET['success']) && $_GET['success'] == 'true') {

        echo '<h1 style="color:var(--GREEN-100, #00984B); text-align:center; margin:4rem 0;font-size:36px">Thank you! Your message has been sent successfully. We’ll get back to you soon.</h1>';
        echo '<style> #acf-form { display:none } </style>';
      ?>

      <?php } else { ?>
      <?php

        $date = date('M-d-Y');
        acf_form(array(
          'post_id' => 'new_post',
          'field_groups' => array(
            'group_699b995c29595',
          ),
          'new_post' => array(
            'post_type' => 'contact-us',
            'post_title' => 'Subscriber as of ' . $date . '',
            'post_status' => 'publish',
          ),
          'return' => add_query_arg('success', 'true', get_permalink()),
          'submit_value' => __('Submit', 'acf'),
        ));
      } ?>
    </div>

    <!-- RIGHT: INFO CARD -->
    <div class="col-lg-4 ">
      <div class="card shadow-sm h-100">
        <div class="card-body ps-5 pe-5 pt-3  pb-5">
          <h2 class="card-title mb-5 mt-5 display-3">Visit the NHCP!</h2>

          <!-- Address -->
          <p class="d-flex align-items-start mb-5">
            <i class="fa-solid fa-location-dot me-2 mt-1 fa-fw"></i>
            <span>
              <strong>Serafin D. Quiason Resource Center</strong><br>
              Ground Floor, NHCP Building,<br>
              T.M. Kalaw St., Ermita, Manila, 1000<br>
              Opens Monday to Friday<br>
              8:00 am to 4:00 pm
            </span>
          </p>

          <!-- Phone -->
          <p class="d-flex align-items-start mb-5">
            <i class="fa-solid fa-phone me-2 mt-1 fa-fw"></i>
            <span>
              (02) 5335-1200<br>
              (02) 5335-1214<br>
              telefax +632 8536 3181
            </span>
          </p>

          <!-- Email -->
          <p class="d-flex align-items-start">
            <i class="fa-solid fa-envelope me-2 mt-1 fa-fw"></i>
            <span>
              info@nhcp.gov.ph<br>
              library@nhcp.gov.ph
            </span>
          </p>

        </div>
      </div>
    </div>


  </div>
</div>



<?php get_footer(); ?>