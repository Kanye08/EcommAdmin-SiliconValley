@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        @if(session('message'))
        <p class="alert alert-success">{{session('message')}}</p>
        @endif
        <div class="me-md-3 me-xl-5">
            <h2>Welcome Admin,</h2>
            <p class="mb-md-0">Project Silicon Valley.</p>
            <hr>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label for="">Total Categories</label>
                    <h1>{{$totalCategories}}</h1>
                    <a href="{{url('admin/category')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label for="">Total Brands</label>
                    <h1>{{$totalBrands}}</h1>
                    <a href="{{url('admin/brands')}}" class="text-white">View</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label for="">Total Products</label>
                    <h1>{{$totalProducts}}</h1>
                    <a href="{{url('admin/products')}}" class="text-white">View</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label for="">Total Orders</label>
                    <h1>{{$totalOrders}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                </div>
            </div>

            <hr>

            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label for="">Total Users</label>
                    <h1>{{$totalAllUsers}}</h1>
                    <a href="{{url('admin/users')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label for="">Users</label>
                    <h1>{{$totalUsers}}</h1>
                    <a href="{{url('admin/users')}}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-secondary text-white mb-3">
                    <label for="">Admin</label>
                    <h1>{{$totalAdmin}}</h1>
                    <a href="{{url('admin/users')}}" class="text-white">View</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-body bg-secondary text-white mb-3">
                    <label for="">Completed Orders</label>
                    <h1>{{$totalCompletedOrders}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                </div>
            </div>
            <hr>

            <div class="col-md-3">
                <div class="card card-body bg-secondary text-white mb-3">
                    <label for="">Tasks</label>
                    <h1>{{$totalTasks}}</h1>
                    <a href="{{url('admin/tasks')}}" class="text-white">View</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-body bg-secondary text-white mb-3">
                    <label for="">Pending Tasks</label>
                    <h1>{{$totalPendingTasks}}</h1>
                    <a href="{{url('admin/tasks')}}" class="text-white">View</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-body bg-secondary text-white mb-3">
                    <label for="">Completed Tasks</label>
                    <h1>{{$totalCompletedTasks}}</h1>
                    <a href="{{url('admin/tasks')}}" class="text-white">View</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-body bg-secondary text-white mb-3">
                    <label for="">Pending Orders</label>
                    <h1>{{$totalPendingOrders}}</h1>
                    <a href="{{url('admin/tasks')}}" class="text-white">View</a>
                </div>
            </div>



        </div>

    </div>
</div>

@endsection