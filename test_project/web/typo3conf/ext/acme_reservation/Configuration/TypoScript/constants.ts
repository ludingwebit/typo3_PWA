plugin.tx_acmereservation_reservaciaplugini {
    view {
        # cat=plugin.tx_acmereservation_reservaciaplugini/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:acme_reservation/Resources/Private/Templates/
        # cat=plugin.tx_acmereservation_reservaciaplugini/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:acme_reservation/Resources/Private/Partials/
        # cat=plugin.tx_acmereservation_reservaciaplugini/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:acme_reservation/Resources/Private/Layouts/
    }

    persistence {
        # cat=plugin.tx_acmereservation_reservaciaplugini//a; type=string; label=Default storage PID
        storagePid =
    }

    settings {
        # cat=plugin.tx_app//a; type=string; label=typeNum ANYNAME for AJAX
        typeNumFi = 1421771406
        # cat=plugin.tx_app//b; type=string; label=typeNum OTHERNAME for AJAX
        typeNumSe = 1421771407
        # cat=plugin.tx_app//a; type=string; label=pageUid for AJAX
        pageUid = 1337 // Use your page id where the plugin is set
    }
}

