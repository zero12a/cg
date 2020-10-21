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

        <v-subheader  dense>Menus</v-subheader>

        <v-treeview
        v-model="myMenuTree"
        :open="myMenuOpen"
        :items="myMenu"
        :active="myMenuActive"
        activatable
        item-key="id"
        open-on-click
        @update:active="treeNodeActive"
        dense
        >

        <template v-slot:prepend="{ item, open }">
            <v-icon v-if="item.children">
            {{ open ? 'mdi-folder-open' : 'mdi-folder' }}
            </v-icon>
            <v-icon v-else  @click="addTab(item.id, item.name, item.url)">mdi-file-document-outline
            </v-icon>
        </template>
        <template v-slot:label="{ item, open }">
          <div v-if="!item.url">{{ item.name }}</div>
          <div v-else @click="addTab(item.id, item.name, item.url)">{{ item.name }}</div>
        </template>

        </v-treeview>  


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

          <v-row no-gutters>
            <v-col
              class="light-blue darken-3"
              
              md="auto"
              style="cursor: pointer"
            >
              <v-icon @click="goNaviToggle" class="pt-0 ma-0 px-1" small>mdi-resize</v-icon><br>
              <v-icon @click="goFullScreen" class="pt-0 ma-0 px-1" small>{{isFullScreen? 'mdi-fullscreen-exit':'mdi-fullscreen'}}</v-icon>
            </v-col>
            <v-col

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
            </v-col>

          </v-row>



        
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
            alog(this);
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
              tmp += '    frameborder="0" id="iframe-' + tId + '" src="' + tUrl + '"> ';
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
            //alert(tmp);
        },
        closeTab: function(tId){
            alog("closeTab().........................start ");
            alog("  tId = " + tId);
            //alog("  active_tab = " + this.active_tab);

            var otherActive = "";
            for(t=0;t<this.mytab.length;t++){

                if(this.mytab[t].id == tId){
                  //this.$refs["ref-" + this.mytab[t].id][0].remove();

                  //활성화 상태
                  var isDisplay = this.mytab[t].isdisplay + "";

                  //배열에서 지우기
                  $("#div-"+ this.mytab[t].id).remove(); //오브젝트 삭제

                  this.mytab.splice(t,1);

                  //보여주던 탭이 닫쳤으면 활성화탭 넘겨주기
                  if(isDisplay == "" && this.mytab.length > 0){
                    this.active_tab = 0;//첫번째 탭으로 보내기
                    this.mytab[0].isdisplay = "";
                  }else{
                    //닫힌 탭이 중간이고 우측이 활성화 탭이면 활성화 탭 숫자 1 줄이기
                    if(t < this.active_tab){
                      this.active_tab--;
                    }
                  }
                  if(this.mytab.length>0){
                    //$("#div-"+ this.mytab[this.active_tab].id).css("display","");
                    $("#div-"+ this.mytab[this.active_tab].id).css("visibility","visible");
                    $("#div-"+ this.mytab[this.active_tab].id).css("z-index","1");
                    //$("#div-"+ this.mytab[this.active_tab].id).css("top","0px");
                  }

                }
            }
            
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
