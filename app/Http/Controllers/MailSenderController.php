<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendMailJob;

class MailSenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $file = $request->exelfile;
        
        $path = $file->store('exelfiles');
        $file_path = Storage::path($path);
        $file = fopen($file_path, "r");
        $all_data = [];
        while (($data = fgetcsv($file)) !== FALSE) {
            array_push($all_data, $data);
        }

        // for ($i = 1; $i < sizeof($all_data); $i++) {
        // dispatch(function(){
        //     Mail::to("test@gmail.com")->send(new WelcomeMail("test"));     //This is first methods
        // })->delay(now()->addSecond(value:5));
        // }


        // for ($i = 1; $i < sizeof($all_data); $i++) {
        //     Mail::to($all_data[$i][3])->send(new WelcomeMail($all_data[$i][2]));
        // }

        // dispatch(new SendMailJob())->delay(now()->addSecond(value:5));

        for ($i = 1; $i < sizeof($all_data); $i++) {
            SendMailJob::dispatch($all_data[$i][3],$all_data[$i][2])->delay(now());
        }   
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
        //
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
        //
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
