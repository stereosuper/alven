import { forEach } from '@stereorepo/sac';

import { gsap } from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin.js';

gsap.registerPlugin(ScrollToPlugin);

const portfolio = () => {
    const portfolio = document.getElementById('portfolio');
    const filters = document.getElementById('portfolio-filters');

    if (!portfolio || !filters) return;

    const btns = filters.querySelectorAll('.btn-filter');
    const links = portfolio.querySelectorAll('li');
    let filterNames = [];
    let filterName = '';
    let filter = '';

    // responsive
    let filtersWrapper;
    const btnsFilters = filters.querySelectorAll('.js-open-filters');
    const closeFilters = filters.querySelectorAll('.js-close-filters');

    const sortPortfolio = () => {
        forEach(links, link => {
            if (!filterNames.length) {
                link.classList.remove('off');
                return;
            }

            link.classList.add('off');

            forEach(filterNames, filter => {
                if (!link.dataset[filter.name].split(',').includes(filter.filter)) return;
                link.classList.remove('off');
            });
        });
    };

    const addFilter = () => {
        filterNames.push({ name: filterName, filter: filter });
        sortPortfolio();
    };

    const getFilter = btn => {
        filterName = btn.dataset.filter;
        filter = btn.dataset[filterName];
    };

    const handleFilter = btn => {
        getFilter(btn);

        if (btn.classList.contains('on')) {
            filterNames = filterNames.filter(x => x.filter !== filter);
            sortPortfolio();

            btn.classList.remove('on');
            btn.blur();

            return;
        }

        addFilter();
        btn.classList.add('on');
    };

    forEach(btns, btn => {
        if (btn.classList.contains('on')) {
            getFilter(btn);
            addFilter();
        }

        btn.addEventListener(
            'click',
            () => {
                handleFilter(btn);
            },
            false
        );
    });

    forEach(btnsFilters, btn => {
        btn.addEventListener(
            'click',
            () => {
                filtersWrapper = document.getElementById(btn.dataset.type);
                filtersWrapper.classList.add('on');
                document.getElementsByTagName('html')[0].classList.add('no-scroll');
            },
            false
        );
    });

    forEach(closeFilters, btn => {
        btn.addEventListener(
            'click',
            () => {
                btn.parentNode.classList.remove('on');
                document.getElementsByTagName('html')[0].classList.remove('no-scroll');
                gsap.set(window, { scrollTo: '#portfolio-filters' });
            },
            false
        );
    });
};

export default portfolio;
