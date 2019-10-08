@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">
                   
                   <div class="row">
                        @foreach ($states as $state)
                    <div class="col-md-3">
                     <div class="alert alert-primary" role="alert">
                        <h5>{{$state->name}}</h5>
                        <p>Country : {{$state->country->name}}</p>
                        @for ($i = 0; $i < count($state->cities); $i++)
                        <p>City : {{$state->cities[$i]->name}}</p>
                        @endfor                       
                     </div>
                   </div>
                   @endforeach

                   </div>                       
                </div>
                {{$states->links()}}
            </div>
		</div>
	</div>
</div>
@endsection