import api from "../common/api";

 const SupplierService = {
  add: (data) => api.post("/business-access/suppliers",data),
  update: (data) => api.put("/business-access/suppliers/" + data.id,data),
  show: (id) => api.get("/business-access/suppliers/" + id),
  list: (data) => api.get("/business-access/suppliers",{
    params: data
  }),
  view: () => api.get("/business-access/view/suppliers"),
  delete: (data) => api.delete("/business-access/suppliers/"  + data.id,{
    params: data
  }),
};
export default SupplierService;