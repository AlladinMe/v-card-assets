<?php
    $profile = \App\Models\Utility::get_file('uploads/avatar');
    $qr_path = \App\Models\Utility::get_file('qrcode');
    $businesses = App\Models\Business::allBusiness();
    $currantBusiness = $users->currentBusiness();
    $bussiness_id = $users->current_business;
    $settings = Utility::settings();
?>

<?php $__env->startPush('css-page'); ?>
    <style>
        .shareqrcode img {
            width: 65%;
            height: 65%;
        }

        .shareqrcode canvas {
            width: 65%;
            height: 65%;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="page-title mb-3">
            <div class="row justify-content-between align-items-center">
                <div class="d-flex col-md-10 mb-3 mb-md-0">
                    <h5 class="h3 mb-0"><?php echo e(__('Dashboard')); ?></h5>

                    
                    <ul class="list-unstyled business-header">
                        <li class="dropdown dash-h-item drp-language">
                            <a class="dash-head-link dropdown-toggle arrow-none me-0 cust-btn shadow-sm border border-success"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                data-bs-original-title="<?php echo e(__('Select your bussiness')); ?>">
                                <i class="ti ti-credit-card"></i>
                                <span class="drp-text hide-mob"><?php echo e(__(ucfirst($currantBusiness))); ?></span>
                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                            </a>
                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end page-inner-dropdowm">
                                <?php $__currentLoopData = $businesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $business): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($business['admin_enable'] == 'on'): ?>
                                        <a href="<?php echo e(route('business.change', $business['id'])); ?>" class="dropdown-item">
                                            <i
                                                class="<?php if($bussiness_id == $business['id']): ?> ti ti-checks text-primary <?php elseif($currantBusiness == $business['title']): ?> ti ti-checks text-primary <?php endif; ?> "></i>
                                            <span><?php echo e(ucfirst($business['title'])); ?></span>
                                        </a>
                                    <?php else: ?>
                                        <a href="#" class="dropdown-item">
                                            <i class="ti ti-lock"></i>
                                            <span class="row-disabled"><?php echo e(ucfirst($business['title'])); ?></span>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </li>
                    </ul>

                    

                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-4 welcome-card">
                    <div class="border bg-light-success p-3 border-success rounded text-dark h-100 ">
                        <div class="d-flex align-items-center mb-4">
                            <div class="me-2">
                                <img class="theme-avtar avtar rounded-circle"
                                    src="<?php echo e(!empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . '/avatar.png'); ?>" />
                            </div>
                            <div>
                                <h5 class="mb-0">
                                    <span class="d-block" id="greetings"></span>
                                    <b class="f-w-700"><?php echo e(__(ucFirst(Auth::user()->name))); ?></b>
                                </h5>
                            </div>
                        </div>
                        <p class="mb-0">
                            <?php echo e(__('Have a nice day! Did you know that you can quickly add your favorite card to the business?')); ?>

                        </p>
                        <div class="btn-group mt-4">
                            <button class="btn  btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-plus me-2">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <?php echo e(__('Quick add')); ?></button>
                            <div class="dropdown-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create business')): ?>
                                    <a href="#" data-size="xl" data-url="<?php echo e(route('business.create')); ?>"
                                        data-ajax-popup="true" data-title="Create New Business" class="dropdown-item"
                                        data-bs-placement="top ">
                                        <span><?php echo e(__('Add new Business')); ?></span>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create user')): ?>
                                    <a href="#" data-size="md" data-url="<?php echo e(route('users.create')); ?>"
                                        data-ajax-popup="true" data-title="Create New User" class="dropdown-item"
                                        data-bs-placement="top ">
                                        <span><?php echo e(__('Add new user')); ?></span>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create role')): ?>
                                    <a href="#" data-size="lg" data-url="<?php echo e(route('roles.create')); ?>"
                                        data-ajax-popup="true" data-title="Create New Role" class="dropdown-item"
                                        data-bs-placement="top">
                                        <span><?php echo e(__('Add new role')); ?></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($businessData): ?>
                    <?php
                        if ($businessData['enable_businesslink'] == 'on') {
                            $start_url = url('/').'/'. $businessData['slug'];
                        } elseif ($businessData['enable_domain'] == 'on') {
                            $start_url = 'https://' . $businessData['domains'] . '/';
                        } else {
                            $start_url = 'https://' . $businessData['subdomain'] . '/';
                        }
                    ?>
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-body" style="min-height: 230px;">
                                <h6 class="mb-0 text-center"><?php echo e(ucFirst($businessData->title)); ?></h6>
                                <div class="mb-3 shareqrcode text-center"></div>
                                <div class="d-flex justify-content-between">
                                    <a href="#!" class="btn btn-sm btn-light-primary w-100 cp_link"
                                        data-link="<?php echo e($start_url); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="" data-bs-original-title="Click to copy business link">
                                        <?php echo e('Business Link'); ?>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-copy ms-1">
                                            <rect x="9" y="9" width="13" height="13" rx="2"
                                                ry="2"></rect>
                                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                        </svg>
                                    </a>
                                    <a href="#" id="socialShareButton"
                                        class="socialShareButton btn btn-sm btn-primary ms-1 share-btn">
                                        <i class="ti ti-share"></i>
                                    </a>
                                    <div id="sharingButtonsContainer" class="sharingButtonsContainer"
                                        style="display: none;">
                                        <div class="Demo1 d-flex align-items-center justify-content-center hidden"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body" style="min-height: 230px;">
                            <div class="theme-avtar bg-primary">
                                <i class="ti ti-briefcase dash-micon"></i>
                            </div>
                            <p class="text-muted text-sm mt-4 mb-2"></p>
                            <h6 class="mb-3"><?php echo e(__('Total Business')); ?></h6>
                            <h3 class="mb-0"><?php echo e($total_bussiness); ?> </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body" style="min-height: 230px;">
                            <div class="theme-avtar bg-warning">
                                <i class="ti ti-clipboard-check dash-micon"></i>
                            </div>
                            <p class="text-muted text-sm mt-4 mb-2"></p>
                            <h6 class="mb-3"><?php echo e(__('Total Appointments')); ?></h6>
                            <h3 class="mb-0"><?php echo e($total_app); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body" style="min-height: 230px;">
                            <div class="theme-avtar bg-warning">
                                <i class="ti ti-users dash-micon"></i>
                            </div>
                            <p class="text-muted text-sm mt-4 mb-2"></p>
                            <h6 class="mb-3"><?php echo e(__('Total Staff')); ?></h6>
                            <h3 class="mb-0"><?php echo e($total_staff); ?></h3>
                        </div>
                    </div>
                </div>



                <div class="col-lg-6 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-end">
                                <span class="mb-0 float-right"><?php echo e(__('Last 7 Days')); ?></span>
                            </div>
                            <h5><?php echo e(__('Appointments')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div id="apex-storedashborad" data-color="primary" data-height="280"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-end">
                                <span class="mb-0 text-sm float-right mt-1"><?php echo e(__('Last 15 Days')); ?></span>
                            </div>
                            <h5 class="mb-0 float-left"><?php echo e(__('Platform')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div id="user_platform-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-end">
                                <span class="mb-0 text-sm float-right mt-1"><?php echo e(__('Last 15 Days')); ?></span>
                            </div>
                            <h5 class="mb-0 float-left"><?php echo e(__('Browser')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div id="pie-storebrowser"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-end">
                                <span class="mb-0 text-sm float-right mt-1"><?php echo e(__('Last 15 Days')); ?></span>
                            </div>
                            <h5 class="mb-0 float-left"><?php echo e(__('Device')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div id="pie-storedashborad"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php if(\Auth::user()->type == 'company'): ?>
                    <div class="col-md-4 ">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Storage Status')); ?> <small>(<?php echo e($users->storage_limit . 'MB'); ?> /
                                        <?php echo e($plan->storage_limit . 'MB'); ?>)</small></h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div id="device-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
        <img src="<?php echo e(isset($qr_detail->image) ? $qr_path . '/' . $qr_detail->image : ''); ?>" id="image-buffers" crossorigin="anonymous"
            style="display: none">
    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('custom-scripts'); ?>
        <script src="<?php echo e(asset('custom/js/purpose.js')); ?>"></script>
            <script src="<?php echo e(asset('custom/js/jquery.qrcode.min.js')); ?>"></script>
       
        <script type="text/javascript">
            $(document).on("change", "select[name='select_card']", function() {
                var b_id = $("select[name='select_card']").val();
                if (b_id == '0') {
                    window.location.href = '<?php echo e(url('/dashboard')); ?>';
                } else {
                    window.location.href = '<?php echo e(url('business/analytics')); ?>/' + b_id;
                }

            });
        </script>
        <script>
            (function() {
                var options = {
                    chart: {
                        height: 350,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },
                    series: <?php echo json_encode($chartData['data']); ?>,
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

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        floating: true,
                        offsetY: -25,
                        offsetX: -5
                    },

                };
                var chart = new ApexCharts(document.querySelector("#apex-storedashborad"), options);
                chart.render();
            })();

            var options = {
                chart: {
                    height: 250,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: true,
                },
                series: <?php echo json_encode($devicearray['data']); ?>,
                colors: ["#6fd943", '#ffa21d', '#FF3A6E', '#3ec9d6'],
                labels: <?php echo json_encode($devicearray['label']); ?>,
                legend: {
                    show: true,
                    position: 'bottom',
                },
            };
            var chart = new ApexCharts(document.querySelector("#pie-storedashborad"), options);
            chart.render();

            var options = {
                chart: {
                    height: 250,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: true,
                },
                series: <?php echo json_encode($browserarray['data']); ?>,
                colors: ["#6fd943", '#ffa21d', '#FF3A6E', '#3ec9d6'],
                labels: <?php echo json_encode($browserarray['label']); ?>,
                legend: {
                    show: true,
                    position: 'bottom',
                },
            };
            var chart = new ApexCharts(document.querySelector("#pie-storebrowser"), options);
            chart.render();
        </script>
        <script>
            var WorkedHoursChart = (function() {
                var $chart = $('#user_platform-chart');

                function init($this) {
                    var options = {
                        chart: {
                            height: 250,
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
                            name: 'Platform',
                            data: <?php echo json_encode($platformarray['data']); ?>,
                        }],
                        xaxis: {
                            labels: {
                                // format: 'MMM',
                                style: {
                                    colors: PurposeStyle.colors.gray[600],
                                    fontSize: '14px',
                                    fontFamily: PurposeStyle.fonts.base,
                                    cssClass: 'apexcharts-xaxis-label',
                                },
                            },
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: true,
                                borderType: 'solid',
                                color: PurposeStyle.colors.gray[300],
                                height: 6,
                                offsetX: 0,
                                offsetY: 0
                            },
                            title: {
                                text: '<?php echo e(__('Platform')); ?>'
                            },
                            categories: <?php echo json_encode($platformarray['label']); ?>,
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    color: PurposeStyle.colors.gray[600],
                                    fontSize: '12px',
                                    fontFamily: PurposeStyle.fonts.base,
                                },
                            },
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: true,
                                borderType: 'solid',
                                color: PurposeStyle.colors.gray[300],
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
                            strokeColor: "#fff",
                            strokeWidth: 3,
                            hover: {
                                size: 7,
                            }
                        },
                        grid: {
                            borderColor: PurposeStyle.colors.gray[300],
                            strokeDashArray: 5,
                        },
                        dataLabels: {
                            enabled: false
                        }
                    }
                    // Get data from data attributes
                    var dataset = $this.data().dataset,
                        labels = $this.data().labels,
                        color = $this.data().color,
                        height = $this.data().height,
                        type = $this.data().type;

                    // Inject synamic properties
                    // options.colors = [
                    //     PurposeStyle.colors.theme[color]
                    // ];
                    // options.markers.colors = [
                    //     PurposeStyle.colors.theme[color]
                    // ];
                    options.chart.height = height ? height : 350;
                    // Init chart
                    var chart = new ApexCharts($this[0], options);
                    // Draw chart
                    setTimeout(function() {
                        chart.render();
                    }, 300);
                }

                // Events
                if ($chart.length) {
                    $chart.each(function() {
                        init($(this));
                    });
                }
            })();
        </script>
        
        <script>
            $(function() {
                $(".dash-head-link.cust-btn").tooltip().tooltip("show");
                setTimeout(() => {
                    $(".dash-head-link.cust-btn").tooltip().tooltip("hide");

                    $(".cust-btn-creat").tooltip().tooltip("show");
                }, 4000);
            });
            $(function() {
                setTimeout(() => {
                    $(".cust-btn-creat").tooltip().tooltip("hide");
                }, 8000);
            });
        </script>
        <script>
            (function() {
                var options = {
                    series: [<?php echo e(number_format($storage_limit, 2)); ?>],
                    chart: {
                        height: 350,
                        type: 'radialBar',
                        offsetY: -20,
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -90,
                            endAngle: 90,
                            track: {
                                background: "#e7e7e7",
                                strokeWidth: '97%',
                                margin: 5, // margin is in pixels
                            },
                            dataLabels: {
                                name: {
                                    show: true
                                },
                                value: {
                                    offsetY: -50,
                                    fontSize: '20px'
                                }
                            }
                        }
                    },
                    grid: {
                        padding: {
                            top: -10
                        }
                    },
                    colors: ["#6FD943"],
                    labels: ['Used'],
                };
                var chart = new ApexCharts(document.querySelector("#device-chart"), options);
                chart.render();
            })();
        </script>
        <script type="text/javascript">
            $('.cp_link').on('click', function() {
                var value = $(this).attr('data-link');
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(value).select();
                document.execCommand("copy");
                $temp.remove();
                toastrs('<?php echo e(__('Success')); ?>', '<?php echo e(__('Link Copy on Clipboard')); ?>', 'success');
            });
        </script>
        <script>
            $(document).ready(function() {
                <?php if($businessData): ?>
                    var slug = '<?php echo e($businessData->slug); ?>';
                    var url_link = `<?php echo e(url('/')); ?>/${slug}`;

                    $(`.qr-link`).text(url_link);
                    
                        var foreground_color =
                            `<?php echo e(isset($qr_detail->foreground_color) ? $qr_detail->foreground_color : '#000000'); ?>`;
                        var background_color =
                            `<?php echo e(isset($qr_detail->background_color) ? $qr_detail->background_color : '#ffffff'); ?>`;
                        var radius = `<?php echo e(isset($qr_detail->radius) ? $qr_detail->radius : 26); ?>`;
                        var qr_type = `<?php echo e(isset($qr_detail->qr_type) ? $qr_detail->qr_type : 0); ?>`;
                        var qr_font = `<?php echo e(isset($qr_detail->qr_text) ? $qr_detail->qr_text : 'vCard'); ?>`;
                        var qr_font_color =
                            `<?php echo e(isset($qr_detail->qr_text_color) ? $qr_detail->qr_text_color : '#f50a0a'); ?>`;
                        var size = `<?php echo e(isset($qr_detail->size) ? $qr_detail->size : 9); ?>`;

                        $('.shareqrcode').empty().qrcode({
                            render: 'image',
                            size: 500,
                            ecLevel: 'H',
                            minVersion: 3,
                            quiet: 1,
                            text: url_link,
                            fill: foreground_color,
                            background: background_color,
                            radius: .01 * parseInt(radius, 10),
                            mode: parseInt(qr_type, 10),
                            label: qr_font,
                            fontcolor: qr_font_color,
                            image: $("#image-buffers")[0],
                            mSize: .01 * parseInt(size, 10)
                        });
                  
                <?php endif; ?>
            });
        </script>
        <script>
            var timezone = '<?php echo e(!empty($settings['timezone']) ? $settings['timezone'] : 'IST'); ?>';

            let today = new Date(new Date().toLocaleString("en-US", {
                timeZone: timezone
            }));
            var curHr = today.getHours()
            var target = document.getElementById("greetings");

            if (curHr < 12) {
                target.innerHTML = "Good Morning,";
            } else if (curHr < 17) {
                target.innerHTML = "Good Afternoon,";
            } else {
                target.innerHTML = "Good Evening,";
            }
        </script>

        <script type="text/javascript">
            <?php if($businessData): ?>
                $(document).ready(function() {
                    var customURL = <?php echo json_encode(url('/' . $businessData->slug)); ?>;
                    $('.Demo1').socialSharingPlugin({
                        url: customURL,
                        title: $('meta[property="og:title"]').attr('content'),
                        description: $('meta[property="og:description"]').attr('content'),
                        img: $('meta[property="og:image"]').attr('content'),
                        enable: ['whatsapp', 'facebook', 'twitter', 'pinterest', 'linkedin']
                    });

                    $('.socialShareButton').click(function(e) {
                        e.preventDefault();
                        $('.sharingButtonsContainer').toggle();
                    });
                });
            <?php endif; ?>
        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vcard/public_html/resources/views/dashboard/dashboard.blade.php ENDPATH**/ ?>