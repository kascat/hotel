<?php

namespace App\Http\Controllers;

use App\Model\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * HotelController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('hotel.index', [
            'hotels' => Hotel::all()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('hotel.form', [
            'hotel' => new Hotel()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Hotel::create($request->all());

        return response()->json([]);
    }

    /**
     * @param Hotel $hotel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Hotel $hotel)
    {
        return view('hotel.form', [
            'hotel' => $hotel
        ]);
    }

    /**
     * @param Request $request
     * @param Hotel $hotel
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Hotel $hotel)
    {
        $hotel->update($request->all());

        return response()->json($hotel->toArray());
    }

    /**
     * @param Hotel $hotel
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return response()->json([]);
    }
}
