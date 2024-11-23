<?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Machine;
// use Illuminate\Support\Facades\Storage;
// use App\Models\Event;

// class AdminMachineController extends Controller
// {
//     public function index()
//     {
//         $machines = Machine::all();
//         return view('adminDashboard.machines.index', compact('machines'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'brand' => 'required|string|max:255',
//             'capacity' => 'required|string|max:255',
//             'power' => 'nullable|string|max:255',
//             'materials' => 'required|string|max:255',
//             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//         ]);

//         if ($request->hasFile('image')) {
//             $imageName = time().'.'.$request->image->extension();
//             $request->image->move(public_path('images'), $imageName);
//             $imagePath = 'images/' . $imageName;
//         }

//         Machine::create([
//             'name' => $request->name,
//             'brand' => $request->brand,
//             'capacity' => $request->capacity,
//             'power' => $request->power,
//             'materials' => $request->materials,
//             'image_path' => $imagePath,
//         ]);

//         return redirect()->route('admin.machines.index')->with('success', 'Machine added successfully.');
//     }
//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'title' => 'required|string|max:255',
//             'Type_de_billet' => 'required|string|max:255',
//             'description' => 'nullable|string',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//             'location' => 'required|string|max:255',
//             'price' => 'required|numeric',
//             'event_date' => 'required|date',
//             'max_subscribers' => 'required|integer|min:0',
//         ]);

//         $event = Event::findOrFail($id);
        
//         if ($request->hasFile('image')) {
//             // Delete the old image
//             if ($event->image_path) {
//                 Storage::disk('public')->delete($event->image_path);
//             }

//             $imageName = time() . '.' . $request->image->extension();
//             $request->image->move(public_path('images'), $imageName);
//             $event->image_path = 'images/' . $imageName;
//         }

//         $event->update([
//             'title' => $request->title,
//             'Type_de_billet' => $request->Type_de_billet,
//             'description' => $request->description,
//             'image_path' => $event->image_path ?? $event->image_path,
//             'location' => $request->location,
//             'price' => $request->price,
//             'event_date' => $request->event_date,
//             'max_subscribers' => $request->max_subscribers,
//         ]);

//         return redirect()->route('event-admin.index')->with('success', 'Event updated successfully.');
//     }
//     public function destroy(Machine $machine)
//     {
//         Storage::disk('public')->delete($machine->image_path);
//         $machine->delete();
//         return redirect()->route('admin.machines.index')->with('success', 'Machine deleted successfully.');
//     }
// }
