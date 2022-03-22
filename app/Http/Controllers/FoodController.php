<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('food.index', [
            'foods' => Food::with('category')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('food.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png',
        ]);

        if($validateData['image'] === null) {
            $validateData['image'] = '';
        } else {
            $image = $request->image;
            $imageName = time().hash('sha256', $image->getClientOriginalName()).$image->getClientOriginalName();
            $image->storeAs('public/foods', $imageName);
            $validateData['image'] = $imageName;
        }
        Food::create($validateData);
        return redirect()->route('food.index')->with('message','Berhasil Tambah Data Makanan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        return view('food.edit', [
            'food' => $food,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png' 
        ]);

        if($validateData['image'] === null) {
            $validateData['image'] = $food->image;
        } else {
            $image = $request->image;
            $imageName = time() . hash('sha256', $image->getClientOriginalName()) . $image->getClientOriginalName();
            Storage::disk('public')->delete('foods/' . $imageName);
            $image->storeAs('public/foods', $imageName);
            $validateData['image'] = $imageName;
        }
        $food->update($validateData);
        return redirect()->route('food.index')->with('message','Berhasil Update Data Makanan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        if($food->image !== null) {
            Storage::disk('public')->delete('foods/' . $food->image);
        }
        $food->delete();
        return redirect()->route('food.index')->with('message','Berhasil Hapus Data Makanan');
    }
}
