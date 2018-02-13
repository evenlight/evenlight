! function(t) {
    "use strict";
    var e = "",
        a = "",
        s = "",
        o = "",
        i = "#fafafa",
        n = "#fafafa";
    if (t(window).on("load", function() {
            t("body").addClass("loaded"), (new WOW).init()
        }), t(window).on("scroll", function() {
            t(this).scrollTop() > 1 ? t(".header").addClass("sticky") : t(".header").removeClass("sticky")
        }), t("a.nav").length > 0 && t("a.nav").each(function() {
            e = t(this).attr("href"), "#home" != e && t(e).hide()
        }), t("a.nav").length > 0 && t("a.nav").on("click", function(e) {
            e.preventDefault(), a = t(this).attr("class"), s = t(this).attr("href"), t(this).hasClass("active") || (t(".overlay-bg").removeAttr("style"), t(this).addClass("active"), t("a.nav").each(function() {
                o = t(this).attr("href"), t(o).hide(), t(this).attr("href") != s && t(this).hasClass("active") && t(this).removeClass("active")
            }), a.indexOf("left") > 0 && setTimeout(function() {
                t(".overlay-bg").css("left", "50%"), setTimeout(function() {
                    t(s).fadeIn(1e3)
                }, 800)
            }, 400), a.indexOf("right") > 0 && setTimeout(function() {
                t(".overlay-bg").css("right", "50%"), setTimeout(function() {
                    t(s).fadeIn(1e3)
                }, 800)
            }, 400), a.indexOf("home") > 0 && setTimeout(function() {
                setTimeout(function() {
                    t(s).fadeIn(1e3)
                }, 800)
            }, 400))
        }), t("#countdown").length > 0 && t("#countdown").countdown(t("#countdown").attr("data-time"), function(e) {
            t(this).html(e.strftime("<div>%D<span>Дней</span></div> <div>%H<span>Часов</span></div> <div>%M<span>Минут</span></div> <div>%S<span>Секунд</span></div>"))
        }), t("#slideshow-background").length > 0 && t("#slideshow-background").vegas({
            preload: !0,
            timer: !1,
            delay: 5e3,
            transition: "fade",
            transitionDuration: 1e3,
            slides: [{
                src: "./assets/images/slider/img_001.jpg"
            }, {
                src: "./assets//images/slider/img_002.jpg"
            }, {
                src: "./assets//images/slider/img_003.jpg"
            }]
        }), t("#youtube-background").length > 0) {
        var r = [{
            videoURL: "8xeP50_UZNg",
            showControls: !1,
            containment: "#youtube-background",
            autoPlay: !0,
            mute: !0,
            startAt: 0,
            opacity: 1,
            loop: !1,
            showYTLogo: !1,
            realfullscreen: !0,
            addRaster: !0
        }];
        t(".player").YTPlaylist(r, !0)
    }
    t("#contact-form").length > 0 && t("#contact-form").validator().on("submit", function(e) {
        if (!e.isDefaultPrevented()) {
            e.preventDefault();
            var a = t(this);
            t.ajax({
                url: "mail/mail.php",
                type: "post",
                data: a.serialize(),
                success: function(e) {
                    t(".msg-finish").append("Сообщение отправлено! Мы свяжемся с вами в ближайшее время").fadeIn(200).delay(1e3).fadeOut(600), t("#contact-form")[0].reset()
                },
                error: function() {
                    t(".msg-finish").append("Ой! Что-то пошло не так, пожалуйста попробуйте позже.").fadeIn(200).delay(1e3).fadeOut(600)
                }
            })
        }
    }), t("#mc-form").length > 0 && t("#mc-form").ajaxChimp({
        url: "http://altitudscom.us2.list-manage.com/subscribe/post?u=6ea67f91a19c8027d96407e83&id=d78227ae31"
    }), t("#particule").length > 0 && (i = "" == t("#particule").data("dot-color") ? i : t("#particule").data("dot-color"), n = "" == t("#particule").data("line-color") ? n : t("#particule").data("line-color"), console.log(i), console.log(n), t("#particule").particleground({
        dotColor: i,
        lineColor: n,
        density: 9e3
    }))
}(jQuery);