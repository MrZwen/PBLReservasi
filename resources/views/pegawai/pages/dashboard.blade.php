@extends('pegawai.layouts.main')

@section('contentPegawai')
    <h1>Welcome {{Auth::user()->username}}</h1>
@endsection