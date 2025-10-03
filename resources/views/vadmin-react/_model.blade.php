<script>
    window.VAdminReact = window.VAdminReact || {};
    window.VAdminReact.model = {
        siteName: @json($siteName ?? 'Admin'),
        domain: @json($domain ?? request()->getHost()),
        app: @json($app ?? 'vadmin-testsite'),
        themeColor: @json($themeColor ?? '#6366f1')
    };
</script>


