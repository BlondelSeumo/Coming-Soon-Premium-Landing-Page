@extends('layouts.admin')

@section('content')
<div class="container"></div>
    
        <div class="clearfix">
            <h2 style="margin-top: 0;" class="pull-left"> Subscriber List </h2> 
            <a href="{{url('admin/subscriptions/download')}}" class="pull-right btn btn-danger">
                <span class="glyphicon glyphicon-save"></span>
                download
            </a>
        </div>

    <table class= "table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th style= "width:50px" >S.No</th>
                <th>Name</th>
                <th>Email</th> 
            </tr>
        </thead>
        
        <?php $i = $listsubs->perPage() * ($listsubs->currentPage()-1);?>
            @foreach($listsubs as $listsub)
                <tbody>
                    <tr>
                        <td style="width:50px"> <?php $i++ ?>  {{ $i }}</td>
                        <td>{{ $listsub->name }} </td>
                        <td> {{ $listsub->email }} </td>
                    </tr>
                </tbody>
            @endforeach

    </table>

    <div class="text-center">
        {{ $listsubs->links() }}
    </div>

</div>


@endsection