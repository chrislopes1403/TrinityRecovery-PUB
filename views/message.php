
 <!-- ======= Appointment Section ======= -->
 <section id="appointment" class="appointment section-bg" style="margin-top:60px; !important">
    <div class="container">

      <div class="section-title">
        <h2>Send A Message</h2>
        <p>Send a message to one of our doctors and our team will get back to yo shortly.</p>
      </div>

      <form action="" method="post" role="form" class="php-email-form">
        <div class="row">
          <div class="col-md-4 form-group">
            <input type="text" name="client" class="form-control" id="client" placeholder="Your Name"  data-msg="Please enter at least 4 chars">
            <div class="validate"></div>
          </div>
          <div class="col-md-4 form-group mt-3 mt-md-0">
            <input type="text" class="form-control" name="title" id="title" placeholder="Message Title"  data-msg="Please enter a Title">
            <div class="validate"></div>
          </div>
          <div class="col-md-4 form-group mt-3 mt-md-0">
            <input type="text" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
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
          <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message"></textarea>
          <div class="validate"></div>
        </div>
        <div class="mb-3">
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
        </div>
        <div class="text-center"><button type="submit">Send A Message</button></div>
      </form>

    </div>
  </section><!-- End Appointment Section -->
