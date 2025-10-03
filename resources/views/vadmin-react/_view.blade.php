<script>
    window.VAdminReact = window.VAdminReact || {};
    (function () {
        function AdminView({ viewModel }) {
            const containerStyle = {
                minHeight: '100vh',
                background: 'linear-gradient(135deg, ' + viewModel.model.themeColor + ', #0ea5e9)',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center'
            };
            const cardStyle = {
                background: 'rgba(255,255,255,0.1)',
                borderRadius: 16,
                padding: 24,
                boxShadow: '0 8px 32px rgba(0,0,0,0.35)',
                width: 'min(92vw, 960px)'
            };

            return React.createElement('div', { style: containerStyle },
                React.createElement('div', { style: cardStyle },
                    React.createElement('h1', { style: { marginTop: 0, marginBottom: 12 } }, '🚍 ' + viewModel.getHeaderTitle()),
                    React.createElement('div', null,
                        ...viewModel.getBadges().map(function (b) {
                            return React.createElement(window.Shared.Badge, { key: b.label, label: b.label, value: b.value });
                        })
                    ),
                    React.createElement('p', null, 'React admin dashboard placeholder. Replace this with your dashboard routes/components.'),
                    React.createElement('p', null,
                        React.createElement('a', { href: '/about', style: { color: 'white', textDecoration: 'underline' } }, 'About Page')
                    )
                )
            );
        }

        window.VAdminReact.AdminView = AdminView;
    })();
</script>


