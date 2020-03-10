@extends('layouts.app')

@section('content')
<div class="container">
                <form action ="{{ route('music.save', ['$uuid' => $musix->uuid]) }}" method="post">
                @csrf
                <div class="form-group">
                      Title:  <input type="text" name="title" class="form-control" value="{{$musix->title}}" required>
                    </div>
                    <div class="form-group">
                      Artist:  <input type="text" name="artist" class="form-control" value="{{$musix->artist}}" required>
                    </div>
                    <div class="form-group">
                       Album: <input type="text" name="album" class="form-control" value="{{$musix->album}}" required>
                    </div>
                    <div class="form-group">
                       Year: <input type="text" name="year" class="form-control" value="{{$musix->year}}" required>
                    </div>
                    <div class="form-group">
                       Genre: <input type="text" name="genre" class="form-control" value="{{$musix->genre}}" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control">
                    </div>

                </form>

</div>
@endsection