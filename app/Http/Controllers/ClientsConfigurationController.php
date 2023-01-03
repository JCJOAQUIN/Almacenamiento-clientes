<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
use App\Models\Clients;
use RealRashid\SweetAlert\Facades\Alert;

class ClientsConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clients                    = new App\Models\Clients();
        $clients->kind              = $request->kind;
        $clients->rfc               = $request->rfc;
        $clients->name_physical     = $request->namePhysical;
        $clients->last_name         = $request->lastName;
        $clients->second_last_name  = $request->secondLastName;
        $clients->name_moral        = $request->nameMoral;
        $clients->business_name     = $request->businessName;
        $clients->using_cfdi_id     = $request->cfdiUsing;
        $clients->status            = $request->status;
        $clients->contact_name      = $request->nameContact;
        $clients->phone             = $request->phone;
        $clients->celphone          = $request->cellPhone;
        $clients->email_address     = $request->email;
        $clients->comments          = $request->comments;
        $clients->country_id        = $request->country;
        $clients->state             = $request->state;
        $clients->district          = $request->district;
        $clients->city              = $request->city;
        $clients->zip_code          = $request->zipCode;
        $clients->suburb            = $request->suburb;
        $clients->street            = $request->street;
        $clients->external_number   = $request->externalNumber;
        $clients->inside_number     = $request->insideNumber;
        $exist = App\Models\Clients::where('rfc',$request->rfc)->count();
        if ($exist>0)
        {
            Alert::error('','El rfc ingresado ya existe, favor de registrar uno diferente');
            return redirect()->back();
        }
        else
        {
            $clients->save();
            Alert::success('','Cliente guardado exitosamente');
            return redirect()->route('clients.search');
        }
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

    public function search(Request $request)
    {
        $client     =   $request->client;
        $clients    =   App\Models\Clients::where(function($query) use ($client)
        {
            if ($client!="")
            {
                $query->where('name_physical','like','%'.$client.'%')
                ->orWhere('last_name','like','%'.$client.'%')
                ->orWhere('second_last_name','like','%'.$client.'%')
                ->orWhere('rfc','like','%'.$client.'%')
                ->orWhere('business_name','like','%'.$client.'%')
                ->orWhere('name_moral','like','%'.$client.'%');
            }
        })
        ->orderBy('id','DESC')
        ->simplePaginate(10);
        return view('customers/search',
        [
            'clients'  =>  $clients,
            'client'   =>   $request->client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requestClient   =   App\Models\Clients::find($id);
        return view('customers/create',['requests'=>$requestClient]);
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
        $clients                    = App\Models\Clients::find($id);
        $clients->kind              = $request->kind;
        $clients->rfc               = $request->rfc;
        $clients->name_physical     = $request->namePhysical;
        $clients->last_name         = $request->lastName;
        $clients->second_last_name  = $request->secondLastName;
        $clients->name_moral        = $request->nameMoral;
        $clients->business_name     = $request->businessName;
        $clients->using_cfdi_id     = $request->cfdiUsing;
        $clients->status            = $request->status;
        $clients->contact_name      = $request->nameContact;
        $clients->phone             = $request->phone;
        $clients->celphone          = $request->cellPhone;
        $clients->email_address     = $request->email;
        $clients->comments          = $request->comments;
        $clients->country_id        = $request->country;
        $clients->state             = $request->state;
        $clients->district          = $request->district;
        $clients->city              = $request->city;
        $clients->zip_code          = $request->zipCode;
        $clients->suburb            = $request->suburb;
        $clients->street            = $request->street;
        $clients->external_number   = $request->externalNumber;
        $clients->inside_number     = $request->insideNumber;

        $exist = App\Models\Clients::where('id','!=',$id)->where('rfc',$request->rfc)->count();
        if ($exist>0)
        {
            Alert::error('','El rfc ingresado ya existe, favor de registrar uno diferente');
            return redirect()->back();
        }
        else
        {
            $clients->save();
            Alert::success('','Cliente actualizado exitosamente');
            return redirect()->route('clients.search');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function suspend($id)
    {
        $user = App\Models\Clients::find($id);
        $user->delete();
        Alert::success('','Cliente eliminado exitosamente');
        return redirect()->route('clients.search');
    }

    public function destroy($id)
    {
        //
    }
}
