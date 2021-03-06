@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>Students Detail</h1>
        <div class="table-responsive">
            <table border="0" class="table table-bordered" id="dataTable">
                <tr>
                    <td>Name</td>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <td>Experience Point</td>
                    <td>{{$exp}}</td>
                </tr>
                <tr>
                    <td>Level</td>
                    @if(Auth::user()->exp <= 20)
                        <td>1</td>
                    @elseif(Auth::user()->exp > 20 && Auth::user()->exp <=40)
                        <td>2</td>
                    @elseif(Auth::user()->exp > 40 && Auth::user()->exp <=60)
                        <td>3</td>
                    @elseif(Auth::user()->exp > 60 && Auth::user()->exp <=80)
                        <td>4</td>
                    @elseif(Auth::user()->exp > 80)
                        <td>5</td>
                    @endif

                </tr>
                <tr>
                    <td colspan="2">Subjects</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <ol>
                        @foreach($subjects as $subject)

                                <li>{{$subject->subject_name}}</li>

                        @endforeach
                        </ol>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Completed Quests</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <ol>
                            @foreach($completed as $complete)

                                <li>{{$complete->title}} (Exp: {{$complete->hr}}/{{$complete->exp}})</li>

                            @endforeach
                        </ol>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">Achievement List</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <ol>
                            @foreach($achievements as $ach)

                                <li>{{$ach->ach_title}} (Reward: +{{$ach->hr_reward}})</li>

                            @endforeach
                        </ol>
                    </td>
                </tr>

            </table>
        </div>
    </div>
@endsection
