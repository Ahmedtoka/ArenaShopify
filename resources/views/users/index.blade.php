@extends('layouts.app')
@section('content')
    <div class="pagetitle">
        <div class="row">
            <div class="col-8">
                <h1>Users</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item">Users</li>
                    </ol>
                </nav>
            </div>
            <div class="col-4">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td><a href="{{ route('user.create') }}" style="float:right"
                                    class="btn btn-success">Create User</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users List</h5>
                        {{-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> --}}
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Store</th>
                                    <th scope="col">Warehouse</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->role ? $user->role->name : 'NA' }}</td>
                                        <td>{{ $user->store ? $user->store->name : 'NA' }}</td>
                                        <td>{{ $user->warehouse ? $user->warehouse->name : 'NA' }}</td>
                                        <td>{{ date('Y-m-d', strtotime($user->created_at)) }}</td>
                                        <td><a href="{{ route('edit.user' , $user->id) }}"
                                                class="btn btn-secondary">Edit</a>
                                            <form action="{{route('destroy.user', $user->id)}}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                csrf_field()
                                                method_field('DELETE')
                                                <button type="submit" class="btn btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $("ul#operation").siblings('a').attr('aria-expanded', 'true');
        $("ul#operation").addClass("show");
        $("#products").addClass("active");
    </script>
@endsection
