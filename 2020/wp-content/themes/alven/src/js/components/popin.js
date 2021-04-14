import vimeo from './vimeo';
import { forEach } from '@stereorepo/sac';

const popin = () => {
    const btns = document.querySelectorAll('.js-popin');

    if (!btns.length) return;

    let popin;
    let popinInner;
    let close;

    // create a popin elt
    const createPopin = () => {
        const main = document.getElementById('main');
        const popinContent = document.createElement('div');

        popin = document.createElement('div');
        popin.className = 'popin';
        popin.id = 'popin';

        popinContent.className = 'popin-content';

        popinInner = document.createElement('div');

        close = document.createElement('button');
        close.className = 'btn-close';
        close.innerHTML = 'Close';

        main.appendChild(popin);
        popin.appendChild(popinContent);
        popinContent.appendChild(close);
        popinContent.appendChild(popinInner);
    };

    // add video and open popin
    const addVideoAndOpenPopin = btn => {
        const video = document.createElement('div');

        video.dataset.vimeoUrl = btn.dataset.popinVideo;
        video.className = 'video';
        popinInner.appendChild(video);

        vimeo.addPlayerAndPlay(video);
        popin.classList.add('on');
    };

    // close popin
    const closePopin = () => {
        popin.classList.remove('on');
        setTimeout(() => {
            popinInner.innerHTML = '';
        }, 300);
    };

    // create popin elt
    createPopin();

    // add listeners
    forEach(btns, btn => btn.addEventListener('click', () => addVideoAndOpenPopin(btn), false));
    close.addEventListener('click', closePopin, false);
    popin.addEventListener(
        'click',
        e => {
            if (e.target.id === 'popin') closePopin();
        },
        'false'
    );
};

export default popin;
