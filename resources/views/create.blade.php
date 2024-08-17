@extends('mater')
@section('title')
    <h1>thêm mới</h1>
@endsection
@section('content')
    <form action="{{ route('product.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="mt-3">
            @if ($errors->any())
            <ul>
                 @foreach ($errors->all() as $item)
                    <li style="color: red">{{$item}}</li>
                @endforeach
            </ul>
               
            @endif
        </div>
        <div class="mt-3">
            <label for="">nam</label>
            <input type="text" class="form form-control" name="name">
        </div>
        <div class="mt-3">
            <label for="">description</label>
            <input type="text" class="form form-control" name="description">
        </div>
        <div class="mt-3">
            <label for="">price</label>
            <input type="number" class="form form-control" name="price">
        </div>
        <div class="mt-3">
            <label for="">danh mục</label>
            <select name="dm" class="form form-control" id="">
                @foreach ($ct as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label for="">Tag</label>
            <select name="tag[]" multiple class="form form-control" id="">
                @foreach ($tag as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label for="">gallery</label>

            <?php
             for ($i=0; $i < 2; $i++) {  ?>

            <input type="file" class="form form-control" name="gallery[]">

            <?php  }
            ?>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-success">thêm mới</button>
        </div>
    </form>
@endsection
