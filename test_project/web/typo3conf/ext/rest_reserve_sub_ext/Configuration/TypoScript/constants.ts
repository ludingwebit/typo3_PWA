
plugin.tx_restreservesubext_reservesub {
    view {
        # cat=plugin.tx_restreservesubext_reservesub/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:rest_reserve_sub_ext/Resources/Private/Templates/
        # cat=plugin.tx_restreservesubext_reservesub/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:rest_reserve_sub_ext/Resources/Private/Partials/
        # cat=plugin.tx_restreservesubext_reservesub/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:rest_reserve_sub_ext/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_restreservesubext_reservesub//a; type=string; label=Default storage PID
        storagePid =
    }
}
