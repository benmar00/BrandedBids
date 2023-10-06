@extends('layouts.app')
@section('content')
    <section class="waht-is">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="static-menu">
                        <div class="side-bar-menu">
                            <a href="#About-id">About Us</a>
                            <div class="side-ul">
                                <ul>
                                    <h6>HOW IT WORKS</h6>
                                    <li>
                                        <a href="#buyimg-a-car">Buying a Car</a>
                                    </li>
                                    <li>
                                        <a href="#selling-a-car">Selling a Car</a>
                                    </li>
                                    <li>
                                        <a href="#finalizing-the-sale">Finalizing the Sale</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="side-ul">
                                <ul>
                                    <h6>FAQ</h6>
                                    @foreach ($faqCategory as $item)
                                        @if (!$item->faqs->isEmpty())
                                            <li>
                                                <a
                                                    href="#{{ str_replace(' ', '-', strtolower($item->name)) }}-faq">{{ $item->name }}</a>
                                            </li>
                                        @endif
                                    @endforeach


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    {!! $page->findSection('first-why-section') !!}

                    <div class="doug-quote d-flex"><img src="{{ asset($page->findSection('reviewer-image')) }}"
                            class="img-fluid" alt="Doug DeMuro">
                        {!! $page->findSection('reviewer-content') !!}
                    </div>
                    {!! $page->findSection('main-content') !!}

                    @foreach ($faqCategory as $item)
                        @if (!$item->faqs->isEmpty())
                            <div class="about-tabs-main" id="{{ str_replace(' ', '-', strtolower($item->name)) }}-faq">
                                <div class="about-tabs">
                                    <h4>{{ $item->name }}</h4>
                                    <div class="accordion">
                                        @foreach ($item->faqs as $faq)
                                            <div class="card">
                                                <div class="card-header" data-toggle="collapse"
                                                    data-target="#{{ str_replace(' ', '-', strtolower($faq->question)) }}"
                                                    aria-expanded="true">
                                                    <span class="title">{{ $faq->question }}</span>
                                                    <span class="accicon"><i
                                                            class="fas fa-angle-down rotate-icon"></i></span>
                                                </div>
                                                <div id="{{ str_replace(' ', '-', strtolower($faq->question)) }}"
                                                    class="collapse" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        {!! $faq->answer !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach


                            {!! $page->findSection('funding') !!}
                </div>
            </div>
        </div>
    </section>
@endsection
