<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Barangay;
use Validator;

class BarangayController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth:api')->except('index'); 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangays = Barangay::all()->toArray();

        $response = [
            'success' => true,
            'data' => $barangays,
            'message' => 'Barangays retrieved successfuly.'
        ];

        return response()->json($response, 200);
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
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'lat_long' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $barangays = Barangay::create($input)->toArray();

        $response = [
            'success' => true,
            'data' => $barangays,
            'message' => 'Barangay saved successfuly.'
        ];

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barangay = Barangay::find($id)->toArray();

        if (is_null($barangay)) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Book not found.'
            ];
            return response()->json($response, 404);
        }

        $response = [
            'success' => true,
            'data' => $barangay,
            'message' => 'barangay retrieved successfully.'
        ];

        return response()->json($response, 200);
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
    public function update(Request $request, Barangay $barangay)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'lat_long' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $barangay->name = $input['name'];
        $barangay->lat_long = $input['lat_long'];
        $barangay->save();

        $response = [
            'success' => true,
            'data' => $barangay->toArray(),
            'message' => 'barangay updated successfully.'
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barangay $barangay)
    {
        $barangay->delete();

        $response = [
            'success' => true,
            'data' => $barangay->toArray(),
            'message' => 'barangay deleted successfuly.'
        ];

        return response()->json($response, 200);
    }
}
