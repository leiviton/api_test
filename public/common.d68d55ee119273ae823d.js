(window.webpackJsonp=window.webpackJsonp||[]).push([[1],{"46/5":function(t,e,o){"use strict";var n=o("TYT/"),r=new n.r("WindowToken","undefined"!=typeof window&&window.document?{providedIn:"root",factory:function(){return window}}:void 0),i=o("K9Ia"),s=o("Valr");o.d(e,"b",(function(){return a})),o.d(e,"a",(function(){return c}));var a=function(){function t(t,e){this.document=t,this.window=e,this.copySubject=new i.a,this.copyResponse$=this.copySubject.asObservable(),this.config={}}return t.prototype.configure=function(t){this.config=t},t.prototype.copy=function(t){if(!this.isSupported||!t)return this.pushCopyResponse({isSuccess:!1,content:t});var e=this.copyFromContent(t);return this.pushCopyResponse(e?{content:t,isSuccess:e}:{isSuccess:!1,content:t})},Object.defineProperty(t.prototype,"isSupported",{get:function(){return!!this.document.queryCommandSupported&&!!this.document.queryCommandSupported("copy")&&!!this.window},enumerable:!0,configurable:!0}),t.prototype.isTargetValid=function(t){if(t instanceof HTMLInputElement||t instanceof HTMLTextAreaElement){if(t.hasAttribute("disabled"))throw new Error('Invalid "target" attribute. Please use "readonly" instead of "disabled" attribute');return!0}throw new Error("Target should be input or textarea")},t.prototype.copyFromInputElement=function(t,e){void 0===e&&(e=!0);try{this.selectTarget(t);var o=this.copyText();return this.clearSelection(e?t:void 0,this.window),o&&this.isCopySuccessInIE11()}catch(n){return!1}},t.prototype.isCopySuccessInIE11=function(){var t=this.window.clipboardData;return!(t&&t.getData&&!t.getData("Text"))},t.prototype.copyFromContent=function(t,e){if(void 0===e&&(e=this.document.body),this.tempTextArea&&!e.contains(this.tempTextArea)&&this.destroy(this.tempTextArea.parentElement),!this.tempTextArea){this.tempTextArea=this.createTempTextArea(this.document,this.window);try{e.appendChild(this.tempTextArea)}catch(n){throw new Error("Container should be a Dom element")}}this.tempTextArea.value=t;var o=this.copyFromInputElement(this.tempTextArea,!1);return this.config.cleanUpAfterCopy&&this.destroy(this.tempTextArea.parentElement),o},t.prototype.destroy=function(t){void 0===t&&(t=this.document.body),this.tempTextArea&&(t.removeChild(this.tempTextArea),this.tempTextArea=void 0)},t.prototype.selectTarget=function(t){return t.select(),t.setSelectionRange(0,t.value.length),t.value.length},t.prototype.copyText=function(){return this.document.execCommand("copy")},t.prototype.clearSelection=function(t,e){t&&t.focus(),e.getSelection().removeAllRanges()},t.prototype.createTempTextArea=function(t,e){var o,n="rtl"===t.documentElement.getAttribute("dir");return(o=t.createElement("textarea")).style.fontSize="12pt",o.style.border="0",o.style.padding="0",o.style.margin="0",o.style.position="absolute",o.style[n?"right":"left"]="-9999px",o.style.top=(e.pageYOffset||t.documentElement.scrollTop)+"px",o.setAttribute("readonly",""),o},t.prototype.pushCopyResponse=function(t){this.copySubject.next(t)},t.prototype.pushCopyReponse=function(t){this.pushCopyResponse(t)},t.ngInjectableDef=Object(n.U)({factory:function(){return new t(Object(n.X)(s.e),Object(n.X)(r,8))},token:t,providedIn:"root"}),t.\u0275fac=function(e){return new(e||t)(n.hc(s.e),n.hc(r,8))},t.\u0275prov=n.Pb({token:t,factory:function(e){return t.\u0275fac(e)},providedIn:"root"}),t}(),c=function(){function t(){}return t.\u0275mod=n.Rb({type:t}),t.\u0275inj=n.Qb({factory:function(e){return new(e||t)},imports:[[s.c]]}),t}()},sJBm:function(t,e,o){var n,r,i;i=this,n=[o("uki+")],void 0===(r=(function(t){return i.returnExportsGlobal=function(t){return function(t,e,o){"use strict";var n={currency:void 0,currencyFormatCallback:void 0,tooltipOffset:{x:0,y:-20},anchorToPoint:!1,appendToBody:!1,class:void 0,pointClass:"ct-point"};function r(t){var e=new RegExp("tooltip-show\\s*","gi");t.className=t.className.replace(e,"").trim()}function i(t,e){return(" "+t.getAttribute("class")+" ").indexOf(" "+e+" ")>-1}o.plugins=o.plugins||{},o.plugins.tooltip=function(s){return s=o.extend({},n,s),function(n){var a=s.pointClass;n instanceof o.Bar?a="ct-bar":n instanceof o.Pie&&(a=n.options.donut?"ct-slice-donut":"ct-slice-pie");var c=n.container,p=c.querySelector(".chartist-tooltip");p||((p=e.createElement("div")).className=s.class?"chartist-tooltip "+s.class:"chartist-tooltip",s.appendToBody?e.body.appendChild(p):c.appendChild(p));var u=p.offsetHeight,l=p.offsetWidth;function f(t,e,o){c.addEventListener(t,(function(t){e&&!i(t.target,e)||o(t)}))}function d(e){var o,n,r=-(l=l||p.offsetWidth)/2+s.tooltipOffset.x,i=-(u=u||p.offsetHeight)+s.tooltipOffset.y;if(s.appendToBody)p.style.top=e.pageY+i+"px",p.style.left=e.pageX+r+"px";else{var a=c.getBoundingClientRect(),f=e.pageX-a.left-t.pageXOffset,d=e.pageY-a.top-t.pageYOffset;!0===s.anchorToPoint&&e.target.x2&&e.target.y2&&(o=parseInt(e.target.x2.baseVal.value),n=parseInt(e.target.y2.baseVal.value)),p.style.top=(n||d)+i+"px",p.style.left=(o||f)+r+"px"}}r(p),f("mouseover",a,(function(t){var r,a=t.target,c="",f=(n instanceof o.Pie?a:a.parentNode)?a.parentNode.getAttribute("ct:meta")||a.parentNode.getAttribute("ct:series-name"):"",h=a.getAttribute("ct:meta")||f||"",y=!!h,m=a.getAttribute("ct:value");if(s.transformTooltipTextFnc&&"function"==typeof s.transformTooltipTextFnc&&(m=s.transformTooltipTextFnc(m)),s.tooltipFnc&&"function"==typeof s.tooltipFnc)c=s.tooltipFnc(h,m);else{if(s.metaIsHTML){var g=e.createElement("textarea");g.innerHTML=h,h=g.value}if(h='<span class="chartist-tooltip-meta">'+h+"</span>",y)c+=h+"<br>";else if(n instanceof o.Pie){var b=function(t,e){do{t=t.nextSibling}while(t&&!i(t,"ct-label"));return t}(a);b&&(c+=((r=b).innerText||r.textContent)+"<br>")}m&&(s.currency&&(m=null!=s.currencyFormatCallback?s.currencyFormatCallback(m,s):s.currency+m.replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g,"$1,")),c+=m='<span class="chartist-tooltip-value">'+m+"</span>")}c&&(p.innerHTML=c,d(t),function(t){i(t,"tooltip-show")||(t.className=t.className+" tooltip-show")}(p),u=p.offsetHeight,l=p.offsetWidth)})),f("mouseout",a,(function(){r(p)})),f("mousemove",null,(function(t){!1===s.anchorToPoint&&d(t)}))}}}(window,document,t),t.plugins.tooltips}(t)}).apply(e,n))||(t.exports=r)}}]);