@extends('login.auth')
@section('content')
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                    <div class="col-md-4 hero">
                    	   <h1>JobPlus</h1>
                    	    <p class="tagline">Great Career.Great Life</p>
                    	    <hr>
                    	   <p>Dont have an account yet?</p>
                    	   <a href="{{ url('/register')}}">
                    	   <div class="signup">
                    	  	 <h3>Create account</h3>
                    	   </div>
                    	   </a>

                    </div>
                        <div class="col-sm-6 col-md-offset-1">

                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Login to our site</h3>
	                           	 		<p>Enter username and password to log on:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-key"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="{{ url('/login') }}" method="post" class="login-form">
				                     {{ csrf_field() }}
				                    	<div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
				                    		<label class="sr-only" for="username">Username</label>
				                        	<input type="text" name="username" placeholder="Username..." class="form-username form-control" id="username">
				                        	
				                        	 @if ($errors->has('username'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('username') }}</strong>
		                                    </span>
                              				 @endif
				                        </div>

				                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
				                        	<label class="sr-only" for="password">Password</label>
				                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="password">
				                        </div>

				                            <div class="form-group">
					                            <div class="col-md-6 ">
					                                <div class="checkbox">
					                                    <label>
					                                        <input type="checkbox" name="remember"> Remember Me
					                                    </label>
					                                </div>
					                            </div>
					                        </div>
					                 
					                        <hr>
				                        <button type="submit" class="btn">Sign in!</button>
				                    </form>

			                    </div>
		                    </div>
		                
		        
                        </div>
                       
                    </div>
                    
                </div>
            </div>
        </div>
       
@endsection