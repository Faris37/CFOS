@extends('layouts.app')

@section('content')
<div class="content">
<div class="row">
        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-header">
                    @can('parent.users')
                        <h5 class="card-category">Total Childrens</h5>
                        <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> {{$child}}</h3>
                    @endcan
                    @can('edit.canteen')
                        <h5 class="card-category">Total Menu</h5>
                        <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> {{$child}}</h3>
                    @endcan
                </div>
            </div>
        </div>
        <br>
        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-header">
                    @can('parent.users')
                        <h5 class="card-category">Total orders</h5>
                        <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> {{$orders}}</h3>
                    @endcan
                    @can('edit.canteen')
                        <h5 class="card-category">Total Orders Income</h5>
                        <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> {{$orders}}</h3>
                    @endcan
                    
                </div>
            </div>
        </div> 
    </div>

        <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                        @can('parent.users')
                            <h5 class="card-category">Total Spent (RM)</h5>
                        @endcan
                        @can('edit.canteen')
                        <h5 class="card-category">Total Income (RM)</h5>
                        @endcan
                        </div>
                        <div class="col-sm-6">
                            
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="canvas" width="1422" height="440" style="display: block; width: 711px; height: 220px;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script type="application/javascript">
    var year = <?php echo $year; ?>;
    var user = <?php echo $user; ?>;
    var barChartData = {
        labels: year,
        datasets: [{
            label: '',
            backgroundColor: "#b9e567",
            data: user
        }]
    };
    
    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: false,
                    text: 'Spent (RM)'
                }
            }
        });
    };
</script>