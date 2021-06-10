@extends('pages/app')

@section('content')
<script>
    // $(document).ready(function () {
    //     $('select').selectize({
    //         sortField: 'text'
    //     });
    // });

</script>


<div class="container">
    <form action="" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Hotel Name </label>
            <input type="text" class="form-control" name="" placeholder="Type hotel name" value="">
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Hotel Name</label>
            <input type="text" class="form-control" name="" placeholder="Quantity" value="">
        </div>
        <script>
            var idx= 0;
        </script>
        <div class="mb-3">
            <label for="age" class="form-label">Pick hotel facility</label> <br>
            {{-- Menampilkan data dari database --}}
            {{-- Masukin ke dalam array --}}
            <?php $arrayFacility[] = []; ?>
            @for ($i = 0; $i < count($editfacilities);)
                <?php $arrayFacility[$i] = $editfacilities[$i]->id_facility ?>
                <?php $i++; ?>
            @endfor

            <?php $index = 0; ?>
            <?php $check = true; $x = 0 ?>
            @for ($i = 0; $i < count($facilities); $i++)
                @if ($check || $x != count($arrayFacility))
                    
                @endif
                <input type="checkbox" class="" name="facility{{ $index++ }}" placeholder="Pick hotel facility" value="{{ $facilities[$i]->id_facility }}"
                <?php  ?>> {{ $facilities[$i]->name }} <br>
                {{ $facilities[$i]->id_facility }}
            @endfor
            
            <input type="hidden" name="count_facility" value="{{ count($facilities) }}">
        </div>

        <div class="mb-3" style="padding-top: 10px">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

        @foreach ($errors->all() as $item)
            <p>{{ $item }}</p>
        @endforeach
    </form>
</div>

@endsection
