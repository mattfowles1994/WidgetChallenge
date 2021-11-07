<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class widgetController extends Controller
{
    public function index(Request $rq)
    {



        return view('widgets.index');
        
    }

    public function order(Request $rq)
    {
        

        $request = $rq->all();
        //dd($request);

        $order = $request["order"];
        $origOrder = $order;
        $packs = $request["packs"];

        $i = 1;
        $packSizes = [];
        while($i <= $packs){
            array_push($packSizes, $request[$i]);
            $i++;
        }
        // Sort extracted pack sizes
        rsort($packSizes);

        $packsToSend = [];
        $prevPack = 0;
        $id = 0;
        
        while($id+1 <= $packs){
            // Check total order doesnt exceed max pack size
            while($packSizes[$id] <= $order){
                array_push($packsToSend, $packSizes[$id]);
                $order = $order - $packSizes[$id];
            }

            if(isset($packSizes[$id+1])){
                if($packSizes[$id+1] < $order){
                    // if 2 of the next pack size is less widgets than the current, send those instead
                    if(2*$packSizes[$id+1] < $packSizes[$id]){
                        array_push($packsToSend, $packSizes[$id+1]);
                        $order = $order - $packSizes[$id+1];
                    }
                    // if there aren't smaller sizes, keep going
                    elseif(isset($packSizes[$id+2]) != True){
                        array_push($packsToSend, $packSizes[$id]);
                        $order = $order - $packSizes[$id];
                    } 
                } 
            }
            $prevPack = $packSizes[$id];
            $id++;
        }

        //If there is some ordered quantity left, add smallest pack
        if($order > 0){
            array_push($packsToSend, $prevPack);
        }

        return view('widgets.results', compact('origOrder', 'packsToSend'));
        
    }
}
