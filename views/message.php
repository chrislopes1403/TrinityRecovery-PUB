
 <!-- ======= Appointment Section ======= -->
 <section id="appointment" class="appointment section-bg" style="margin-top:60px; !important">
    <div class="container">

      <div class="section-title">
        <h2>Send A Message</h2>
        <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
      </div>

      <form action="forms/appointment.php" method="post" role="form" class="php-email-form">
        <div class="row">
          <div class="col-md-4 form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
            <div class="validate"></div>
          </div>
          <div class="col-md-4 form-group mt-3 mt-md-0">
            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
            <div class="validate"></div>
          </div>

         <div class="col-md-4 form-group">
            <select name="doctor" id="doctor" class="form-select">
            <option value="" disabled selected hidden>Please A Doctor</option>
            <?php foreach($params as $item): ?>
              <option value="<?php echo $item['lastname']; ?>"><?php echo $item['lastname']; ?></option>
             
            <?php endforeach; ?>

            </select>
            <div class="validate"></div>
          </div>
        </div>
      
        <div class="form-group mt-3">
          <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
          <div class="validate"></div>
        </div>
        <div class="mb-3">
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
        </div>
        <div class="text-center"><button type="submit">Make an Appointment</button></div>
      </form>

    </div>
  </section><!-- End Appointment Section -->
