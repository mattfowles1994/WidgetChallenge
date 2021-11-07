@extends('layouts.app')

<h1>Results</h1>
<h2>Ordered Quantity: {{ $origOrder }}</h2>

@foreach($packsToSend as $pack)
    <h3>{{ $pack }} </h3>
@endforeach