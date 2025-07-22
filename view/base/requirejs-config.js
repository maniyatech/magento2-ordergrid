/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_OrderGrid
 */

var config = {
    map: {
        '*': {
            'ui/template/grid/paging-total':
                'ManiyaTech_OrderGrid/template/grid/paging-total'
        }
    },
    'config': {
        'mixins': {
            'Magento_Ui/js/grid/provider': {
                'ManiyaTech_OrderGrid/js/grid/provider': true
            }
        }
    }
};
