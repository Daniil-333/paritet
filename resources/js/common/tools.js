export const Tools = {
    isWebp: function(callback) {
        let webP = new Image();
		webP.onload = webP.onerror = function () {
			callback(webP.height == 2);
		};
		webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
    },
    isIOS: function () {
        return [
                'iPad Simulator',
                'iPhone Simulator',
                'iPod Simulator',
                'iPad',
                'iPhone',
                'iPod',
                'MacIntel',
            ].includes(window.navigator.platform)
            // iPad on iOS 13 detection
            || (window.navigator.userAgent.includes("Mac"))
    },
    resetForm: function($form) {
        if($form.length) {
            $form[0].reset();
            $form.find('.is-invalid').removeClass('is-invalid');
        }
    },
    cookie: {
        set: function(name, value, options = {}) {

            options = {
                path: '/',
            };

            if (options.expires instanceof Date) {
                options.expires = options.expires.toUTCString();
            }

            let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

            for (let optionKey in options) {
                updatedCookie += "; " + optionKey;
                let optionValue = options[optionKey];
                if (optionValue !== true) {
                    updatedCookie += "=" + optionValue;
                }
            }

            document.cookie = updatedCookie;
        },
        get: function(name) {
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }
    },
    getFormField: function(selector) {

        let data = {};
        const regex = /(?!^|\[)\w+(?=\]|$)/g;

        $(selector).find('input[type="text"],input[type="date"],input[type="email"],input[type="tel"],input[type="password"],input[type="hidden"],input[type="number"],input[type="checkbox"],input[type="radio"]:checked,select,textarea').each(function(){

            let name = $(this).attr('name');
            if($(this).attr('disabled') == 'disabled') {
                return true;
            }

            let value = $(this).val();
            if($(this).attr('type') == 'checkbox')
                value = $(this).is(':checked') ? 1 : 0;

            if( name && name != '') {

                if(name.match(/\[/gi)) {
                    let attr = name.match(regex);
                    let replace = '\[' + attr + '\]';
                    let field = name.replace(replace,'');

                    if(!data[field]) {
                        data[field] = {};
                    }
                    let t = data[field];
                    for(let j = 0; j < attr.length; j++){

                        if(t[attr[j]] === undefined){
                            t[attr[j]] = {}
                        }

                        if(j === attr.length - 1)
                            t[attr[j]] = value;
                        else
                            t = t[attr[j]]
                    }
                }
                else {
                    if (!data[name])
                        data[name] = value;
                    else {
                        if (!Array.isArray(data[name])) {
                            var val = data[name];
                            data[name] = [];
                            data[name].push(val);
                        }

                        data[name].push(value);
                    }
                }
            }

        });

        return data;
    },

    getSelector() {
        return {
            html: document.documentElement,
            body: document.querySelector('body'),
            wrapper: document.querySelector('.wrapper'),
        }
    },
    bodyFixPosition () {

        setTimeout( function() {

            let scrollPosition = window.pageYOffset || Tools.getSelector().html.scrollTop;

            Tools.getSelector().body.setAttribute('data-body-scroll-fix', scrollPosition);
            Tools.getSelector().body.classList.add('_locked');

            if (!Tools.isIOS())
                Tools.getSelector().body.classList.add('_fixPadding');

            Tools.getSelector().body.style.top = `-${scrollPosition}px`;
        }, 15 );
    },
    bodyUnfixPosition () {
        let scrollPosition = parseInt(this.getSelector().body.getAttribute('data-body-scroll-fix'));

        this.getSelector().body.removeAttribute('data-body-scroll-fix');

        this.getSelector().body.classList.remove('_locked', '_fixPadding');

        this.getSelector().body.removeAttribute('style');

        window.scroll(0, scrollPosition);
    }
};
