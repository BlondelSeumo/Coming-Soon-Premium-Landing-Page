@extends('layouts.admin')

@section('content')
    
    <!-- start .flash-message -->
    <div class="flash-message flashmessage">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            
            @if(Session::has('alert-' . $msg))
                
                <p style="text-align: center;" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            
            @endif

        @endforeach
    </div> <!-- end .flash-message -->

    <form method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label> 
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                    Upload Image 
                </label>
                
                <div class="push-left">
                    <input type="file" name="filetoupload">
                </div>  
            </div>
         
            <div class="form-group">
                <div>
                    <label> 
                        <i class="fa fa-picture-o"></i>
                        Set Background Image
                    </label>
                </div>
                <div class="push-left">
                    @foreach($images as $image)
                        <label class="bg-selector" style="background-image: url({{ asset('images/backgrounds/' . $image->image) }})">
                            <input class="radiobutton" {{ $image->active ? 'checked="checked"' : ''}} type="radio" name="background" value="{{ $image->id }}" />

                            <a href="{{ url('admin/background/delete', [$image->id]) }}">
                                <i class="glyphicon glyphicon-trash deleteicon" ></i>
                            </a>
                        </label>
                    @endforeach
                </div>
            </div>
       
            <div class="form-group">
                <label>
                    <i class="glyphicon glyphicon-time"></i>
                    Set Count Down
                </label>
                <div class="push-left">
                    <div class="calender">
                        <input style="text-align: center;" type="text" name="date" value= "{{$launch_date->value}}" placeholder="Please select date" class="datepicker form-control" >
                    </div>
                </div>
            </div>
            
            <script>
                $('.datepicker').datepicker({
                startDate: new Date(),
                autoclose:true
                });
            </script>

        <div class="form-group">
            <label>
                <i class="fa fa-pencil-square-o"></i>
                Set Homepage Message:
            </label>
            <div class="push-left">
                <input type="text" name="homemessage" value="{{$home_message->value}}" class=form-control placeholder="Enter your message here!!">      
            </div>
        </div>

        <div class="form-group">
            <label>
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                Set Brand Message:
            </label>
            <div class="push-left">
                <input type="text" name="brandmessage" value="{{$brand_message->value}}" class=form-control placeholder="Enter your brand message here!!">
            </div>
        </div>
        
        <div class="form-group">
            <label>
                <i class="fa fa-facebook-official"></i>
                Facebook
            </label>
            <div class="push-left">
                <input class="form-control" type="text" value="{{$fb_page->value}}" name="facebook_page">
            </div>

        </div>
        <div class="form-group">
            <label>
            <i class="fa fa-twitter-square"></i>
                Twitter
            </label>
            <div class="push-left">
                <input class="form-control" type="text" value="{{$tw_page->value}}" name="twitter_page">
            </div>
        </div>
        <div class="form-group">
            <label>
                <i class="fa fa-google-plus-square"></i>
                Google+
            </label>
            <div class="push-left">
                <input class="form-control" type="text" value="{{$gplus_page->value}}" name="gplus_page">
            </div>
        </div>
        <div class="form-group">
            <label>
            <i class="fa fa-instagram" aria-hidden="true"></i>
                Instagram
                </label>
            <div class="push-left">
                <input class="form-control" type="text" value="{{$insta_page->value}}" name="instagram_page">
            </div>
        </div>

        <input type="submit" value="Update It !" class="btn btn-default updatebutton" />
   </form>

@endsection
