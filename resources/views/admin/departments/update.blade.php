@extends('admin.layoutss.app')

@section('title')
    Update Department
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Department Update</h5>
                                <a href="{{ route('admin.department.list') }}"
                                            class="btn btn-primary" style="position: absolute; right: 12px; top: 16px;">View List</a>
                                <form class="" id="update_department">
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail" class="">Name</label>
                                        <input name="name" value="{{ $department->name }}" id="emp_name" placeholder="Enter Department Name" type="text"
                                            class="form-control">
                                            <input name="id" value="{{ $department->id }}" id="id" placeholder="Enter Your Name" type="hidden"
                                            class="form-control">
                                    </div>
                                    <button type="submit" class="mt-1 btn btn-primary">Update</button>
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
   $("#update_department").submit( function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route("admin.department.update") }}',
            data: formData,
            dataType:'json',
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success==true){
                    alert(data.message)
                }else{
                    alert(data.message)
                }
            }
        })

    })
       
    </script>
@endsection