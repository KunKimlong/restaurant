@extends('master-dashboard')

@section('page-title')
    <div class="card card-rounded">
        <div class="card-header p-3">
            <h5 class="m-0">Food Management</h5>
        </div>
    </div>
@endsection

@section('content')
    @if ($errors->any())
        <div class="text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card rounded rounded-5">
        <div class="card-header d-flex justify-between p-3">
            <div class="card-title">Food</div>
            <div class="right">
                <button class="btn btn-primary text-light" data-url="{{ route('food.create') }}" data-action="show">+ Create
                    new food</button>
            </div>
        </div>
        <div class="card-body">
            <div class="row" id="show-card">
                @forelse ($foods as $index => $food)
                    <div class="col-3">
                        <div class="card">
                            <img class="card-img-top card-img" src="{{ asset('Store/' . $food->image) }}" alt="Card image cap">
                            <div class="card-body">
                                <h6 class="card-title">Name: {{ $food->name }}</h6>
                                <h6 class="card-title">Type: {{ $food->type }}</h6>
                                <div class="d-flex justify-content-between">
                                    <span class="card-title">Price: {{ $food->price }}$</span>
                                    <span class="card-title">Discount: {{ $food->discount }}%</span>
                                </div>
                                <h6 class="card-title">Created at: {{ $food->created_at_date }}</h6>
                                <h6 class="card-title">Updated at: {{ $food->updated_at_date }}</h6>
                                <button class="btn btn-warning" data-url="{{ route('food.edit', $food->id) }}"
                                    data-action="show" update_id="{{ $food->id }}">{!! iconEdit() !!}
                                    Edit</button>
                                <button class="btn btn-danger" id="btn-remove"
                                    data-remove-id="{{ $food->id }}">{!! iconRemove() !!}Delete</button>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>


            {{-- <ul class="page">
                @for ($i = 1; $i <= $pages; $i++)
                    <li><a href="?page={{$i}}">{{$i}}</a></li>
                @endfor
            </ul> --}}
        </div>
    </div>

    @if (Session::has('success'))
        <script>
            $(document).ready(function() {
                var message = {!! json_encode(Session::get('success')) !!}
                $.notify({
                    icon: 'la la-bell',
                    title: 'Success',
                    message,
                }, {
                    type: 'success',
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    time: 2000,
                });
            })
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            $(document).ready(function() {
                var message = {!! json_encode(Session::get('error')) !!}
                console.error(message);
                $.notify({
                    icon: 'la la-bell',
                    title: 'Error',
                    message,
                }, {
                    type: 'danger',
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    time: 2000,
                });
            })
        </script>
    @endif
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#btn-remove', function() {
                Swal.fire({
                    title: "Are you sure to remove?",
                    text: "You will be remove it and cannot get it back.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#1d62f0",
                    cancelButtonColor: "#ff646d ",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).data('remove-id');
                        var url = "{{ route('food.destroy', ':id') }}".replace(':id', id)
                        $.ajax({
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id
                            },
                            url,
                            success: function(res, textStatus, xhr) {
                                var foods = res.foods;
                                var txt = '';
                                foods.forEach((food, i) => {
                                    var updateUrl =
                                        '{{ route('food.edit', ':id') }}'
                                        .replace(':id', food.id);
                                    txt += `
                                        <div class="col-3">
                                            <div class="card">
                                                <img class="card-img-top card-img" src="{{ asset('Store/${food.image}') }}" alt="Card image cap">
                                                <div class="card-body">
                                                    <h6 class="card-title">Name: ${food.name }</h6>
                                                    <h6 class="card-title">Type: ${ food.type }</h6>
                                                    <div class="d-flex justify-content-between">
                                                        <span class="card-title">Price: ${ food.price }$</span>
                                                        <span class="card-title">Discount: ${ food.discount }%</span>
                                                    </div>
                                                    <h6 class="card-title">Created at: ${ food.created_at }</h6>
                                                    <h6 class="card-title">Updated at: ${ food.updated_at }</h6>
                                                    <button class="btn btn-warning" data-url="${updateUrl}"
                                                        data-action="show" update_id="${food.id }">{!! iconEdit() !!}
                                                        Edit</button>
                                                    <button class="btn btn-danger" id="btn-remove"
                                                        data-remove-id="${ food.id }">{!! iconRemove() !!}Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                });
                                $('#show-card').html(txt);
                                if (xhr.status === 200) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: res.responseText,
                                        icon: "success"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: res.responseText,
                                        icon: "error"
                                    });
                                }
                            }
                        })
                    }
                });
            })
        })
    </script>
@endpush
