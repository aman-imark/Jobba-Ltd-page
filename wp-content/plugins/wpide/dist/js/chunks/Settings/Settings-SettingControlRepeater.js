(self.webpackChunkwpide=self.webpackChunkwpide||[]).push([[336],{3380:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>l});n(1539),n(8783),n(3948),n(561),n(9554),n(4747),n(9720);const i={name:"SettingControlRepeater",components:{SettingControl:function(){return n.e(265).then(n.bind(n,8178))}},props:["field","model"],methods:{remove:function(e){this.model.splice(e,1)},add:function(){if("group"===this.field.type){var e=[];Object.entries(this.field.fields).forEach((function(){e.push("")})),this.model.push(e)}else this.model.push("")}}};const l=(0,n(1001).Z)(i,(function(){var e=this,t=e._self._c;return t("div",[e._l(e.model,(function(n,i){return[t("div",{key:i,staticClass:"repeater-row"},[t("SettingControl",{attrs:{module:e.field.module,id:e.field.id,type:e.field.type,label:e.field.label||null,options:e.field.options||null,multiple:e.field.multiple||null,fields:e.field.fields||null,repeater:!1,vindex:i}}),t("a",{staticClass:"repeater-row-remove",attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),e.remove(i)}}},[t("em",{staticClass:"icon ni ni-trash"})])],1)]})),t("a",{staticClass:"repeater-row-add",attrs:{href:"#"},on:{click:function(t){return t.preventDefault(),e.add.apply(null,arguments)}}},[t("em",{staticClass:"icon ni ni-plus-circle"}),e._v(" Add")])],2)}),[],!1,null,"888cea76",null).exports},4699:(e,t,n)=>{var i=n(9781),l=n(1702),r=n(1956),s=n(5656),o=l(n(5296).f),u=l([].push),a=function(e){return function(t){for(var n,l=s(t),a=r(l),d=a.length,c=0,f=[];d>c;)n=a[c++],i&&!o(l,n)||u(f,e?[n,l[n]]:l[n]);return f}};e.exports={entries:a(!0),values:a(!1)}},9720:(e,t,n)=>{var i=n(2109),l=n(4699).entries;i({target:"Object",stat:!0},{entries:function(e){return l(e)}})}}]);