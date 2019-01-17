/* less codes */
@bgColor: #f0f0f0;
@themeColor: #ee1981;
@themeColor2: #555;
@typoColor: #29262b;
@themeBackground: #efefef url(../images/bg.png);

.gradient(@color1, @color2){
  background: -moz-linear-gradient(top,  @color1 0%, @color2 100%); /* FF3.6+ */
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,@color1), color-stop(100%,@color2)); /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(top,  @color1 0%,@color2 100%); /* Chrome10+,Safari5.1+ */
  background: -o-linear-gradient(top,  @color1 0%,@color2 100%); /* Opera 11.10+ */
  background: -ms-linear-gradient(top,  @color1 0%,@color2 100%); /* IE10+ */
  background: linear-gradient(to bottom,  @color1 0%,@color2 100%); /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=@color1, endColorstr=@color2,GradientType=0 ); /* IE6-8 */  
}


.shadowMe(@params){
  box-shadow: @params;
  -webkit-box-shadow: @params;
  -moz-box-shadow: @params;
  -o-box-shadow: @params;
  
  /*-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=5, Color='#ccc')";*/
  /*filter: progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=5, Color='#ccc');*/
  /*behavior: url(PIE.htc);*/
}


.borderRadiusMe(@params){
  border-radius: @params;
  -webkit-border-radius: @params;
  -moz-border-radius: @params;
  -o-border-radius: @params;
  
}





      
/* custom css */
#splash {
    background: @themeColor;
    width: 100%;
    height: 120%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 10000;
    
    #splash-content {
        margin: 0 auto;
    }
    img#splash-bg {
        width: 100%;
        height: 100%;
        position: absolute;
        opacity: 0.6;
    }
    img#splash-title,img#splash-footer {
        position: absolute; 
    }
    img#splash-title {
        width: 141px;
        height: 120px;
        top: 50%;
        margin-top: -136px;
        left: 50%;
        margin-left: -70px;
    }
}


#header, #footer{
  /*width: 320px;*/
  color: #fff;
  background: #000000; /* Old browsers */
  .gradient(#555555, #000000);
}

header, #header{
  display: none;
  height: 50px;
  text-shadow: 1px 1px 1px #000;
  position: fixed;
  width: 100%;
  top:0;
  z-index: 999999;
  
  .shadowMe(1px 1px 2px 0px #777);
  
  
  .navigation {
    display: block;
    padding-left: 7px;
    
    
    a {
      display: inline-block;
      width: 19%;
      height: 100%;
      text-align: center;
      height: 50px;
      
      img {
        margin-top: 6px;
        margin-bottom: 2px;
      }
    }
    a.active {
      background: #000000;
    }
    em {
      color: #fff;
      font-style: normal !important;
    }
  }
  
  
}

/* ==============================*/
/* Styles for Contact Page */
/* ==============================*/

.address-container {
  background: #fafafa;
  .shadowMe(1px 1px 5px 0px #444);
  padding: 4%;
  margin: 4%;
  
  iframe {
    width: 100%;
    height: 180px;
    border: none;
  }
  p {
    margin: 0;
    margin-bottom: 5px;
    font-size: 16px;
    
    img {
      width: 16px;
      height: 16px;
      margin-right: 10px;
    }
  }
  a {
    color: @themeColor2 !important;
  }
  
}
.address-container.contact-icon {
  background: #fafafa url(../images/contact.png?) no-repeat 90% 30%;
}
.map-container {
  overflow: hidden;
}


form {
  .form-element {
    margin-bottom: 10px;
    
    label {
      display: block;
      color: #777;
      text-transform: uppercase;
    }
    input, textarea {
      border: 1px solid #ddd;
      border-radius: 0 !important;
      background: none;
      padding: 5px;
      color: #444;
      width: 95%;
      color: @themeColor;
      outline-color: #ccc;
      ::-webkit-input-placeholder {
        color:    #ddd;
      }
      :-moz-placeholder {
        color:    #ddd;
      }
      :-ms-input-placeholder {
        color:    #ddd;
      }
    }
    input.invalid, textarea.invalid {
      border-color: red;
    }
  }
  
}


/* ==============================*/
/* Styles for Portfolio Page */
/* ==============================*/

.pictures {
  padding: 0;
  
  li {
    display: inline-block;
    float: left;
    list-style: none;
    width: 33%;
    
    
    a {
      display: block;
      margin-left: 5px;
      margin-bottom: 5px;
      border: 2px solid #fff;
      overflow: hidden;
    }
    a:hover {
      border-color: @themeColor2;
    }
    img {
      width: 100%;
      height: auto;
      border: none;
    }
  }
}


/* ==============================*/
/* Styles for Blog Page */
/* ==============================*/

.blog-article {
  .shadowMe(1px 1px 9px 0px #444);
  margin-bottom: 20px;
  
  
  .article-header {
    padding: 4%;
    background: rgba(255,255,255,70%);
    border-bottom: 1px solid #bbb;
    
    .title {
      text-transform: uppercase;
      color: @themeColor;
      margin: 0 !important;
    }
    .info {
      color: #666;
      margin: 0 !important;
      
      span {
        color: #aaa;
      }
    }
  }
  .article-body {
    padding: 4%;
    img {
      float: right;
      margin: 0 0 10px 10px;
      width: 128px;
      height: auto;
    }
    img.left {
      float: left;
    }
    img.right {
      float: right;
    }
    .text {
    }
  }
  .article-footer {
    padding: 4%;
    padding-top: 0;
    
    .social {
      margin-top: 3px;
    }
  }
}

/* ==============================*/
/* General Styles */
/* ==============================*/

/* Utility css */
a{
  text-decoration: none;
}

.left{
  float: left;
}
.right{
  float: right;
}
.clear {
  clear: both;
}

.alpha{
  margin-left: 0 !important;
}
.omega{
  margin-right: 0 !important;
}
.hidden {
    display: none;
}



.page-loader {
  text-align: center;
  padding: 100px 0 100px 0;
  border-top: 1px solid lighten(@themeColor, 20%);
  font-family: arial; /* dont use custom google font so text can render faster to show loading message */
  
  p {
    color: @themeColor2;
  }
}

.flexslider, .slider-component {
  margin: 0 auto;
  max-height: 313px;
  overflow: hidden;
  
  .flex-caption {
    padding: 10px;
    margin: 0;
    background: @themeColor2;
    color: #fff;
    opacity: 0.8;
    font-weight: bold;
    margin-top: -33px;
  }
}

  
#footer{
  /*
  position: fixed;
  width: 100%;
  bottom:0;
  */
  height: 23px;
  color: #fff;
  padding: 0 8px;
  font-size: 8px;
  line-height: 23px;
  /*.shadowMe(1px -1px 3px 0px #000);*/
}

html {
    
}
body{

  ::selection {
    background-color: @themeColor; color:#fff;
  }
  ::-moz-selection {
    background-color: @themeColor;
    color:#fff;
  }
  /*font-family: 'Quattrocento', serif;*/
  font-family: 'Source Sans Pro';
  background: @bgColor;
  color: @themeColor;
  font-size: 13px;
  padding: 0px 0 0;
  height: 100%;
  background: @themeBackground !important;
  overflow-y: scroll;
}
body.menu-shown {
  padding-top: 44px;
}
a {
  color: @themeColor;
}

#container {
  margin: 0 auto;
  
  .logo-menu {
    padding: 20px 15px;
/*    .shadowMe(1px 1px 9px 0px #444);*/
    
    h1, h2 {
      text-transform: uppercase;
      margin: 0;
      font-size: 24px;
      line-height: 24px;
      font-weight: normal;
      text-shadow: 1px 1px 2px #fff;
    }
    h2 {
      font-size: 17px;
      line-height: 18px;
      text-transform: none;
      letter-spacing: 1px;
    }
    a#menu-trigger {
      .borderRadiusMe(5px);
      background: #000;
      display: inline-block;
      text-transform: uppercase;
      font-size: 14px;
      margin-top: 3px;
      cursor: pointer;
      border: 1px solid #fff;
    }
    a#menu-trigger:hover {
      color: #fff;
    }
  }
  .page {
    color: @themeColor;
    display: none;

    a {
      color: @themeColor;
    }
    h2 {
      color: #fff;
      background: @themeColor2;
      padding: 5px 15px;
      margin: 0;
      font-weight: normal;
    }
    .page-content {
      padding: 4%;
      color: @typoColor;
      font-size: 14px;
      margin: 0 auto;
      
      h3 {
        color: @themeColor;
        font-weight: normal;
        margin: 5px 0;
        text-shadow: 1px 1px 2px #fff;
      }
      
      .icon-text {
        display: block;
        margin-bottom: 20px;
        min-height: 86px;
      }
      p {
        margin: 0 0 15px 0;
        
        strong {
          color: @themeColor2;
          font-weight: normal;
          display: inline;
          padding-bottom: 3px;
        }
        img.wrap-around {
          float: left;
          background: transparent;
          padding: 10px;
          margin-right: 14px;
        }
      }
    }
    .subpage-header-img-container {
        max-height: 200px;
        overflow: hidden;
    }
    .subpage-header-image {
      width: 100%;
    }
    .divider {
      height: 1px;
      background: #cccccc;
      margin: 12px 0;
      border-bottom: 1px solid #fff;
    }
  }
}
.content{
  margin: 8px;
}



/* ==============================*/
/* Typography Styles for About Page */
/* ==============================*/

.justify {
  text-align: justify;
}
.column-text {
  .two-column-first, .two-column-second {
    width: 45%;
    float: left;
  }
  .two-column-first {
    padding-right: 8px;
  }
  .two-column-second {
    padding-left: 8px;
  }
}

/* Navigable List Styles */
ul.nav-list {
    border-radius: 7px;
    padding: 0;
    overflow: hidden;
    border: 1px solid #ccc;
}
ul.nav-list li {
    margin: 0;
    border-bottom: 1px solid #ccc;
}
ul.nav-list li:last-child {
    border: 0px;
}
ul.nav-list li a {
    background: #FAFAFA;
    padding: 10px;
    display: block;
    color: @themeColor2 !important;
}
ul.nav-list li a:hover {
    background: @themeColor;
    color: #fff !important;
}
ul.nav-list li a span {
    float: right;
    font-family: "monaco";
    font-weight: bold;
    font-size: 14px;
    line-height: 17px;
}

/* Button Styles */
.button {
  display: inline-block;
  padding: 6px 10px;
  .borderRadiusMe(5px);
  text-shadow: 1px 1px 1px #aaa;
}
.button1 {
  .gradient(#fff, darken(#fff, 5%));
  color: @themeColor;
  border: 1px solid #fff;
}
.button1:hover {
  .gradient(darken(#fff, 5%), #fff);
}
.button2 {
  .gradient(lighten(@themeColor, 10%), @themeColor);
  color: #fff !important;
  border: 1px solid @themeColor;
}
.button2:hover {
  .gradient(@themeColor, lighten(@themeColor, 10%));
}

.button3 {
  .gradient(lighten(#000, 30%), #000);
  color: #fff !important;
  border: 1px solid #000;
}
.button3:hover {
  .gradient(#000, lighten(#000, 30%));
}

/* Highlight Styles */
.highlight {
  background-color: @themeColor;
  color: white;
  text-shadow: none;
  margin-top: 5px;
  padding: 1px;
}
.white-highlight {
  background-color: #fff;
  color: @themeColor;
}
.black-highlight {
  background-color: #000;
  color: #fff;
}

/* Table Styles */
table {
    border: 1px solid #d8d8d8;
    margin-bottom: 5px;
}
table td, table th {
    padding: 5px 9px;
    text-align: left;
    font-weight: normal;
}

table.table1 th {
    color: @themeColor;
}
table.table1 td, table.table1 th {
    .gradient(#f3f1f1, #e0dfdf);
}

table.table2 td, table.table2 th {
    background: #F7F4F4;
}
table.table2 th {
    border-bottom: 1px solid #d8d8d8;
}

table.table3 td, table.table3 th {
    background: #F7F4F4;
}
table.table3 th {
    background: @themeColor2;
    color: #fff;
}


/* Bullet Styles */
ul.bullet-1, ul.bullet-2, ul.bullet-3, ul.bullet-4 {padding: 0 0 0 15px;}
ul.bullet-1 li, ul.bullet-2 li, ul.bullet-3 li, ul.bullet-4 li {list-style: none;padding: 0 0 3px 15px;margin: 0 0 5px;background: no-repeat 0 4px;}
ul.bullet-1 li a, ul.bullet-2 li a, ul.bullet-3 li a, ul.bullet-4 li a {font-size: 100%;line-height: 1.7;}
ul.bullet-1 li {background-image: url(../images/bullet1.png);}
ul.bullet-2 li {background-image: url(../images/bullet2.png);}
ul.bullet-3 li {background-image: url(../images/bullet3.png);}
ul.bullet-4 li {background-image: url(../images/bullet4.png);}

/* Notice Styles */
pre  {background: #F9F1ED;border-bottom: 1px solid #DCD7D4;border-right: 1px solid #DCD7D4;color: #AC3400;font-style:italic;overflow: auto;padding: 10px;}
.cssstyle-style1 pre, .cssstyle-style3 pre, .cssstyle-style5 pre {background: #333;border-bottom: 1px solid #3a3a3a;border-right: 1px solid #3a3a3a;color: #bbb;}
.alert, .approved, .attention, .camera, .cart, .doc, .download, .media, .note, .notices {display: block;margin: 0 0 15px 0;background: repeat-x 0 100%;background-color: #FAFCFD;}
.typo-icon {display: block;padding: 8px 10px 0px 36px;margin: 0 0 15px 0;background: no-repeat 10px 12px;}
.alert {color: #D0583F;background-image: url(../images/icons/alert.png);border-bottom: 1px solid #F8C9BB;border-right: 1px solid #F8C9BB;}
.approved {color: #6CB656;background-image: url(../images/icons/approved.png);border-bottom: 1px solid #C1CEC1;border-right: 1px solid #C1CEC1;}
.attention {color: #E1B42F;background-image: url(../images/icons/attention.png);border-bottom: 1px solid #E4E4D5;border-right: 1px solid #E4E4D5;}
.camera {color: #55A0B4;background-image: url(../images/icons/camera.png);border-bottom: 1px solid #C9D5D8;border-right: 1px solid #C9D5D8;}
.cart {color: #559726;background-image: url(../images/icons/cart.png);border-bottom: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;}
.doc {color: #666666;background-image: url(../images/icons/doc.png);border-bottom: 1px solid #E5E5E5;border-right: 1px solid #E5E5E5;}
.download {color: #666666;background-image: url(../images/icons/download.png);border-bottom: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;}
.media {color: #8D79A9;background-image: url(../images/icons/media.png);border-bottom: 1px solid #DBE1E6;border-right: 1px solid #DBE1E6;}
.note {color: #B76F38;background-image: url(../images/icons/note.png);border-bottom: 1px solid #E6DAD2;border-right: 1px solid #E6DAD2;}
.notices {color: #6187B3;background-image: url(../images/icons/notice.png);border-bottom: 1px solid #C7CDDA;border-right: 1px solid #C7CDDA;}
.approved .typo-icon {background-image: url(../images/icons/approved-icon.png);}
.alert .typo-icon {background-image: url(../images/icons/alert-icon.png);}
.attention .typo-icon {background-image: url(../images/icons/attention-icon.png);}
.camera .typo-icon {background-image: url(../images/icons/camera-icon.png);}
.cart .typo-icon {background-image: url(../images/icons/cart-icon.png);}
.doc .typo-icon {background-image: url(../images/icons/doc-icon.png);}
.download .typo-icon {background-image: url(../images/icons/download-icon.png);}
.media .typo-icon {background-image: url(../images/icons/media-icon.png);}
.note .typo-icon {background-image: url(../images/icons/note-icon.png);}
.notices .typo-icon {background-image: url(../images/icons/notice-icon.png);}








/* checkboxes css */
.iPhoneCheckContainer {
  position: relative;
  height: 27px;
  cursor: pointer;
  overflow: hidden; }
  .iPhoneCheckContainer input {
    position: absolute;
    top: 5px;
    left: 30px;
    opacity: 0; }
  .iPhoneCheckContainer label {
    white-space: nowrap;
    font-size: 17px;
    line-height: 17px;
    font-family: "Helvetica Neue", Arial, Helvetica, sans-serif;
    cursor: pointer;
    display: block;
    height: 20px;
    position: absolute;
    width: auto;
    top: 0;
    padding-top: 5px;
    overflow: hidden; }

.iPhoneCheckDisabled {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
  opacity: 0.5; }

label.iPhoneCheckLabelOn {
  color: white;
  background: @themeColor;
  border: 1px solid #aaa;
  border-radius: 4px;
  text-shadow: 0px 0px 2px rgba(0, 0, 0, 0.6);
  left: 0;
  padding-top: 5px; }
  label.iPhoneCheckLabelOn span {
    padding-left: 8px; }
label.iPhoneCheckLabelOff {
  color: #8b8b8b;
  background: #ddd;
  border: 1px solid #aaa;
  border-radius: 4px;
  text-align: right;
  right: 0;
  }
  label.iPhoneCheckLabelOff span {
    padding-right: 8px; }

.iPhoneCheckHandle {
  display: block;
  height: 27px;
  cursor: pointer;
  position: absolute;
  top: 0;
  left: 0;
  width: 0;
  background: url('../images/iphone-style-checkboxes/slider_left.png?1284697268') no-repeat;
  padding-left: 3px; }

.iPhoneCheckHandleRight {
  height: 100%;
  width: 100%;
  padding-right: 3px;
  background: url('../images/iphone-style-checkboxes/slider_right.png?1284697268') no-repeat right 0; }

.iPhoneCheckHandleCenter {
  height: 100%;
  width: 100%;
  background: url('../images/iphone-style-checkboxes/slider_center.png?1284697268'); }

.iOSCheckContainer {
  position: relative;
  height: 27px;
  cursor: pointer;
  overflow: hidden; }
  .iOSCheckContainer input {
    position: absolute;
    top: 5px;
    left: 30px;
    filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
    opacity: 0; }
  .iOSCheckContainer label {
    white-space: nowrap;
    font-size: 17px;
    line-height: 17px;
    font-weight: bold;
    font-family: "Helvetica Neue", Arial, Helvetica, sans-serif;
    cursor: pointer;
    display: block;
    height: 27px;
    position: absolute;
    width: auto;
    top: 0;
    padding-top: 5px;
    overflow: hidden; }
  .iOSCheckContainer, .iOSCheckContainer label {
    user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none; }

.iOSCheckDisabled {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
  opacity: 0.5; }

label.iOSCheckLabelOn {
  color: white;
  background: url('../images/ios-style-checkboxes/on.png?1284697268') no-repeat;
  text-shadow: 0px 0px 2px rgba(0, 0, 0, 0.6);
  left: 0;
  padding-top: 5px; }
  label.iOSCheckLabelOn span {
    padding-left: 8px; }
label.iOSCheckLabelOff {
  color: #8b8b8b;
  background: url('../images/ios-style-checkboxes/off.png?1284697268') no-repeat right 0;
  text-shadow: 0px 0px 2px rgba(255, 255, 255, 0.6);
  text-align: right;
  right: 0; }
  label.iOSCheckLabelOff span {
    padding-right: 8px; }

.iOSCheckHandle {
  display: block;
  height: 27px;
  cursor: pointer;
  position: absolute;
  top: 0;
  left: 0;
  width: 0;
  background: url('../images/ios-style-checkboxes/slider_left.png?1284697268') no-repeat;
  padding-left: 3px; }

.iOSCheckHandleRight {
  height: 100%;
  width: 100%;
  padding-right: 3px;
  background: url('../images/ios-style-checkboxes/slider_right.png?1284697268') no-repeat right 0; }

.iOSCheckHandleCenter {
  height: 100%;
  width: 100%;
  background: url('../images/ios-style-checkboxes/slider_center.png?1284697268'); }
/* checkboxes css end */




/* DEMO PURPOSE CSS - Safe to remove */
.icons-collection {
  padding: 5px;
  background: #000;
  p {
    color: #fff;
    font-size: 9px;
    margin: 5px 0 !important;
    
    a {
      color: #fff;
      text-decoration: underline;
    }
  }
  img {
    width: 32px;
    height: 32px;
  }
}
/* End DEMO PURPOSE CSS */


.pagination {
    background: #f2f2f2;
    padding: 20px;
    margin-bottom: 20px;
}


.pagination a.paginate {
    display: inline-block;
    padding: 0px 9px;
    margin-right: 4px;
    border-radius: 3px;
    border: solid 1px #c0c0c0;
    background: #e9e9e9;
    box-shadow: inset 0px 1px 0px rgba(255,255,255, .8), 0px 1px 3px rgba(0,0,0, .1);
    font-size: .875em;
    font-weight: bold;
    text-decoration: none;
    color: #717171;
    text-shadow: 0px 1px 0px rgba(255,255,255, 1);
}

.pagination a.paginate:hover {
    background: #fefefe;
    background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FEFEFE), to(#f0f0f0));
    background: -moz-linear-gradient(0% 0% 270deg,#FEFEFE, #f0f0f0);
}

.pagination a.current {
    border: none;
    background: #616161;
    box-shadow: inset 0px 0px 8px rgba(0,0,0, .5), 0px 1px 0px rgba(255,255,255, .8);
    color: #f0f0f0;
    text-shadow: 0px 0px 3px rgba(0,0,0, .5);
}

.pagination a.paginate {
    background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#f8f8f8), to(#e9e9e9));
    background: -moz-linear-gradient(0% 0% 270deg,#f8f8f8, #e9e9e9);
}



#sideOrders ul li {
list-style: none;
}

.regular-checkbox {
display: none;
}

.regular-checkbox + label {
background-color: #fafafa;
border: 1px solid #cacece;
box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
padding: 9px;
border-radius: 3px;
display: inline-block;
position: relative;
}

.regular-checkbox + label:active, .regular-checkbox:checked + label:active {
box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
}

.regular-checkbox:checked + label {
background-color: #e9ecee;
border: 1px solid #adb8c0;
box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);
color: #99a1a7;
}

.regular-checkbox:checked + label:after {
content: '\2714';
font-size: 14px;
position: absolute;
top: 0px;
left: 3px;
color: #99a1a7;
}


.big-checkbox + label {
vertical-align: middle;
padding: 18px;
}

.big-checkbox:checked + label:after {
font-size: 28px;
left: 6px;
}
.radio-1 {
width: 193px;
}

.button-holder {
float: left;
}

/* RADIO */

.regular-radio {
display: none;
}

.regular-radio + label {
-webkit-appearance: none;
background-color: #fafafa;
border: 1px solid #cacece;
box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
padding: 9px;
border-radius: 50px;
display: inline-block;
position: relative;
}

.regular-radio:checked + label:after {
content: ' ';
width: 12px;
height: 12px;
border-radius: 50px;
position: absolute;
top: 3px;
background: #99a1a7;
box-shadow: inset 0px 0px 10px rgba(0,0,0,0.3);
text-shadow: 0px;
left: 3px;
font-size: 32px;
}

.regular-radio:checked + label {
background-color: #e9ecee;
color: #99a1a7;
border: 1px solid #adb8c0;
box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1), inset 0px 0px 10px rgba(0,0,0,0.1);
}

.regular-radio + label:active, .regular-radio:checked + label:active {
box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
}

.big-radio + label {
padding: 16px;
}

.big-radio:checked + label:after {
width: 24px;
height: 24px;
left: 4px;
top: 4px;
}