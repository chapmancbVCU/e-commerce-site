<?php use Core\Lib\Utilities\Env; ?>
<?php use Core\Lib\Utilities\Config; ?>
<?php $this->setSiteTitle("Vendor Dashboard"); ?>

<!-- Head content between these two function calls.  Remove if not needed. -->
<?php $this->start('head'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
<script type="text/javascript" src="<?=Env::get('APP_DOMAIN', '/')?>node_modules/moment/min/moment.min.js?v=<?=Config::get('config.version')?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<?php $this->end(); ?>


<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<h2>Vendor Dashboard</h2>
<hr>

<div class="row">
    <div class="col-12">
        <div class="form-group col-2 offset-10">
            <select name="" id="dateRangeSelector" class="form-control form-control-sm">
                <option value="last-0">Today</option>
                <option value="last-7">Last 7 Days</option>
                <option value="last-28" selected="selected">Last 28 Days</option>
                <option value="last-90">Last 90 Days</option>
                <option value="last-365">Last 365 Days</option>
            </select>
        </div>
    </div>
    <div class="col-12">
        <canvas id="dailySalesChart" width="400" height="80" class="chartjs"></canvas>
    </div>
</div>

<script>
    function loadDailySalesChart() {
        let range = jQuery('#dateRangeSelector').val();
        jQuery.ajax({
            url : '<?=Env::get('APP_DOMAIN')?>vendordashboard/getDailySales',
            method : "POST",
            data : { range : range },
            success : function(resp) { console.log(resp)
                let ctx = document.getElementById('dailySalesChart');
                
                let data = {
                    labels: resp.labels,
                    datasets: [
                        {
                            "label": "Daily Sales",
                            "data": resp.data,
                            "fill": false,
                            "borderColor": "rgb(75, 192, 192)",
                            "lineTension": 0.1
                        }
                    ]
                };
        
                let options = {};
                let myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });
            }
        });
    }

    document.getElementById('dateRangeSelector').addEventListener('change', function() {
        loadDailySalesChart();
    });

    $('document').ready(function() {
        loadDailySalesChart();
    });
</script>
<?php $this->end(); ?>
