@extends('layouts.admin')


@section('title','Tasks')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Tasks
                    <a href="{{url('admin/tasks/create')}}" class="btn btn-primary float-end mx-1">
                        Create New Task
                    </a>
                    <a href="{{url('admin/tasks/index')}}" class="btn btn-secondary mx-1  float-end">
                        Back
                    </a>
                    <a href="{{url('admin/tasks/generate')}}" class="btn btn-success float-end mx-1">
                        Generate
                        Report</a>

                </h3>
                <hr>
                <!-- filter -->
                <form class="mt-3" action="" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Filter by Date</label>
                            <input type="date" name="start_date" value="{{ Request::get('start_date') }}" class="form-control" placeholder="From">
                            <input type="date" name="end_date" value="{{ Request::get('end_date') }}" class="form-control" placeholder="To">
                        </div>

                        <div class="col-md-3">
                            <label for="">Filter by Status</label>
                            <select name="status" class="form-select">
                                <option value="">Select All Status</option>
                                <option value="in progress" {{Request::get('status') == 'in progress' ? 'selected' : ''}}>
                                    In progress
                                </option>
                                <option value="completed" {{Request::get('status') == 'completed' ? 'selected' : ''}}>
                                    Completed</option>
                                <option value="pending" {{Request::get('status') == 'pending' ? 'selected' : ''}}>
                                    Pending
                                </option>
                                <option value="urgent" {{Request::get('status') == 'urgent' ? 'selected' : ''}}>
                                    Urgent
                                </option>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <button type="submit" class="btn btn-secondary">Filter</button>
                        </div>

                    </div>
                </form>
            </div>
            <hr>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Assignee</th>
                                <th>Task Description</th>
                                <th>Start Date</th>
                                <th>Status</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tasks as $task)
                            <tr>
                                <td>{{$task->id}}</td>
                                <td>{{$task->user->name}}</td>
                                <td>{{$task->description}}</td>
                                <td>{{\Carbon\Carbon::parse($task->start_date)->format('Y/m/d')}}</td>
                                <td>{{$task->status}}</td>
                                <td>{{\Carbon\Carbon::parse($task->end_date)->format('Y/m/d')}}</td>


                                <td>
                                    <a href="{{url('admin/tasks/'.$task->id.'/edit')}}" class="btn btn-sm btn-secondary">Edit Task</a>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">No Tasks Available</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$tasks->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection