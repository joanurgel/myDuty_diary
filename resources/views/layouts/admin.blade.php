@include('layouts.admin-partials._header')
    
    <div id="app">
        <body id="page-top">

        <div id="wrapper">
            @include('layouts.admin-partials._sidebar')
            
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content" class="pb-2">

                        @include('layouts.admin-partials._topbar')

                        <!-- Begin Page Content -->
                        <div class="container-fluid pb-2 mb-2">

                            @yield('content')

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                    @include('layouts.admin-partials._footer-block')

                </div>
                <!-- End of Content Wrapper -->
            </main>
        </div>
    </div>

    @include('layouts.admin-partials._scroll-to-top')

    @include('layouts.admin-partials._log-out-modal')

    @include('layouts.admin-partials._footer')