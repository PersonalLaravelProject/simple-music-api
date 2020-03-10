@extends('layouts.app')

@section('content')
<div class="container">
    
                <!--use /music/upload i.e without api prefix for view testing. uncomment all commented route in web.php-->

                <form action ="{{ route('music.upload',) }}" method="post" enctype="multipart/form-data">
                @csrf
                  <div class="form-group">
                     <label for ="title">Title</label>                
                     <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label for ="artist">Artist</label>
                      <input type="text" name="artist" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label for ="album">Album</label>
                       <input type="text" name="album" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for ="year">Year</label>
                       <input type="text" name="year" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for ="genre">Genre</label>
                       <input type="text" name="genre" class="form-control" required>
                    </div>
                    <div class="form-group">
                    
                        <select  class="form-control" name="album_id" required>
                        <div>
                        <option value= "" class="form-control">---Please Choose Album---</option>
                        </div>

                           @foreach($albums as $album)
                        <div>
                           <option value= "{{$album->id}}" class="form-control">{{$album->album_name}}</option>
                     </div>
            
                           @endforeach  
                        </select>
                    </div>
                    <div class="form-group">
                      <input type="file" name="song" class="form-control" required>
                    </div>
                    <div class="form-group">
                       <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-info form-control">
                    </div>
                </form>
               </div> 
               <div class="container">
                <div class ="table">
                <table>
                    <thead>
                    <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th></th>
                    <th></th>
                    <th></th>


                    </tr>
                    <!--<th>Action</th>-->
                    </thead>
                    <tbody>
                    @foreach($musix as $music)
                     
                     <tr>
                     <td>{{$music->title}}</td>
                     <td>{{$music->artist}}</td>
                     <td>{{$music->album}}</td>
                     <td>{{$music->year}}</td>
                     <td>{{$music->title}}</td>
                     <td>
                     <a href="{{ route('music.download', ['$uuid' => $music->uuid]) }}"class="btn btn-info btn-rounded mt-2" type="button">
                        Download
                     </a>
                     </td>
                     <td>
                     <a href="{{ route('music.update', ['$uuid' => $music->uuid]) }}" class="btn btn-success btn-rounded mt-2" type="button">
                      Update
                     </a>
                     </td>
                     <td>
                     <a href="{{ route('music.delete', ['$uuid' => $music->uuid]) }}"class="btn btn-danger btn-rounded mt-2" type="button">
                      Delete
                     </a>
                     </td>
                     </tr>
                     @endforeach
                    </tbody>
                </table>
                </div>
                </div>

@endsection

                <!--for testing-->
              