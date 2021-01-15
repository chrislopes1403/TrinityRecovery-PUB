<h1>Register</h1>
<form  action="" method="post">
  <div class="form-group">
    <label >Firstname</label>
    <input type="text" name="firstname" class="form-control  <?php echo $model->hasError('firstname') ? ' is-invalid' : '' ?>" >
  </div>
  <div class="form-group">
    <label >Lastname</label>
    <input type="text"name="lastname" class="form-control">
  </div>
  <div class="form-group">
    <label >Email</label>
    <input type="text"name="email" class="form-control">
  </div>
  <div class="form-group">
    <label >Password</label>
    <input type="text"name="password" class="form-control">
  </div>
  <div class="form-group">
    <label >Confirm Password</label>
    <input type="text"name="confirmPassword" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>