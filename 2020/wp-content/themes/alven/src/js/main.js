// ⚠️ Do not remove the line below or your scss won't work anymore
import '../scss/main.scss';

// @babel/polyfill is necessary for async imports
import '@babel/polyfill';

// Imports
// To learn how to use Sac
// SEE: https://github.com/stereosuper/stereorepo/tree/master/packages/sac
import { bodyRouter, useSacVanilla, useSuperLoad } from '@stereorepo/sac';
import header from './components/header';

// ⚠️ DO NOT REMOVE ⚠️
// This function allow you to use dynamic imports with webpack
const dynamicLoading = ({ name }) => async () => {
    // Do not use multiple variables for the import path, otherwise the chunck name will be composed of all the variables (and not the last one)
    const { default: defaultFunction } = await import(/* webpackChunkName: "[request]" */ `./components/${name}`);
    defaultFunction();
};
// ⚠️ DO NOT REMOVE ⚠️

// Dynamic imports
// The dynamicLoading function will search for the component DynamicExample in ./js/components folder
const startup = dynamicLoading({ name: 'startup' });
const portfolioFilters = dynamicLoading({ name: 'portfolio-filters' });
const portfolioSearch = dynamicLoading({ name: 'portfolio-search' });
const slider = dynamicLoading({ name: 'slider' });

// Initialization functions
const preloadCallback = () => {
    // All actions needed at page load

    // Example of component called only on the /test route
    // Assuming the .test class is applied on html or body tag
    bodyRouter({
        identifier: '.home',
        callback: slider
    });
    bodyRouter({
        identifier: '.page-template-portfolio',
        callback: startup
    });
    bodyRouter({
        identifier: '.page-template-portfolio',
        callback: portfolioSearch
    });
    bodyRouter({
        identifier: '.page-template-portfolio',
        callback: portfolioFilters
    });
};

const loadCallback = () => {
    // All actions needed after page load (like click events for example)
    header();
};

const animationsCallback = () => {
    // Animations shouldn't be render blocking... so they'll be called last
};

// Init sac superComponents
useSacVanilla();
useSuperLoad();

// Access superComponents
window.$stereorepo.superLoad.initializeLoadingShit({
    preloadCallback,
    loadCallback,
    animationsCallback,
    noTransElementsClass: '.element-without-transition-on-resize'
});
