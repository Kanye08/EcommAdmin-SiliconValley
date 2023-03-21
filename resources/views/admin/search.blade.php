@extends('layouts.admin')
@section('title','Search Results')
@section('content')

<div class="row">
    <h2 class="mb-3">Search Results: </h2>
    <hr>

    @if ($orders->count())
    <div class="table-responsive table-striped mb-3">
        <h3>Orders</h3>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->fullname }}</td>
                    <td>{{ $order->status_message }}</td>
                    <td>{{ $order->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    {{ $orders->appends(request()->query())->links() }}
    @endif

    @if ($products->count())
    <div class="table-responsive table-striped mb-3">
        <h3>Products</h3>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price ?? '' }}</td>
                    <td>{{ $product->status ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $products->appends(request()->query())->links() }}
    @endif

    @if ($categories->count())
    <div class="table-responsive table-striped mb-3">
        <h3>Categories</h3>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $categories->appends(request()->query())->links() }}
    @endif

    @if ($tasks->count())
    <div class="table-responsive table-striped mb-3">
        <h3>Tasks</h3>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Assignee</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->assignee }}</td>
                    <td>{{ $task->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $tasks->appends(request()->query())->links() }}
    @endif

    @if ($brands->count())
    <div class="table-responsive table-striped mb-3">
        <h3>Brands</h3>
        <hr>
        <table class="table table-bordered table-striped">
            @foreach ($brands as $brand)
            <tr>
                <td>Brands</td>
                <td>{{ $brand->name }}</td>
                <td>{{ $brand->description }}</td>
                <td></td>
                <td></td>
                <!-- <td><a href="">View</a></td> -->
            </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@if ($users->count())
<div class="row">
    <h2>Users</h2>
    <hr>
    <div class="table-responsive table-striped mb-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date Created</th>
                    <th>Status</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>Users</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td></td>
                    <!-- <td><a href="">View</a></td> -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@if ($orders->count() || $products->count() || $categories->count() || $tasks->count() || $brands->count() ||
$users->count())
<div class="row">
    {{ $orders->appends(request()->query())->links() }}
    {{ $products->appends(request()->query())->links() }}
    {{ $categories->appends(request()->query())->links() }}
    {{ $tasks->appends(request()->query())->links() }}
    {{ $brands->appends(request()->query())->links() }}
    {{ $users->appends(request()->query())->links() }}
</div>
@endif
</div>
@endsection