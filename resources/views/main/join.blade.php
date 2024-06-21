<section id="join" class="join">
    <div class="join__container">
        <div class="join__content">
            <div class="join__left">
                <h2 class="join__title">Купи квартиру — <span class="wow fadeInUp">Получи автомобиль!</span></h2>
            </div>
            <div class="join__right">
                <form id="form-send" class="join__form form" autocomplete="off">
                    @csrf
                    <div class="form__field">
                        <input type="text" name="name" class="form__input" placeholder="Ваше имя">
                    </div>
                    <div class="form__field">
                        <input type="tel" name="phone" class="form__input" placeholder="(999) 999-99-99">
                    </div>
                    <div class="form__msg _msg"></div>
                    <button type="submit" class="form__submit">ОТПРАВИТЬ →</button>

                    <p class="form__agree">Заполняя форму, вы соглашаетесь с <a href="/privacy-policy" target="_blank">Политикой Конфиденциальности</a></p>
                </form>
            </div>
        </div>
    </div>
</section>
