<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function show(Coupon $coupon)
    {
        return view('admin.coupons.show', compact('coupon'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'value' => 'required|numeric',
            'type' => 'required|in:fixed,percent',
        ]);
        
        $coupon = new Coupon($request->all());
        $coupon->status = $request->has('status');
        $coupon->save();

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created.');
    }
    
     public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([ 'code' => 'required', 'value' => 'required|numeric' ]);
        
        $coupon->fill($request->all());
        $coupon->status = $request->has('status');
        $coupon->save();

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted.');
    }
}
