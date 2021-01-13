<div class="card mb-5" style=" margin:auto; margin-top:100px; width:750px; margin-left:300px;">
  <h1 class="m-3">Register</h1>
  <form  action="" method="post" class="m-5">
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
    <button type="submit" class="btn btn-primary mt-4">Submit</button>
  </form>
</div>