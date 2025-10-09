<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");


$CFG = require_once("../common/include/incConfig.php");	
require_once("../common/include/incUtil.php");
require_once("../common/include/incUser.php");
?><!DOCTYPE html>
<html>
<head>
    <title>CG CORE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

  <!--css-->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/materialdesignicons/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/vuetify2x.min.css" rel="stylesheet">

  <!--js-->
  <script type="text/javascript" src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/lodash.min.js"></script>
  <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/vue2x.min.js"></script>
  <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/vuetify2x.min.js"></script>
  <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-3.5.1.min.js"></script>

  <style>
    /*
    우측 스크롤 문제 생기는거 해결 auto, hidden 둘다 동작함
    https://stackoverflow.com/questions/46522331/scroll-bar-in-the-main-section-of-a-v-app
    */
    html{
      overflow-y: auto;
    }
  </style>

</head>
<body>

<div id="app">

    <v-app id="inspire">
      <v-navigation-drawer
        v-model="drawer"
        app
        clipped
      >
        <v-list
        expand=true
        dense>
           
          <v-subheader>Menus</v-subheader>

          <!--그냥 메뉴-->
          <div v-for="m in myMenu" :key="m.id">

          <v-list-item v-if="m.submenus.length == 0" link  @click="addTab(m.id,m.nm,m.url);">
            <v-list-item-icon>
            <v-icon>mdi-folder</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>{{m.nm}}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>


          <!--하위메뉴 있는 메뉴폴더 -->
          <v-list-group v-else no-action>
            <template v-slot:activator  @click="addTab(m.id,m.nm,m.url);">
            
              <v-list-item-icon>
                <v-icon>mdi-folder</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title>{{m.nm}}</v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item v-for="s in m.submenus" :key="s.id" link   @click="addTab(s.id,s.nm,s.url);" style="min-height:33px;">
              <v-list-item-content>
                <v-list-item-title>{{s.nm}}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>

          </div>

          </v-list>

      </v-navigation-drawer>
  
      <v-app-bar
        app
        clipped-left
        dense
        v-if="topNavi"
      >
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>CG CORE</v-toolbar-title>

        <v-spacer></v-spacer>
        
        <v-icon @click="goFullScreen" class="pt-0 ma-0 px-1" >{{isFullScreen? 'mdi-fullscreen-exit':'mdi-fullscreen'}}</v-icon>

        <v-switch 
        class="pt-5 pr-2"
        v-model="dark_theme" @change="changeTheme" label="Dark theme"></v-switch>

        <v-switch 
        class="pt-5"
        v-model="topNavi" label="Top navi"></v-switch>

        <v-btn icon>
          <v-badge
            color="green"
            content="6"
            overlap
          >
          <v-icon>mdi-bell</v-icon>
        </v-btn>        
        <v-btn icon @click="location='logout.php'">
          <v-icon>mdi-location-exit</v-icon>
        </v-btn>
      </v-app-bar>
  
      <v-main id="vmain">
        <v-container
          class="pa-0 fill-height"
          fluid 
          v-resize="resizeTabContent"
          id="vcontainer"
        >
        <v-layout
          justify-center
          align-center 
        >
          <v-flex id="vflex" text-xs-center fill-height
          fluid 
          >
            <v-tabs
                dark
                background-color="light-blue darken-2"
                show-arrows
                v-on:change="changeTabs"
                v-model="active_tab"
                next-icon="mdi-arrow-right-bold-box-outline"
                prev-icon="mdi-arrow-left-bold-box-outline"
            >
                <v-tabs-slider color="teal lighten-3"></v-tabs-slider>

                <v-tab
                v-for="i in mytab"
                :key="i.id"
                class="pr-0"
                @click="changeTab(i.id)"
                >
                {{ i.name }}&nbsp;<v-btn icon small @click.prevent="closeTab(i.id)"><v-icon small>fas fa-times</v-icon></v-btn>
                </v-tab>
            </v-tabs>

            <div id="tabContent" class="divTab" ref="refTabContent" 
             style="overflow:hidden;backgroud-color:blue;"></div>


            </v-flex>
        </v-layout>
        
        </v-container>
      </v-main>
    </v-app>

</div>

<script>


new Vue({
  el: '#app',
  vuetify: new Vuetify(),
    props: {
        source: String,
    },

    data: () => ({
        drawer: null,
        myValue: null,
        active_tab : null, //0, 1, 2, 3 ~ 숫자 인덱스 순서임
        mytab : [],
        myMenuTree : [],
        myMenu : [],
        myNotice : [],
        myMenuOpen: ['core'],
        tree: [],
        myMenuActive: [],        
        dark_theme : false,
        topNavi : true,
        isFullScreen : false,
        accessToken : '<?=getAccessToken()?>',
        CFG_RD_URL_MNU_ROOT : '<?=$CFG["CFG_RD_URL_MNU_ROOT"]?>'
    }),

    created () {
        this.$vuetify.theme.dark = this.dark_theme
    },
    watch: {
      topNavi: function (newVal, oldVal){
        alog("watch.topNavi()...............................start");
        this.resizeTabContent();
      },
      drawer: function(newVal, oldVal){
        alog("watch.drawer()...............................start");
        alog("  newVal = " + newVal);
      },
      accessToken: function(newVal, oldVal){
        alog("watch.accessToken()...............................start");
        alog("  newVal = " + newVal);
      },
      active_tab : function(val){
        alog("[watch] active_tab = " + val);
        if(typeof val == 'undefined')return; //탭이 하나도 없으면 처리하지 마세요

        var tId = this.mytab[val].id;
        for(t=0;t<this.mytab.length;t++){
          //alog(t + "   #div-"+ this.mytab[t].id);
          if(this.mytab[t].id == tId){
              this.mytab[t].isdisplay = "";
              //$("#div-"+ this.mytab[t].id).css("display","");
              alog("tId 를 노출 = " + tId);

              $("#div-"+ this.mytab[t].id).css("visibility","visible");
              $("#div-"+ this.mytab[t].id).css("z-index","1");
              //$("#div-"+ this.mytab[t].id).css("top","0px");   
          }else{
              this.mytab[t].isdisplay = "none";
              //$("#div-"+ this.mytab[t].id).css("display","none");

              $("#div-"+ this.mytab[t].id).css("visibility","hidden");
              $("#div-"+ this.mytab[t].id).css("z-index","0");
              //$("#div-"+ this.mytab[t].id).css("top","-5000px");                    
          }
        }

      }
    },
    mounted () {
      alog("vue.mounted()...............................start");
      this.loadMenus();
      this.loadUserInfo();
      this.resizeTabContent();
    },
    methods:{
        treeNodeActive: function(){
          alog("methods.treeNodeActive()...............................start");
          alog(this.myMenuActive);
        },
        goNaviToggle: function(){
          alog("methods.goNaviToggle()...............................start");
          if(!this.topNavi){
            this.topNavi = true;
            this.drawer = true;
          }else{
            this.topNavi = false;
            this.drawer = false;
          }
        },
        /* View in fullscreen */
        goFullScreen: function () {
          alog("methods.goFullScreen()...............................start");
          var elem = document.getElementById("vcontainer");


          if(this.isFullScreen == false){
            //var elem = $("#vmain");
            if (elem.requestFullscreen) {
              alog("requestFullscreen");
              elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) { /* Firefox */
              alog("mozRequestFullScreen");
              elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
              alog("webkitRequestFullscreen");
              elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE/Edge */
              alog("msRequestFullscreen");
              elem.msRequestFullscreen();
            }

            this.isFullScreen = true;
          }else{
            if (document.exitFullscreen) {
              document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { /* Firefox */
              document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
              document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE/Edge */
              document.msExitFullscreen();
            }

            this.isFullScreen = false;
          }

        },
        resizeTabContent: function(){
          //alog("methods.resizeTabContent()...............................start");
          //main이 리사이즈 되면 탭 컨텐츠도 사이즈 변경 ( 탭컨텐츠 = main - header 48 - tabs 48 )

          //$("#vmain").height()
          if(!this.topNavi){
            $("#vcontainer").height(window.innerHeight);
            $("#tabContent").height(window.innerHeight - 48);
            $(".divTab").height(window.innerHeight - 48);
          }else{
            $("#vcontainer").height(window.innerHeight - 48);
            $("#tabContent").height(window.innerHeight - 48 - 48);
            $(".divTab").height(window.innerHeight - 48 - 48);
          }

          
          //alog("window.innerHeight = " + window.innerHeight);
          //alog("vmain.height = "  + $("#vmain").height());
          //alog("vcontainer.height = "  + $("#vcontainer").height());
          //alog("tabContent.height = "  + $("#tabContent").height());

        },
        changeTheme: function(){
          alog("methods.changeTheme()...............................start");
          this.$vuetify.theme.dark = this.dark_theme;
          return !this.dark_theme;
        },
        loadMenus: function(){
          alog("methods.loadTabs()...............................start");          
            var self = this;

            $.getJSON( "bo_main_v3_api.php?CTL=getMenu", function() {
                alog( "success" );
            })
            .done(function(data) {
                alog( "second success" );
                alog(data);
                self.myMenu = data;
            })
            .fail(function() {
                alert( "error" );
            });

        },
        loadUserInfo: function(){
            var self = this;

            $.getJSON( "bo_main_v3_api.php?CTL=getUserInfo", function() {
                alog( "loadUserInfo()......................success" );
            })
            .done(function(data) {
                alog( "loadUserInfo.done()......................success" );
                alog(data);
                //for(i=0;i<data.intro.length;i++){
                  //self.addTab(data.intro[i].PGMID,data.intro[i].MNU_NM,data.intro[i].URL);
                //}
                //self.accessToken = data.accessToken;
            })
            .fail(function() {
                alert( "error" );
            });

        },        
        changeTabs: function(tHref){
            alog("changeTabs().........................start");
            //alog(this);
            //alog("  tHref=" + tHref);

            //alert(tmp);
        },          
        addTab: function(tId,tNm,tUrl2){
            alog("addTab().........................start");

            var tUrl = tUrl2 + "?access_token=" + this.accessToken;

            tJson = {id:tId,name:tNm,link:tUrl,isdisplay:""};

            //이미 추가된 메뉴이면 활성화 시키기
            findIndex = _.findIndex(this.mytab, ['id', tId]);
            //alog("  findIndex = " + findIndex);
            if(findIndex >= 0){
              //선택탭 활성화만 하고 리턴
              this.mytab[findIndex].isdisplay = "";
              this.active_tab = findIndex;

              tId = this.mytab[findIndex].id;
              for(t=0;t<this.mytab.length;t++){
                //alog(t + "   #div-"+ this.mytab[t].id);
                if(this.mytab[t].id == tId){
                    this.mytab[t].isdisplay = "";
                    //$("#div-"+ this.mytab[t].id).css("display","");

                    $("#div-"+ this.mytab[t].id).css("visibility","visible");
                    $("#div-"+ this.mytab[t].id).css("z-index","1");
                    //$("#div-"+ this.mytab[t].id).css("top","0px");   
                }else{
                    this.mytab[t].isdisplay = "none";
                    //$("#div-"+ this.mytab[t].id).css("display","none");

                    $("#div-"+ this.mytab[t].id).css("visibility","hidden");
                    $("#div-"+ this.mytab[t].id).css("z-index","0");
                    //$("#div-"+ this.mytab[t].id).css("top","-5000px");                    
                }
              }


            }else{
              //기존꺼 모두 숨기기
              for(t=0;t<this.mytab.length;t++){
                this.mytab[t].isdisplay = "none";
                //alog("  hidden tabid = #div-" + this.mytab[t].id);
                //$("#div-"+ this.mytab[t].id).css("display","none");

                $("#div-"+ this.mytab[t].id).css("visibility","hidden");
                $("#div-"+ this.mytab[t].id).css("z-index","0");
                //$("#div-"+ this.mytab[t].id).css("top","-5000px");   
              }
              this.mytab[this.mytab.length] = tJson;
              this.active_tab = this.mytab.length - 1;

              //html 생성하기
              var tabContentHeight = $("#tabContent").height();
              //alert(tabContentHeight);

              tmp = '<div class="divTab"  id="div-'  + tId + '"';
              tmp += ' style="overflow:hidden;position:absolute;width:100%;height:' + tabContentHeight + 'px;z-index:1;"><iframe frameborder="0" marginwidth="0" marginheight="0" ';
              tmp += '    style="border:0px;position:relative;border:none;height:100%;width:100%;border-width:0px;border-color:silver;" ';
              tmp += '    scrolling="yes" frameborder="0" id="iframe-' + tId + '" src="' + tUrl + '"> ';
              tmp += '  </iframe>';
              tmp += '</div>';

              $("#tabContent").append( $(tmp) );

            }


            //alog("  active_tab = " + this.active_tab);
        }, 
        changeTab: function(tId){
            alog("changeTab().........................start");
            //alog(this);
            alog("  tId=" + tId);
            //alog("  active_tab = " + this.active_tab);

            //alert(tmp);
        },
        closeTab: function(tId){
            alog("closeTab().........................start ");
            alog("  tId = " + tId);
            //alog("  active_tab = " + this.active_tab);

            var otherActive = "";
            var closeIndex ;
            for(t=0;t<this.mytab.length;t++){

                if(this.mytab[t].id == tId){
                  //this.$refs["ref-" + this.mytab[t].id][0].remove();

                  //활성화 상태
                  closeIndex = t;

                }
            }

            //배열에서 지우기
            $("#div-"+ this.mytab[closeIndex].id).remove(); //오브젝트 삭제
            
            // this.$delete(obj, key)
            if(this.mytab.length > 1){
              if(this.active_tab>0){
                alog("active_tab 1빼기");
                this.active_tab--;
              }else{
                alog("active_tab 동일값 세팅");
                this.active_tab = "0"; //숫자 0으로 세팅시 변화가 없기때문에 문자"0"으로 세팅하기
              }
            }
            Vue.delete(this.mytab, closeIndex);

            
        }
    }
});

function alog(t){
    if(console)console.log(t);
}

$( window ).resize( function() {
  alog("window.resize()......................start");
  // do somthing
  var vflexHeight = $("#vflex").height() - 48;

  $(".divTab").css("height",vflexHeight);

});
$( document ).ready(function() {
  alog("document.ready()......................start");

  var vflexHeight= $("#vflex").height() - 48;

  
  $(".divTab").css("height",vflexHeight);
});

</script>
</body>
</html>
