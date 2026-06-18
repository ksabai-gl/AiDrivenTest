import api from "../common/api";

 const PurchaseService = {
  add: (data) => api.post("/business-access/purchases",data),
  show: (id) => api.get("/business-access/purchases/" + id),
  list: (data) => api.get("/business-access/purchases",{
    params: data
  }),
  view: () => api.get("/business-access/view/purchases"),
  update: (data) => api.put("/business-access/purchases/" + data.id,data)
};
export default PurchaseService;