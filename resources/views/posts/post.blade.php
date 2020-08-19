@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>Post</h1>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <th>No</th>
                <th>Student Name</th>
                <th>Quest Title</th>
                <th>Exp Date</th>
                <th>Complete Date</th>
                <th>Ongoing</th>
                <?php $no = 1; ?>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$post->name}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->exp_date}}</td>
                        <td>{{$post->complete_date}}</td>
                        @if($post->ongoing == 1)
                            <td align="center"><img src="img/ongoing-stamp.png" width="100px"> </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
