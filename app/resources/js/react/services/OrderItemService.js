import api from "../common/api";

 const OrderItemService = {
  add: (data) => api.post("/business-access/orderitems",data),
  update: (data) => api.put("/business-access/orderitems/" + data.id,data),
  delete: (data) => api.delete("/business-access/orderitems/"  + data.id,{
    params: data
  }),
  show: (id) => api.get("/business-access/orderitems/" + id),
  list: (data) => api.get("/business-access/orderitems?order_id=",{
    params: data
  }),
  summary: (data) => api.get("/business-access/orderitems?order_id=" 
    + data.order_id 
    + '&summary=1')
};
export default OrderItemService;