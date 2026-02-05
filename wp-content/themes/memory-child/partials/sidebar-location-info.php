<div class="nm-sidebar-card nm-nhcp-visit bg-body-tertiary">
    <h2 class="nm-sidebar-title"><?php echo the_field('title','option'); ?></h2>
    <div class="row">
        <div class="col-md-2"><span class="nm-sidebar-icon"><i class="fa-solid fa-location-dot"></i></span></div>
        <div class="col-md-10"><p><?php echo the_field('location_details','option'); ?></p></div>
    </div>
    <div class="row">
        <div class="col-md-2"><span class="nm-sidebar-icon"><i class="fa-solid fa-phone"></i></span></div>
        <div class="col-md-10"><p><?php echo the_field('contact_details','option'); ?></p></div>
    </div>
    <div class="row">
        <div class="col-md-2"><span class="nm-sidebar-icon"><i class="fa-solid fa-envelope"></i></span></div>
        <div class="col-md-10"><p><?php echo the_field('email_details','option'); ?></p></div>
    </div>
</div>