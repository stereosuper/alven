// ⚠️ Do not remove the line below or your scss won't work anymore
import '../scss/main.scss';

// @babel/polyfill is necessary for async imports
import '@babel/polyfill';

// Imports
// To learn how to use Sac
// SEE: https://github.com/stereosuper/stereorepo/tree/master/packages/sac
import { bodyRouter, useSacVanilla, useSuperLoad, useSuperWindow } from '@stereorepo/sac';
import header from './components/header';
import search from './components/search';
import forms from './components/forms';
import contact from './components/contact';
import gallery from './components/gallery';
import vimeo from './components/vimeo';
import popin from './components/popin';

// ⚠️ DO NOT REMOVE ⚠️
// This function allow you to use dynamic imports with webpack
const dynamicLoading = ({ name }) => async () => {
    // Do not use multiple variables for the import path, otherwise the chunck name will be composed of all the variables (and not the last one)
    const { default: defaultFunction } = await import(/* webpackChunkName: "[request]" */ `./components/${name}`);
    defaultFunction();
};
// ⚠️ DO NOT REMOVE ⚠️

// Dynamic imports
const slider = dynamicLoading({ name: 'slider' });
const startup = dynamicLoading({ name: 'startup' });
const portfolioFilters = dynamicLoading({ name: 'portfolio-filters' });
const portfolioSearch = dynamicLoading({ name: 'portfolio-search' });
const portfolioLogos = dynamicLoading({ name: 'portfolio-logos' });
const history = dynamicLoading({ name: 'history' });
const team = dynamicLoading({ name: 'team' });
const videos = dynamicLoading({ name: 'videos' });

// Initialization functions
// const preloadCallback = () => {
// All actions needed at page load
// };

const loadCallback = () => {
    // All actions needed after page load (like click events for example)
    header();
    search();
    forms();
    gallery();
    vimeo.initPlayers();
    popin();

    bodyRouter({
        identifier: '.home',
        callback: () => {
            slider();
            videos();
        }
    });

    bodyRouter({
        identifier: '.page-template-portfolio',
        callback: () => {
            startup();
            portfolioSearch();
            portfolioFilters();
            portfolioLogos();
        }
    });

    bodyRouter({
        identifier: '.page-template-about',
        callback: history
    });

    bodyRouter({
        identifier: '.page-template-team',
        callback: team
    });

    contact();
};

// const animationsCallback = () => {
// Animations shouldn't be render blocking... so they'll be called last
// };

// Init sac superComponents
useSacVanilla();
useSuperLoad();
useSuperWindow();

// Access superComponents
window.$stereorepo.superLoad.initializeLoadingShit({
    //preloadCallback,
    loadCallback,
    //animationsCallback,
    noTransElementsClass: '.element-without-transition-on-resize'
});
