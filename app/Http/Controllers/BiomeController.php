<?php

namespace App\Http\Controllers;

use App\Models\Abundance;
use Validator;
use App\Models\Crops;
use App\Models\Organism;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

/**
 * Example of controller for the Challenge
 */
class BiomeController extends Controller
{


    /**
     * Returns a list of samples
     */
    public function listSamples(){
        return Sample::query()
            ->with("crops") 
            ->withCount('abundances')
            ->get();
    }

    /**
     * Creates a new organism
     */
    public function newOrganism(Request $request){

        // Log is configured to print to stderr
        Log::info($request->all());
        
        $validator = Validator::make($request->all(), [
            'genus' => 'required',
            'species' => 'required',
        ]);
        if ($validator->fails()) {
            //En caso de que alguno de los elementos se campo vacío devolveremos la excepcion generada por el VALIDATOR
            return response()->json(['error' => $validator->errors()->first()], 400);
        }
        else {
            $organism = new Organism();
            $organism->fill($request->all())->save();
        }
    }

    /**
     * Returns a paginated list of organisms 
     */
    public function listOrganisms(){
        return Organism::paginate(10);
    }

    /**
     * Returns the top list of organisms
     */
    public function listOrganismsTop10(){

        //Devolvemos los 10 organismos mas repetidos en la tabla Abundance

        return response()->json(Abundance::select("organism_id", DB::raw("COUNT(*) as count"))->groupBy('organism_id')->orderByRaw('COUNT(*) DESC')->take(10)->with("organism")->get());

        
    }

}
