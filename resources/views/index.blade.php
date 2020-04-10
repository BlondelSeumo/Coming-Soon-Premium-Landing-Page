<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Coming-Soon</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}"> 
        <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Cantarell|Montserrat|Open+Sans+Condensed:300|Raleway" rel="stylesheet">


        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="{{ asset('js/Extremely-Lightweight-jQuery-Countdown-Timer-Plugin-downCount/jquery.downCount.js') }}"></script> 
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.backstretch.min.js') }}"></script>

    </head>

    <body>
        <div class="pattern"></div>

            <div>
                <div>   
                    <h1 class='homemessage'>{{$home_message->value}}</h1>
                    <h5 class='brandmessage'>{{$brand_message->value}}</h5>

                    <ul class="countdown">
                        <li> <span class="days">00</span>
                            <p class="days_ref">days</p>
                        </li>
                        
                        <li> <span class="hours">00</span>
                             <p class="hours_ref">hours</p>
                        </li>
                        
                        <li> <span class="minutes">00</span>
                            <p class="minutes_ref">minutes</p>
                        </li>
                        
                        <li> <span class="seconds">00</span>
                            <p class="seconds_ref">seconds</p>
                        </li>
                    </ul>

            <!-- =========================
                 Start Subscription Form 
            ============================== -->
                
                    <form id="user-form" method='post'>
                    {{ csrf_field() }}
                        <div>
                            <input type="text" name="name" class=user-detail id="user-name" placeholder="Name:">
                            <input type="text" name="email" class=user-detail id="user-email" placeholder="Email:">
                            <button type="submit" class="btn btn-default subs-btn" name="action">NOTIFY ME!</button>
                        </div> 

                    <!-- SUBSCRIPTION SUCCESSFUL OR ERROR MESSAGES -->
                        
                        <div class="alert alert-success successmessage" style="display:none" role="alert">
                            <strong>you are subscribed successfully!!!</strong>
                        </div>
                   
                        <div >
                            <p class="alert alert-danger warning-message"  style="display:none" role="alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </p>

                        </div>

                    <!-- END ERROR AND SUCCESS MESSAGE -->
                  
                    </form>
            <!-- END SUBSCRIPBE FORM -->

                </div>
            <?php if ($fb_page->value||$tw_page->value||$gplus_page->value || $insta_page->value): ?>
                <ul class="social"> 
                    <?php if ($fb_page->value): ?>
                        <li>
                            <a href="{{$fb_page->value}}" class="fb">
                                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                            </a>
                        </li>
                    <?php endif ?>

                    <?php if ($tw_page->value): ?>
                        <li>
                            <a href="{{$tw_page->value}}" class="tw">
                                <i class="fa fa-twitter-square" aria-hidden="true"></i>
                            </a>
                        </li>       
                    <?php endif ?>
                    
                    <?php if ($gplus_page->value): ?>
                        <li>
                            <a href="{{$gplus_page->value}}" class="google">
                                <i class="fa fa-google-plus-square" aria-hidden="true"></i>
                            </a>
                        </li>  
                    <?php endif ?>
                
                    <?php if ($insta_page->value): ?>   
                        <li>
                            <a href="{{$insta_page->value}}" class="insta">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        </li>
                    <?php endif ?>
                
                </ul>  
            <?php endif ?>
        </div>

        <script>
            $('#user-form').submit(function() {
                var uname = $('#user-name').val();
                var uemail = $('#user-email').val();

                $.post('{{ url('/') }}/', {email: uemail, name: uname, _token: '{{ csrf_token() }}'}, function(res){
                    if (res.success == true) {      
                        $('.successmessage').show(); 
                        $('.warning-message').hide();   
                    }else{
                        var namemessage1 = '';
                        var emailmessage2 = '';
                        
                        if(res.name){
                            namemessage1 = res.name[0] + "<br />";
                        }

                        if(res.email){
                            emailmessage2 = res.email[0];
                        }
                           
                        $('.warning-message').html(namemessage1 + emailmessage2).show();
                        $('.successmessage').hide();
                    }

                });

                return false;
            });
        </script>
       
        <script>$.backstretch("{{ asset('images/backgrounds/' . $image->image) }}");</script>

        <script>
            $('.countdown').downCount({
            date: '{{ $launch_date->value }}',
            offset: +5,
            },);
        </script>

            <h4 class="copyrights"> Copyright &copy; {{ date('Y') }}</h4>
    </body>
</html>
