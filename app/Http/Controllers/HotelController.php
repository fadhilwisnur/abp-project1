<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\hotel;

class HotelController extends Controller
{
    //
    public function homeview()
    {
        $hotel = hotel::all();
        return view('home',['hotel' => $hotel]);
    }
    public function tambahHotelView()
    {
        return view('add');
    }
    public function edithotelview($id)
    {
        $hotel = hotel::find($id);
        return view('edit',[
            'hotel' => $hotel
        ]);
    }
    public function tambahHotel(Request $request)
    {
        $uuid = Str::uuid()->toString();
        $extension = $request->image->extension();
        $imageName = $uuid.'.'.$extension;  
        $request->image->move(public_path('images'), $imageName);
        $hotel = hotel::create(['name'=>$request->name,
        'description'=>$request->description,
        'rating'=>$request->rating,
        'image'=>$imageName
        ]);
        $hotel = hotel::all();
        return view('home',['hotel' => $hotel]);
    }
    public function viewhotel(int $id)
    {
        $hotel_id = hotel::where('id', $id)->first();
        return view('hotel', ['hotel' => $hotel_id]);
    }
    public function deletehotel(int $id)
    {
        $hotel_id = hotel::where('id', $id)->delete();
        return redirect('/home');
    }
    public function update(Request $request, $id)
    {
        $uuid = Str::uuid()->toString();
        $extension = $request->image->extension();
        $imageName = $uuid.'.'.$extension;  
        $request->image->move(public_path('images'), $imageName);

        $data = $request;
        $hotel = hotel::find($id);
        $hotel->name = $data['name'];
        $hotel->description = $data['description'];
        $hotel->rating = $data['rating'];
        $hotel->image = $imageName;
        $hotel->update();
        $hotels = hotel::all();
        return view('home',['hotel' => $hotels]);
    }
}
