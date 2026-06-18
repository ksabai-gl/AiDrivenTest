import api from "../common/api";

 const ShippingService = {
  add: (data) => api.post("/business-access/shippings",data),
  update: (data) => api.put("/business-access/shippings/" + data.id,data),
  show: (data) => api.get("/business-access/shippings/",{
    params: data
  }),
  list: (data) => api.get("/business-access/shippings",{
    params: data
  }),
  view: (data) => api.get("/business-access/view/shippings",{
    params: data
  }),
  delete: (data) => api.delete("/business-access/shippings/"  + data.id,{
    params: data
  }),
};
export default ShippingService;