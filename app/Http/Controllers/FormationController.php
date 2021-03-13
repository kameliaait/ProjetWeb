<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Episode;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FormationController extends Controller
{
    public function index(){
        $formation=Formation::with('user')
        ->select('formations.*', DB::raw(
            '(SELECT COUNT(DISTINCT(user_id))
            FROM completion
            INER JOIN episodes ON episode_id = episodes.id
            WHERE episodes.formation_id=formations.id
            ) AS participants'
        ))->withCount('episodes')->orderBy('id', 'DESC')->paginate(10);
        return Inertia::render('formation/index',
    [
        'formation'=>$formation
    ]);

    }
   

    public function show(int $id){
       $formation = Formation::where('id',$id)->with('episodes')->first();
       $watched = auth()->user()->episodes;

        return Inertia::render('formation/show',
        [
            'formation'=>$formation,
            'watched'=>$watched
        ]  
        );

    }
   
    //it would be better to place in it's own controller later the vue contains the form also
    public function store(Request $request){
       // dd($request->input('episodes'));
       $request->validate([
           'title'=>'required',
           'description'=>'required',
           'episodes'=>['required','array'],
           'episodes.*.title'=>'required',
           'episodes.*.description'=>'required',
           'episodes.*.video_url'=>'required'
       ]);
     $formation= Formation::create($request->all());
     foreach($request->input('episodes') as $episode){
         $episode['formation_id']= $formation->id;
         Episode::create($episode);
     }

     return  Redirect::route('formation.index')->with('success', 'BRAVO! Votre formation est mise en ligne!');
    }
    public function toggleCompletion(request $request){
        $episodeId= $request->input('episodeId');
        $user = auth()->user();
        $user->episodes()->toggle($episodeId);
        return $user->episodes;
    }
    public function edit(int $id){
        $formation=Formation::where('id',$id)->with('episodes')->first();
        $this->authorize('update', $formation);
        return Inertia::render('formation/Edit',[ 'formation'=>$formation]);
    }
    public function update(Request $request){
        //dd($request);
       $formation= Formation::where('id', $request->id)->with('episodes')->first();
       $this->authorize('update', $formation);
       $formation->update($request->all());
       $formation->episodes()->delete();

       foreach($request->episodes as $episode){
           $episode['formation_id'] = $formation->id;
           Episode::create($episode);
       }
       return  Redirect::route('formation.index')->with('success', 'Votre formation a bien été mise à jour!');

    }
   
    public function destroy($id)
    {
        $formation= Formation::where('id',$id);
        //$this->authorize('delete', $formation);
        $formation->delete();
        return  Redirect::route('formation.index')->with('success', 'Votre formation a bien été Supprimé!');



    }

}
