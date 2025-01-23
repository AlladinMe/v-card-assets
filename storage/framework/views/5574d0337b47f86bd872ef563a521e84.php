<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Campaigns Analytics')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Campaigns Analytics')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php if(Auth::user()->type == 'company'): ?>
        <li class="breadcrumb-item active" aria-current="page"><a
                href="<?php echo e(route('campaigns.index')); ?>"><?php echo e(__('Campaigns')); ?></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Campaigns Analytics')); ?></li>
    <?php else: ?>
        <li class="breadcrumb-item active" aria-current="page"><a
                href="<?php echo e(route('campaigns.index')); ?>"><?php echo e(__('Campaigns')); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Campaigns Analytics')); ?></li>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-end">
                        <span class="mb-0 float-right"><?php echo e(__('Total Days')); ?></span>
                    </div>
                    <h5><?php echo e(__('Campaign')); ?></h5>
                    <small></small>
                </div>
                <div class="card-body">
                    <div id="campaignChartDate"></div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('custom-scripts'); ?>
        <script src="<?php echo e(asset('custom/js/purpose.js')); ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            var devicearray = <?php echo json_encode($devicearray); ?>;
           
            var options = {
                chart: {
                    height: 400,
                    type: 'bar',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    },
                    shadow: {
                        enabled: false,
                    },
                },
                plotOptions: {
                    bar: {
                        columnWidth: '30%',
                        borderRadius: 10,
                        dataLabels: {
                            position: 'top',
                        },
                    }
                },
                stroke: {
                    show: true,
                    width: 1,
                    colors: ['#fff']
                },
                series: [{
                        name: 'Total Days',
                        data: devicearray.total_days,
                    },
                    {
                        name: 'Total Cost',
                        data: devicearray.total_cost,
                    }
                ],
                xaxis: {
                    labels: {
                        style: {
                            colors: '#293240',
                            fontSize: '12px',
                            fontFamily: "sans-serif",
                            cssClass: 'apexcharts-xaxis-label',
                        },
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: true,
                        borderType: 'solid',
                        color: '#f2f2f2',
                        height: 6,
                        offsetX: 0,
                        offsetY: 0
                    },
                    title: {
                        text: 'Category'
                    },
                    categories: devicearray.label,
                },
                yaxis: {
                    labels: {
                        style: {
                            color: '#f2f2f2',
                            fontSize: '12px',
                            fontFamily: "Open Sans",
                        },
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: true,
                        borderType: 'solid',
                        color: '#f2f2f2',
                        height: 6,
                        offsetX: 0,
                        offsetY: 0
                    }
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                markers: {
                    size: 4,
                    opacity: 0.7,
                    strokeColor: "#000",
                    strokeWidth: 3,
                    hover: {
                        size: 7,
                    }
                },
                grid: {
                    borderColor: '#f2f2f2',
                    strokeDashArray: 5,
                },
                dataLabels: {
                    enabled: false
                }
            };

            var chart = new ApexCharts(document.querySelector("#campaignChartDate"), options);
            chart.render();
        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/campaigns/analytics.blade.php ENDPATH**/ ?>