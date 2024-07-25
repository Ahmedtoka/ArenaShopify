@extends('layouts.app')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-8 offset-2">
      <div class="card">
        <div class="card-body">
          {{-- <h5 class="card-title">Add a Private App</h5> --}}
          <!-- General Form Elements -->
          <form method="POST" action="{{route('stores.update.config' , $store->table_id)}}" enctype="multipart/form-data">
            @csrf
            <h3 class="pt-4">Store Details</h3>
            <div class="row mb-3 mt-4">
                <label for="inputText" class="col-sm-4 col-form-label">Store Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" value="{{$store->site_name}}" required>
                  @error('name')
                    <span class="badge bg-danger" >{{$message}}</span>
                  @enderror
                </div>
            </div>
            <div class="row mb-3 mt-4">
                <label for="inputEmail" class="col-sm-4 col-form-label">Store Symbol</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="symbol" value="{{$store->site_symbol}}" required>
                  @error('symbol')
                    <span class="badge bg-danger" >{{$message}}</span>
                  @enderror
                </div>
            </div>
            <div class="row mb-3 mt-4">
                <label for="inputPassword" class="col-sm-4 col-form-label">Website</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="website" value="{{$store->website}}" required>
                  @error('website')
                    <span class="badge bg-danger" >{{$message}}</span>
                  @enderror
                </div>
            </div>
            <div class="row mb-3 mt-4">
              <label for="inputPassword" class="col-sm-4 col-form-label">Facebook</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="facebook" value="{{$store->facebook}}" required>
                @error('facebook')
                  <span class="badge bg-danger" >{{$message}}</span>
                @enderror
              </div>
            </div>
          
            <div class="row mb-3 mt-4">
              <label for="inputPassword" class="col-sm-4 col-form-label">Instagram</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="instagram" value="{{$store->instagram}}" required>
                @error('instgram')
                  <span class="badge bg-danger" >{{$message}}</span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputImage" class="col-sm-4 col-form-label">Store logo</label>
              <div class="col-sm-8">
                @if ($store->logo)
                  <img src="{{ asset($store->logo) }}" alt="Store Logo" style="max-width: 200px; max-height: 200px;">
                @else
                  <p>No image uploaded</p>
                @endif
                <input type="file" class="form-control" name="logo">
                @error('logo')
                  <span class="badge bg-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form><!-- End General Form Elements -->
        </div>
      </div>
    </div>
  </div>
</section>
@endsection