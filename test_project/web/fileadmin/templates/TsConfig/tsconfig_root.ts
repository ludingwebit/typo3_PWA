config {
linkVars = L
uniqueLinkVars = 1
sys_language_uid = 0
language = de
locale_all = de_DE
}


# Default PAGE object:
page = PAGE
page {
# Allgemeine Seiteneigenschaften setzen
  config.doctype = html5
# Metatags angeben
  meta.author = Paul Luding
  meta.language = de
  meta.description = Dies ist die Beschreibung
  meta.viewport = width=device-width, initial-scale=1
#CSS-datein einfügen
  includeCSS{
    main1 = fileadmin/css/app.css
    main2 = fileadmin/css/mini-dark.min.css
    main2.title = main
    main2.media = all
  }
#JS-datein einfügen
  includeJSFooter{
    main1 = fileadmin/javascript/main.js
    main2 = fileadmin/javascript/app.js
  }

  headerData {
    10 = IMAGE
    10{
      file{
        import =1
        import{
          data = levelmedia:-1,slide
          listNum = 0
          }
        treatIdAsReference = 1
        width = 1920
        }
         sourceCollection{
           small{
             width=1920
             pixelDensity= 1
           }
           big{
             width=1920
             pixelDensity = 2
           }
      }
      layoutKey = cssbg
      layout {
        cssbg{
          element = <style type="text/css">###SOURCECOLLECTION###</style>
          source = @media(min-resolution: ###PIXELDENSITY###dppx),
          (-webkit-min-device-pixel-ratio: ###PIXELDENSITY###)
            { .trailer{background-image:url(###SRC###); }}
          }
        }
      }
    }

# Designvorlage integrieren
10 = FLUIDTEMPLATE
  10{
    file.cObject = CASE
    file.cObject{
        key{
            data = levelfield: -1, backend_layout_next_level, slide
            override.data = TSFE:page|backend_layout
            }
        1 = TEXT
        1.value = fileadmin/templates/vorlage.html

        2 = TEXT
        2.value = fileadmin/templates/vorlage_einspaltig.html

        default < .1
        }
      variables{

      brandLineFirst = TEXT
      brandLineFirst.value = MedienUnternehmen
      brandLineFirst.lang.en = MediaGroup

      brandLineSecond = TEXT
      brandLineSecond.value = Luding, Paul

      brandName = TEXT
      brandName.value = Restaurant webit!
      brandName.params = class="brand-name"
        logo = IMAGE
        logo{
          file = fileadmin/images/logo.jpg
          params = class="logo"
             }      today = TEXT
      today.data = date:d.m.Y

      labelNews = TEXT
      labelNews.value = Aktuelles
      labelNews.lang.en = News

      labelToday = COA_INT
      labelToday{
      10 = TEXT
      10.value = Guten Morgen
      10.lang.en = Good Morning
      10.wrap = |!&nbsp;

      20 = TEXT
      20.value = Heute ist der
      20.lang.en = Today is
      }

      labelMore = TEXT
      labelMore.value = Mehr
      labelMore.lang.en = More

      #Inhalt der Hauptspalte ausgeben
      contentMain = CONTENT
      contentMain{
      table = tt_content
      select.orderBy = sorting
      select.where = colPos=0
      select.languageField = sys_language_uid
      }

      contentMargin = COA
      contentMargin{
      10 < styles.content.get
      10.select.where = colPos=2


      20 < styles.content.get
      20.select.where = colPos=2
      20.select.pidInList = 21
      }

       #Den Inhalt des Trailers auslesen
       contentTrailer < styles.content.get
       contentTrailer.select.where = colPos=5
      contentUserlist = lib.userlist
      contentUserlist = CONTENT
      contentUserlist {
      table = fe_users

      select.orderBy = username


      renderObj = TEXT
      renderObj{
        field = username
        wrap = <br />
        }
      }

      menuBreadcrumb = HMENU
      menuBreadcrumb {
    special = rootline
    special.range = 0|-2

    1 = TMENU
    1 {
        NO.linkWrap =  | »
        CUR = 1
        CUR.linkWrap =  |
        CUR.doNotLinkIt = 1
    }

}

    menuPrimary = HMENU
    menuPrimary {
        special = directory
        special.value = 5

        wrap = <ul class="list-unstyled components">|</ul>

        1 = TMENU
        1 {
        NO = 1
        }
        logo = IMAGE
        logo{
          file = fileadmin/images/logo.jpg
          params = class="logo"
             }
       }

       menuPrimaryMobile = HMENU
       menuPrimaryMobile {
            special = directory
            special.value = 5

            1 = TMENU
            1 {
            NO = 1
            NO.ATagParams = class="footer-link"
            NO{
                 stdWrap.wrap.insertData=1
                 stdWrap.wrap = <span id="menu-item-{field:uid}"><p>|</p></span>
               }
            }


      menuSecondary = HMENU
      menuSecondary{
        special = directory
        special.value = 12
        wrap = <ul>|</ul>
      1 = TMENU
        1{
          NO=1
          NO{
            wrapItemAndSub= <li>|</li>
        }
      }

      logo = IMAGE
      logo{
        file = fileadmin/images/logo.png
        params = class="logo"
      }

      image = IMG_RESOURCE
      image{
        file{
          import=1
          import{
            data = levelmedia:-1,slide
            listNum = 0
            }
          treatIdAsReference = 1
          width = 1920
        }
      }
      sourceCollection{
        small{
          width=200
          srcsetCandidate = 1x
          }
        big{
          width=200
          pixelDensity = 2
          srcsetCandidate=2x
          }
        }
      layoutKey = srcset
      layout{
        srcset{
          element = <img src="###SRC###" srcset="###SOURCECOLLECTION###" ###PARAMS### ###ALTPARAMS###>
          source=|*|###SRC### ###SRCSETCANDIDATE###,|*|###SRC### ###SRCSETCANDIDATE###
          }
        }
      }

      #Den Sprachwechsler darstellen
      language = COA
      language {
      wrap = <div class="btn-group">|</div>
      10 = TEXT
      10{
        value = Sprache
        lang.en = Language
        wrap(
             <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-globee"></i>&nbsp;
                |
                &nbsp;<span class="caret"></span>
            </a>
            )
         }
      20 = HMENU
      20{
      special = language
      special.value = 0,1

      1 = TMENU
      1{
      wrap = <ul class="dropdown-menu dropdown-menu-right">|</ul>

      NO = 1
        NO{
           linkWrap = <li>|</li>
           stdWrap.override = Deutsch|| Englisch

              }
          ACT < .NO
          ACT.linkWrap = <li class="active">|</li>
          }
         }
      }
      }
        }
      }
    }

lib.contentElement {
    partialRootPath{
    10 = fileadmin/templates/content/partials
    }
}

config {
    #prefixLocalAnchors = all
    #simulateStaticDocuments = 0
    #baseURL >
    #tx_realurl_enable = 1

  ### activate RealUrl
  simulateStaticDocuments = 0
  tx_realurl_enable = 1
  baseURL = {$baseurl}
  prefixLocalAnchors = all
  typolinkCheckRootline = 1
  ### remove baseurl, use absolute links instead
  baseURL >
  prefixLocalAnchors >
  absRefPrefix = /
}
#Zeitabhängiger Begrüßungstext
[hour = >10]
page.10.variables.labelToday.10.value = Guten Tag
page.10.variables.labelToday.10.value.lang.en = Good day
[hour = >18]
page.10.variables.labelToday.10.value = Guten Abend
page.10.variables.labelToday.10.value.lang.en = Good Evening

#Mehrsprachigkeit
[globalVar = GP:L=1]
config {
sys_language_uid = 1
language = en
locale_all = en_UK
}
page.10.variables.language{
value = Deutsch
typolink.additionalParams = &L=0
}
page.10.variables.langage.20.1.NO.stdWrap.override = German || English
[global]
