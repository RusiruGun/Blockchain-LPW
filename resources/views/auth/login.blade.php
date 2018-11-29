<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="css/signin.css" rel="stylesheet">

    </head>
    <body class="text-center">
                   
                                    <form class="form-signin" method="POST" action="{{ route('login') }}">
                                            <img class="mb-4" src="https://lankaplywood.lk/wp-content/uploads/2018/05/Lanka-Plywood-Logo.png" alt="">
                                            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                                            {{ csrf_field() }}
                
                                            <label for="email" class="sr-only">E-Mail Address</label>
                                            <input id="email" type="email" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}" required autofocus>
                
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                           
                                      
                
                                            <label for="password" class="sr-only">Password</label>
                
                                           
                                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                        
                
                                        
                                                <div class="checkbox mb-3">
                                                    <label>
                                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                    </label>
                                                </div>
                                            
                                     
                                                <button type="submit" class="btn btn-lg btn-primary btn-block">
                                                    Login
                                                </button>
                
                                                <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
                                       
                                    </form>
                                </div>
               
                

    </body>
</html>
