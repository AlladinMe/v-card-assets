
<?php $__env->startPush('css-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
    <script src="<?php echo e(asset('custom/js/purpose.js')); ?>"></script>
    <script>
        var e = $("#chart-sales");
        ! function(e) {
            var t = {
                    chart: {
                        width: "100%",
                        zoom: {
                            enabled: !1
                        },
                        toolbar: {
                            show: !1
                        },
                        shadow: {
                            enabled: !1
                        }
                    },
                    stroke: {
                        width: 6,
                        curve: "smooth"
                    },
                    series: [{
                        name: "<?php echo e(__('Order')); ?>",
                        data: <?php echo json_encode($chartData['data']); ?>

                    }],
                    xaxis: {
                        labels: {
                            format: "MMM",
                            style: {
                                colors: PurposeStyle.colors.gray[600],
                                fontSize: "14px",
                                fontFamily: PurposeStyle.fonts.base,
                                cssClass: "apexcharts-xaxis-label"
                            }
                        },
                        axisBorder: {
                            show: !1
                        },
                        axisTicks: {
                            show: !0,
                            borderType: "solid",
                            color: PurposeStyle.colors.gray[300],
                            height: 6,
                            offsetX: 0,
                            offsetY: 0
                        },
                        type: "text",
                        categories: <?php echo json_encode($chartData['label']); ?>

                    },
                    yaxis: {
                        labels: {
                            style: {
                                color: PurposeStyle.colors.gray[600],
                                fontSize: "12px",
                                fontFamily: PurposeStyle.fonts.base
                            }
                        },
                        axisBorder: {
                            show: !1
                        },
                        axisTicks: {
                            show: !0,
                            borderType: "solid",
                            color: PurposeStyle.colors.gray[300],
                            height: 6,
                            offsetX: 0,
                            offsetY: 0
                        }
                    },
                    fill: {
                        type: "solid"
                    },
                    markers: {
                        size: 4,
                        opacity: .7,
                        strokeColor: "#fff",
                        strokeWidth: 3,
                        hover: {
                            size: 7
                        }
                    },
                    grid: {
                        borderColor: PurposeStyle.colors.gray[300],
                        strokeDashArray: 5
                    },
                    dataLabels: {
                        enabled: !1
                    }
                },
                a = (
                    e.data().dataset, e.data().labels, e.data().color),
                n = e.data().height,
                o = e.data().type;
            t.colors = [
                    PurposeStyle.colors.theme[a]
                ],
                t.markers.colors = [
                    PurposeStyle.colors.theme[a]
                ], t.chart.height = n || 350, t.chart.type = o || "line";
            var i = new ApexCharts(e[0], t);
        }($("#chart-sales"));
    </script>
<?php $__env->stopPush(); ?>
<?php
    $admin_payment_setting = \App\Models\Utility::getAdminPaymentSetting();

?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="row">
                        <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body" style="min-height: 230px;">
                                    <div class="theme-avtar bg-info">
                                        <i class="ti ti-user dash-micon"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total Users')); ?></p>
                                    <h3 class="mb-0 mt-3"><?php echo e($user->total_user); ?></h3>

                                    <h6 class="mb-0 mt-2"><?php echo e(__('PAID USERS : ')); ?> <span
                                            class="text-success text-sm "><?php echo e($user['total_paid_user']); ?></span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body" style="min-height: 230px;">
                                    <div class="theme-avtar bg-warning">
                                        <i class="ti ti-shopping-cart"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total Orders')); ?></p>
                                    <h3 class="mb-0 mt-3"><?php echo e($user->total_orders); ?></h3>

                                    <h6 class="mb-0 mt-2"><?php echo e(__('Total Order Amount : ')); ?> <span
                                            class="text-warning text-sm "><?php echo e((isset($admin_payment_setting['CURRENCY_SYMBOL']) ? $admin_payment_setting['CURRENCY_SYMBOL']  : '$') . $user['total_orders_price']); ?></span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6 col-12 ">
                            <div class="card">
                                <div class="card-body" style="min-height: 230px;">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-trophy"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total Plans')); ?></p>
                                    <h3 class="mb-0 mt-3"><?php echo e($user['total_plan']); ?></h3>

                                    <h6 class="mb-0 mt-2"><?php echo e(__('Most Purchase Plan : ')); ?><span
                                            class="text-primary text-sm "><?php echo e($user['most_purchese_plan']); ?></span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <h5><?php echo e(__('Recent Order')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <div id="chart-sales"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
    <script src="<?php echo e(asset('custom/js/purpose.js')); ?>"></script>
    <script type="text/javascript">
        (function() {
            // <?php echo json_encode($chartData['data']); ?>


            var options = {
                series: [{
                    name: 'Order',
                    //  data: [31, 40, 28, 51, 42, 109, 100]
                    data: <?php echo json_encode($chartData['data']); ?>

                }],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    }
                },

                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    type: 'datetime',
                    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z",
                        "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                        "2018-09-19T06:30:00.000Z"
                    ]
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector("#chart-sales"), options);
            chart.render();
        })();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/dashboard/admin_dashboard.blade.php ENDPATH**/ ?>