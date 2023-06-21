@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<div class="col-lg-10">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon kt-hidden">
							<i class="la la-gear"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Marcas registradas
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div id="chartdiv"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')


@endsection