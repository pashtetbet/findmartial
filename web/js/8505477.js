/*
* jQuery Form Plugin; v20130523
* http://jquery.malsup.com/form/
* Copyright (c) 2013 M. Alsup; Dual licensed: MIT/GPL
* https://github.com/malsup/form#copyright-and-license
*/
;(function(e){"use strict";function t(t){var r=t.data;t.isDefaultPrevented()||(t.preventDefault(),e(this).ajaxSubmit(r))}function r(t){var r=t.target,a=e(r);if(!a.is("[type=submit],[type=image]")){var n=a.closest("[type=submit]");if(0===n.length)return;r=n[0]}var i=this;if(i.clk=r,"image"==r.type)if(void 0!==t.offsetX)i.clk_x=t.offsetX,i.clk_y=t.offsetY;else if("function"==typeof e.fn.offset){var o=a.offset();i.clk_x=t.pageX-o.left,i.clk_y=t.pageY-o.top}else i.clk_x=t.pageX-r.offsetLeft,i.clk_y=t.pageY-r.offsetTop;setTimeout(function(){i.clk=i.clk_x=i.clk_y=null},100)}function a(){if(e.fn.ajaxSubmit.debug){var t="[jquery.form] "+Array.prototype.join.call(arguments,"");window.console&&window.console.log?window.console.log(t):window.opera&&window.opera.postError&&window.opera.postError(t)}}var n={};n.fileapi=void 0!==e("<input type='file'/>").get(0).files,n.formdata=void 0!==window.FormData;var i=!!e.fn.prop;e.fn.attr2=function(){if(!i)return this.attr.apply(this,arguments);var e=this.prop.apply(this,arguments);return e&&e.jquery||"string"==typeof e?e:this.attr.apply(this,arguments)},e.fn.ajaxSubmit=function(t){function r(r){var a,n,i=e.param(r,t.traditional).split("&"),o=i.length,s=[];for(a=0;o>a;a++)i[a]=i[a].replace(/\+/g," "),n=i[a].split("="),s.push([decodeURIComponent(n[0]),decodeURIComponent(n[1])]);return s}function o(a){for(var n=new FormData,i=0;a.length>i;i++)n.append(a[i].name,a[i].value);if(t.extraData){var o=r(t.extraData);for(i=0;o.length>i;i++)o[i]&&n.append(o[i][0],o[i][1])}t.data=null;var s=e.extend(!0,{},e.ajaxSettings,t,{contentType:!1,processData:!1,cache:!1,type:u||"POST"});t.uploadProgress&&(s.xhr=function(){var e=jQuery.ajaxSettings.xhr();return e.upload&&e.upload.addEventListener("progress",function(e){var r=0,a=e.loaded||e.position,n=e.total;e.lengthComputable&&(r=Math.ceil(100*(a/n))),t.uploadProgress(e,a,n,r)},!1),e}),s.data=null;var l=s.beforeSend;return s.beforeSend=function(e,t){t.data=n,l&&l.call(this,e,t)},e.ajax(s)}function s(r){function n(e){var t=null;try{e.contentWindow&&(t=e.contentWindow.document)}catch(r){a("cannot get iframe.contentWindow document: "+r)}if(t)return t;try{t=e.contentDocument?e.contentDocument:e.document}catch(r){a("cannot get iframe.contentDocument: "+r),t=e.document}return t}function o(){function t(){try{var e=n(g).readyState;a("state = "+e),e&&"uninitialized"==e.toLowerCase()&&setTimeout(t,50)}catch(r){a("Server abort: ",r," (",r.name,")"),s(D),j&&clearTimeout(j),j=void 0}}var r=f.attr2("target"),i=f.attr2("action");w.setAttribute("target",d),u||w.setAttribute("method","POST"),i!=m.url&&w.setAttribute("action",m.url),m.skipEncodingOverride||u&&!/post/i.test(u)||f.attr({encoding:"multipart/form-data",enctype:"multipart/form-data"}),m.timeout&&(j=setTimeout(function(){T=!0,s(k)},m.timeout));var o=[];try{if(m.extraData)for(var l in m.extraData)m.extraData.hasOwnProperty(l)&&(e.isPlainObject(m.extraData[l])&&m.extraData[l].hasOwnProperty("name")&&m.extraData[l].hasOwnProperty("value")?o.push(e('<input type="hidden" name="'+m.extraData[l].name+'">').val(m.extraData[l].value).appendTo(w)[0]):o.push(e('<input type="hidden" name="'+l+'">').val(m.extraData[l]).appendTo(w)[0]));m.iframeTarget||(v.appendTo("body"),g.attachEvent?g.attachEvent("onload",s):g.addEventListener("load",s,!1)),setTimeout(t,15);try{w.submit()}catch(c){var p=document.createElement("form").submit;p.apply(w)}}finally{w.setAttribute("action",i),r?w.setAttribute("target",r):f.removeAttr("target"),e(o).remove()}}function s(t){if(!x.aborted&&!F){if(M=n(g),M||(a("cannot access response document"),t=D),t===k&&x)return x.abort("timeout"),S.reject(x,"timeout"),void 0;if(t==D&&x)return x.abort("server abort"),S.reject(x,"error","server abort"),void 0;if(M&&M.location.href!=m.iframeSrc||T){g.detachEvent?g.detachEvent("onload",s):g.removeEventListener("load",s,!1);var r,i="success";try{if(T)throw"timeout";var o="xml"==m.dataType||M.XMLDocument||e.isXMLDoc(M);if(a("isXml="+o),!o&&window.opera&&(null===M.body||!M.body.innerHTML)&&--O)return a("requeing onLoad callback, DOM not available"),setTimeout(s,250),void 0;var u=M.body?M.body:M.documentElement;x.responseText=u?u.innerHTML:null,x.responseXML=M.XMLDocument?M.XMLDocument:M,o&&(m.dataType="xml"),x.getResponseHeader=function(e){var t={"content-type":m.dataType};return t[e]},u&&(x.status=Number(u.getAttribute("status"))||x.status,x.statusText=u.getAttribute("statusText")||x.statusText);var l=(m.dataType||"").toLowerCase(),c=/(json|script|text)/.test(l);if(c||m.textarea){var f=M.getElementsByTagName("textarea")[0];if(f)x.responseText=f.value,x.status=Number(f.getAttribute("status"))||x.status,x.statusText=f.getAttribute("statusText")||x.statusText;else if(c){var d=M.getElementsByTagName("pre")[0],h=M.getElementsByTagName("body")[0];d?x.responseText=d.textContent?d.textContent:d.innerText:h&&(x.responseText=h.textContent?h.textContent:h.innerText)}}else"xml"==l&&!x.responseXML&&x.responseText&&(x.responseXML=X(x.responseText));try{L=_(x,l,m)}catch(b){i="parsererror",x.error=r=b||i}}catch(b){a("error caught: ",b),i="error",x.error=r=b||i}x.aborted&&(a("upload aborted"),i=null),x.status&&(i=x.status>=200&&300>x.status||304===x.status?"success":"error"),"success"===i?(m.success&&m.success.call(m.context,L,"success",x),S.resolve(x.responseText,"success",x),p&&e.event.trigger("ajaxSuccess",[x,m])):i&&(void 0===r&&(r=x.statusText),m.error&&m.error.call(m.context,x,i,r),S.reject(x,"error",r),p&&e.event.trigger("ajaxError",[x,m,r])),p&&e.event.trigger("ajaxComplete",[x,m]),p&&!--e.active&&e.event.trigger("ajaxStop"),m.complete&&m.complete.call(m.context,x,i),F=!0,m.timeout&&clearTimeout(j),setTimeout(function(){m.iframeTarget||v.remove(),x.responseXML=null},100)}}}var l,c,m,p,d,v,g,x,b,y,T,j,w=f[0],S=e.Deferred();if(r)for(c=0;h.length>c;c++)l=e(h[c]),i?l.prop("disabled",!1):l.removeAttr("disabled");if(m=e.extend(!0,{},e.ajaxSettings,t),m.context=m.context||m,d="jqFormIO"+(new Date).getTime(),m.iframeTarget?(v=e(m.iframeTarget),y=v.attr2("name"),y?d=y:v.attr2("name",d)):(v=e('<iframe name="'+d+'" src="'+m.iframeSrc+'" />'),v.css({position:"absolute",top:"-1000px",left:"-1000px"})),g=v[0],x={aborted:0,responseText:null,responseXML:null,status:0,statusText:"n/a",getAllResponseHeaders:function(){},getResponseHeader:function(){},setRequestHeader:function(){},abort:function(t){var r="timeout"===t?"timeout":"aborted";a("aborting upload... "+r),this.aborted=1;try{g.contentWindow.document.execCommand&&g.contentWindow.document.execCommand("Stop")}catch(n){}v.attr("src",m.iframeSrc),x.error=r,m.error&&m.error.call(m.context,x,r,t),p&&e.event.trigger("ajaxError",[x,m,r]),m.complete&&m.complete.call(m.context,x,r)}},p=m.global,p&&0===e.active++&&e.event.trigger("ajaxStart"),p&&e.event.trigger("ajaxSend",[x,m]),m.beforeSend&&m.beforeSend.call(m.context,x,m)===!1)return m.global&&e.active--,S.reject(),S;if(x.aborted)return S.reject(),S;b=w.clk,b&&(y=b.name,y&&!b.disabled&&(m.extraData=m.extraData||{},m.extraData[y]=b.value,"image"==b.type&&(m.extraData[y+".x"]=w.clk_x,m.extraData[y+".y"]=w.clk_y)));var k=1,D=2,A=e("meta[name=csrf-token]").attr("content"),E=e("meta[name=csrf-param]").attr("content");E&&A&&(m.extraData=m.extraData||{},m.extraData[E]=A),m.forceSync?o():setTimeout(o,10);var L,M,F,O=50,X=e.parseXML||function(e,t){return window.ActiveXObject?(t=new ActiveXObject("Microsoft.XMLDOM"),t.async="false",t.loadXML(e)):t=(new DOMParser).parseFromString(e,"text/xml"),t&&t.documentElement&&"parsererror"!=t.documentElement.nodeName?t:null},C=e.parseJSON||function(e){return window.eval("("+e+")")},_=function(t,r,a){var n=t.getResponseHeader("content-type")||"",i="xml"===r||!r&&n.indexOf("xml")>=0,o=i?t.responseXML:t.responseText;return i&&"parsererror"===o.documentElement.nodeName&&e.error&&e.error("parsererror"),a&&a.dataFilter&&(o=a.dataFilter(o,r)),"string"==typeof o&&("json"===r||!r&&n.indexOf("json")>=0?o=C(o):("script"===r||!r&&n.indexOf("javascript")>=0)&&e.globalEval(o)),o};return S}if(!this.length)return a("ajaxSubmit: skipping submit process - no element selected"),this;var u,l,c,f=this;"function"==typeof t&&(t={success:t}),u=t.type||this.attr2("method"),l=t.url||this.attr2("action"),c="string"==typeof l?e.trim(l):"",c=c||window.location.href||"",c&&(c=(c.match(/^([^#]+)/)||[])[1]),t=e.extend(!0,{url:c,success:e.ajaxSettings.success,type:u||"GET",iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank"},t);var m={};if(this.trigger("form-pre-serialize",[this,t,m]),m.veto)return a("ajaxSubmit: submit vetoed via form-pre-serialize trigger"),this;if(t.beforeSerialize&&t.beforeSerialize(this,t)===!1)return a("ajaxSubmit: submit aborted via beforeSerialize callback"),this;var p=t.traditional;void 0===p&&(p=e.ajaxSettings.traditional);var d,h=[],v=this.formToArray(t.semantic,h);if(t.data&&(t.extraData=t.data,d=e.param(t.data,p)),t.beforeSubmit&&t.beforeSubmit(v,this,t)===!1)return a("ajaxSubmit: submit aborted via beforeSubmit callback"),this;if(this.trigger("form-submit-validate",[v,this,t,m]),m.veto)return a("ajaxSubmit: submit vetoed via form-submit-validate trigger"),this;var g=e.param(v,p);d&&(g=g?g+"&"+d:d),"GET"==t.type.toUpperCase()?(t.url+=(t.url.indexOf("?")>=0?"&":"?")+g,t.data=null):t.data=g;var x=[];if(t.resetForm&&x.push(function(){f.resetForm()}),t.clearForm&&x.push(function(){f.clearForm(t.includeHidden)}),!t.dataType&&t.target){var b=t.success||function(){};x.push(function(r){var a=t.replaceTarget?"replaceWith":"html";e(t.target)[a](r).each(b,arguments)})}else t.success&&x.push(t.success);if(t.success=function(e,r,a){for(var n=t.context||this,i=0,o=x.length;o>i;i++)x[i].apply(n,[e,r,a||f,f])},t.error){var y=t.error;t.error=function(e,r,a){var n=t.context||this;y.apply(n,[e,r,a,f])}}if(t.complete){var T=t.complete;t.complete=function(e,r){var a=t.context||this;T.apply(a,[e,r,f])}}var j=e('input[type=file]:enabled[value!=""]',this),w=j.length>0,S="multipart/form-data",k=f.attr("enctype")==S||f.attr("encoding")==S,D=n.fileapi&&n.formdata;a("fileAPI :"+D);var A,E=(w||k)&&!D;t.iframe!==!1&&(t.iframe||E)?t.closeKeepAlive?e.get(t.closeKeepAlive,function(){A=s(v)}):A=s(v):A=(w||k)&&D?o(v):e.ajax(t),f.removeData("jqxhr").data("jqxhr",A);for(var L=0;h.length>L;L++)h[L]=null;return this.trigger("form-submit-notify",[this,t]),this},e.fn.ajaxForm=function(n){if(n=n||{},n.delegation=n.delegation&&e.isFunction(e.fn.on),!n.delegation&&0===this.length){var i={s:this.selector,c:this.context};return!e.isReady&&i.s?(a("DOM not ready, queuing ajaxForm"),e(function(){e(i.s,i.c).ajaxForm(n)}),this):(a("terminating; zero elements found by selector"+(e.isReady?"":" (DOM not ready)")),this)}return n.delegation?(e(document).off("submit.form-plugin",this.selector,t).off("click.form-plugin",this.selector,r).on("submit.form-plugin",this.selector,n,t).on("click.form-plugin",this.selector,n,r),this):this.ajaxFormUnbind().bind("submit.form-plugin",n,t).bind("click.form-plugin",n,r)},e.fn.ajaxFormUnbind=function(){return this.unbind("submit.form-plugin click.form-plugin")},e.fn.formToArray=function(t,r){var a=[];if(0===this.length)return a;var i=this[0],o=t?i.getElementsByTagName("*"):i.elements;if(!o)return a;var s,u,l,c,f,m,p;for(s=0,m=o.length;m>s;s++)if(f=o[s],l=f.name,l&&!f.disabled)if(t&&i.clk&&"image"==f.type)i.clk==f&&(a.push({name:l,value:e(f).val(),type:f.type}),a.push({name:l+".x",value:i.clk_x},{name:l+".y",value:i.clk_y}));else if(c=e.fieldValue(f,!0),c&&c.constructor==Array)for(r&&r.push(f),u=0,p=c.length;p>u;u++)a.push({name:l,value:c[u]});else if(n.fileapi&&"file"==f.type){r&&r.push(f);var d=f.files;if(d.length)for(u=0;d.length>u;u++)a.push({name:l,value:d[u],type:f.type});else a.push({name:l,value:"",type:f.type})}else null!==c&&c!==void 0&&(r&&r.push(f),a.push({name:l,value:c,type:f.type,required:f.required}));if(!t&&i.clk){var h=e(i.clk),v=h[0];l=v.name,l&&!v.disabled&&"image"==v.type&&(a.push({name:l,value:h.val()}),a.push({name:l+".x",value:i.clk_x},{name:l+".y",value:i.clk_y}))}return a},e.fn.formSerialize=function(t){return e.param(this.formToArray(t))},e.fn.fieldSerialize=function(t){var r=[];return this.each(function(){var a=this.name;if(a){var n=e.fieldValue(this,t);if(n&&n.constructor==Array)for(var i=0,o=n.length;o>i;i++)r.push({name:a,value:n[i]});else null!==n&&n!==void 0&&r.push({name:this.name,value:n})}}),e.param(r)},e.fn.fieldValue=function(t){for(var r=[],a=0,n=this.length;n>a;a++){var i=this[a],o=e.fieldValue(i,t);null===o||void 0===o||o.constructor==Array&&!o.length||(o.constructor==Array?e.merge(r,o):r.push(o))}return r},e.fieldValue=function(t,r){var a=t.name,n=t.type,i=t.tagName.toLowerCase();if(void 0===r&&(r=!0),r&&(!a||t.disabled||"reset"==n||"button"==n||("checkbox"==n||"radio"==n)&&!t.checked||("submit"==n||"image"==n)&&t.form&&t.form.clk!=t||"select"==i&&-1==t.selectedIndex))return null;if("select"==i){var o=t.selectedIndex;if(0>o)return null;for(var s=[],u=t.options,l="select-one"==n,c=l?o+1:u.length,f=l?o:0;c>f;f++){var m=u[f];if(m.selected){var p=m.value;if(p||(p=m.attributes&&m.attributes.value&&!m.attributes.value.specified?m.text:m.value),l)return p;s.push(p)}}return s}return e(t).val()},e.fn.clearForm=function(t){return this.each(function(){e("input,select,textarea",this).clearFields(t)})},e.fn.clearFields=e.fn.clearInputs=function(t){var r=/^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;return this.each(function(){var a=this.type,n=this.tagName.toLowerCase();r.test(a)||"textarea"==n?this.value="":"checkbox"==a||"radio"==a?this.checked=!1:"select"==n?this.selectedIndex=-1:"file"==a?/MSIE/.test(navigator.userAgent)?e(this).replaceWith(e(this).clone(!0)):e(this).val(""):t&&(t===!0&&/hidden/.test(a)||"string"==typeof t&&e(this).is(t))&&(this.value="")})},e.fn.resetForm=function(){return this.each(function(){("function"==typeof this.reset||"object"==typeof this.reset&&!this.reset.nodeType)&&this.reset()})},e.fn.enable=function(e){return void 0===e&&(e=!0),this.each(function(){this.disabled=!e})},e.fn.selected=function(t){return void 0===t&&(t=!0),this.each(function(){var r=this.type;if("checkbox"==r||"radio"==r)this.checked=t;else if("option"==this.tagName.toLowerCase()){var a=e(this).parent("select");t&&a[0]&&"select-one"==a[0].type&&a.find("option").selected(!1),this.selected=t}})},e.fn.ajaxSubmit.debug=!1})(jQuery);
$(document).ready(function(){
    $('.sign-menu-narrow').on('click', function(){
        $( ".sign-menu" ).slideToggle( "fast");
    });
});




        
// Generated by CoffeeScript 1.6.1
(function() {
  var _this = this,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  window.App = window.App || {};

  App.AbstractErrorizer = (function() {

    function AbstractErrorizer() {}

    AbstractErrorizer.prototype.errorize = function($element, formErrors) {};

    AbstractErrorizer.prototype.clear = function($element) {};

    return AbstractErrorizer;

  })();

  App.FatalErrorizer = {};

  App.FatalErrorizer.Default = (function(_super) {

    __extends(Default, _super);

    function Default(errorizeClass, offsetLeft, offsetTop) {
      var _this = this;
      this.errorizeClass = errorizeClass != null ? errorizeClass : 'errorized-element';
      this.offsetLeft = offsetLeft != null ? offsetLeft : 0;
      this.offsetTop = offsetTop != null ? offsetTop : 0;
      this.clear = function() {
        return Default.prototype.clear.apply(_this, arguments);
      };
    }

    Default.prototype.errorize = function($element, response) {
      if (response && response.error) {
        return this.handleErrorResponse($element, response);
      } else if (typeof response === 'string' && response.search(/Fatal error:/i) !== -1) {
        return this.handleFatalErrorResponse($element, response);
      } else {
        return this.handleUnknownErrorResponse($element, response);
      }
    };

    Default.prototype.handleErrorResponse = function($element, response) {
      var message;
      message = response.error.xhr.status + " " + response.error.xhr.statusText + " " + this.getBasicMessage();
      return this.renderError($element, message);
    };

    Default.prototype.handleFatalErrorResponse = function($element, response) {
      var message;
      message = "An unrecoverable error occurred. " + this.getBasicMessage();
      return this.renderError($element, message);
    };

    Default.prototype.handleUnknownErrorResponse = function($element, response) {
      return this.handleFatalErrorResponse($element, response);
    };

    Default.prototype.getBasicMessage = function() {
      return "<br/> Please refresh your browser and try again. <br />         If the problem persists please inform us about it by contacting our technical support.         ";
    };

    Default.prototype.renderError = function($element, message) {
      var offset;
      offset = $element.offset();
      $('body').append('<div class="' + this.errorizeClass + ' fatal-error" style="top:' + (offset.top + this.offsetTop) + 'px; left:50%; ">' + message + '</div>');
      $('.fatal-error').css('margin-left', '-' + $('.fatal-error').width() / 2 + 'px');
      return $('body').append('<div class="ui-widget-overlay fatal-error-modal" style="width:' + $(document).width() + 'px; height:' + $(document).height() + 'px; "></div>');
    };

    Default.prototype.clear = function() {
      var _this = this;
      return $("." + this.errorizeClass).hide('slow', function() {
        $("." + _this.errorizeClass).remove();
        return $('fatal-error-modal').remove();
      });
    };

    return Default;

  })(App.AbstractErrorizer);

  App.AjaxAbstractLogic = (function() {

    AjaxAbstractLogic.prototype.currentElement = null;

    function AjaxAbstractLogic(selector, loader, errorizers) {
      var _this = this;
      this.selector = selector;
      this.loader = loader;
      this.errorizers = errorizers;
      this.clearErrors = function($element) {
        return AjaxAbstractLogic.prototype.clearErrors.apply(_this, arguments);
      };
      this.displayErrors = function($element, response) {
        return AjaxAbstractLogic.prototype.displayErrors.apply(_this, arguments);
      };
      this.validateAndParseJsonResponse = function(response) {
        return AjaxAbstractLogic.prototype.validateAndParseJsonResponse.apply(_this, arguments);
      };
      this.getConfiguration = function(that) {
        return AjaxAbstractLogic.prototype.getConfiguration.apply(_this, arguments);
      };
      if (!errorizers || !errorizers.length) {
        this.errorizers = [new App.FatalErrorizer.Default];
      } else {
        this.errorizers.push(new App.FatalErrorizer.Default);
      }
      if (!loader) {
        this.loader = new App.AjaxLoader.Default();
      }
    }

    AjaxAbstractLogic.prototype.getConfiguration = function(that) {
      var _this = this;
      if (!that) {
        that = this;
      }
      return {
        success: function(response, statusText, xhr, element) {
          _this.element = element;
          that.element = _this.element;
          that.preHandleResponse(_this.element);
          response = that.validateAndParseJsonResponse(response);
          if (response && response.success) {
            that.handleSuccess(response.success);
            return true;
          } else if (response) {
            that.handleFailure(response, _this.element);
          }
          return false;
        },
        error: function(xhr, ajaxOptions, thrownError) {
          that.preHandleResponse(that.currentElement);
          return that.handleFailure({
            'error': {
              'xhr': xhr,
              'ajaxOptions': ajaxOptions,
              'thrownError': thrownError
            }
          }, that.currentElement);
        },
        beforeSubmit: function(data, $element, options) {
          that.currentElement = $element;
          return that.preSubmit($element);
        }
      };
    };

    AjaxAbstractLogic.prototype.validateAndParseJsonResponse = function(response) {
      var parsedResponse;
      if (!response) {
        this.handleFailure(response, this.element);
      } else if (!response.success && !response.failure) {
        try {
          parsedResponse = $.parseJSON($(response).text());
        } catch (error) {
          this.handleFailure(response, this.element);
        }
        if (!parsedResponse) {
          this.handleFailure(response, this.element);
        } else if (!parsedResponse.success && !parsedResponse.failure) {
          this.handleFailure(parsedResponse, this.element);
        }
        return parsedResponse;
      }
      return response;
    };

    AjaxAbstractLogic.prototype.handleSuccess = function(success) {
      if (success.redirect) {
        window.location.href = success.redirect;
      } else if (success.reload) {
        window.location.reload();
      }
      if (success.content) {
        if (!success.callback) {
          throw "you don't have callback defined in your response";
        }
        try {
          return this[success.callback](success.content);
        } catch (e) {
          if (e instanceof TypeError) {
            throw "you don't have callback method defined!\n" + e;
          } else {
            throw e;
          }
        }
      }
    };

    AjaxAbstractLogic.prototype.handleFailure = function(failure, $element) {
      this.displayErrors($element, failure);
      return false;
    };

    AjaxAbstractLogic.prototype.displayErrors = function($element, response) {
      var errorizer, _i, _len, _ref;
      _ref = this.errorizers;
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        errorizer = _ref[_i];
        if (errorizer.errorize($element, response)) {
          return true;
        }
      }
    };

    AjaxAbstractLogic.prototype.clearErrors = function($element) {
      var errorizer, _i, _len, _ref, _results;
      _ref = this.errorizers;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        errorizer = _ref[_i];
        _results.push(errorizer.clear($element));
      }
      return _results;
    };

    AjaxAbstractLogic.prototype.preSubmit = function($element) {
      return this.loader.start();
    };

    AjaxAbstractLogic.prototype.preHandleResponse = function($element) {
      return this.loader.stop();
    };

    return AjaxAbstractLogic;

  })();

}).call(this);

// Generated by CoffeeScript 1.6.1
(function() {
  var __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  App.AjaxLoader = {};

  App.AjaxLoader.Abstract = (function() {
    var running;

    function Abstract() {}

    running = false;

    Abstract.prototype.start = function() {
      if (!running) {
        running = true;
        return this.onStart();
      }
    };

    Abstract.prototype.stop = function() {
      if (running) {
        this.onStop();
        return running = false;
      }
    };

    Abstract.prototype.isRunning = function() {
      return running;
    };

    return Abstract;

  })();

  App.AjaxLoader.Default = (function(_super) {

    __extends(Default, _super);

    function Default(containerElement, loaderElement) {
      this.containerElement = containerElement != null ? containerElement : '#container';
      this.loaderElement = loaderElement != null ? loaderElement : '<div id="ajax-loader">loading...</div>';
    }

    Default.prototype.onStart = function() {
      return $(this.containerElement).append(this.loaderElement);
    };

    Default.prototype.onStop = function() {
      return $('#' + $(this.loaderElement).attr('id')).remove();
    };

    return Default;

  })(App.AjaxLoader.Abstract);

}).call(this);

// Generated by CoffeeScript 1.6.1
(function() {
  var _this = this,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  App.AjaxForm = {};

  App.AjaxForm.Abstract = (function(_super) {

    __extends(Abstract, _super);

    function Abstract(selector, loader, errorizers) {
      var _this = this;
      this.selector = selector;
      this.loader = loader;
      this.errorizers = errorizers;
      this.getConfiguration = function() {
        return Abstract.prototype.getConfiguration.apply(_this, arguments);
      };
      Abstract.__super__.constructor.call(this, this.selector, this.loader, this.errorizers);
      if (!errorizers) {
        this.errorizers = [new App.FormErrorizer.Default()].concat(this.errorizers);
      }
      $(selector).ajaxForm(this.getConfiguration());
      this.bindSubmitClickHandler();
    }

    Abstract.prototype.getConfiguration = function() {
      var config;
      config = Abstract.__super__.getConfiguration.call(this, this);
      config.delegation = true;
      return config;
    };

    Abstract.prototype.preSubmit = function($form) {
      this.disableSubmits($form);
      return this.loader.start();
    };

    Abstract.prototype.submitButtonClick = function($form, $button) {};

    Abstract.prototype.preHandleResponse = function($form) {
      this.loader.stop();
      this.clearErrors($form);
      return this.enableSubmits($form);
    };

    Abstract.prototype.enableSubmits = function($form) {
      return this.findFormSubmits($form).removeAttr('disabled');
    };

    Abstract.prototype.disableSubmits = function($form) {
      return this.findFormSubmits($form).attr('disabled', 'disabled');
    };

    Abstract.prototype.findFormSubmits = function($form) {
      return $form.find('input[type="image"],input[type="submit"],button');
    };

    Abstract.prototype.bindSubmitClickHandler = function() {
      var self, submitButtons;
      submitButtons = $(this.selector).find('input[type="image"],input[type="submit"],button');
      self = this;
      return $(submitButtons).click(function(event) {
        var $form;
        $form = $(this).closest('form');
        return self.submitButtonClick($form, $(this));
      });
    };

    return Abstract;

  })(App.AjaxAbstractLogic);

  App.AjaxForm.Default = (function(_super) {

    __extends(Default, _super);

    function Default() {
      return Default.__super__.constructor.apply(this, arguments);
    }

    Default.prototype.submitButtonClick = function($form, $button) {
      Default.__super__.submitButtonClick.call(this, $form, $button);
      return this.updateFormAction($form, $button);
    };

    Default.prototype.updateFormAction = function($form, $button) {
      if ($button && $button.data('action')) {
        this.storeFormAction($form);
        return $form.attr('action', $button.data('action'));
      } else {
        return this.restoreFormAction($form);
      }
    };

    Default.prototype.storeFormAction = function($form) {
      if (!$form.data('main-action')) {
        return $form.data('main-action', $form.attr('action'));
      }
    };

    Default.prototype.restoreFormAction = function($form) {
      if ($form.data('main-action')) {
        return $form.attr('action', $form.data('main-action'));
      }
    };

    return Default;

  })(App.AjaxForm.Abstract);

  App.FormErrorizer = {};

  App.FormErrorizer.Default = (function(_super) {
    var getFormName, resolvePath;

    __extends(Default, _super);

    function Default(errorizeClass, messageClass, errorGroupClass) {
      this.errorizeClass = errorizeClass != null ? errorizeClass : 'errorized';
      this.messageClass = messageClass != null ? messageClass : 'error';
      this.errorGroupClass = errorGroupClass != null ? errorGroupClass : 'error-group';
      this.formErrorPosition = 'top';
      this.formErrorFadeOutTime = null;
    }

    Default.prototype.errorize = function($form, response) {
      var formName;
      if (response.failure && response.failure.formErrors) {
        formName = getFormName(response.failure.formErrors);
        if (response.failure.formErrors[formName].errors) {
          this.displayFormErrors($form, response.failure.formErrors[formName].errors);
        }
        if (response.failure.formErrors[formName].childErrors) {
          this._errorizeChildren($form, response.failure.formErrors[formName].childErrors, formName);
        }
        return true;
      } else {
        return false;
      }
    };

    Default.prototype.clear = function($form) {
      return $form.find("." + this.errorizeClass).removeClass("." + this.errorizeClass).filter("." + this.messageClass).remove();
    };

    Default.prototype.displayFormErrors = function($form, messages) {
      var _this = this;
      return $(messages).each(function(i, message) {
        var element;
        element = _this.getErrorElement();
        if (_this.formErrorPosition === 'bottom') {
          $form.append(element.text(message));
        } else {
          $form.prepend(element.text(message));
        }
        if (_this.formErrorFadeOutTime > 0) {
          return element.delay(_this.formErrorFadeOutTime).fadeOut();
        }
      });
    };

    Default.prototype.displayFieldError = function(fieldId, errors) {
      var $field,
        _this = this;
      $field = $('[name^="' + fieldId + '"]').first();
      if ($field.closest("." + this.errorGroupClass).length) {
        $field = $field.closest("." + this.errorGroupClass);
        $field.addClass(this.errorizeClass);
        return $.each(errors, function(i, message) {
          return $field.after(_this.getWrappedError(message));
        });
      } else {
        $field.addClass(this.errorizeClass);
        return $.each(errors, function(i, message) {
          return $field.after(_this.getErrorElement().text(message));
        });
      }
    };

    Default.prototype.getWrappedError = function(message) {
      return this.getErrorElement().text(message);
    };

    Default.prototype.getErrorElement = function() {
      return $('<div/>', {
        'class': "" + this.errorizeClass + " " + this.messageClass
      });
    };

    Default.prototype.setFormErrorPosition = function(formErrorPosition) {
      this.formErrorPosition = formErrorPosition;
    };

    Default.prototype.setFormErrorFadeOutTime = function(formErrorFadeOutTime) {
      this.formErrorFadeOutTime = formErrorFadeOutTime;
    };

    Default.prototype._errorizeChildren = function($form, childErrors, path) {
      var _this = this;
      return $(childErrors).each(function(i, child) {
        return $.each(child, function(inputId, errors) {
          if (errors.errors) {
            if (typeof inputId === 'string') {
              _this.displayFieldError(resolvePath(path, inputId), errors.errors);
            } else {
              _this.displayFormErrors($form, errors.errors);
            }
          }
          if (errors.childErrors) {
            _this._errorizeChildren($form, errors.childErrors, resolvePath(path, inputId));
          }
          if ($.isArray(errors)) {
            return _this.displayFieldError(resolvePath(path, inputId), errors);
          }
        });
      });
    };

    getFormName = function(form) {
      var k, key;
      for (k in form) {
        key = k;
      }
      return key;
    };

    resolvePath = function(path, inputId) {
      return path + '[' + inputId + ']';
    };

    return Default;

  })(App.AbstractErrorizer);

}).call(this);

// Generated by CoffeeScript 1.6.1
(function() {
  var _this = this,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  App.AjaxElement = {};

  App.AjaxElement.Abstract = (function(_super) {

    __extends(Abstract, _super);

    function Abstract(selector, loader, errorizers) {
      var _this = this;
      this.selector = selector;
      this.loader = loader;
      this.errorizers = errorizers;
      this.bind = function(options) {
        return Abstract.prototype.bind.apply(_this, arguments);
      };
      this.getConfiguration = function() {
        return Abstract.prototype.getConfiguration.apply(_this, arguments);
      };
      Abstract.__super__.constructor.call(this, this.selector, this.loader, this.errorizers);
      if (!errorizers) {
        this.errorizers = [new App.ElementErrorizer.Default()].concat(this.errorizers);
      }
      this.currentConfig = this.getConfiguration();
      this.bind(this.currentConfig);
    }

    Abstract.prototype.getConfiguration = function() {
      var options;
      options = {
        type: "post",
        dataType: "html",
        async: true,
        cache: false,
        event: "click"
      };
      return $.extend(Abstract.__super__.getConfiguration.call(this, this), options);
    };

    Abstract.prototype.bind = function(options) {
      var self;
      self = this;
      return $('body').on(options.event, this.selector, function() {
        var _this = this;
        $.ajax({
          url: $(this).attr('href'),
          type: options.type,
          async: options.async,
          cache: options.cache,
          dataType: options.dataType,
          success: function(data, textStatus, jqXHR) {
            try {
              return options.success($.parseJSON(data), textStatus, jqXHR, $(_this));
            } catch (error) {
              return self.handleFailure(data, $(_this));
            }
          },
          beforeSend: function(jqXHR, settings) {
            return options.beforeSubmit(jqXHR, $(_this), settings);
          },
          error: options.error
        });
        return false;
      });
    };

    Abstract.prototype.preSubmit = function($element) {
      if (this.loader.isRunning()) {
        return false;
      }
      return this.loader.start();
    };

    return Abstract;

  })(App.AjaxAbstractLogic);

  App.AjaxElement.Default = (function(_super) {

    __extends(Default, _super);

    function Default() {
      return Default.__super__.constructor.apply(this, arguments);
    }

    return Default;

  })(App.AjaxElement.Abstract);

  App.ElementErrorizer = {};

  App.ElementErrorizer.Default = (function(_super) {

    __extends(Default, _super);

    function Default(errorizeClass, offsetLeft, offsetTop) {
      var _this = this;
      this.errorizeClass = errorizeClass != null ? errorizeClass : 'errorized-element';
      this.offsetLeft = offsetLeft != null ? offsetLeft : 0;
      this.offsetTop = offsetTop != null ? offsetTop : 0;
      this.clear = function() {
        return Default.prototype.clear.apply(_this, arguments);
      };
    }

    Default.prototype.errorize = function($link, response) {
      var offset,
        _this = this;
      if (response.failure) {
        offset = $link.offset();
        $('body').append('<div class="' + this.errorizeClass + '" style="top:' + (offset.top + this.offsetTop) + 'px; left:' + (offset.left + this.offsetLeft) + 'px;">' + response.failure + '</div>');
        $("." + this.errorizeClass).delay(2000).hide('slow', function() {
          return $("." + _this.errorizeClass).remove();
        });
        return true;
      } else {
        return false;
      }
    };

    Default.prototype.clear = function() {
      var _this = this;
      return $("." + this.errorizeClass).hide('slow', function() {
        return $("." + _this.errorizeClass).remove();
      });
    };

    return Default;

  })(App.AbstractErrorizer);

}).call(this);

// Generated by CoffeeScript 1.6.1
(function() {

  new App.AjaxForm.Default('.ajax-form');

}).call(this);
