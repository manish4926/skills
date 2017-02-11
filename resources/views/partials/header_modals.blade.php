<!-- Popup: Login -->
<!-- Modal -->
<div class="modal fade" id="nav-login-dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="widget-title">Member Login</h3>
        <p>Welcome back, friend. Login to get started</p>
        <hr />
        @foreach ($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
        <div class="social-login">
          <a href="{{ route('facebooklogin') }}">
            <i class="fa fa-facebook fa-lg"></i>
            Login with facebook
          </a>
          <a href="{{ route('googlelogin') }}">
            <i class="fa fa-google-plus fa-lg"></i>
            Login with Google
          </a>
        </div>
        <div class="or_option">
            <span>OR</span>
        </div>
        {!! Form::open(array('route' => 'loginMethod', 'method' => 'post', 'class'=>'', 'data-parsley-validate'=>'')) !!}
            <div class="form-group">
                <label>Email or Username</label>
                <input class="form-control" type="email" name="email" placeholder="User name or email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="pass" placeholder="Your password" id="loginpass" required minlength="5">
            </div>
            <div class="checkbox">
                <label>
                    <input class="i-check" type="checkbox" name="remember" />Remeber Me</label>
            </div>
            <input class="btn btn-primary" type="submit" value="Sign In" />
        {!! Form::close() !!}
        <div class="gap gap-small"></div>
        <ul class="list-inline">
            <li><a data-toggle="modal" data-target="#nav-signup-dialog" onclick="$('#nav-login-dialog').modal('hide');">Not Member Yet</a>
            </li>
            <li><a  href="{{ route('forgotpasswordreset') }}">Forgot Password?</a>
            </li>
        </ul>
      </div>
      
    </div>
  </div>
</div>
<!-- /Popup: Login -->

<!-- Popup: Register -->
<div class="modal fade" id="nav-signup-dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="widget-title">Not A Member? Register Now</h3>
        <p>Ready to get best offers? Let's get started!</p>
        <hr />
        @foreach ($errors->all() as $error)
            <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
        {!! Form::open(array('route' => 'registerMethod', 'method' => 'post', 'class'=>'', 'data-parsley-validate'=>'')) !!}
            <div class="row">
                <div class="col-md-12 col-sm-12">
                <span class="opensans" onclick="change_account_type('1');"><span>Student</span><br /><input name="type" id="rd1" type="radio" value="student" checked="checked"></span>
                <span class="opensans" onclick="change_account_type('2');"><span>Teacher</span><br /><input name="type" id="rd2" type="radio" value="teacher"></span>
                <span class="opensans" onclick="change_account_type('3');"><span>School</span><br /><input  name="type" id="rd3" type="radio" value="school"></span>
                <span class="opensans" onclick="change_account_type('4');"><span>Business Associates</span><br /><input name="type" id="rd4" type="radio" value="business"></span>
                </div>
                <div class="col-md-12 col-sm-12" style="height: 80px;" id="tdiv">
                    <div class="form-group">
                        <label id="tlabel"></label>
                        <input type="text" placeholder="" name="tname" id="tname" class="form-control">
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-6" style="height: 80px;" id="fname">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" placeholder="First Name" name="fname" id="regfirstname" class="form-control">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6" style="height: 80px;" id="lname">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input  type="text" placeholder="Last Name" name="lname" id="reglastname" class="form-control">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6" style="height: 80px;">
                    <div class="form-group">
                        <label>Email</label>
                        <input  type="email" placeholder="Email" name="email" id="regemail" class="form-control" required data-parsley-required></div>
                </div>
                <div class="col-md-6 col-sm-6" style="height: 80px;">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input  type="tel" placeholder="Phone Number" name="phone" id="regphone" class="form-control" required data-parsley-required data-parsley-type="number" data-parsley-minlength="10" data-parsley-maxlength="10"></div>
                </div>  
                <div class="col-md-6 col-sm-6" style="height: 80px;">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" placeholder="Password" name="password" id="pass" class="form-control" required data-parsley-required minlength="5" data-parsley-minlength="5"></div>
                </div> 
                <div class="col-md-6 col-sm-6" style="height: 80px;">
                    <div class="form-group">
                        <label>Repeat Password</label>
                        <input type="password" placeholder="Confirm Password" name="password_confirmation" id="repass" class="form-control" required  data-parsley-required minlength="5" data-parsley-minlength="5" data-parsley-equalto="#pass">
                    </div>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Create Account" />
        {!! Form::close() !!}
        <div class="gap gap-small"></div>
        <ul class="list-inline">
            <li><a data-toggle="modal" data-target="#nav-login-dialog" onclick="$('#nav-signup-dialog').modal('hide');">Already Memeber ? Login Now</a>
            </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- /Popup: Register -->

<!-- Create Gorup -->

<div class="modal fade" id="CreateGroupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  {!! Form::open(['route' => 'creategroup', 'method' => 'post', 'id' => 'frmchange', 'files'=> true, 'form-horizontal', 'class' => '']) !!}

  <div class="modal-dialog" role="document">

    <div class="modal-content">

        <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Create Group</h4>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label>Group Name</label>
                <input name="group_name" type="text" value="" class="form-control">
            </div>
            <div class="form-group">
                <label>Group Description</label>
                <textarea name="description" rows=5 cols=20 class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Group Image:</label>
                <input name="image1" type="file">
                <input name="id" type="hidden" value="">
            </div>
            <div class="form-group">
                <label>Allow users to join the group without confirm?</label>
                <input name="allow_join" type="checkbox" value="1">
            </div>
            <div class="form-group">
                <label>Allow group users to add posts without review?</label>
                <input name="allow_post_public" type="checkbox" value="1">
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Create Group</button>
        </div>
    </div>

  </div>

   {!! Form::close() !!}

</div>

<!-- Modal -->

@push('topscripts')

@endpush