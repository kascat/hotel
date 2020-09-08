<?php

namespace App\Http\Controllers;

use App\Model\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * ReservationController constructor.
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
        return view('reservation.index', [
            'reservations' => Room::query()->whereNull('user_id')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function new(Request $request)
    {
        Room::find($request->room)->update([
            'user_id' => Auth::user()->id
        ]);

        return response()->json([]);
    }
}
