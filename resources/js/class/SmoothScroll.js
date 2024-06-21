export class SmoothScroll {
    constructor(params = {}) {
        this.selector = params.selector ?? 'a[href^="#"]'
        this._init();
    }

    _init() {
        const obj = this;
        $(document).on('click', obj.selector, function (e) {


            let href = $(this).attr('href');

            if($('body').hasClass('_locked')) {
                window.Burger.closeMenu();
            }

            $('html, body').animate({
                scrollTop: $(href).offset().top
            });
            return false;
        })
    }
}
