<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Task;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{
    public function answer($id)
    {
        $task = Task::findOrFail($id);

        return view('answers.create', compact('task'));
    }

    public function storeAnswer(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'email' => 'required|email',
            'status' => 'nullable',
            'nama_tugas' => 'required',
            'pesan' => 'required',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,png,jpeg,xls,xlsx,ppt,pptx',
            'status' => 'nullable',
        ]);

        $data = $request->all();
        $data['task_id'] = $id;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/private/answer'), $filename);
            $data['attachment'] = $filename;
        }

        Answer::create($data);

        return redirect('/tasks')->with('success', 'Jawaban berhasil dikirim!');
    }

    public function markAsRead($id)
    {
        $answer = Answer::findOrFail($id);
        $answer->update(['status' => 'Telah Dibaca']);
        
        return redirect()->back()->with('success', 'Jawaban berhasil ditandai sebagai telah dibaca.');
    }

    public function listAnswer($id)
    {
        $task = Task::findOrFail($id);

        $answers = Answer::where('task_id', $id)->get();

        return view('tasks.listAnswer', compact('task', 'answers'));
    }

    public function showTheAnswer($id)
    {
        $answer = Answer::findOrFail($id);
        return view('answers.show', compact('answer'));
    }

    public function deleteAnswer($id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();
        return redirect()->back()->with('success', 'Jawaban berhasil dihapus.');
    }

    public function showMyAnswer($id)
    {
        $answer = Answer::where('task_id', $id)
            ->where('email', auth()->user()->email)
            ->firstOrFail();

        return view('answers.show', compact('answer'));
    }
}
