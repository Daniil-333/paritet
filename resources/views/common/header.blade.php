<header class="header">
    <div class="header__container">
        <div class="header__content">
            <a href="{{ route('front.main') }}" class="header__logo logo">
                <img src="{{ asset('storage/img/svg/logo.svg') }}" alt="Паритет Девелопмент" class="logo__img">
            </a>
            <button id="burger" class="header__burger burger">
                <span></span>
                <span></span>
            </button>
            <div id="menu" class="header__main">
                <button id="burger-close" class="header__burger burger burger_close">
                    <span></span>
                    <span></span>
                </button>
                <nav class="header__menu menu">
                    <a href="#projects" class="menu__link _mobile">Проекты</a>
                    <a href="#about" class="menu__link _always">О застройщике</a>
                    <a href="#gift" class="menu__link">Подарки</a>
                    <a href="#membership" class="menu__link _always">Как получить?</a>
                    <a href="#join" class="menu__link _mobile">Контакты</a>
                </nav>
                <div class="header__contact">
                    <a href="tel:+73452520020" class="header__phone" target="_blank">+7 (3452) 52-00-20</a>
                </div>
            </div>
        </div>
    </div>
</header>
