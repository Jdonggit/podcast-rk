<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Http\Resources\PodcastResource;
use App\Services\PodcastService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class PodcastController extends Controller
{

    public function __construct(PodcastService $podcastService)
    {
        $this->podcastService = $podcastService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $res = Podcast::where('date', date('Y-m-d'))->get();
        $apple = array();
        $spotify = array();
        foreach ($res as $key => $value) {
            if($value->plat == 0){
                $apple[] = $value;
            }elseif($value->plat == 1){
                $spotify[] = $value;
            }
        }
        $data = array(
            'apple' => $apple, 
            'spotify' => $spotify
        );
        return new PodcastResource($data); 
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
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function show(Podcast $podcast)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function edit(Podcast $podcast)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Podcast $podcast)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function destroy(Podcast $podcast)
    {
        //
    }

    public function getdata(){
        $res = $this->podcastService->get_podcast();
        return response()->json($res);

        
    }
}
