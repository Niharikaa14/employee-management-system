@extends('admin.layoutss.app')

@section('title')
Attendances
@endsection

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="container">

            <div class="card">
                <div class="card-header">
                    <h3>List of Attendances</h3>
                    <!-- <a href="" class="btn btn-primary"
                        style="position: absolute; right: 12px;">Add Department</a> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="list_department" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>Finish Time</th>
                                    <th>Total Hours</th>
                                </tr>
                            </thead>
                            @foreach ($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->user->name }}</td>
                                <td>{{ $attendance->date }}</td>
                                <td>{{ $attendance->start_time }}</td>
                                <td>{{ $attendance->finish_time }}</td>
                                <td>{{ $attendance->total_hours }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')

@endsection