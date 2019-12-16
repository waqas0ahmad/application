<div class="login-out">
   <div class="login-in">
      <form class="row" method="post" action="./login.php">
        <div class="col-md-12 text-center form-group">
          <label style="font-size: 45px;border-bottom: 5px solid #738bff;">Login</label>
        </div>
         <div class="col-md-12 form-group">
           <label>Username:</label>
            <input type="text" class="form-control" name="U_NAME" placeholder="e.g. WA201" required/>
         </div>
         <div class="col-md-12 form-group">
           <label>Password:</label>
         <input type="password" class="form-control" name="U_PASS" placeholder="Your password" required/>
         </div>
         <div class="col-md-12">
           <input type="submit" value="Login" class="btn btn-primary button pull-right"/>
         </div>
      </form>
   </div>
</div>
<div role="alert" aria-live="assertive" aria-atomic="true" class="toast " id="toast-error" data-delay="1500"
  data-autohide="true">
  <div class="toast-header bg-danger text-white">
    <i class="glyphicon glyphicon-user"></i>
    <strong class="mr-auto">Error</strong>

    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="alert-danger  toast-body">
    <span id="error"></span>
  </div>
</div>
