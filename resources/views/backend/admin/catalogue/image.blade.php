@if(!empty($orders->photo) )
<div class="col-md-2 p-0">
  <img width="80px;" height="80px" src="{{asset($orders->photo)}}">
</div>
@endif