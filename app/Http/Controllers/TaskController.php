<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {

        $users = \App\Models\User::where('token', 'admin')->get();

        return view('tasks.create', compact('users'));
        }
        
        public function store(Request $request)
        {
            $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png',
            'guru' => 'required|string',
            'due_date' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['guru'] = $request->input('guru');
        
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/private'), $filename);
            
            $data['attachment'] = $filename;
            }
            
            Task::create($data);
            
            return redirect('/tasks')->with('success', 'Task created successfully.');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        $userAnswer = \App\Models\Answer::where('task_id', $id)
            ->where('email', auth()->user()->email)
            ->first();

        return view('tasks.show', compact('task', 'userAnswer'));
        }
        
        public function edit($id)
        {
        $users = \App\Models\User::where('token', 'admin')->get();

        $task = Task::findOrFail($id);
    
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'attachment' => 'nullable|string',
            'guru' => 'required|string',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());

        return redirect('/tasks')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/tasks')->with('success', 'Task deleted successfully.');
    }

    public function showAttachment($filename)
    {   
        $this->authorizeDownload();
        $path = storage_path('app/private/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }  

        return response()->file($path);
    }

    public function showAnswerAttachment($filename)
    {   
        $this->authorizeDownload();
        $path = storage_path('app/private/answer/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }  

        return response()->file($path);
    }

    private function authorizeDownload()
    {
        $user = Auth::user();
        if ($user->token !== 'admin' && $user->token !== 'siswa' && $user->token !== 'guru') {
            abort(403, 'Unauthorized');
        }
    }

    public function answer($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.answer', compact('task'));
    }

    public function storeAnswer(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->answers()->create($request->all());
        return redirect('/tasks')->with('success', 'Task updated successfully.');
    }

    public function deleteAnswer($id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();

        return redirect()->back()->with('success', 'Answer deleted successfully.');
    }
}
