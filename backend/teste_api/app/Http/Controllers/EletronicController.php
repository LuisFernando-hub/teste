<?php

namespace App\Http\Controllers;

use App\Models\Eletronic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EletronicController extends Controller
{
    private $eletronic;

    public function __construct(Eletronic $eletronic)
    {
        $this->eletronic = $eletronic;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->eletronic->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'voltage' => 'required|int',
            'brand' => 'required|int',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $this->eletronic->create($request->all());

        return response()->json(['message' => 'Eletrodoméstico criado com sucesso'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Eletronic  $eletronic
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $eletronic = Eletronic::find($id);

        if ($eletronic === null) {
            return response()->json(['message' => 'Eletrodoméstico não encontrado'], 404);
        }

        return $eletronic->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Eletronic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eletronic $eletronic)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'voltage' => 'required|int',
            'brand' => 'required|int',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $eletronic->update($request->all());

        return response()->json(['message' => 'Eletrodoméstico editado com sucesso'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $eletronic = Eletronic::find($id);

        if ($eletronic === null) {
            return response()->json(['message' => 'Eletrodoméstico não encontrado'], 404);
        }

        $eletronic->delete();

        return response()->json(['message' => 'Eletrodoméstico deletado com sucesso'], 200);
    }
}
