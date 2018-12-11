
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
}
