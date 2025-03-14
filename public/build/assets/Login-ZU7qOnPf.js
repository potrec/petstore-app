import{d as k,c as y,g as u,o as n,u as e,k as h,w as o,e as a,r as v,C as B,a as C,j as p,b as r,m as V,t as $,i as S,h as l}from"./app-DumOiAmi.js";import{_}from"./InputError.vue_vue_type_script_setup_true_lang-CTMEPijY.js";import{_ as w}from"./TextLink.vue_vue_type_script_setup_true_lang-BK8xmQc3.js";import{S as j,W as L,c as P,j as q,_ as N}from"./Button.vue_vue_type_script_setup_true_lang-Dstjlrk5.js";import{C as E}from"./check-G6ByUT-W.js";import{_ as c,a as x}from"./Label.vue_vue_type_script_setup_true_lang-pSt1WH4x.js";import{L as R,_ as U}from"./AuthLayout.vue_vue_type_script_setup_true_lang-DRElgG_3.js";import"./createLucideIcon-D4hBZuRw.js";import"./index-DFHyhZyb.js";import"./AppLogoIcon.vue_vue_type_script_setup_true_lang-CZ3H0Q3a.js";const z=k({__name:"Checkbox",props:{defaultChecked:{type:Boolean},checked:{type:[Boolean,String]},disabled:{type:Boolean},required:{type:Boolean},name:{},value:{},id:{},asChild:{type:Boolean},as:{},class:{}},emits:["update:checked"],setup(f,{emit:t}){const m=f,i=t,s=y(()=>{const{class:g,...b}=m;return b}),d=j(s,i);return(g,b)=>(n(),u(e(L),h(e(d),{class:e(P)("peer size-5 shrink-0 rounded-sm border border-input ring-offset-background focus-visible:outline-hidden focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground data-[state=checked]:border-accent-foreground",m.class)}),{default:o(()=>[a(e(q),{class:"flex h-full w-full items-center justify-center text-current"},{default:o(()=>[v(g.$slots,"default",{},()=>[a(e(E),{class:"size-3.5 stroke-[3]"})])]),_:3})]),_:3},16,["class"]))}}),D={key:0,class:"mb-4 text-center text-sm font-medium text-green-600"},F={class:"grid gap-6"},W={class:"grid gap-2"},M={class:"grid gap-2"},T={class:"flex items-center justify-between"},A={class:"flex items-center justify-between",tabindex:3},G={class:"text-center text-sm text-muted-foreground"},se=k({__name:"Login",props:{status:{},canResetPassword:{type:Boolean}},setup(f){const t=B({email:"",password:"",remember:!1}),m=()=>{t.post(route("login"),{onFinish:()=>t.reset("password")})};return(i,s)=>(n(),u(U,{title:"Log in to your account",description:"Enter your email and password below to log in"},{default:o(()=>[a(e(V),{title:"Log in"}),i.status?(n(),C("div",D,$(i.status),1)):p("",!0),r("form",{onSubmit:S(m,["prevent"]),class:"flex flex-col gap-6"},[r("div",F,[r("div",W,[a(e(c),{for:"email"},{default:o(()=>s[3]||(s[3]=[l("Email address")])),_:1}),a(e(x),{id:"email",type:"email",required:"",autofocus:"",tabindex:1,autocomplete:"email",modelValue:e(t).email,"onUpdate:modelValue":s[0]||(s[0]=d=>e(t).email=d),placeholder:"email@example.com"},null,8,["modelValue"]),a(_,{message:e(t).errors.email},null,8,["message"])]),r("div",M,[r("div",T,[a(e(c),{for:"password"},{default:o(()=>s[4]||(s[4]=[l("Password")])),_:1}),i.canResetPassword?(n(),u(w,{key:0,href:i.route("password.request"),class:"text-sm",tabindex:5},{default:o(()=>s[5]||(s[5]=[l(" Forgot password? ")])),_:1},8,["href"])):p("",!0)]),a(e(x),{id:"password",type:"password",required:"",tabindex:2,autocomplete:"current-password",modelValue:e(t).password,"onUpdate:modelValue":s[1]||(s[1]=d=>e(t).password=d),placeholder:"Password"},null,8,["modelValue"]),a(_,{message:e(t).errors.password},null,8,["message"])]),r("div",A,[a(e(c),{for:"remember",class:"flex items-center space-x-3"},{default:o(()=>[a(e(z),{id:"remember",checked:e(t).remember,"onUpdate:checked":s[2]||(s[2]=d=>e(t).remember=d),tabindex:4},null,8,["checked"]),s[6]||(s[6]=r("span",null,"Remember me",-1))]),_:1})]),a(e(N),{type:"submit",class:"mt-4 w-full",tabindex:4,disabled:e(t).processing},{default:o(()=>[e(t).processing?(n(),u(e(R),{key:0,class:"h-4 w-4 animate-spin"})):p("",!0),s[7]||(s[7]=l(" Log in "))]),_:1},8,["disabled"])]),r("div",G,[s[9]||(s[9]=l(" Don't have an account? ")),a(w,{href:i.route("register"),tabindex:5},{default:o(()=>s[8]||(s[8]=[l("Sign up")])),_:1},8,["href"])])],32)]),_:1}))}});export{se as default};
