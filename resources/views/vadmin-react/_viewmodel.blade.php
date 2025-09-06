<script>
    window.VAdminReact = window.VAdminReact || {};
    (function () {
        function createViewModel(model) {
            function getHeaderTitle() {
                return model.siteName + ' Admin';
            }
            function getBadges() {
                return [
                    { label: 'Domain', value: model.domain },
                    { label: 'App', value: model.app },
                    { label: 'Theme', value: model.themeColor }
                ];
            }
            return { model, getHeaderTitle, getBadges };
        }
        window.VAdminReact.createViewModel = createViewModel;
    })();
</script>


