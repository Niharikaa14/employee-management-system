@extends('employee.layoutss.app')

@section('title')
    List of Tasks
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">

                <div class="card">
                    <div class="card-header">
                        <h3>My Task List</h3>
                    </div>

                    <div class="card-body">
                        <p>Here’s the list of your assigned tasks!</p>
                    </div>

                    <div class="card-body">
                    <div class="table-responsive">
                        <table id="list_employee" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S NO.</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Assigned Date</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
        @foreach($tasks as $key => $task)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->content }}</td>
                <td>{{ $task->date }}</td>
                <td>{{ $task->deadline }}</td>
                <td>{{ $task->status == 1 ? 'Complete' : 'Pending' }}</td>
                <td>
                    <form action="{{ route('employee.task.updateStatus', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" name="status" value="1" class="btn btn-success btn-sm">Complete</button>
                        <button type="submit" name="status" value="0" class="btn btn-warning btn-sm">Pending</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>

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
