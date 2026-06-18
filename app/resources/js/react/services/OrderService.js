import api from "../common/api";

 const OrderService = {
  add: (data) => api.post("/business-access/orders",data),
  show: (id) => api.get("/business-access/orders/" + id),
  list: (data) => api.get("/business-access/orders",{
    params: data
  }),
  update: (data) => api.put("/business-access/orders/" + data.id,data),
  view: () => api.get("/business-access/view/orders"),
};
export default OrderService;