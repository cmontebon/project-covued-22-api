<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CaseModel;
use Validator;

class CaseController extends Controller
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
        $cases = CaseModel::with('barangay')->get()->toArray();

        $response = [
            'success' => true,
            'data' => $cases,
            'message' => 'Covid cases retrieved successfuly.'
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
            'age' => 'required',
            'classification' => 'required',
            'brgy_id' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $cases = CaseModel::create($input)->toArray();

        $response = [
            'success' => true,
            'data' => $cases,
            'message' => 'Covid cases saved successfuly.'
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
        $case = CaseModel::find($id)->toArray();

        if (is_null($case)) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Book not found.'
            ];
            return response()->json($response, 404);
        }

        $response = [
            'success' => true,
            'data' => $case,
            'message' => 'Case retrieved successfully.'
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
    public function update(Request $request, CaseModel $case)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'age' => 'required',
            'classification' => 'required',
            'brgy_id' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $case->age = $input['age'];
        $case->brgy_id = $input['brgy_id'];
        $case->classification = $input['classification'];
        $case->save();

        $response = [
            'success' => true,
            'data' => $case->toArray(),
            'message' => 'Case updated successfully.'
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaseModel $case)
    {
        $case->delete();

        $response = [
            'success' => true,
            'data' => $case->toArray(),
            'message' => 'Case deleted successfuly.'
        ];

        return response()->json($response, 200);
    }
}
