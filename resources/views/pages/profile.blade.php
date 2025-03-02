@extends('layouts/main')
@include('modals/createNote')
@section('title', 'Profile')
@section('content')
    <h2 class="text-center font-bold text-2xl mb-10">Ваши записи</h2>
    <div class="buttons flex gap-5">
        <a onclick="openCreatePostModal()"><x-button text="Создать запись" /></a>
        <x-button text="Архив записей" />
    </div>
@endsection
