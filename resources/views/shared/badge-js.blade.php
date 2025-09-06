<script>
    window.Shared = window.Shared || {};
    (function () {
        function Badge(props) {
            const style = {
                display: 'inline-block',
                background: 'rgba(255,255,255,0.2)',
                padding: '6px 12px',
                borderRadius: 9999,
                marginRight: 8,
                marginBottom: 8,
                fontWeight: 700
            };
            return React.createElement('span', { style }, props.label + ': ' + props.value);
        }

        window.Shared.Badge = Badge;
    })();
</script>


