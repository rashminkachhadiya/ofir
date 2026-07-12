@foreach($orders->orderPicture as $image)
    <img src="{{ asset('assets/images/users/order/').'/'.$image->images }}" alt="Order image" width="48" height="48">
    @php break; @endphp
@endforeach
