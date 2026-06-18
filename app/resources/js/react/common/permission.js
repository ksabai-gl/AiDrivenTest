const PERMISSIONS = {
  USER: {
    INDEX: "erp.user.index",
    SHOW: "erp.user.show",
    CREATE: "erp.user.create",
    UPDATE: "erp.user.update",
    DELETE: "erp.user.delete",
  },

  CUSTOMER: {
    INDEX: "erp.customer.index",
    SHOW: "erp.customer.show",
    CREATE: "erp.customer.create",
    UPDATE: "erp.customer.update",
    DELETE: "erp.customer.delete",
    CREATE_ORDER_SHIPPING: "erp.customer.creatordershipping",
  },

  CUSTOMER_GROUP: {
    INDEX: "erp.customergroup.index",
    SHOW: "erp.customergroup.show",
    CREATE: "erp.customergroup.create",
    UPDATE: "erp.customergroup.update",
    DELETE: "erp.customergroup.delete",
  },

  SUPPLIER: {
    INDEX: "erp.supplier.index",
    SHOW: "erp.supplier.show",
    CREATE: "erp.supplier.create",
    UPDATE: "erp.supplier.update",
    DELETE: "erp.supplier.delete",
  },

  PRICE_LIST: {
    INDEX: "erp.pricelist.index",
    SHOW: "erp.pricelist.show",
    CREATE: "erp.pricelist.create",
    UPDATE: "erp.pricelist.update",
    DELETE: "erp.pricelist.delete",
  },

  SHIPPING: {
    INDEX: "erp.shipping.index",
    SHOW: "erp.shipping.show",
    CREATE: "erp.shipping.create",
    UPDATE: "erp.shipping.update",
    DELETE: "erp.shipping.delete",
  },

  ORDER: {
    INDEX: "erp.order.index",
    SHOW: "erp.order.show",
    CREATE: "erp.order.create",
    UPDATE: "erp.order.update",
    DELETE: "erp.order.delete",
    APPROVED: "erp.order.approved",
    CANCELLED: "erp.order.cancelled",
  },

  ORDER_SHIPPING: {
    INDEX: "erp.ordershipping.index",
    SHOW: "erp.ordershipping.show",
    CREATE: "erp.ordershipping.create",
    UPDATE: "erp.ordershipping.update",
    DELETE: "erp.ordershipping.delete",
  },

  ORDER_ITEM: {
    INDEX: "erp.orderitem.index",
    SHOW: "erp.orderitem.show",
    CREATE: "erp.orderitem.create",
    UPDATE: "erp.orderitem.update",
    DELETE: "erp.orderitem.delete",
    COMPLETED: "erp.orderitem.completed",
    SUMMARY: "erp.orderitem.summary",
    CANCELLED: "erp.orderitem.cancelled",
  },

  PRODUCT: {
    INDEX: "erp.product.index",
    SHOW: "erp.product.show",
    CREATE: "erp.product.create",
    UPDATE: "erp.product.update",
    DELETE: "erp.product.delete",
  },

  CATEGORY_PRODUCT: {
    INDEX: "erp.categoryproduct.index",
    SHOW: "erp.categoryproduct.show",
    CREATE: "erp.categoryproduct.create",
    UPDATE: "erp.categoryproduct.update",
    DELETE: "erp.categoryproduct.delete",
  },

  INVENTORY: {
    INDEX: "erp.inventory.index",
    SHOW: "erp.inventory.show",
    CREATE: "erp.inventory.create",
    UPDATE: "erp.inventory.update",
    DELETE: "erp.inventory.delete",
    ADJUSTMENT_CREATE: "erp.inventoryadjustment.create",
  },

  INVOICE_IN: {
    INDEX: "erp.invoicein.index",
    SHOW: "erp.invoicein.show",
    CREATE: "erp.invoicein.create",
    UPDATE: "erp.invoicein.update",
    DELETE: "erp.invoicein.delete",
    CANCELLED: "erp.invoicein.cancelled",
    APPROVED: "erp.invoicein.approved",
  },

  INVOICE_OUT: {
    INDEX: "erp.invoiceout.index",
    SHOW: "erp.invoiceout.show",
    CREATE: "erp.invoiceout.create",
    UPDATE: "erp.invoiceout.update",
    DELETE: "erp.invoiceout.delete",
    UNAPPROVED: "erp.invoiceout.unapproved",
    APPROVED: "erp.invoiceout.approved",
  },

  CUSTOM_INVOICE_OUT: {
    INDEX: "erp.custominvoiceout.index",
    CREATE: "erp.custominvoiceout.create",
    UPDATE: "erp.custominvoiceout.update",
    DELETE: "erp.custominvoiceout.delete",
  },

  CUSTOM_INVOICE_IN: {
    INDEX: "erp.custominvoicein.index",
    CREATE: "erp.custominvoicein.create",
    UPDATE: "erp.custominvoicein.update",
    DELETE: "erp.custominvoicein.delete",
  },

  PURCHASE: {
    INDEX: "erp.purchase.index",
    SHOW: "erp.purchase.show",
    CREATE: "erp.purchase.create",
    UPDATE: "erp.purchase.update",
    DELETE: "erp.purchase.delete",
    CANCELLED: "erp.purchase.cancelled",
    APPROVED: "erp.purchase.approved",
    REQUESTED: "erp.purchase.requested",
  },

  PURCHASE_ITEM: {
    INDEX: "erp.purchaseitem.index",
    SHOW: "erp.purchaseitem.show",
    CREATE: "erp.purchaseitem.create",
    UPDATE: "erp.purchaseitem.update",
    DELETE: "erp.purchaseitem.delete",
  },

  PURCHASE_TAX: {
    CREATE: "erp.purchasetax.create",
  },

  STOCK_IN: {
    INDEX: "erp.stockin.index",
    SHOW: "erp.stockin.show",
    CREATE: "erp.stockin.create",
    UPDATE: "erp.stockin.update",
    DELETE: "erp.stockin.delete",
    CANCELLED: "erp.stockin.cancelled",
    RECEIVED: "erp.stockin.received",
  },

  STOCK_OUT: {
    INDEX: "erp.stockout.index",
    SHOW: "erp.stockout.show",
    CREATE: "erp.stockout.create",
    UPDATE: "erp.stockout.update",
    DELETE: "erp.stockout.delete",
    COMPLETED: "erp.stockout.completed",
    SHIPPED: "erp.stockout.shipped",
  },

  STOCK_MOVEMENT_IN: {
    INDEX: "erp.stockmovementin.index",
    SHOW: "erp.stockmovementin.show",
    CREATE: "erp.stockmovementin.create",
    UPDATE: "erp.stockmovementin.update",
    DELETE: "erp.stockmovementin.delete",
    COMPLETED: "erp.stockmovementin.completed",
  },

  STOCK_MOVEMENT_OUT: {
    INDEX: "erp.stockmovementout.index",
    SHOW: "erp.stockmovementout.show",
    CREATE: "erp.stockmovementout.create",
    UPDATE: "erp.stockmovementout.update",
    DELETE: "erp.stockmovementout.delete",
  },

  WAREHOUSE: {
    INDEX: "erp.warehouse.index",
    SHOW: "erp.warehouse.show",
    CREATE: "erp.warehouse.create",
    UPDATE: "erp.warehouse.update",
    DELETE: "erp.warehouse.delete",
  },

  REPORT: {
    INDEX: "erp.report.index",
    SHOW: "erp.report.show",
  },

  BUSINESS: {
    UPDATE: "erp.business.update",
  },

  NOTIFICATION: {
    INDEX: "erp.notification.index",
    SHOW: "erp.notification.show",
    CREATE: "erp.notification.create",
    UPDATE: "erp.notification.update",
    DELETE: "erp.notification.delete",
    MANY: "erp.notification.many",
  },

  OVERVIEW: {
    INDEX: "erp.overview.index",
  },

  EXTENSION: {
    INDEX: "erp.extension.index",
    CREATE: "erp.extension.create",
    UPDATE: "erp.extension.update",
    DELETE: "erp.extension.delete",
  },
};
export default PERMISSIONS;