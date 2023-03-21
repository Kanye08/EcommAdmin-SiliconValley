@extends('layouts.admin')


@section('title','Edit Task')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif

        @if($errors->any())
        <div class="alert alert-warning">
            @foreach($errors->all() as $error)
            <div>{{$error}}</div>
            @endforeach
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3> Edit Task
                    <a href="{{url('admin/tasks')}}" class="btn btn-secondary float-end">
                        Back
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin/tasks/'.$task->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Assignee</label>
                            <!-- <input type="text" name="assignee" value="{{$task->user->name}}" class="form-control"> -->
                            <select name="assignee" class="form-control">
                                <option value="">Select Assignee</option>
                                @foreach ($users as $user)
                                @if ($user->role_as == 1)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Description</label>
                            <input type="text" name="description" value="{{$task->description}}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Start Date</label>
                            <input type="date" value="{{$task->start_date}}" name=" start_date" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Status</label>
                            <input type="text" value="{{$task->status}}" name=" status" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">End Date</label>
                            <input type="date" value="{{$task->end_date}}" name=" end_date" class="form-control">
                        </div>

                        <div class="col-md-12 text-end">

                            <button type="submit" class="btn btn-secondary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection