@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <div class="row">
        <div class="col-8">
            <h1>Users</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item">Edit User</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update <span style="color:blue;">{{$user->name}} </span>Date</h5>
                    <!-- Floating Labels Form -->
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

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form class="row g-3" method="POST" action="{{route('update.users' , $user->id)}}">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-floating">
                            <input type="text" class="form-control" id="floatingName" name="name" placeholder="Enter Name" value="{{$user->name}}" required>
                            <label for="floatingName">Name</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                            <input type="email" class="form-control" id="floatingName" name="email" placeholder="Enter Email" value="{{$user->email}}" required>
                            <label for="email">Email</label>
                            </div>
                        </div>
                        <!-- <div class="col-md-12">
                            <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            <label for="password">Password</label>
                            </div>
                        </div> -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-control" id="floatingWarehouse" name="warehouse_id" value="{{$user->warehouse_id}}" required>
                                    <option value="">Select Warehouse</option>
                                    @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}" {{ $user->warehouse_id == $warehouse->id ? 'selected' : '' }}>{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingWarehouse">Warehouse</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-control" id="floatingStore" name="store_id" value="{{$user->store_id}}" required>
                                    <option value="">Select Store</option>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}" {{ $user->store_id == $store->id ? 'selected' : ''}}>{{ $store->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingStore">Store</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-control" id="floatingRole" name="role_id" value="{{$user->role_id}}" required>
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingRole">Role</label>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" style="width:40%">Update</button>
                        </div>
                    </form><!-- End floating Labels Form -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

