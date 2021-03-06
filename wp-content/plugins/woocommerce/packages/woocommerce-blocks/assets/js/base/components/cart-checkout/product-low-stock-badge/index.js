/**
 * External dependencies
 */
import { __, sprintf } from '@wordpress/i18n';
import PropTypes from 'prop-types';

/**
 * Internal dependencies
 */
import ProductBadge from '../product-badge';

/**
 * Returns a low stock badge.
 */
const ProductLowStockBadge = ( { lowStockRemaining } ) => {
    if (! lowStockRemaining ) {
        return null;
    }

    return (
    <ProductBadge className="wc-block-components-product-low-stock-badge">
    { sprintf(
        /* translators: %d stock amount (number of items in stock for product) */
        __('%d left in stock', 'woocommerce'),
        lowStockRemaining
    ) }
    </ProductBadge>
    );
};

ProductLowStockBadge.propTypes = {
    lowStockRemaining: PropTypes.number,
};

export default ProductLowStockBadge;
