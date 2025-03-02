@extends('employee.layoutss.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">

        <h2 class="my-4">Welcome, {{ $employeeName }}!</h2>
            <div class="row">

                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-midnight-bloom">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Tasks</div>
                                <div class="widget-subheading">{{ $taskCount }} Tasks Assigned To You!</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"> </div>
                            </div>
                        </div>
                    </div>
                </div>

                

                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-midnight-bloom">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">
                                <a href="{{ route('employee.task.list') }}" class="btn btn-primary"
                                style="">SHOW MY TASK</a>
                                </div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"> </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>
@endsection