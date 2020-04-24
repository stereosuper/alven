const startup = () => {
    const portfolio = document.getElementById('portfolio');

    if (!portfolio) return;

    const wrapper = document.getElementById('startup');
    const links = portfolio.querySelectorAll('.ajax-load');

    const openStartup = (html, href, name) => {
        wrapper.innerHTML = html;

        wrapper.querySelector('#close').addEventListener(
            'click',
            () => {
                wrapper.innerHTML = '';
            },
            false
        );

        history.pushState(
            {
                id: name
            },
            '',
            href
        );
    };

    const loadUrl = (href, name) => {
        fetch(alven_ajax.ajax_url + '?action=alven_portfolio_ajax&name=' + name, {
            method: 'POST'
        })
            .then(response => response.text())
            .then(html => openStartup(html, href, name))
            .catch(ex => console.error('Error', ex.message));
    };

    links.forEach(link => {
        link.addEventListener(
            'click',
            e => {
                e.preventDefault();
                loadUrl(link.href, link.dataset.name);
            },
            false
        );
    });

    if (window.location.pathname === '/portfolio/' && window.location.hash) {
        loadUrl(window.location.href, window.location.hash.replace('#', ''));
    }
};

export default startup;
