<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //listing all lists
    public function index()
    {
        // dd(request('tag'));
        return view('listings.index', [
            "listings" => Listing::latest()->filter(request(['tag', 'search']))->paginate(2)
        ]);
    }
    //showing single list
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //show create form
    public function create()
    {
        return view('listings.create');
    }

    //store listing data
    public function store(Request $request)
    {
        // dd($request->file());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $formFields['user_id'] = auth()->id();
        // dd($formFields['user_id']);
        Listing::create($formFields);
        return redirect('/')->with('message', 'Listing created successfully!');
    }

    //Show Edit Form
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    //Update listing data
    public function update(Request $request, Listing $listing)
    {
        // dd($request->file());
        if ($listing->user_id != auth()->id()) {
            abort(403, 'unauthorized action');
        }
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);
        return back()->with('message', 'Listing updated successfully!');
    }

    //Show Edit Form
    public function destroy(Listing $listing)
    {
        // dd($listing->title);
        if ($listing->user_id != auth()->id()) {
            abort(403, 'unauthorized action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
