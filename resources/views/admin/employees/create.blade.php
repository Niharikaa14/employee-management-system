
@extends('admin.layoutss.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Employee Create</h5>
                                <a href="{{ route('admin.employee.list') }}"
                                   class="btn btn-primary" style="position: absolute; right: 12px; top: 16px;">View List</a>

                                <!-- Success & Error Messages -->
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <!-- Display Validation Errors -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Employee Create Form -->
                                <form class="" id="create_emp">
                                @csrf

                                    <div class="position-relative form-group">
                                        <label for="emp_name">Name</label>
                                        <input name="name" id="emp_name" placeholder="Enter Your Name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="department">List of Department</label>
                                        <select name="department" id="department"
                                                class="form-control @error('department') is-invalid @enderror">
                                            <option value="">Select Department</option>
                                            @forelse ($departs as $depart)
                                                <option value="{{ $depart->id }}" {{ old('department') == $depart->id ? 'selected' : '' }}>
                                                    {{ $depart->name }}
                                                </option>
                                            @empty
                                                <option value="">Department not found</option>
                                            @endforelse
                                        </select>
                                        @error('department')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="emp_email">Email</label>
                                        <input name="email" id="emp_email" placeholder="Enter Your Email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="password">Password</label>
                                        <input name="password" id="password" placeholder="Enter your Password"
                                               type="password" class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="emp_dob">Date of Birth</label>
                                        <input name="dob" id="emp_dob" placeholder="Enter Your Date of Birth"
                                               type="date" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
                                        @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="emp_phone">Phone</label>
                                        <input name="phone" id="emp_phone" placeholder="Enter Your Phone" type="text"
                                               class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="emp_city">City</label>
                                        <input name="city" id="emp_city" placeholder="Enter Your City" type="text"
                                               class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}">
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="emp_image">Image</label>
                                        <input name="image" id="emp_image" type="file"
                                               class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
