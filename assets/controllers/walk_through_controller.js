import {Controller} from 'stimulus';

export default class extends Controller {
    connect () {
        $(function () {
            return $('.carousel').on('slide.bs.carousel', function (ev) {
                let lazy;
                lazy = $(ev.relatedTarget).find('img[data-src]');
                lazy.attr('src', lazy.data('src'));
                lazy.removeAttr('data-src');
            });
        });
    }
}
