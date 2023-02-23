@extends('layouts.fiscalyear')
@section('content')

<div class="container p-5">
    <h1 class="bg-success text-light text-center p-3">Change Fiscal Year</h1>
    <form action="{{route('addFiscalYear')}}" method="POST">
        @csrf
        <div class="row">
          @foreach ($fiscalyears as $item)
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="form-date" class="form-label">Start Date date</label>
                    <input type="date" id="form-date" class="form-control" name="start_date" value="{{$item->start_date}}">
                    @error('start_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror <br>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="to-date" class="form-label">End date</label>
                    <input type="date" id="to-date" class="form-control" name="end_date" value="{{$item->end_date}}">
                    @error('end_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror <br>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="to-date" class="form-label">Password</label>
                    <input type="text" id="to-date" class="form-control" name="password" value="{{$item->password}}">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror <br>
                </div>
            </div> --}}
          @endforeach
        </div>
        <button type="submit" class="btn btn-primary text-center">Save changes</button>
        </form>
    </div>



@endsection



