<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Order;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('staff-access')) return $next($request);

            abort(403, 'Maaf, Hak akses anda dibatasi !');
        });
    }

    public function index(Request $request)
    {
        $status = $request->get('status');
        $buyer_email = $request->get('buyer_email');


        $orders = Order::with('user')
            ->with('books')
            ->whereHas('user', function ($query) use ($buyer_email) {
                $query->where('email', 'LIKE', "%$buyer_email%");
            })
            ->where('status', 'LIKE', "%$status%")
            ->paginate(10);

        $title = 'Manage Order';

        return view('pages.orders.index', ['orders' => $orders, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $order = Order::findOrFail($id);
        $title = 'Manage Order';

        return view('pages.orders.edit', ['order' => $order, 'title' => $title]);
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
        $order = Order::findOrFail($id);

        $order->status = $request->get('status');

        $order->save();

        return redirect()->route('orders.index')->with('status', 'Berhasil Update Data ' . $order->invoice_number);
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
}
