<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

use function PHPUnit\Framework\isEmpty;

class ClientController extends Controller
{
    /**
     * Devuelve todos los clientes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*
        foreach (Client::all() as $client) {
            echo $client->name;
        }
        */
        return Client::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Una API suele excluir metodos tipo create

        try {
            //Validated
            $validateUser = Validator::make($request->all(),
            [
                'name' => 'required',
                'cif' => 'required',
                'password' => 'required',
                'state_id' => 'required|numeric|between:0,1'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $client = Client::create([
                'name' => $request->name,
                'cif' => $request->cif,
                'state_id' => $request->state_id,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Client Created Successfully'
                //'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Devuelve un cliente dado un id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $clients = Client::all();
        $clients->where('id',$id)->first();

        return $clients->where('id',$id)->first();

    }

    /**
     * Actualiza el cliente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

            $client = Client::where('id', $id)->first();


            $validateUser = Validator::make($request->all(),
            [
                'name' => 'string',
                'cif' => 'string',
                'password' => 'string',
                'state_id' => 'numeric|between:0,1'
            ]);


            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            if($client == null){
                return response()->json([
                    'status' => true,
                    'message' => 'Client doesn\'t exists'

                ], 200);
            }else{
                try {
                    $updatedClient = $request->all();
                    $updatedClient['password'] = Hash::make($request['password']);
                    $client->update($updatedClient);

                    //$client->save();
                    return response()->json([
                        'status' => true,
                        'message' => 'Client Updated Successfully'
                        //'message' => $request->cif
                        //'token' => $user->createToken("API TOKEN")->plainTextToken
                    ], 200);
                } catch (\Throwable $th) {
                    //throw $th;
                    return response()->json([
                        'status' => false,
                        'message' => $th->getMessage()
                    ], 500);
                }

            }
    }

    /**
     * Elimina un cliente de la BD dado un ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $clients = Client::all();
        try {
            //code...
            $clients->where('id',$id)->first()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Client Deleted Successfully'
                //'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }
}
