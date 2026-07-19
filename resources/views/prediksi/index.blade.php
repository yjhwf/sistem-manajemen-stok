@extends('layouts.app')

@section('content')

<div class="container">

<h2 class="mb-4">Prediksi Stok Barang</h2>

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Produk</th>

<th>M1</th>
<th>M2</th>
<th>M3</th>
<th>M4</th>
<th>M5</th>
<th>M6</th>
<th>M7</th>
<th>M8</th>

<th>MA-2</th>

<th>Prediksi M9</th>

</tr>

</thead>

<tbody>

@foreach($hasil as $item)

<tr>

<td>{{ $item['nama_produk'] }}</td>

<td>{{ $item['m1'] }}</td>
<td>{{ $item['m2'] }}</td>
<td>{{ $item['m3'] }}</td>
<td>{{ $item['m4'] }}</td>
<td>{{ $item['m5'] }}</td>
<td>{{ $item['m6'] }}</td>
<td>{{ $item['m7'] }}</td>
<td>{{ $item['m8'] }}</td>

<td>{{ $item['ma2'] }}</td>

<td>{{ $item['prediksi'] }}</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection