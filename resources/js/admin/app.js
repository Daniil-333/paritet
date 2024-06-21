import '../bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import jQuery from "jquery";
window.$ = window.jQuery = jQuery;

import {Tools} from './common/tools.js';

window.Tools = Tools;

class Base {

    constructor() {
        //Вызываем init-функции
        let protoMain = Object.getPrototypeOf(this);
        let protoBase = Object.getPrototypeOf(protoMain);
        this.initStack = [];
        this.callInitByProto(protoBase);
        this.callInitByProto(protoMain);

        //Проверяем поддержку WebP
        Tools.isWebp((support) => (support) ?
            document.documentElement.classList.add('webp') :
            document.documentElement.classList.add('no-webp'));
    }

    //Вызываем init-функции
    callInitByProto(proto) {
        let vars = Object.getOwnPropertyNames(proto);

        for(let method of vars) {
            if(method.match(/^init[\w]+/,method)) {
                this.initStack.push(method);

                this[method]();
            }
        }
    }

    initPhotoBlock() {
        $(document).on('click', '[data-copy]', function () {
            const $block = $(`.${$(this).data('copy')}:first-child`);
            let $parent = $block.parent();
            $parent.append($block.clone());

            $parent.children(':last-child').find('input').each(function () {
                if($(this).attr('type') == 'checkbox' || $(this).attr('type') == 'radio') {
                    $(this).prop('checked', false);
                }
                else if($(this).attr('type') == 'hidden' && $(this).attr('name') == 'id[]') {
                    $(this).val(Tools.uniqid('pic'));
                }
                else if($(this).attr('type') == 'file') {
                    $(this).prev().html('Загрузить');
                    $(this).val('');
                }
                else {
                    $(this).val('');
                }
            })

        })

        $(document).on('click', '[data-del]', function () {
            if($(this).parents('.photos').children().length == 1) {
                return;
            }
            $(this).parent().remove();
        })
    }

    initPreviewFile() {
        $(document).on('change', '.ui-input__file', function (e) {
            const $preview = $(this).prev();
            const [file] = this.files;

            if (file) {
                let img = new Image();
                img.src = URL.createObjectURL(file);
                $preview.html(img);
            }
        })
    }
}

window.Base = Base;

window.addEventListener('load', function () {
    new Base();
})
