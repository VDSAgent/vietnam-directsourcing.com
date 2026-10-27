document.addEventListener('DOMContentLoaded', function () {
    var EP_MAP = {970:1,478:2,683:3,987:4,1004:5,1025:6,1052:7,1366:8,1731:9,472:10,1879:11,1044:12,2100:13,2096:14,2672:15,2677:16,2683:17,2687:18,2691:19,2697:20,2737:21,2745:22,2751:23,2755:24,2759:25,2763:26,2837:27,2842:28,2848:29,2853:30,2858:31,3177:32,3185:33,3192:34,3208:35,3219:36,3236:37,3242:38,3258:39,3266:40,3290:41,3314:42,3329:43,3341:44,3354:45,3372:46,3720:47,3721:48,3722:49,3905:50,3912:51,4027:52,4036:53,4038:54,4140:55,4158:56,4184:57,4287:58,4293:59,4298:60};

    var m = document.body.className.match(/postid-(\d+)/);
    if (!m) { return; }
    var postId = parseInt(m[1], 10);
    var ep = EP_MAP[postId];
    if (!ep) { return; }

    var target = '/podcast/#episode-' + ep;
    var links = document.querySelectorAll('.podcast-container a.podcast-video');
    for (var i = 0; i < links.length; i++) {
        var a = links[i];
        var href = a.getAttribute('href') || '';
        if (/youtube\.com|youtu\.be|open\.spotify\.com/i.test(href)) {
            a.setAttribute('href', target);
            a.removeAttribute('target');
        }
    }
});