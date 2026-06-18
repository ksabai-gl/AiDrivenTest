import api from "../common/api";

 const CustomerService = {
  add: (data) => api.post("/business-access/customers",data),
  update: (data) => api.put("/business-access/customers/" + data.id,data),
  show: (id) => api.get("/business-access/customers/" + id),
  list: (data) => api.get(`/business-access/customers`,{
    params: data
  }),
  delete: (data) => api.delete("/business-access/customers/" + data.id,{
    params: data
  }),
  view: () => api.get("/business-access/view/customers"),
};
export default CustomerService;