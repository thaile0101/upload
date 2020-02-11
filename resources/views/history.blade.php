@extends('layout')

@section('page-title', 'Media')

@section('content')
    <div class="container">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Mime Type</th>
            </tr>
            </thead>
            <tbody>
            @foreach($media as $item)
                <tr>
                    <td><a href="{{route('download', $item->hashId)}}" target="_blank">{{ $item->name }}</a></td>
                    <td>{{ $item->mime_type }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $media->links() }}
    </div>
@endsection