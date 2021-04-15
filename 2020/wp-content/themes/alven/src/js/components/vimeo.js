import Player from '@vimeo/player';
import { forEach } from '@stereorepo/sac';

const vimeo = {
    addPlayer(video) {
        const iframe = video.querySelector('iframe');
        const player = iframe ? new Player(iframe) : new Player(video);

        player.ready().then(() =>
            video.querySelector('.js-cover').addEventListener(
                'click',
                e => {
                    e.target.classList.add('off');
                    player.play();
                },
                false
            )
        );

        return player;
    },

    addPlayerAndPlay(video) {
        const player = new Player(video);
        player.ready().then(() => player.play());
    },

    unloadPlayer(player) {
        player.unload();
    },

    initPlayers() {
        const videos = document.querySelectorAll('.js-vimeo');

        if (videos.length) forEach(videos, video => this.addPlayer(video));
    }
};

export default vimeo;
