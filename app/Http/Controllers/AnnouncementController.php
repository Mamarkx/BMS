<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function showAnnounce()
    {
        $announce = Announce::latest()->paginate(3);
        return view('AdminSide.Announcement', compact('announce'));
    }
    public function AddAnnounce(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category'    => 'nullable|string|max:255',
            'attachment'  => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);
        $validatedData['publish_date'] = now();
        if ($request->hasFile('attachment')) {
            $validatedData['attachment'] = $request->file('attachment')->store('documents/announce', 'public');
        }
        Announce::create($validatedData);

        return redirect()
            ->back()
            ->with('success', 'Posted successfully!');
    }
    public function Readmore($id)
    {
        $announcement = Announce::findOrFail($id);
        return view('AdminSide.viewData.readmore', compact('announcement'));
    }
    public function update(Request $request, $id)
    {
        $announcement = Announce::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|max:255',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            // Optional: delete old file
            if ($announcement->attachment) {
                Storage::disk('public')->delete($announcement->attachment);
            }
            $validated['attachment'] = $request->file('attachment')->store('documents/announce', 'public');
        }

        $announcement->update($validated);

        return redirect()->back()->with('success', 'Updated Successfully!');
    }
    public function DeleteAnnounce($id)
    {
        $personnel = Announce::find($id);

        if (!$personnel) {
            return redirect()->back()->with('error', 'Employee not found.');
        }

        $personnel->delete();

        return redirect()->route('Announce')->with('success', 'Deleted Successfully.');
    }
}
