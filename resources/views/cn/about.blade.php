@extends('layouts.CnMaster')
@section('content')
    <div class="banner about-banner text-center">
        <div class="container">
            <p class="title">Multiverse</p>
            <p class="subtitle">Create <span>Virtual</span> Real<span>ity</span>    Games</p>
            <p class=""><span>专业VR内容开发商</span></p>
        </div>
    </div>
    <div class="company container-fluid text-center tab-area">
        <p class="title ">公司简介</p>
        <ul id="company-content" class="tab-content container col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <li class="active">为优秀的开发人员提供帮助，</li>
            <li>创意、高效、兴趣.</li>
            <li>MULTIVERSE最初于2016年三月发布的<Dream Flight>从Gear VR获得许多好评. 经过一整年的努力, 一个制作精良的最新游戏 <Seeking Dawn> 即将到来......</li>
        </ul>
        <ul id="btn-area" class="tab-nav container col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <li class="active">愿景</li>
            <li>价值</li>
            <li>历史</li>

        </ul>
    </div>
    <div class="press text-center">
        <p class="title ">媒体评价</p>
        <div id="posts-area" class="container">
            <div class="btn-area hidden-xs" id="prev-btn"><i class="fa fa-chevron-left"></i></div>
            <div class="col-lg-4">
                <div class="post">
                    <div class="thumb"><img src="/img/press1.png" alt=""></div>
                    <div class="des">One of the most visually arresting experience</div>
                    <a href="#" class="link-href">Read More</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="post">
                    <div class="thumb"><img src="/img/press2.png" alt=""></div>
                    <div class="des">One of the most visually arresting experience</div>
                    <a href="#" class="link-href">Read More</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="post">
                    <div class="thumb"><img src="/img/press3.png" alt=""></div>
                    <div class="des">One of the most visually arresting experience</div>
                    <a href="#" class="link-href">Read More</a>
                </div>
            </div>
            <div class="btn-area hidden-xs" id="next-btn"><i class="fa fa-chevron-right"></i></div>
        </div>
    </div>
    <div class="about-partners">
        <div class="container">
            <p class="title text-center">合作伙伴</p>
            <ul>
                <li class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><img src="{{ url('img/partners1.png') }}" alt="vive"></li>
                <li class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><img src="{{ url('img/press3.png') }}" alt=""></li>
                <li class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><img src="{{ url('img/partners-steam.png') }}" alt=""></li>
            </ul>

            {{--<div class="join-area">
                <div class="col-lg-8 col-lg-offset-2">
                    <span class="col-lg-6">Want to join our team</span> <a href="#" class="">Search Jobs</a>
                </div>
            </div>--}}
        </div>
    </div>
@endsection
@section('script')
    var tabs = $('.tab-area');
    var uls= $('.tab-content');
    var ulv= $('.tab-nav');
    ulv.children('li').click(function () {
    var _li = $(this).index()
    ulv.children('li').removeClass('active');
    uls.children('li').removeClass('active');
    $(this).addClass('active');
    uls.children().eq(_li).addClass('active');
    console.log(this)
    })
@endsection