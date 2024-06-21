import './bootstrap';

import jQuery from "jquery";
window.$ = window.jQuery = jQuery;

import {Tools} from './common/tools.js';
window.Tools = Tools;

import {Burger} from "./class/Burger";
import Splide from "@splidejs/splide";
import {SmoothScroll} from "./class/SmoothScroll";
import WOW from 'wow.js';

class Base {

    constructor() {
        let protoMain = Object.getPrototypeOf(this);
        let protoBase = Object.getPrototypeOf(protoMain);
        this.initStack = [];
        this.callInitByProto(protoBase);
        this.callInitByProto(protoMain);

        Tools.isWebp((support) => (support) ?
            document.documentElement.classList.add('webp') :
            document.documentElement.classList.add('no-webp'));

        new Burger();
        new SmoothScroll();
    }

    callInitByProto(proto) {
        let vars = Object.getOwnPropertyNames(proto);

        for(let method of vars) {
            if(method.match(/^init[\w]+/,method)) {
                this.initStack.push(method);

                this[method]();
            }
        }
    }

    initSlider() {

        if(!$('.projects__slider').length)
            return;

        new Splide('.projects__slider', {
            arrows: false,
            pagination: false,
            gap: 20,
            drag: 'free',
            padding: { left: 15, right: 15 },
            mediaQuery: 'min',

            breakpoints: {
                1209.98: {
                    fixedWidth: 820,
                },
                767.98: {
                    fixedWidth: 520,
                },
                320: {
                    fixedWidth: 290
                }
            }

        }).mount();
    }

    initSendForm() {
        $('#form-send').on('submit', function (e) {
            e.preventDefault();
            const $form = $(this);

            const data = Tools.getFormField('#form-send');


            $.ajax({
                url: '/send',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    const $msgBlock = $form.find('._msg');

                    if(data.success) {
                        $msgBlock.addClass('_active _success').html(data.success);
                        Tools.resetForm($('#form-send'));

                        setTimeout(() => {
                            $msgBlock.removeClass('_active _success').html('');
                        }, 3000);
                    }
                    else if(data.error) {
                        let errors = '';
                        for (let idMsg in data.error) {
                            if(data.error.hasOwnProperty(idMsg)) {
                                errors += `<p>${data.error[idMsg]}</p>`;
                            }
                        }
                        $msgBlock.addClass('_active _failed').html(errors);

                        setTimeout(() => {
                            $msgBlock.removeClass('_active _failed').html('');
                        }, 3000);
                    }


                },
            })
        })
    }

    initAnimate() {
        const wow = new WOW({
            live: false,
        });
        wow.init();
    }

    initLazyLoadIframe() {
        'use strict';
        function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
        r(function(){
            if (!document.getElementsByClassName) {
                // Поддержка IE8
                var getElementsByClassName = function(node, classname) {
                    var a = [];
                    var re = new RegExp('(^| )'+classname+'( |$)');
                    var els = node.getElementsByTagName("*");
                    for(var i=0,j=els.length; i < j; i++)
                        if(re.test(els[i].className))a.push(els[i]);
                    return a;
                }
                var videos = getElementsByClassName(document.body,"youtube");
            } else {
                var videos = document.getElementsByClassName("_youtube");
            }
            var nb_videos = videos.length;
            for (var i=0; i < nb_videos; i++) {
                // Находим постер для видео, зная ID нашего видео
                videos[i].style.backgroundImage = 'url(http://i.ytimg.com/vi/' + videos[i].id + '/sddefault.jpg)';
                // Размещаем над постером кнопку Play, чтобы создать эффект плеера
                // var play = document.createElement("div");
                // play.setAttribute("class","play");
                // videos[i].appendChild(play);
                videos[i].onclick = function() {
                    // Создаем iFrame и сразу начинаем проигрывать видео, т.е. атрибут autoplay у видео в значении 1
                    var iframe = document.createElement("iframe");
                    var iframe_url = "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1";
                    if (this.getAttribute("data-params")) iframe_url+='&'+this.getAttribute("data-params");
                    iframe.setAttribute("src",iframe_url);
                    iframe.setAttribute("frameborder",'0');
                    // Высота и ширина iFrame будет как у элемента-родителя
                    iframe.style.width  = this.style.width;
                    iframe.style.height = this.style.height;
                    // Заменяем начальное изображение (постер) на iFrame
                    this.parentNode.replaceChild(iframe, this);
                }
            }
        });
    }
}

window.Base = Base;

window.addEventListener('load', function () {
    new Base();
})
