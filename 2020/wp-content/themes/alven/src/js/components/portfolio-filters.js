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
    const types = ['investment', 'location', 'field', 'subfield'];
    let filterNames = [];

    // responsive variables
    let filtersWrapper;
    const btnsFilters = filters.querySelectorAll('.js-open-filters');
    const closeFilters = filters.querySelectorAll('.js-close-filters');

    const sortPortfolio = () => {
        forEach(links, link => {
            forEach(filterNames, filter => {
                if (!link.dataset[filter.name].split(',').includes(filter.filter)) link.classList.add('off');
            });
        });
    };

    const addFilter = btn => {
        filterNames.push({ name: btn.dataset.filter, filter: btn.dataset[btn.dataset.filter] });
        sortPortfolio();
    };

    const removeFilter = btn => {
        filterNames = filterNames.filter(x => x.filter !== btn.dataset[btn.dataset.filter]);
        forEach(links, link => {
            if (!link.dataset[btn.dataset.filter].split(',').includes(btn.dataset[btn.dataset.filter]))
                link.classList.remove('off');
        });

        sortPortfolio();

        btn.classList.remove('on');
        btn.blur();
    };

    const handleUniqueFilter = (btn, cat) => {
        if (btn.dataset.filter !== cat) return;

        forEach(btns, link => {
            if (
                (cat === 'field' && link.dataset.filter === 'subfield') ||
                (cat === 'subfield' && link.dataset.filter === 'field' && btn.dataset.parent !== link.dataset.field)
            ) {
                removeFilter(link);
            }

            if (!link.dataset[cat]) return;

            if (link.dataset[cat] !== btn.dataset[btn.dataset.filter] && link.classList.contains('on')) {
                removeFilter(link);
            }
        });
    };

    const handleFilter = btn => {
        if (btn.classList.contains('on')) {
            removeFilter(btn);
            return;
        }

        addFilter(btn);
        btn.classList.add('on');

        forEach(types, type => {
            handleUniqueFilter(btn, type);
        });
    };

    forEach(btns, btn => {
        if (btn.classList.contains('on')) {
            addFilter(btn);
        }

        btn.addEventListener(
            'click',
            () => {
                handleFilter(btn);
            },
            false
        );
    });

    // responsive
    forEach(btnsFilters, btn => {
        btn.addEventListener(
            'click',
            () => {
                filtersWrapper = document.getElementById(btn.dataset.type);
                gsap.fromTo(filtersWrapper, 0.2, { display: 'block' }, { opacity: 1, y: 0 });
                gsap.fromTo(filtersWrapper.querySelector('.filters-inner'), 0.25, { y: 50 }, { y: 0, delay: 0.05 });
                document.getElementsByTagName('html')[0].classList.add('no-scroll');
            },
            false
        );
    });

    forEach(closeFilters, btn => {
        btn.addEventListener(
            'click',
            () => {
                gsap.to(filtersWrapper.querySelector('.filters-inner'), 0.2, { y: 50 });
                gsap.to(filtersWrapper, 0.2, {
                    opacity: 0,
                    delay: 0.1,
                    onComplete: () => {
                        gsap.set(filtersWrapper, { display: 'none' });
                    }
                });
                document.getElementsByTagName('html')[0].classList.remove('no-scroll');
                gsap.set(window, { scrollTo: '#portfolio-filters' });
            },
            false
        );
    });
};

export default portfolio;
