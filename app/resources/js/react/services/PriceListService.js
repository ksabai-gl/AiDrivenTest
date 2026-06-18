import api from "../common/api";

 const PriceListService = {
  add: (data) => api.post("/business-access/price-lists",data),
  show: (id) => api.get("/business-access/price-lists/" + id),
  list: (data) => api.get("/business-access/price-lists",{
    params: data
  }),
  view: () => api.get("/business-access/view/price-lists"),
  update: (data) => api.put("/business-access/price-lists/" + data.id,data),
  delete: (data) => api.delete("/business-access/price-lists/"  + data.id,{
    params: data
  }),
};
export default PriceListService; 