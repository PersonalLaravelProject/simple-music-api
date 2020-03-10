<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Music;
use App\Album;
use App\Http\Resources\Music as MusicResource;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all music
        $musix = Music::paginate(15); 

        if (count($musix)<= 0) {                                                                      // if there are no songs in the database, return a failure message, else return a resource.
                $failed ="Sorry no song was found";
                return json_encode($failed);
        }else{
                return MusicResource::collection($musix);
                //for testing
               // return view('home')->with('musix', $musix);

        }
                   
    }

    public function index_album()
    {
        //get all music
        $albums = Album::all(); 

        if (count($albums)<= 0) {                                                                      // if there are no songs in the database, return a failure message, else return a resource.
                $failed ="Sorry no album was found";
                return json_encode($failed);
        }else{
                return MusicResource::collection($albums);
                //for testing
               // return view('home')->with('musix', $musix);

        }
                   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $file = $request->file('song');
        $image = $request->file('image');

            if ($file && $image) {  
                $imageFileName =$image->getClientOriginalName();
                $filenameRExt = strtolower($file->getClientOriginalExtension());       //pick up the .mp3 file extension;
                $fileimageRExt = strtolower($image->getClientOriginalExtension());
               // dd($filenameRExt);     
                                        
                    if ($filenameRExt==='mp3' && $fileimageRExt==='jpg'){                                                            //if the file extension is mp3;
                        $fileId= uniqid('site_name_here',true).'.mp3';                                                       //create a unique id for every file upload as users may upload files with identical names
                                                                            
                            if( $file->move(storage_path().'\\uploads\\music', $fileId) &&  $image->move(storage_path().'\\uploads\\images', $imageFileName)){

                                $music = new Music;
                                
                                $music->uuid = 'song'.uniqid(true);
                                $music->title = $request->input('title');
                                $music->artist= $request->input('artist');
                                $music->album = $request->input('album');
                                $music->year =  $request->input('year');
                                $music->genre = $request->input('genre');
                                $music->file_name = $fileId;
                                $musix->album_id = $request->album_id;
                                $music->image_filename =$imageFileName;
                                $music->image_url =storage_path().'\\uploads\\images\\'.$imageFileName;


                                    if ($music->save() ){
                                        return new MusicResource($music);
                                    }else{
                                        $uploadError4 = "Music could not save";
                                        return json_encode($uploadError4); 
                                    }   

                            }else{
                                $uploadError3 = "your Music upload was unsuccessful";
                                return json_encode($uploadError3);
                            }
                        
                    }else{                                                                                          //returns a message if a wrong file type is chosen.
                        $uploadError2 = "Kindly choose an mp3 file for music and jpg for image";
                        return json_encode($uploadError2);
                    }


            }else{
                $uploadError1 = "There was an issue with your Upload, pls try again";                         //returns an error if there was error in requesting file.
                return json_encode($uploadError1);
            }
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
         //Get Music
         $musix = Music::where('uuid', $uuid)->firstOrFail();
         if (!$musix->exists()){
               $noSong = "Sorry, This song is not Available";
             
                return json_encode($noSong);
         
            }else{
             return new MusicResource($musix);
         }
    }
 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
          //Get Music
          $music = Music::where('uuid', $uuid)->firstOrFail();
          if (!$music->delete()){
             $deleteFailed ="sorry, there was an error. Please try again";
             return json_encode($deleteFailed);
          
            }else{

              return new MusicResource($music);
          }

          
    }



    public function download($uuid)
    {
        $musix = Music::where('uuid', $uuid)->firstOrFail();
        $pathToFile = storage_path('uploads/' . $musix->file_name);
        return response()->download($pathToFile);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
       $music =   Music::where('uuid', $uuid)->firstOrFail();

//     $music->id =$request->input('id');
       $music->title =$request->input('title');
       $music->artist =$request->input('artist');
       $music->album =$request->input('album');
       $music->year =$request->input('year');
       $music->genre =$request->input('genre');

       if ($music->save()) {
              return new MusicResource($music);
       }else{
        $updateFailed = "Sorry there was an Error and update failed";
        return json_encode($updateFailed);
       }

    }

}
