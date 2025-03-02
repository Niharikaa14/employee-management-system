@extends('admin.layoutss.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-midnight-bloom">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Tasks</div>
                                <!-- <div class="widget-subheading">Last year expenses</div> -->
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white">  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Employees</div>
                                <!-- <div class="widget-subheading">Total Clients Profit</div> -->
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white">  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-grow-early">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Departments</div>
                                <!-- <div class="widget-subheading">People Interested</div> -->
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white">  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-premium-dark">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Products Sold</div>
                                <div class="widget-subheading">Revenue streams</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning"><span>$14M</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Admins</div>
                                    <!-- <div class="widget-subheading">Last year expenses</div> -->
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-success">  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
            
        </div>
    </div>
@endsection
