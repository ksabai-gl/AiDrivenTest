import api from "../common/api";
const CustomInvoiceInService = {
  add: (data) => api.post("/business-access/custom-invoice-ins",data),
  show: (id) => api.get("/business-access/custom-invoice-ins/" + id),
  list: (data) => api.get("/business-access/custom-invoice-ins",{
    params: data
  }),
  view: () => api.get("/business-access/view/custom-invoice-ins"),
  update: (data) => api.put("/business-access/custom-invoice-ins/" + data.id,data),
  delete: (data) => api.delete("/business-access/custom-invoice-ins/" 
      + data.id,{
    params: data
  })
};
export default CustomInvoiceInService;
