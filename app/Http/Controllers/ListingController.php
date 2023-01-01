<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index()
    {
        // dd(request("tag"));
        // dd(Listing::latest()->filter(request(["tag", "search"]))->paginate(2));

        return view('listings.index', [
            // "listings" => Listing::latest()->filter(request(["tag", "search"]))->get(),
            // "listings" => Listing::latest()->filter(request(["tag", "search"]))->simplePaginate(6),
            "listings" => Listing::latest()->filter(request(["tag", "search"]))->paginate(6),
        ]);
    }

    // Show single listing
    public function show(Listing $listing)
    {
        return view("listings.show", [
            "listing" => $listing,
        ]);
    }

    // Show create form
    public function create()
    {
        return view("listings.create");
    }

    // Store listing
    public function store(Request $request)
    {
        // dd($request->file("logo"));
        // dd($request->file("logo")->store());

        $formFields = $request->validate([
            "company" => ["required", Rule::unique("listings", "company")],
            "title" => "required",
            "location" => "required",
            "email" => ["required", "email"],
            "website" => "required",
            "tags" => "required",
            "description" => "required",
        ]);

        if ($request->hasFile("logo")) {
            // $logoPath = $request->file("logo")->store("logos", "public");
            // $formFields["logo"] = $logoPath;

            $formFields["logo"] = $request->file("logo")->store("logos", "public");
        }

        $formFields["user_id"] = auth()->id();

        // Creating model with mass asignment
        Listing::create($formFields);

        // $listing = new Listing();
        // $listing->company = $formFields["company"];
        // $listing->title = $formFields["title"];
        // $listing->location = $formFields["location"];
        // $listing->email = $formFields["email"];
        // $listing->website = $formFields["website"];
        // $listing->tags = $formFields["tags"];
        // $listing->description = $formFields["description"];
        // $listing->save();

        return redirect("/")->with("message", "Listing created successfully!!!");
    }

    // Show edit form
    public function edit(Listing $listing)
    {
        return view("listings.edit", ["listing" => $listing]);
    }

    // Show updated listing
    public function update(Request $request, Listing $listing)
    {
        // Make sure logged in user is owner of listing
        if ($listing->user_id != auth()->id()) {
            abort(403, "Unauthorized Action");
        }

        $formFields = $request->validate([
            "company" => ["required"],
            "title" => "required",
            "location" => "required",
            "email" => ["required", "email"],
            "website" => "required",
            "tags" => "required",
            "description" => "required",
        ]);

        if ($request->hasFile("logo")) {
            $formFields["logo"] = $request->file("logo")->store("logos", "public");
        }

        $listing->update($formFields);

        return back()->with("message", "Listing updated successfully");
    }

    // Delete listing
    public function destroy(Listing $listing)
    {
        // Make sure logged in user is owner of listing
        if ($listing->user_id != auth()->id()) {
            abort(403, "Unauthorized Action");
        }

        $listing->delete();

        return redirect("/")->with("message", "Listing deleted successfully!!!");
    }

    // Manage listings
    public function manage()
    {
        // $listings = User::find(auth()->id())->listings()->get();

        // return view("listings.manage", ["listings" => auth()->user()->listings()->get()]);
        // return view("listings.manage", ["listings" => User::find(auth()->id())->listings()->paginate(1)]);
        return view("listings.manage", ["listings" => User::find(auth()->id())->listings()->get()]);
    }
}
