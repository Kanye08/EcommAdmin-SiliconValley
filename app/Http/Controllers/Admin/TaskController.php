<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class TaskController extends Controller
{

    public function index(Request $request)
    {


        $tasks = Task::query();

        // filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $tasks->whereBetween('start_date', [$start_date, $end_date]);
        }

        // filter by status
        if ($request->has('status')) {
            $status = $request->status;
            $tasks->where('status', 'LIKE', '%' . $status . '%');
        }

        $tasks = $tasks->paginate(10);

        return view('admin.tasks.index', compact('tasks'));
    }


    public function create()
    {
        $users = User::where('role_as', 1)->get();
        return view('admin.tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [

                'assignee' => ['required', 'string'],
                'description' => ['required', 'string', 'max:255'],
                'start_date' => ['required', 'date'],
                'status' => ['required', 'string'],
                'end_date' => ['required', 'date'],
            ]
        );

        Task::create([

            'assignee' => $request->assignee,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'status' => $request->status,
            'end_date' => $request->end_date
        ]);

        return redirect('admin/tasks')->with('message', 'Task Created Successfully!');
    }

    public function edit(int $taskId)
    {
        $task = Task::findOrFail($taskId);
        $users = User::where('role_as', 1)->get();
        return view('admin.tasks.edit', compact('task', 'users'));
    }

    // update
    public function update(Request $request, int $taskId)
    {
        $validated = $request->validate(
            [
                'assignee' => ['required', 'string'],
                'description' => ['required', 'string', 'max:255'],
                'start_date' => ['required', 'date'],
                'status' => ['required', 'string'],
                'end_date' => ['required', 'date'],
            ]
        );
        Task::findOrFail($taskId)->update([
            'assignee' => $request->assignee,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'status' => $request->status,
            'end_date' => $request->end_date
        ]);

        return redirect('admin/tasks')->with('message', 'Task Updated Successfully!');
    }

    public function generateTask()
    {
        $tasks = Task::paginate(10);
        $data = ['tasks' => $tasks];

        $todayDate = Carbon::now()->format('d-m-Y');
        $pdf = Pdf::loadView('admin.tasks.index', $data);
        return $pdf->download('task-' . $todayDate . '.pdf');
    }
}
