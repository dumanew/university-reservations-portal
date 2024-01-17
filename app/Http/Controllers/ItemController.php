<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User;
use App\Item;
use App\Category;
use App\Status;
use App\Action;
use App\Wagon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::where('is_archived', 0)->get();
        return view('items.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryOptions = Category::all();
        $statusOptions = Status::all();
        return view('items.create', [
            'categories' => $categoryOptions,
            'statuses' => $statusOptions
        ]);
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $item = new Item;

        $item->name = $request->name;
        $item->description= $request->description;
        $item->category_id = $request->category_id;
        $item->status_id = $request->status_id;
        $item->quantity = $request->quantity;

        $path = $request->image->store('image', 'public');
        $item->image_location = $path;

        $item->save();
        $request->session()->flash('message', 'Item details have been added.');

        return redirect('/menu');   
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
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        $statuses = Status::all();
        return view('items.edit', [
            'item' => $item,
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->status_id = $request->status_id;

        if ($request->hasFile('image')) {
            // remove the old file
            Storage::disk('public')->delete($item->image_location);
            // save the new image
            $path = $request->image->store('images', 'public');
            $item->image_location = $path;
        }

        $item->save();
        $request->session()->flash('message', 'The item has been updated.');

        return redirect('/menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function deleteConfirm($id)
    {
        $item = Item::find($id);
        $category = Category::find($item->category_id);
        $status = Status::find($item->status_id);
        return view('items.delete', [
            'item' => $item,
            'category' => $category,
            'status' => $status
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $item = Item::find($id);

        $item->is_archived = 1;

        $item->save();
        $request->session()->flash('message', 'The item has been deleted.');

        return redirect('/menu');
    }

    
}
