<template>
    <div class="container-fluid">
        <nav-bar></nav-bar>
        <div id="fullpage">
            <div class="section " id="section0">
                <div class="slide text-center"><img src="/images/index-banner.png" alt="Multiverse E3 show"></div>
                <div class="slide text-center"><img src="/images/index-banner2.png" alt="Multiverse Team"></div>
            </div>
            <div class="section" id="section1">
                <img src="/images/released-games.png" class="title" alt="RELEASED GAMES" style="position: absolute;top: 10px;left: 10px;">
                <ul class="game-list">
                    <li v-for="list in $t('games')">
                        <div class="thumb">
                            <a href="/game"><img :src="list.cover" :alt="list.cover_alt" class="cover"></a>

                            <div class="play_btn" @click="play_video(list.video)" style="position: absolute;top: 50%;left: 50%;margin-top: -32px;margin-left: -32px;" v-if="list.isPlay"></div>
                        </div>
                        <a :href="list.link" class="more" target="_blank" rel="nofollow" ><img src="/images/more.png" alt=""></a>
                        <div class="des"><p>{{list.des}}</p></div>
                    </li>
                </ul>

            </div>
            <div class="section" id="about" style="">
                <div class="left">
                    <img src="/images/about-us.png" alt="ABOUT US" class="title">
                    <div class="des" v-html="$t('index_view.about_des')">
                    </div>
                    <a class="more" href="/about"><img src="/images/more_across.png" alt="more" style="height: 60px;margin-top: 25px;"></a>
                </div>
            </div>
            <div class="section" id="news">
                <div class="container"><img src="/images/new_title.png" alt="" style="margin-top: 110px"></div>
                <ul class="news-list container">
                    <li v-for="(list, index) in $t('news')" v-if="index<4">
                        <a :href="list.link" target="_blank">
                        <div class="thumb">
                            <img :src="list.cover" alt="">
                            <p class="news-title">{{list.title}}</p>
                        </div>
                        </a>
                    </li>
                </ul>
                <footer-bar></footer-bar>
            </div>
        </div>
        <videos  :videoSrc="videoSrc" v-if="videoIsShow"></videos>
    </div>
</template>

<script>
    import NavBar from '../components/NavBar'
    import FooterBar from '../components/FooterBar'
    import Videos from '../components/Video'

    export default {
        created() {
            localStorage.setItem('navIndex','0')
        },
        mounted() {
            console.log('Index Pages mounted.')
//            this.$i18n.locale = localStorage.getItem('language')

        },
        data(){
          return{
              videoIsShow: false,
              videoSrc:''
          }
        },
        components:{
            NavBar, FooterBar, Videos
        },
        methods:{
            play_video(e){
                e==""|e==null?this.videoIsShow = false:this.videoIsShow=true,this.videoSrc = e
            }
        }
    }

</script>
<style>
    .section{
        background: url("/images/bg.jpg") no-repeat center;
    }
    .section p{
        color: #999999;
    }
    #section0 img{
        display: block;
        width: auto;
        height: 100%;
        margin: 0 auto;
    }
    #section1>img{

    }
    #section2 img{
        position: absolute;
        top: 30px;
        left: 10%;
    }
    .intro p{
        width: 50%;
        margin: 0 auto;
        font-size: 1.5em;
    }
    .twitter-share-button{
        position: absolute;
        z-index: 99;
        right: 149px;
        top: 9px;
    }

</style>