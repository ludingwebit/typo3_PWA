plugin.tx_acmereservation_reservaciaplugini {
  view {
    templateRootPaths.0 = EXT:acme_reservation/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_acmereservation_reservaciaplugini.view.templateRootPath}
    partialRootPaths.0 = EXT:acme_reservation/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_acmereservation_reservaciaplugini.view.partialRootPath}
    layoutRootPaths.0 = EXT:acme_reservation/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_acmereservation_reservaciaplugini.view.layoutRootPath}
  }

  persistence {
    storagePid = {$plugin.tx_acmereservation_reservaciaplugini.persistence.storagePid}
    #recursive = 1
  }

  features {
    #skipDefaultArguments = 1
    # if set to 1, the enable fields are ignored in BE context
    ignoreAllEnableFieldsInBe = 0
    # Should be on by default, but can be disabled if all action in the plugin are uncached
    requireCHashArgumentForActionArguments = 1
  }

  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }

  settings {
    pageUid = {$plugin.tx_app.settings.pageUid}
  }
}

  lib.AJAXPrototype = PAGE
  lib.AJAXPrototype {
     typeNum = 0
      config {
        disableAllHeaderCode = 1
        additionalHeaders = Content-type:application/html
        xhtml_cleaning = 0
        debug = 0
        no_cache = 1
        admPanel = 0
     }
  }


#Die entsprechenden Felder aus dem Standard Eintrag anpassen.
ANYNAME < lib.AJAXPrototype
ANYNAME {
  typeNum = {$plugin.tx_app.settings.typeNumANY}
  10 < tt_content.list.20.app_pi1
}

OTHERNAME < lib.AJAXPrototype
OTHERNAME {
  typeNum = {$plugin.app.settings.typeNumOTHER}
  config {
    additionalHeaders = Content-Type: application/json
  }

  10 < tt_content.list.20.app_pi2
}

# these classes are only used in auto-generated templates
plugin.tx_acmereservation._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-acme-reservation table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-acme-reservation table th {
        font-weight:bold;
    }

    .tx-acme-reservation table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)
