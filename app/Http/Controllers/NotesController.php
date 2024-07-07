<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $notes = Auth::user()->notes;
      return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->validate([
        'content' => 'required|string|max:10000',
      ]);

      $note = new Note();
      $note->content = $request->content;
      $note->user_id = Auth::id();
      $note->save();

      Log::create([
          'user_id' => Auth::id(),
          'action' => 'Created note: ' . $note->id,
      ]);

      return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not used
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Not used
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Not used
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $note = Note::find($id);

      if ($note->user_id != Auth::id()) {
        return redirect()->route('notes.index')->with('error', 'Unauthorized action.');
      }

      $note->delete();

      Log::create([
          'user_id' => Auth::id(),
          'action' => 'Deleted note: ' . $note->id,
      ]);

      return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
    }
}
