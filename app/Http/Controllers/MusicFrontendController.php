<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Music;
use App\Album;
use App\Http\Resources\Music as MusicResource;

class MusicFrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $musix = Music::paginate(15); 
        $albums = Album::all();

        if (count($musix)<= 0) {                                                                      // if there are no songs in the database, return a failure message, else return a resource.
                $failed ="Sorry no song was found";
                return json_encode($failed);
        }else{
                //return MusicResource::collection($musix);
                //for testing
                return view('home')->with('musix', $musix)->with('albums', $albums);

        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
    
        $file = $request->file('song');
        $image = $request->file('image');

            if ($file) {  
               $filename =$image->getClientOriginalName();
                $filenameRExt = strtolower($file->getClientOriginalExtension());       //pick up the .mp3 file extension;
               // dd($filenameRExt);     
                                        
                    if ($filenameRExt==='mp3'){                                                            //if the file extension is mp3;
                        $fileId= uniqid('site_name_here',true).'.mp3';                                                       //create a unique id for every file upload as users may upload files with identical names
                                                                            
                            if( $file->move(storage_path().'\\uploads', $fileId) &&  $image->move(storage_path().'\\uploads\\images', $filename)){

                                $musix = new Music;
                                
                                
                                $musix->uuid = 'song'.uniqid(true);
                                $musix->title = $request->input('title');
                                $musix->artist= $request->input('artist');
                                $musix->album = $request->input('album');
                                $musix->year =  $request->input('year');
                                $musix->genre = $request->input('genre');
                                $musix->file_name = $fileId;
                                $musix->album_id = $request->album_id;
                                $musix->image_filename = 'albumcover'.uniqid(true).'jpg';
                                $musix->image_url =storage_path().'\\uploads\\images\\'.$filename;



                                    if ($musix->save() ){
                                        Session::flash('response', 'your upload was successful');
                                        return redirect('/music');
                                    }else{
                                        $uploadError4 = "Music could not save";
                                        return json_encode($uploadError4); 
                                    }   

                            }else{
                                $uploadError3 = "your Music upload was unsuccessful";
                                return json_encode($uploadError3);
                            }
                        
                    }else{                                                                                          //returns a message if a wrong file type is chosen.
                        $uploadError2 = "Kindly choose an mp3 file";
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
        if (!$musix){
              $noSong = "Sorry, This song is not Available";
            
               return json_encode($noSong);
        
           }else{
            return new MusicResource($musix);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $uuid)
    {
        //     $music->id =$request->input('id');
        $musix = Music::where('uuid', $uuid)->firstOrFail();

       $musix->title =$request->input('title');
       $musix->artist =$request->input('artist');
       $musix->album =$request->input('album');
       $musix->year =$request->input('year');
       $musix->genre =$request->input('genre');

       if ($musix->save()) {
              
            Session::flash('update', 'Update Successful');
            return redirect('/music');

       }else{
        $updateFailed = "Sorry there was an Error and update failed";
        return json_encode($updateFailed);
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
        $musix = Music::where('uuid', $uuid)->firstOrFail();
        if (!$musix->delete()){
           $deleteFailed ="sorry, there was an error. Please try again";
           return json_encode($deleteFailed);
        
          }else{

            Session::flash('delete', 'Delete Successful');
            return redirect('/music');
        }

    }


    public function download($uuid)
    {
        $musix = Music::where('uuid', $uuid)->firstOrFail();
        $pathToFile = storage_path('uploads\\' . $musix->file_name);
        return response()->download($pathToFile);
    }

    public function update(Request $request, $uuid)
    {
       $musix =   Music::where('uuid', $uuid)->firstOrFail();
       return view('update', compact('musix'));

    }
}
