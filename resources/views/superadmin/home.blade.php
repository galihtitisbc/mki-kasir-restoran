 @extends('layouts.app')
 @push('css')
 @endpush
 @section('content')
     <div class="row d-flex flex-wrap justify-content-center">
         <div class="col-6">
             <div class="card card-primary">
                 <div class="card-header">
                     <h3 class="card-title">Quick Example</h3>
                 </div>
                 <div class="card-body">
                     sdfdsf
                 </div>
             </div>
         </div>
         <div class="col-6">
             <div class="card card-info">
                 <div class="card-header">
                     <h3 class="card-title">Line Chart</h3>
                     <div class="card-tools">
                         <button type="button" class="btn btn-tool" data-card-widget="collapse">
                             <i class="fas fa-minus"></i>
                         </button>
                         <button type="button" class="btn btn-tool" data-card-widget="remove">
                             <i class="fas fa-times"></i>
                         </button>
                     </div>
                 </div>
                 <div class="card-body">
                     <div class="chart">
                         <canvas id="barChart"
                             style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                     </div>
                 </div>
                 <!-- /.card-body -->
             </div>
         </div>
     @endsection
     @push('js')
         <script src="{{ asset('../../plugins/chart.js/Chart.min.js') }}"></script>
         <script src="{{ asset('js/chart-superadmin.js') }}"></script>
     @endpush
