!function e(t,r,n){function i(o,c){if(!r[o]){if(!t[o]){var u="function"==typeof require&&require;if(!c&&u)return u(o,!0);if(a)return a(o,!0);var l=new Error("Cannot find module '"+o+"'");throw l.code="MODULE_NOT_FOUND",l}var s=r[o]={exports:{}};t[o][0].call(s.exports,function(e){var r=t[o][1][e];return i(r||e)},s,s.exports,e,t,r,n)}return r[o].exports}for(var a="function"==typeof require&&require,o=0;o<n.length;o++)i(n[o]);return i}({1:[function(e,t,r){"use strict";window.addEventListener("load",function(){for(var e=document.querySelectorAll("ul.nav-tabs > li"),t=0;t<e.length;t++)e[t].addEventListener("click",function(e){e.preventDefault(),document.querySelector("ul.nav-tabs li.active").classList.remove("active"),document.querySelector(".tab-pane.active").classList.remove("active");var t=e.currentTarget,r=e.target.getAttribute("href");t.classList.add("active"),document.querySelector(r).classList.add("active")})})},{}]},{},[1]);
//# sourceMappingURL=myscript.js.map
function count_actions( pgiftid, peventid,  ptype,purl){

    passed_data={"giftid":pgiftid,"eventid":peventid,"type":ptype};  
    jQuery.ajax({
        type: "post",
        
        url: `${window.location.origin}/wordpress/wp-admin/admin-ajax.php`,
        data: {
          action: "wl_ajax_gifts_counter",  // the action to fire in the server
          data: passed_data,         // any JS object
        },
        complete: function (response) {
            alert(response.responseText);
            console.log(JSON.parse(response.responseText).data);                
            window.open(purl, "_blank");

        },
    });
}