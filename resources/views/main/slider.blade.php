@if(count($slides) > 0)
        <section id="projects" class="projects">
            <div class="projects__content">
                <div class="projects__container">
                    <h2 class="projects__title wow fadeInUp">Проекты</h2>
                </div>
                <div class="projects__main">
                    <div class="projects__slider splide">
                        <div class="splide__track">
                            <div class="splide__list">
                                @foreach($slides as $slide)
                                    <div class="projects__slide splide__slide">
                                        <a href="{{ $slide->link ?? '#' }}" target="_blank" rel="nofollow">
                                            <img src="{{ $slide->name }}" alt="{{ $slide->alt }}" class="projects__img" target="_blank" rel="nofollow">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endif
