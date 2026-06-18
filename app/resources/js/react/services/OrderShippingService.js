import api from "../common/api";

 const OrderShippingService = {
  add: (data) => api.post("/business-access/order-shippings",data),
  update: (data) => api.put("/business-access/order-shippings/" + (data.id ?? data.shipping_id),data),
  show: (data) => api.get("/business-access/order-shippings/" + data.id + '?order_id=' + data.order_id),
  list: (page) => api.get("/business-access/order-shippings?page=" + page),
  view: () => api.get("/business-access/view/order-shippings")
};
export default OrderShippingService;