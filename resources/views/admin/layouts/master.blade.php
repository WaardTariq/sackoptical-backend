<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacks Optical - Admin</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom Premium Style -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Animations CSS -->
    <link href="{{ asset('assets/css/animations.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body>

    <div class="admin-wrapper">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @include('admin.layouts.header')

            <div class="content-body">
                @yield('content')
            </div>

            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Image Uploader JS -->
    <script src="{{ asset('assets/js/image-uploader.js') }}"></script>

    <!-- Dashboard Animations JS -->
    <script src="{{ asset('assets/js/dashboard-animations.js') }}"></script>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="supportToast" class="toast overflow-hidden border-0 shadow-lg" role="alert" aria-live="assertive"
            aria-atomic="true" style="cursor: pointer; background: #fff; width: 350px;">
            <div class="toast-header bg-dark text-white border-0 py-3">
                <i class="fa-solid fa-envelope-open-text me-2"></i>
                <strong class="me-auto">New Support Message</strong>
                <small>Just now</small>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
            <div class="toast-body p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-msg bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 45px; height: 45px; flex-shrink: 0;">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="msg-preview overflow-hidden">
                        <h6 class="mb-0 fw-bold name-placeholder text-dark">Name</h6>
                        <p class="mb-0 text-muted small text-truncate subject-placeholder">Subject line here...</p>
                    </div>
                </div>
            </div>
            <div class="bg-light border-top p-2 text-center">
                <small class="text-uppercase fw-bold letter-spacing-1" style="font-size: 0.6rem;">Click to view
                    message</small>
            </div>
        </div>
    </div>

    @yield('scripts')

    <script>
        $(document).ready(function () {
            let lastMessageCount = 0;
            let firstCheck = true;

            function checkSupportMessages() {
                $.ajax({
                    url: "{{ route('admin.support-messages.unread-count') }}",
                    method: 'GET',
                    success: function (data) {
                        if (!firstCheck && data.count > lastMessageCount) {
                            // Show Toast
                            $('#supportToast .name-placeholder').text(data.latest.name);
                            $('#supportToast .subject-placeholder').text(data.latest.subject);

                            const toast = new bootstrap.Toast(document.getElementById('supportToast'), {
                                autohide: false
                            });
                            toast.show();

                            // Update header badge
                            if(data.count > 0) {
                                $('.support-unread-badge').text(data.count).show();
                            } else {
                                $('.support-unread-badge').hide();
                            }
                        }
                        lastMessageCount = data.count;
                        
                        // Initial badge state
                        if(firstCheck) {
                            if(data.count > 0) {
                                $('.support-unread-badge').text(data.count).show();
                            }
                        }
                        
                        firstCheck = false;
                    }
                });
            }

            // Click toast to redirect
            $('#supportToast').on('click', function () {
                window.location.href = "{{ route('admin.support-messages.index') }}";
            });

            // Initial check and set interval
            checkSupportMessages();
            setInterval(checkSupportMessages, 10000); // Check every 10 seconds
        });
    </script>
</body>

</html>