@once
@php
    $flashMessages = [];
    $flashMap = [
        'success' => 'success',
        'success-main' => 'success',
        'success-front' => 'success',
        'warning' => 'warning',
        'warning-main' => 'warning',
        'warning-front' => 'warning',
        'danger' => 'error',
        'danger-main' => 'error',
        'danger-front' => 'error',
        'error' => 'error',
        'info' => 'info',
        'info-main' => 'info',
        'info-front' => 'info',
    ];

    foreach ($flashMap as $key => $icon) {
        if (Session::has($key)) {
            $flashMessages[] = [
                'icon' => $icon,
                'title' => $icon === 'error' ? 'Error' : ucfirst($icon),
                'text' => Session::get($key),
            ];
        }
    }

    if ($errors->any()) {
        $flashMessages[] = [
            'icon' => 'error',
            'title' => 'Please check the form',
            'html' => '<ul style="text-align:left;margin:0;padding-left:18px;">' . collect($errors->all())->map(fn($error) => '<li>' . e($error) . '</li>')->implode('') . '</ul>',
        ];
    }
@endphp

@if(count($flashMessages))
<script>
(function () {
    const messages = @json($flashMessages);

    function loadSweetAlert(callback) {
        if (window.Swal) {
            callback();
            return;
        }

        const existing = document.querySelector('script[data-sweetalert-loader="true"]');
        if (existing) {
            existing.addEventListener('load', callback, { once: true });
            return;
        }

        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        script.async = true;
        script.dataset.sweetalertLoader = 'true';
        script.onload = callback;
        document.head.appendChild(script);
    }

    function showMessages() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        messages.forEach(function (message, index) {
            setTimeout(function () {
                if (message.html) {
                    Swal.fire({
                        icon: message.icon,
                        title: message.title,
                        html: message.html,
                        confirmButtonText: 'Okay'
                    });
                    return;
                }

                Toast.fire({
                    icon: message.icon,
                    title: message.text || message.title
                });
            }, index * 350);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            loadSweetAlert(showMessages);
        });
    } else {
        loadSweetAlert(showMessages);
    }
})();
</script>
@endif
@endonce
