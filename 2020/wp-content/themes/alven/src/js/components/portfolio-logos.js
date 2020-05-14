import { gsap } from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin.js';

gsap.registerPlugin(ScrollToPlugin);

const logos = () => {
    const listLogos = document.getElementById('logos');

    if (!listLogos) return;

    let logos = listLogos.querySelectorAll('li');
    let nbDisplayedLogos = 11;

    if (logos.length <= nbDisplayedLogos) return;

    const oLogos = listLogos.innerHTML;
    let changeCall;
    let indexes = [];
    let hidedLogos = [];
    let indexLogoToChange = 0;
    let logoToChange;
    let count = 0;
    let wWidth = 0;

    const shuffle = array => {
        array.sort(() => Math.random() - 0.5);
    };

    const changeLogo = () => {
        changeCall.kill();

        logoToChange = logos[indexes[indexLogoToChange]];

        hidedLogos.push(logoToChange.innerHTML);

        gsap.to(logoToChange, 0.3, {
            opacity: 0,
            onComplete: () => {
                logoToChange.innerHTML = hidedLogos[0];
                hidedLogos.splice(0, 1);

                gsap.to(logoToChange, 0.5, {
                    opacity: 1,
                    onComplete: () => {
                        indexLogoToChange = indexLogoToChange + 1 > nbDisplayedLogos - 1 ? 0 : indexLogoToChange + 1;
                        changeCall = gsap.delayedCall(0.5, changeLogo);
                    }
                });
            }
        });
    };

    const setLogos = () => {
        if (!nbDisplayedLogos) return;

        logos.forEach((logo, i) => {
            if (i < nbDisplayedLogos) {
                logo.classList.add('on');
                indexes[i] = i;
            } else {
                logo.classList.remove('on');
                hidedLogos[count] = logo.innerHTML;
                count++;
            }
        });

        shuffle(indexes);

        changeCall = gsap.delayedCall(1, changeLogo);
    };

    const reset = () => {
        listLogos.innerHTML = oLogos;
        logos = listLogos.querySelectorAll('li');

        indexes = [];
        hidedLogos = [];
        indexLogoToChange = 0;
        count = 0;

        if (changeCall) {
            changeCall.kill();
        }
    };

    const launch = () => {
        wWidth = window.$stereorepo.superWindow.windowWidth;

        if (wWidth >= 1264) {
            nbDisplayedLogos = 11;
        } else if (wWidth >= 960) {
            nbDisplayedLogos = 9;
        } else if (wWidth >= 768) {
            nbDisplayedLogos = 7;
        } else if (wWidth >= 580) {
            nbDisplayedLogos = 5;
        } else {
            nbDisplayedLogos = 0;
        }

        setLogos();
    };

    const resize = () => {
        reset();
        launch();
    };

    window.$stereorepo.superWindow.initializeWindow();
    window.$stereorepo.superWindow.addResizeFunction(resize);

    launch();
};

export default logos;
