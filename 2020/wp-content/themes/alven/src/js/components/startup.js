import { gsap } from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin.js';

gsap.registerPlugin(ScrollToPlugin);

import gallery from './gallery';
import { forEach } from '@stereorepo/sac';

const startup = () => {
    const portfolio = document.getElementById('portfolio');

    if (!portfolio) return;

    const wrapper = document.getElementById('startup');
    const links = portfolio.querySelectorAll('.ajax-load');

    const closeStartup = () => {
        gsap.to(wrapper, 0.5, {
            height: 0,
            onComplete: () => {
                wrapper.innerHTML = '';
                wrapper.style.height = '';
            }
        });

        history.pushState(
            {
                id: 'portfolio'
            },
            '',
            window.location.origin + window.location.pathname
        );
    };

    const openStartup = (html, href, name) => {
        wrapper.innerHTML = html;
        gsap.to(window, { duration: 0.8, scrollTo: '#startup' });
        history.pushState({ id: name }, '', href);

        wrapper.querySelector('#close').addEventListener('click', closeStartup, false);

        gallery();
    };

    const loadStartup = (href, name) => {
        fetch(alven_ajax.ajax_url + '?action=alven_portfolio_ajax&name=' + name, {
            method: 'POST'
        })
            .then(response => response.text())
            .then(html => openStartup(html, href, name))
            .catch(ex => console.error('Error', ex.message));
    };

    forEach(links, link => {
        link.addEventListener(
            'click',
            e => {
                e.preventDefault();
                loadStartup(link.href, link.dataset.name);
            },
            false
        );
    });

    if (window.location.pathname === '/portfolio/' && window.location.hash) {
        loadStartup(window.location.href, window.location.hash.replace('#', ''));
    }
};

export default startup;
