@extends('layout.app')

@section('content')
<form action="{{ route('produk.update',$produk->id) }}" method="POST">
@csrf @method('PUT')

<select name="bumdes_id" class="form-control mb-2">
@foreach($bumdes as $b)
<option value="{{ $b->id }}" {{ $produk->bumdes_id==$b->id?'selected':'' }}>
{{ $b->nama_bumdes }}
</option>
@endforeach
</select>

<input type="text" name="nama_produk" class="form-control mb-2" value="{{ $produk->nama_produk }}">
<input type="text" name="kategori" class="form-control mb-2" value="{{ $produk->kategori }}">
<input type="text" name="jenis_usaha" class="form-control mb-2" value="{{ $produk->jenis_usaha }}">
<input type="number" name="tahun" class="form-control mb-2" value="{{ $produk->tahun }}">

<button class="btn btn-success">Update</button>
</form>
@endsection