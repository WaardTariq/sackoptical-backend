<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', true)->orderBy('sort_order', 'asc')->get();
        $reviews = Review::where('status', true)->with('user')->latest()->take(8)->get();

        $featuredProducts = Product::where('is_featured', true)->where('status', true)->take(8)->get();
        $newArrivals = Product::where('status', true)->latest()->take(8)->get();
        $categories = Category::withCount('products')->take(6)->get();

        return view('frontend.home', compact('sliders', 'reviews', 'featuredProducts', 'newArrivals', 'categories'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        \App\Models\ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }

    public function login()
    {
        return view('frontend.auth.login');
    }

    public function register()
    {
        return view('frontend.auth.register');
    }
}
