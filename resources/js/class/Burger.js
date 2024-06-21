
export class Burger {
    constructor(params = {}) {
        this.selector = params.selector ?? '#burger';
        this.closeBtn = params.closeBtn ?? '#burger-close';
        this.menu = params.menu  ?? '#menu';
        this.classMenuOpen = params.classMenuOpen ?? '_open';
        this.classNameClose = params.classNameClose ?? '_close';
        this.$menuBlock = null;

        this.init();
    }

    init() {
        const obj = this;
        this.$menuBlock = $(obj.menu);

        $(document).on('click', this.selector, () => {

            if(!obj.$menuBlock.hasClass(obj.classMenuOpen)) {
                obj.openMenu();
            }else {
                obj.closeMenu();
            }
        })

        $(document).on('click', this.closeBtn, () => {
            obj.closeMenu();
        })

        window.Burger = this;
    }

    openMenu() {
        $(this.selector).addClass('_active');
        this.$menuBlock.addClass(this.classMenuOpen);
        Tools.bodyFixPosition();
    }

    closeMenu() {
        $(this.selector).removeClass('_active');
        this.$menuBlock.removeClass(this.classMenuOpen);
        Tools.bodyUnfixPosition();
    }
}
