<style>
    .row-fluid {
        width: 100%;
    }
    .row-fluid:before, .row-fluid:after {
        display: table;
        content: "";
        line-height: 0;
    }
    .zodiac {
        position: relative;
        height: 100%;
        margin: 0;
        padding: 0;
        min-width: 620px;
        padding-bottom: 30px;
        background-color: #f3f3f3;
        font-family: 'lucida grande', 'lucida sans unicode', lucida,helvetica, 'Hiragino Sans GB', 'Microsoft YaHei', 'WenQuanYi Micro Hei', sans-serif;
        color: #ce452f;
    }
    .avoid-select {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        user-select: none;
    }

    .swiper-container {
                    position: relative;
                    display: block;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    height: 100%;
                    margin-left: auto;
                    margin-right: auto;
                    padding-top: 50px;
                    text-align: center;
                }
    .swiper-container .title-container {
        margin-bottom: 30px;
        font-size: 36px;
        line-height: 36px;
        color: #e9816d;
    }
    .swiper-container .title-container .line {
        top: -12px;
        width: 50px;
        margin: 0px 20px 0px 20px;
    }
    .line {
        position: relative;
        display: inline-block;
        height: 2px;
        padding: 0px;
        overflow: hidden;
        background-color: #d5d5d5;
    }
    .swiper-container .title-container .year {
        position: relative;
        top: 1px;
    }
    .swiper-container .title-container .title {
        color: #2f2f2f;
    }
    .swiper-container .share-container {
        margin-bottom: 40px;
    }
    .swiper-container .share-container .item, .swiper-container .share-container .item a, .swiper-container .share-container .item:hover, .swiper-container .share-container .item a:hover {
        color: #555555;
    }
    .swiper-slide {
        position: relative;
        display: inline-block;
        width: 100%;
        height: 660px;
        max-height: 660px;
        margin-left: -2px;
        margin-right: -2px;
        margin-bottom: 30px;
        padding-left: 5px;
        padding-right: 5px;
        box-sizing: border-box;
        text-align: center;
        font-size: 18px;
        transition: all 200ms ease;
    }
    @media (min-width: 1110px) {
        .swiper-container {
            width: 1110px;
        }
    }
    @media (min-width: 930px) {
        .swiper-container {
            width: 100%;
        }
    }
    @media (min-width: 740px) {
        .swiper-container {
            width: 740px;
        }
    }
    @media (min-width: 930px) {
        .swiper-slide {
            width: 33.33%;
        }
    }
    @media (min-width: 620px) {
            .swiper-slide {
                width: 50%;
            }
        }
    .swiper-slide>.pan {
        min-width: 300px;
        max-width: 342px;
        margin-left: auto;
        margin-right: auto;
        box-sizing: border-box;
        background-color: white;
        box-shadow: 5px 5px 10px #d5d5d5;
        cursor: pointer;
        transition: all 200ms ease;
    }
    .page1>.pan {
        background-image: url(http://cdn-qn0.jianshu.io/assets/stats2015/zodiac/1-c4ee1190b0d1caa463899098d0abf8a9.jpg);
    }
    .page2>.pan {
        background-image: url(http://cdn-qn0.jianshu.io/assets/stats2015/zodiac/2-c99d495b6b2a777d8227e535e7b618e4.jpg);
    }
    .page3>.pan {
        background-image: url(http://cdn-qn0.jianshu.io/assets/stats2015/zodiac/3-a5197e9beffe43687e33c2ceb69ac76d.jpg);
    }
    .page4>.pan {
        background-image: url(http://cdn-qn0.jianshu.io/assets/stats2015/zodiac/4-001a02ffbf4f7203dead5323d8dbc95c.jpg);
    }
    .swiper-slide>.pan .article {
        position: absolute;
        display: block;
        top: 50%;
        left: 0px;
        width: 100%;
        margin-top: -40px;
    }
    .swiper-slide>.pan {
        position: relative;
        display: block;
        width: 100%;
        height: 100%;
        background-size: 100%;
        background-repeat: no-repeat;
    }
    .swiper-slide>.pan .article-title {
        display: block;
        width: 100%;
        height: 25px;
        margin-bottom: 15px;
        font-size: 14px;
        font-weight: bold;
        line-height: 25px;
        text-align: center;
        color: #2f2f2f;
    }
    .swiper-slide>.pan .line {
        width: 38px;
        margin-bottom: 15px;
    }
    .swiper-slide>.pan .content {
        margin-bottom: 15px;
        font-size: 12px;
        line-height: 1.6;
        color: #2f2f2f;
    }
    .swiper-slide>.pan .author {
        position: absolute;
        display: block;
        bottom: 50px;
        left: 0px;
        width: 100%;
        height: 35px;
        line-height: 35px;
        vertical-align: middle;
    }
    img {
        max-width: 100%;
        width: auto\9;
        height: auto;
        vertical-align: middle;
        border: 0;
        -ms-interpolation-mode: bicubic;
    }
    .swiper-slide>.pan .author .icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
    }
    .swiper-slide>.pan .author .name {
        margin-left: 15px;
        font-size: 15px;
        color: #717171;
    }
    .swiper-slide>.pan .mask {
        position: absolute;
        display: block;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        background-color: rgba(255,255,255,0.8);
        opacity: 0;
        cursor: pointer;
        transition: opacity 200ms ease-in;
    }
    .swiper-slide>.pan .mask .btn {
        position: absolute;
        display: block;
        box-sizing: border-box;
        top: 50%;
        left: 50%;
        width: 106px;
        height: 44px;
        margin-left: -53px;
        margin-top: -22px;
        padding: 0px;
        background-color: #e9816d;
        border-color: transparent;
        box-shadow: inset 0px 0px 1px #f8d9d4;
        font-size: 14px;
        line-height: 44px;
        color: white;
    }
    .btn {
        border-radius: 4px;
        box-shadow: none;
        color: #555555;
        border-color: whitesmoke;
        background: whitesmoke;
        border-color: #d5d5d5;
        text-shadow: none;
    }
    .btn {
        display: inline-block;
        padding: 4px 12px;
        margin-bottom: 0;
        font-size: 14px;
        line-height: 20px;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        color: #3f3f3f;
        text-shadow: 0 1px 1px rgba(255,255,255,0.75);
        background-color: whitesmoke;
        background-image: -moz-linear-gradient(top, #fff, #e6e6e6);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), to(#e6e6e6));
        background-image: -webkit-linear-gradient(top, #fff, #e6e6e6);
        background-image: -o-linear-gradient(top, #fff, #e6e6e6);
        background-image: linear-gradient(to bottom, #fff, #e6e6e6);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFE6E6E6', GradientType=0);
        border-color: #e6e6e6 #e6e6e6 #bfbfbf;
        border-color: rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        border: 1px solid #cccccc;
        border-bottom-color: #b3b3b3;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
        -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
    }
</style>
<body class="output fluid zh cn mac reader-day-mode reader-font2" data-js-module="" data-locale="zh-CN">
<div class="row-fluid">
    <div class="zodiac avoid-select">
        <!-- Swiper Container -->
        <div class="swiper-container">
            <!-- Title -->
            <div class="title-container">
                <span class="line"></span><span class="site">简书</span><span class="year">2015</span><span class="title">·每月一篇好文章</span><span class="line"></span>
            </div>
            <!-- Swpier -->
            <div class="swiper-wrapper">
                <!-- Pages -->
                <div class="swiper-slide page1" src="/p/c41190b358b6">
                    <div class="pan">
                        <div class="article">
                            <div class="article-title">给你90天，成为不一样的自己</div>
                            <div class="line"></div>
                            <div class="content">如果你应付不了现在的生活和工作，<br>无论你走到哪里，<br>无论你换了什么工作，什么公司，<br>都无济于事。<br>因为你根本没想让自己成熟起来，<br>想让变的更优秀也不过是一句口头禅。</div>
                        </div>
                        <div class="author">
                            <img thumbnail="90x90" quality="100" class="icon" src="http://upload.jianshu.io/users/upload_avatars/132263/e028b3faa97b.jpg?imageMogr/thumbnail/90x90/quality/100" alt="E028b3faa97b">
                            <span class="name">Sempliciy</span>
                        </div>
                        <a class="mask" href="/p/c41190b358b6?utm_source=maleskine&amp;utm_medium=reader_share&amp;utm_content=zodiac2015">
                            <button class="btn read-more">阅读全文 &gt;</button>
                        </a>          </div>
                </div>
                <div class="swiper-slide page2" src="/p/5450524b65f5">
                    <div class="pan">
                        <div class="article">
                            <div class="article-title">使你更有思想的20本书</div>
                            <div class="line"></div>
                            <div class="content">真正伟大的当代文学，<br>正如人们借由狄更斯来了解十九世纪的英国，<br>后人也可以通过《自由》来了解<br>二十一世纪初期的美国。</div>
                        </div>
                        <div class="author">
                            <img thumbnail="90x90" quality="100" class="icon" src="http://upload.jianshu.io/users/upload_avatars/140917/175a5b928d68.jpg?imageMogr/thumbnail/90x90/quality/100" alt="175a5b928d68">
                            <span class="name">Z蕖Z</span>
                        </div>
                        <a class="mask" href="/p/5450524b65f5?utm_source=maleskine&amp;utm_medium=reader_share&amp;utm_content=zodiac2015">
                            <button class="btn read-more">阅读全文 &gt;</button>
                        </a>          </div>
                </div>
                <div class="swiper-slide page3" src="/p/ae59074c63ba">
                    <div class="pan">
                        <div class="article">
                            <div class="article-title">无感是最舒适的爱情</div>
                            <div class="line"></div>
                            <div class="content">爱情原本就是个很娇气的东西，<br>它经不起太多的矫情，你死我活和无理取闹，<br>也经不起任何的伪装，刻意讨好和忍辱负重。<br>当她拂去所有的惊喜，荣幸，不敢置信和小心翼翼，<br>才是爱情最原本的样子。<br>当她不再刻意的感受他的存在，<br>他才真正存在于她的生命。</div>
                        </div>
                        <div class="author">
                            <img thumbnail="90x90" quality="100" class="icon" src="http://upload.jianshu.io/users/upload_avatars/56412/0ca0659cf3ad.jpg?imageMogr/thumbnail/90x90/quality/100" alt="0ca0659cf3ad">
                            <span class="name">陶瓷兔子</span>
                        </div>
                        <a class="mask" href="/p/ae59074c63ba?utm_source=maleskine&amp;utm_medium=reader_share&amp;utm_content=zodiac2015">
                            <button class="btn read-more">阅读全文 &gt;</button>
                        </a>          </div>
                </div>
                <div class="swiper-slide page4" src="/p/ab75ef36dbfa">
                    <div class="pan">
                        <div class="article">
                            <div class="article-title">作家集训营</div>
                            <div class="line"></div>
                            <div class="content">我还在思考这次的经历，和经历带来的教益，<br>然而并没有一个明确的答案。<br>唯独明确的可能是我想成为作家的心意，<br>毕竟身负这样的行李。</div>
                        </div>
                        <div class="author">
                            <img thumbnail="90x90" quality="100" class="icon" src="http://upload.jianshu.io/users/upload_avatars/208217/449cf008e6be.jpg?imageMogr/thumbnail/90x90/quality/100" alt="449cf008e6be">
                            <span class="name">傅苛讷</span>
                        </div>
                        <a class="mask" href="/p/ab75ef36dbfa?utm_source=maleskine&amp;utm_medium=reader_share&amp;utm_content=zodiac2015">
                            <button class="btn read-more">阅读全文 &gt;</button>
                        </a>          </div>
                </div>
                <div class="swiper-slide page5" src="/p/0675115a53f7">
                    <div class="pan">
                        <div class="article">
                            <div class="article-title">傻姑娘，你配得起更好</div>
                            <div class="line"></div>
                            <div class="content">年轻的我们，<br>如果没把时间浪费在错爱上，简直就是一种浪费，<br>因为错过了，才能成长，<br>才能认清楚谁是自己真正需要的人。</div>
                        </div>
                        <div class="author">
                            <img thumbnail="90x90" quality="100" class="icon" src="http://upload.jianshu.io/users/upload_avatars/416061/bf725bfcd1cc.jpg?imageMogr/thumbnail/90x90/quality/100" alt="Bf725bfcd1cc">
                            <span class="name">修行的猫</span>
                        </div>
                        <a class="mask" href="/p/0675115a53f7?utm_source=maleskine&amp;utm_medium=reader_share&amp;utm_content=zodiac2015">
                            <button class="btn read-more">阅读全文 &gt;</button>
                        </a>          </div>
                </div>
                <div class="swiper-slide page6" src="/p/9ec421d5c7b8">
                    <div class="pan">
                        <div class="article">
                            <div class="article-title">张翠山与殷素素：偷来的那十年</div>
                            <div class="line"></div>
                            <div class="content">金庸笔下的女子在感情事上总是比男子要勇敢，<br>男人们面对感情的时候总是拖泥带水婆婆妈妈，<br>而姑娘们大多刀山火海一往无前，<br>事了一句“不悔”便是交待。<br>情不知所起，她爱上了他，与他到过天之涯海之角，<br>最后与他同赴黄泉，也许她也是无悔的吧。</div>
                        </div>
                        <div class="author">
                            <img thumbnail="90x90" quality="100" class="icon" src="http://upload.jianshu.io/users/upload_avatars/102650/698e41373220.jpg?imageMogr/thumbnail/90x90/quality/100" alt="698e41373220">
                            <span class="name">西湘</span>
                        </div>
                        <a class="mask" href="/p/9ec421d5c7b8?utm_source=maleskine&amp;utm_medium=reader_share&amp;utm_content=zodiac2015">
                            <button class="btn read-more">阅读全文 &gt;</button>
                        </a>          </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>