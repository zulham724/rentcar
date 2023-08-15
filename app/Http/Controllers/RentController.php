<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rent;
use App\Enums\RentStatus;
use Session;
use App\Models\User;

class RentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $userId = auth()->user()->id;
    $rents = Rent::where('user_id', $userId)
    ->whereIn('status',[
      RentStatus::PENDING,
      RentStatus::ACCEPTED,
      RentStatus::REJECTED
    ])
    ->paginate();

    return view('content.rent.index', compact('rents'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    $products = Product::get();

    return view('content.rent.create', compact('products'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
    // dd($request->all());
    $request->validate([
      'product_ids' => 'required|array',
      'product_ids.*' => 'required|exists:products,id',
      'start_date' => 'required',
      'end_date' => 'required',
    ]);

    // validate products jika barang sudah pernah di pesan sebelum nya di tanggal yang dipilih
    $productHasRent = Rent::whereHas('products', function ($query) use ($request) {
      $query->whereIn('product_id', $request->product_ids);
    })->whereDate('start_date', '<=', $request->start_date)
    ->whereDate('end_date', '>=', $request->start_date)
    ->count();

    if($productHasRent > 0){
      Session::flash('error_msg', 'Barang sudah pernah di pinjam sebelumnya');
      return redirect()->back();
    }

    $rent = new Rent();
    $rent->start_date = $request->start_date;
    $rent->end_date = $request->end_date;
    $rent->status = RentStatus::PENDING;

    $request->user()->rents()->save($rent);

    foreach ($request->product_ids as $product_id) {
      $product = Product::findOrFail($product_id);

      $rent->products()->attach($product_id, [
        'cost_per_day' => $product->cost_per_day,
        'product_name' => $product->name,
        'product_brand' => $product->brand,
        'product_model' => $product->model,
        'product_plat_number' => $product->plat_number
      ]);
    }

    Session::flash('success_msg', 'Peminjaman berhasil');

    return redirect()->route('rent.index');
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
    //
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
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  public function return()
  {
    $userId = auth()->user()->id;

    $products = Product::whereHas('rents', function ($query) use ($userId) {
      $query->where('user_id', $userId)->where('status', RentStatus::ACCEPTED);
    })->get();
    return view('content.rent.return', compact('products'));
  }

  public function returnByPlat(Request $request){
    $plat_number = $request->plat_number;

    $rent = Rent::whereHas('products', function ($query) use ($plat_number) {
      $query->where('plat_number', $plat_number);
    })->first();

    if(!$rent){
      Session::flash('error_msg','Barang tidak ditemukan');
      return redirect()->back();
    }

    $rent->status = RentStatus::RETURNED;

    $rent->save();

    Session::flash('success_msg','Barang berhasil dikembalikan');

    return redirect('/rent');
  }

  public function report()
  {
    return view('content.rent.report');
  }
}
