
@extends('admin.layoutss.app')

@section('title')
    Create Task
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Task Create</h5>
                                <a href="{{ route('admin.task.list') }}"
                                   class="btn btn-primary" style="position: absolute; right: 12px; top: 16px;">View List</a>
                                <form id="create_task">
                                    @csrf
                                    
                                    <div class="position-relative form-group">
                                        <label for="employee" class="">List of Employee</label>
                                        <select name="employee" id="employee" class="form-control">
                                            <option value="">Select Employee</option>
                                            @forelse ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @empty
                                                <option value="">Employee list not found</option>
                                            @endforelse
                                        </select>
                                        <span class="text-danger error-text employee_error"></span>
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="title" class="">Title</label>
                                        <input name="title" id="title" placeholder="Enter Task Title" type="text" class="form-control">
                                        <span class="text-danger error-text title_error"></span>
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="content" class="">Content/Description</label>
                                        <textarea name="content" id="content" class="form-control" cols="30" rows="5"></textarea>
                                        <span class="text-danger error-text content_error"></span>
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="date" class="">Publish Date</label>
                                        <input name="date" id="date" type="date" class="form-control">
                                        <span class="text-danger error-text date_error"></span>
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="deadline" class="">Deadline</label>
                                        <input name="deadline" id="deadline" type="date" class="form-control">
                                        <span class="text-danger error-text deadline_error"></span>
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="status" class="">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <span class="text-danger error-text status_error"></span>
                                    </div>

                                    <button type="submit" class="mt-1 btn btn-primary">Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $("#create_task").submit(function(e) {
                e.preventDefault();
                $('.error-text').text(''); // Clear previous errors

                const formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.task.create") }}',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        if (data.success) {
                            alert(data.message);
                            window.location.href = "{{ route('admin.task.list') }}"; // Redirect on success
                        } else {
                            alert(data.message);
                        }
                    },
                    error: (xhr) => {
                        let response = xhr.responseJSON;
                        if (response && response.errors) {
                            $.each(response.errors, function(key, value) {
                                $('.' + key + '_error').text(value[0]); // Show validation errors
                            });
                        } else {
                            alert('Something went wrong! Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endsection
