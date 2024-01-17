<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Item;
use App\Category;
use App\Status;
use App\Action;
use App\Wagon;

class WagonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request, $id)
    {
        
        $item = Item::find($id);
        $user = Auth::user();
        $category = Category::find($item->category_id);
        $status = Status::find($item->status_id);

        return view('borrows.wagon', [
            'item' => $item, 
            'user' => $user,    
            'category' => $category,
            'status' => $status                 
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $borrowDetails = new Wagon;

        $item = Item::find($request->itemId);

        $borrowDetails->user_id = Auth::user()->id;
        $borrowDetails->item_id = $item->id;
        $borrowDetails->category_id = $item->category_id;
        $borrowDetails->status_id = $item->status_id;
        
        $borrowDetails->quantity = $request->quantity;    
        $item->quantity -= $request->quantity; 
        if($item->quantity == 0) {
            $item->status_id = 2; // Unavailable
            $borrowDetails->status_id = 2;
        }  

        $item->save();

        $borrowDetails->action_id = 3;
        $borrowDetails->date_borrowed = NOW();

        $borrowDetails->save();

        $request->session()->flash('message', 'Item is now pending. Wait for the technician to confirm your request.');

        return redirect('/on-hand/{id}');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id) 
    {

        $user = Auth::user()->id;
        $wagons = Wagon::where('action_id', [1])
            ->orWhere('action_id', [3])
            ->orderBy('date_borrowed', 'desc')
            ->orderBy('date_approved', 'desc')
            ->get();

        return view('borrows.on-hand', [
            'user' => $user,
            'wagons' => $wagons,
        ]);
    }

    public function show(Request $request)
    {
       
        $wagons = Wagon::where('action_id', [3])->get();

        return view('borrows.action', [
           'wagons' => $wagons,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function accept(Request $request, $id)
    {
        $wagon = Wagon::where('action_id', [3])->first();

        $item = Item::find($request->itemId);
        // dd($item);
        if($item->quantity == 0 && $item->status_id = 2) { // Unavailable
            $item->status_id = 3; // Out of Stock
            $wagon->status_id = 3; // Out of Stock
        }
        if($item->quantity != 0 && $item->status_id = 2) {  // Out of Stock
            $item->status_id = 1; // Available
            $wagon->status_id = 1; // Available        
        } 
        if($item->quantity == 0 && $item->status_id = 1) { // Available 
            $item->status_id = 3; // Out of Stock
            $wagon->status_id = 3; // Out of Stock        
        } 

        $item->save();

        $wagon->action_id = 1;
        $wagon->date_approved = NOW();
        $wagon->date_denied = NULL;


        $wagon->save();

            
        $request->session()->flash('message', 'The requested item has been approved.');

        return redirect('/action');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deny(Request $request, $id)
    {
        $wagon = Wagon::where('action_id', [3])->first();

        $item = Item::find($request->itemId);

        $wagon->action_id = 2;

        $item->quantity += $wagon->quantity;
        $wagon->quantity = $item->quantity;
        if($item->quantity != 0 && $item->status_id = 2) {
            $wagon->status_id = 1; // Available
            $item->status_id = 1; // Available
        }

        $wagon->date_denied = NOW();
        $wagon->date_returned = NULL;
        $wagon->date_approved = NULL;

        $item->save();
        $wagon->save();
        

        $request->session()->flash('message', 'The requested item has been denied.');

        return redirect('/action');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function approved(Request $request)
    {
        $wagons = Wagon::where('action_id', [1])
            ->orderBy('date_approved', 'desc')
            ->get();

        return view('borrows.approved', [
            'wagons' => $wagons,
        ]);
    }

    public function return(Request $request, $id)
    {
        $wagon = Wagon::where('action_id', [1])->first();

        $wagon->action_id = 4;

        $item = Item::find($request->itemId);

        $item->quantity += $wagon->quantity;
        $wagon->quantity = $item->quantity;
        if($item->quantity != 0 && $item->status_id = 3) {
            $wagon->status_id = 1; // Available
            $item->status_id = 1; // Available
        }

        $wagon->date_returned = NOW();
        $wagon->date_denied = NULL;

        $item->save();
        $wagon->save();

        $request->session()->flash('message', 'The requested item has been returned.');

        return redirect('/approved');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function history()
    {
        $wagons = Wagon::where('action_id', [2])
            ->orwhere('action_id', [4])
            ->orderBy('date_denied', 'desc')
            ->orderBy('date_approved', 'desc')
            ->get();

        return view('borrows.history', [
           'wagons' => $wagons,
        ]);
    }

    public function transactions()
    {
        $wagons = Wagon::where('action_id', [2])
            ->orwhere('action_id', [4])
            ->orderBy('date_denied', 'desc')
            ->orderBy('date_approved', 'desc')
            ->get();

        return view('borrows.transactions', [
           'wagons' => $wagons,
        ]);
    }
}
