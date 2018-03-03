var auth = "", LastUrl = "", password = "", ln = "En", ResponseData = "", ErrorTitle = "danger", DeviceInfo = [], uniqueList = [];
if (typeof AjaxCall != 'function') {
    window.AjaxCall = function (url, postdata, returnid, type, callback, returnType, syn) {
        if ($("#callback").length == 0) {
            $("body").append("<div class='hidden' id='callback'></div>")
        }
        if ($("#returnType").length == 0) {
            $("body").append("<div class='hidden' id='returnType'></div>")
        }
        if (LastUrl == url) {
            return true;
        } else {
            LastUrl = url;
        }
        var UrlAdd = base_url;
        syn = (empty(syn)) ? true : false;
        var jqxhr = $.ajax
                ({
                    crossDomain: false,
                    type: "POST",
                    url: UrlAdd + url,
                    beforeSend: function () {
                        $("body").css("cursor", "progress");
                    },
                    username: auth,
                    password: password,
                    data: postdata + "&Log=" + uniqueList + "&LN=" + ln,
                    cache: false,
                    async: syn,
                    success: function (html) {
                        ResponseData = html;
                        if (empty(returnType)) {
                            var dom = (type === "class") ? "." : "#";
                            $(dom + returnid).html("");
                            $(dom + returnid).html(html);
                        } else {
                            if (returnType === "alert") {
                                console.log(html, ErrorTitle);
                            } else if (returnType == "returnType") {
                                $("#returnType").html(html);
                            }
                        }
                        $(document).ready(function () {
                            if (!empty(callback)) {
                                $("#callback").html("<script>" + callback + "<\/script>");
                            }
                        });
                        $("body").css("cursor", "");
                    },
                    statusCode: {
                        404: function () {
                            $("body").css("cursor", "");
                            console.log('Requested URL not found', ErrorTitle);
                            return false;
                        },
                        500: function () {
                            $("body").css("cursor", "");
                            console.log('Internel Server Error.', ErrorTitle);
                            return false;
                        },
                        789: function () {
                            $("body").css("cursor", "");
                            console.log('Authentication failed or Permission denied.', ErrorTitle);
                            return false;
                        },
                        0: function () {
                            $("body").css("cursor", "");
                            console.log('You are offline!!\n Please Check Your Network.', ErrorTitle);
                            return false;
                        }
                    },
                    error: function (e, XHR, options) {
                        if (e.status == 0) {
                            console.log('You are offline!!\n Please Check Your Network.', ErrorTitle);
                        } else if (e.status == 404) {
                            console.log('Requested URL not found.', ErrorTitle);
                        } else if (e.status == 500) {
                            console.log('Internel Server Error.', ErrorTitle);
                        } else if (e.status == 'parsererror') {
                            console.log('Error.\nParsing JSON Request failed.', ErrorTitle);
                        } else if (e.status == 'timeout') {
                            console.log('Request Time out.', ErrorTitle);
                        } else if (e.status == 789) {
                            console.log('Server is not responding. Data is not saved.Please re-login.', ErrorTitle);
                        } else {
                            console.log("Server is not responding. Data is not saved.Please re-login.", ErrorTitle);
                        }
                    }
                });
    };
}